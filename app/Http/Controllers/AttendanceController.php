<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\Classes;
use App\Models\Student;

class AttendanceController extends Controller
{
    //
    public function mark(Request $request)
    {
        // Lấy thông tin sinh viên và lớp học từ request
        $studentId = $request->input('student_id');
        $classId = $request->input('class_id');

        // Thực hiện điểm danh bằng cách tạo hoặc cập nhật bản ghi trong bảng Attendance
        Attendances::where('studentId', $studentId)
            ->where('classesId', $classId)
            ->create([
                'studentId' => $studentId,
                'classesId' => $classId,
                'AttendanceDate' => now(),
                'present' => 1
            ]);
        // Chuyển hướng hoặc trả về kết quả phù hợp với ứng dụng của bạn
        return redirect()->back()->with('success', 'Điểm danh thành công!');
    }
    public function absent(Request $request)
    {
        // Lấy thông tin sinh viên và lớp học từ request
        $studentId = $request->input('student_id');
        $classId = $request->input('class_id');

        // Thực hiện điểm danh bằng cách tạo hoặc cập nhật bản ghi trong bảng Attendance
        Attendances::where('studentId', $studentId)
            ->where('classesId', $classId)
            ->create([
                'studentId' => $studentId,
                'classesId' => $classId,
                'AttendanceDate' => now(),
                'present' => 2
            ]);
        // Chuyển hướng hoặc trả về kết quả phù hợp với ứng dụng của bạn
        return redirect()->back()->with('success', 'Điểm danh thành công!');
    }
    public function leave(Request $request)
    {
        // Lấy thông tin sinh viên và lớp học từ request
        $studentId = $request->input('student_id');
        $classId = $request->input('class_id');

        // Thực hiện điểm danh bằng cách tạo hoặc cập nhật bản ghi trong bảng Attendance
        Attendances::where('studentId', $studentId)
            ->where('classesId', $classId)
            ->create([
                'studentId' => $studentId,
                'classesId' => $classId,
                'AttendanceDate' => now(),
                'present' => 0
            ]);
        // Chuyển hướng hoặc trả về kết quả phù hợp với ứng dụng của bạn
        return redirect()->back()->with('success', 'Điểm danh thành công!');
    }
    public function attendanceReport($classId)
    {
        // $students = Student::select('students.id', 'students.firstname', 'students.lastname', 'students.email', 'students.birthday', 'students.gender')
        //     ->withCount([
        //         'attendance as present_count' => function ($query) {
        //             $query->where('present', 1);
        //         },
        //         'attendance as excused_count' => function ($query) {
        //             $query->where('present', 2);
        //         },
        //         'attendance as unexcused_count' => function ($query) {
        //             $query->where('present', 0);
        //         }
        //     ])
        //     ->join('attendances', 'attendances.studentId', '=', 'students.id')
        //     ->join('classes', 'classes.id', '=', 'attendances.classesId')
        //     ->groupBy('students.id', 'students.firstname', 'students.lastname', 'students.email', 'students.birthday', 'students.gender')
        //     ->where('classes.id', $classId)
        //     ->get();
        $students = Student::select('students.id', 'students.firstname', 'students.lastname', 'students.email', 'students.birthday', 'students.gender')

            ->join('attendances', 'attendances.studentId', '=', 'students.id')
            ->join('classes', 'classes.id', '=', 'attendances.classesId')
            ->groupBy('students.id', 'students.firstname', 'students.lastname', 'students.email', 'students.birthday', 'students.gender')
            ->where('classes.id', $classId)
            ->with(['attendance' => function ($query) use ($classId) {
                $query->where('classesId', $classId);
            }])
            ->get()
            ->map(function ($student) {
                $presentCount = 0; //điểm danh 
                $excusedCount = 0; //nghỉ phép
                $unexcusedCount = 0; //vắng

                foreach ($student->attendance as $attendance) {
                    if ($attendance->present == 1) {
                        $presentCount++;
                    } elseif ($attendance->present == 2) {
                        $excusedCount++;
                    } else {
                        $unexcusedCount++;
                    }
                }

                // Convert 2 excused absences into 1 unexcused absence
                if ($excusedCount >= 2) {

                    $unexcusedCount = $unexcusedCount + intdiv($excusedCount, 2);
                    $excusedCount  -= 2;
                }
                $student->present_count = $presentCount;
                $student->excused_count = $excusedCount;
                $student->unexcused_count = $unexcusedCount;

                return $student;
            });
        $class = Classes::findOrFail($classId);
        return view('classes.attendreport', compact('students', 'class'));
    }
   
}
