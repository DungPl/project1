<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    //
    public function index()
    {
        $classrooms = DB::table('classrooms')->paginate(3);
        return view('classroom.index', compact('classrooms'));
    }

    public function create()
    {
        return view('classroom.create');
    }
    /**
     * Phương thức store để nhận và lưu dữ liệu vào bảng
     */
    public function store(Request $request)
    {
        // Validate dữ liệu được gửi từ form

        $rules = [
            'number' => 'required:classrooms',
            'court' => 'required:classrooms'
        ];
        $messages = [
            'number.required' => 'Số phòng không để trống',
            'court.required' => 'Toà nhà không để trống',
          
        ];
        $request->validate($rules, $messages);
        // $request->validate([
        //     'number' => 'required|array',
        //     'number.*' => 'integer|min:1|max:500', // Kiểm tra các số phòng phải là số nguyên từ 1 đến 500
        //     'court' => 'required',
        //     'status' => 'required',
        // ]);

        // // Lấy danh sách các số phòng từ dữ liệu form
        // $numbers = $request->input('number');

        // // Thêm các phòng học vào cơ sở dữ liệu
        // foreach ($numbers as $number) {
            DB::table('classrooms')->insert([
                'number' => $request->number,
                'court' => $request->court,
                'status' => $request->status,
            ]);
        // }

        // Chuyển hướng về trang danh sách phòng học
        return redirect()->route('classroom.index');
    }
    public function delete($id)
    {
        DB::table('classrooms')->where('id', $id)->delete(); // return true, false
        return redirect()->route('classroom.index'); // chuyển hướng về danh sách
    }
    public function edit($id)
    {
        /** SELECT * FROM categories WHERE id = $id */
        $classroom = DB::table('classrooms')->find($id);
        /** Gửi dữ liệu qua form edit.blade.php*/
        return view('classroom.edit', compact('classroom'));
    }
    /** Phương thức update để nhận và lưu dữ liệu vào bảng */
    public function update($id, Request $request)
    {
        $rules = [
            'number' => 'required:classrooms'
        ];
        $messages = [
            'number.required' => 'Số phòng không để trống',
            // 'number.unique' => 'Số phòng đã được sử dụng',
        ];
        $request->validate($rules, $messages);
        DB::table('classrooms')->where('id', $id)->update($request->only('number','court', 'status'));
        return redirect()->route('classroom.index'); // chuyển hướng về danh sách
    }
}
