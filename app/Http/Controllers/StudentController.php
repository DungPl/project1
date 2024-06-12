<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //
    public function login()
    {
        // gọi view hiện hị form đăng nhập
        return view('students.login');
    }
    public function post_login(Request $request)
    {
        // code thực hiện đăng nhập
        $login_data = [
            'email' => $request->email,
            'password' => $request->password
            ];
            //dd($login_data);
            $check_login = Auth::guard('student')->attempt($login_data);
            //dd($check_login);
            if(! $check_login){
            return redirect()->back()->with('error','Đăng nhập không thành công vui lòng thử lại');
            }
            return redirect()->route('student.index');
    }
    public function register()
    {
        // gọi view hiện hị form đăng ký
        return view('students.register');
    }
    public function post_register(Request $request)
    {
        // code thực hiện đăng ký
        $rules = [
            'firstname' => 'max:30',
            'lastname' => 'max:30',
            'email' => 'unique:students|max:100',
           
            'phonenumber' => 'max:50',
            'address' => 'max:200',
            'password' => 'min:6|max:12',
            'password_confirmation' => 'same:password',
        ];
        $message = [
            // 'name.required' => 'Vui lòng nhập họ tên'
            'firstname.max'=>'Dộ dài tên không quá 30',
            'lastname.max'=>'Dộ dài  họ không quá 30',
            'email.unique'=>'Email đã tồn tại',
            'email.max'=>'Dộ dài Email không quá 100',
            'phonenumber.max'=>'Dộ dài Số điện thoại không quá 50',
            'address.max'=>'Dộ dài Địa chỉ không quá 200',
            'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu không quá 12 kí tự',
            'password_confirmation.same'=>'Mật khẩu không trùng khớp',

        ];
        $request->validate($rules, $message);
        //dd( $request);
        // Lưu thông in vào bảng customer
        $add = Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'birthday'=>$request->birthday,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => bcrypt($request->password)
        ]);
        // kiểm tra thêm mới thành công hay không
        if (!$add) {
            return redirect()->back()->with('error', 'Đăng ký không thành công vui lòng thử lại');
        }
        return redirect()->route('student.login');
    }

    public function index(){
        
        return view('students.index');
    }
    public function classes(){
        $classes = Classes::select('classes.*', 'classrooms.number', 'classrooms.court','teachers.firstname','teachers.lastname')
        ->join('classrooms', 'classrooms.id', '=', 'classes.classroomId')
        ->join('teachers', 'teachers.id', '=', 'classes.teacherId')
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
        return view('students.classes', compact('classes','dayOfWeekMap'));
    }
    public function classesregister($classId)
    {
        $studentId = Auth::guard('student')->id();

        // Kiểm tra nếu đã đăng ký rồi thì không cho đăng ký lại
        $exists = DB::table('enrollments')
                    ->where('studentId', $studentId)
                    ->where('classesId', $classId)
                    ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký lớp học này.');
        }

        DB::table('enrollments')->insert([
            'studentId' => $studentId,
            'classesId' => $classId,
        ]);
       Attendances::insert([
            'studentId' => $studentId,
            'classesId' => $classId,
            'present' => false, 
        ]);

        return redirect()->back()->with('success', 'Đăng ký lớp học thành công.');
    }
    public function create($classId){
        $studentId = Auth::guard('student')->id();
        $class = DB::table('classes')->where('id', $classId)->first();
        return view('students.absent',compact('studentId','class'));
    }
    public function classesapplied(){
        $classes = DB::table('classes')
    ->select(
        'classes.*',
        'classrooms.number as classroom_number',
        'classrooms.court as classroom_court',
        'teachers.firstname as teacher_firstname',
        'teachers.lastname as teacher_lastname'
    )
    ->join('classrooms', 'classrooms.id', '=', 'classes.classroomId')
    ->join('teachers', 'teachers.id', '=', 'classes.teacherId')
    ->join('enrollments', 'enrollments.classesId', '=', 'classes.id')
    ->where('enrollments.studentId', '=',Auth::guard('student')->id())
    ->get();
    $dayOfWeekMap = [
        2 => 'Thứ hai',
        3 => 'Thứ ba',
        4 => 'Thứ tư',
        5 => 'Thứ năm',
        6 => 'Thứ sáu',
        7 => 'Thứ bảy',
    ];
    return view('students.classes_applied',compact('classes','dayOfWeekMap'));
    }
    public function store(Request $request)
    {
        $class=  Classes::findOrFail($request->classId);
        $classId=$request->classId;
        $studentId = Auth::guard('student')->id();
        if (now()->greaterThan($class->deadline)) {
            return back()->withErrors(['error' => 'Hạn cuối nộp đơn vắng đã qua.']);
        }
    
        // Kiểm tra trạng thái điểm danh
        $attendance = Attendances::where('studentId',  $studentId)
            ->where('classesId', $classId)
            ->whereDate('AttendanceDate', today())
            ->first();
    
        if ($attendance) {
            return back()->withErrors(['error' => 'Không thể sửa đơn sau khi đã điểm danh.']);
        }
        $request->validate([
            'leaveDate' => 'required|date',
            'reason' => 'required|string|max:255',
            'studentId' => 'required|integer',
            'classId' => 'required|integer',
        ]);

        DB::table('absent')->insert([
            'studentId' => $request->studentId,
            'classesId' => $request->classId,
            'leaveDate' => $request->leaveDate,
            'reason' => $request->reason,
        ]);

        return redirect()->route('leave.request', ['classId' => $request->classId])->with('success', 'Leave request submitted successfully.');
    }
}
