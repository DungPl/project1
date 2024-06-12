<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absent;
use App\Models\Classes;

class AbsentController extends Controller
{
    //
    public function leaveRequests()
    {
        $studentId = Auth::guard('student')->id();

        $absents = Absent::where('studentId', $studentId)->get();

        return view('students.leave_requests', compact('absents'));
    }
    public function withdrawLeave($id)
    {
        $absent = Absent::find($id);

        $absent = Absent::find($id);

        // Kiểm tra quyền sở hữu đơn xin nghỉ của sinh viên
        if ($absent->studentId != Auth::guard('student')->id()) {
            return redirect()->back()->withErrors(['error' => 'Bạn không có quyền rút đơn này.']);
        }

        // Kiểm tra nếu đơn được nộp trong ngày hôm nay
     $absent->delete();
            return redirect()->route('students.leave_requests')->with('success', 'Đã rút đơn xin nghỉ thành công.');
       
    
    }
}
