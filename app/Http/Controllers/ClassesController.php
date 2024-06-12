<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class ClassesController extends Controller
{
    //
    public function login()
    {
        // gọi view hiện hị form đăng nhập
        return view('teacher.login');
    }
    public function post_login(Request $request)
    {
        //$login_data = $request->only('email','password');
        $login_data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $check_login = Auth::guard('teacher')->attempt($login_data);
        if (!$check_login) {
            return redirect()->back()->with('error', 'Đăng nhập không thành công vui lòng thử lại');
        }
        return redirect()->route('classes.index');
    }
    public function index()
    {
        // $classes = Classes::paginate(15);
        // return view('classes.index',compact('classes'));
        $id = Auth::guard('teacher')->id();

        // Lấy thông tin các lớp học của giáo viên đó
        $classes = Classes::select('classes.*', 'classrooms.number', 'classrooms.court')
            ->join('classrooms', 'classrooms.id', '=', 'classes.classroomId')
            ->join('teachers', 'teachers.id', '=', 'classes.teacherId')
            ->where('classes.teacherId', $id)
            ->get();

        // Xử lý ngày trong tuần để hiển thị
        $dayOfWeekMap = [
            2 => 'Thứ hai',
            3 => 'Thứ ba',
            4 => 'Thứ tư',
            5 => 'Thứ năm',
            6 => 'Thứ sáu',
            7 => 'Thứ bảy',
        ];

        // Hiển thị dữ liệu
        // foreach ($classes as $class) {
        //     // Tùy chỉnh xử lý ngày trong tuần ở đây nếu cần
        //     $dayOfWeek = $dayOfWeekMap[$class->dayOfWeek];
        //     // Hiển thị thông tin của từng lớp học
        //     // Ví dụ: $class->number, $class->court, $class->lastname, $class->firstname, vv.
        // }
        return view('classes.index', compact('classes', 'dayOfWeekMap'));
    }
    public function create()
    {
        // Lấy dữ liệu cần thiết để điền vào form, ví dụ: danh sách phòng học
        // Lấy danh sách các phòng học
        $classrooms = DB::table('classrooms')->select('id', 'number', 'court')->get();
        return view('classes.create', compact('classrooms'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'classname' => 'string|max:255',
            'classroomId' => 'integer|exists:classrooms,id',
            'timestart' => 'date_format:H:i',
            'endtime' => 'date_format:H:i|after:timestart',
            'dayOfWeek' => 'integer|between:2,7',
        ]);

        // Lấy id của giáo viên hiện tại
        $teacherId = Auth::guard('teacher')->id();

        // Tạo lớp học mới
        DB::table('classes')->insert([
            'classname' => $request->classname,
            'classcore' => $request->classcore,
            'classroomId' => $request->classroom,
            'timestart' => $request->timestart,
            'endtime' => $request->endtime,
            'dayOfWeek' => $request->dayOfWeek,
            'teacherId' => $teacherId,
            'deadline'=>$request->deadline,
        ]);

        // Chuyển hướng về trang danh sách lớp học với thông báo thành công
        return redirect()->route('classes.index')->with('success', 'Lớp học đã được tạo thành công.');
    }
    public function delete($id)
    {
        DB::table('classes')->where('id', $id)->delete(); // return true, false
        return redirect()->route('classes.index'); // chuyển hướng về danh sách
    }
    public function edit($id)
    {
        /** SELECT * FROM categories WHERE id = $id */
        $class = DB::table('classes')->find($id);
        /** Gửi dữ liệu qua form edit.blade.php*/
        $classrooms = DB::table('classrooms')->select('id', 'number', 'court')->get();
        return view('classes.edit', compact('class', 'classrooms'));
    }
    /** Phương thức update để nhận và lưu dữ liệu vào bảng */
    public function update($id, Request $request)
    {
        $rules = [
           
            'classname' => 'required|string|max:255',
            'classroom' => 'required|integer|exists:classrooms,id',
            'timestart' => 'required|date_format:H:i',
            'endtime' => 'required|date_format:H:i|after:timestart',
            'dayOfWeek' => 'required|integer|between:2,7'
        ];
        $messages = [

          
            'classname.required' => 'Tên lớp là bắt buộc',
            'classroom.required' => 'Phòng học là bắt buộc',
            'timestart.required' => 'Thời gian bắt đầu là bắt buộc',
            'endtime.required' => 'Thời gian kết thúc là bắt buộc',
            'endtime.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'dayOfWeek.required' => 'Ngày học là bắt buộc',
        ];
        $request->validate($rules, $messages);
        DB::table('classes')->where('id', $id)->update([
            'classcore' => $request->classcore,
            'classname' => $request->classname,
            'classroomId' => $request->classroom,
            'timestart' => $request->timestart,
            'endtime' => $request->endtime,
            'dayOfWeek' => $request->dayOfWeek,
            'deadline'=>$request->deadline
        ]);
        return redirect()->route('classes.index'); // chuyển hướng về danh sách
    }
    public function getStudents($id)
    {
        $students = Student::select('students.*', 'classrooms.court','classrooms.number')
        ->join('attendances', 'attendances.studentId', '=', 'students.id')
        ->join('classes', 'classes.id', '=', 'attendances.classesId')
        ->join('classrooms', 'classrooms.id', '=', 'classes.classroomId')
        ->where('classes.id', $id)
        //->whereDate('attendances.AttendanceDate', today())'attendances.AttendanceDate'
        ->distinct('students.id') 
        ->get();
        //dd($students);
        $class = Classes::findOrFail($id);
        //dd($class);
        
    // Trả về danh sách sinh viên và thông tin về lớp học
    return view('classes.students', compact('students','class'));

    }
    
}
