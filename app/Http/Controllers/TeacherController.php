<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    //
    public function index()
    {
        $teachers = DB::table('teachers')->paginate(3);
        return view('teacher.index', compact('teachers'));
    }
    public function create()
    {
        return view('teacher.create');
    }
    /**
     * Phương thức store để nhận và lưu dữ liệu vào bảng
     */
    public function store(Request $request)
    {
        // $request->only() lấy dữ liệu từ form giống với $_POST
        //Category::create(); // như lệnh INSERT INTO category
        //DB::table('teachers')->insert($request->only('name','status'));
        $rules = [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|unique:teachers|max:100',
            'password' => 'required|min:6|max:12',
        ];
        $message = [
            // 'name.required' => 'Vui lòng nhập họ tên'
            'firstname.required' => 'Vui lòng nhập họ tên',
            'lastname.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'=>'Độ dài mật khẩu tối thiểu là 6',
            'password.max'=>'Độ dài mật khẩu tối đa là 12'
        ];
        $request->validate($rules, $message);
        // Lưu thông in vào bảng customer
        Teacher::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        // kiểm tra thêm mới thành công hay không
        return redirect()->route('admin.teacher'); // chuyển hướng về danh sách
    }
    /** phương thức edit hiển thị dữ liệu trên form theo id */
    public function edit($id)
    {
        /** SELECT * FROM categories WHERE id = $id */
        $teacher = DB::table('teachers')->find($id);
        /** Gửi dữ liệu qua form edit.blade.php*/
        return view('teacher.edit', compact('teacher'));
    }
    /** Phương thức update để nhận và lưu dữ liệu vào bảng */
    public function update($id, Request $request)
    {
        $rules = [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|unique:teachers|max:100',
            'password' => 'required|min:6|max:12',
        ];
        $messages = [
            'firstname.required' => 'Vui lòng nhập họ tên',
            'lastname.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'=>'Độ dài mật khẩu tối thiểu là 6',
            'password.max'=>'Độ dài mật khẩu tối đa là 12'
        ];
        $request->validate($rules, $messages);
        DB::table('categories')->where('id', $id)->update($request->only('firstname', 'lastanme','status','email',bcrypt('password')));
        return redirect()->route('admin.teacher'); // chuyển hướng về danh sách
    }
}
