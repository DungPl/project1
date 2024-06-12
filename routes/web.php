<?php

use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AbsentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    //Phương thức post để thực hiện login khi submit form
    Route::post('login', [AdminController::class, 'post_login']);

    Route::middleware(['admin'])->group(function () {

        Route::get('/', function () {
            return view('admin');
        })->name('admin.index');
        Route::get('teacher', [TeacherController::class, 'index'])->name('admin.teacher');
        // GET categorry/create để hiển thị form nhập dữ liệu
        Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
        // POST categorry để nhận dữ liệu khi submit form
        Route::post('teacher', [TeacherController::class, 'store'])->name('teacher.store');

        Route::delete('teacher/{id}', [TeacherController::class, 'delete'])->where(["id" => "[0-9]+"])->name('teacher.delete');

        Route::get('teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');

        Route::put('teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');

        Route::get('classroom', [ClassroomController::class, 'index'])->name('classroom.index');

        Route::get('classroom/create', [ClassroomController::class, 'create'])->name('classroom.create');
        // POST categorry để nhận dữ liệu khi submit form
        Route::post('classroom', [ClassroomController::class, 'store'])->name('classroom.store');

        Route::delete('classroom/{id}', [ClassroomController::class, 'delete'])->where(["id" => "[0-9]+"])->name('classroom.delete');

        Route::get('classroom/{id}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit');

        Route::put('classroom/{id}', [ClassroomController::class, 'update'])->name('classroom.update');
        //Auth::routes();

        //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});
Route::prefix('teacher')->group(function () {
    Route::get('login', [ClassesController::class, 'login'])->name('teacher.login');
    Route::post('login', [ClassesController::class, 'post_login']);
    //Auth::routes();

    Route::middleware(['teacher'])->group(function () {
        Route::get('classes', [ClassesController::class, 'index'])->name('classes.index');
        Route::get('classes/create', [ClassesController::class, 'create'])->name('classes.create');
        Route::post('classes', [ClassesController::class, 'store'])->name('classes.store');
        Route::delete('classes/{id}', [ClassesController::class, 'delete'])->where(['id' => '[0-9]+'])->name('classes.delete');
        Route::get('classes/{id}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
        Route::put('classes/{id}', [ClassesController::class, 'update'])->name('classes.update');

        Route::get('classes/{id}/students', [ClassesController::class, 'getStudents'])->name('classes.students');

        Route::post('/attendance/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');

        // Route cho phương thức absent
        Route::post('/attendance/absent', [AttendanceController::class, 'absent'])->name('attendance.absent');

        Route::post('/attendance/leave', [AttendanceController::class, 'leave'])->name('attendance.leave');

        Route::get('/classes/{classId}/attendance-report', [AttendanceController::class, 'attendanceReport'])->name('attendance.report');
    
    });
});

Route::group(['prefix' => 'student'], function () {
    // Phương thức get hiển thị form login
    Route::get('login', [StudentController::class, 'login'])->name('student.login');
    //Phương thức post để thực hiện login khi submit form
    Route::post('login',  [StudentController::class, 'post_login']);
    //Phương thức get để hiển thị form đăng ký
    Route::get('register', [StudentController::class, 'register'])->name('student.register');
    //Phương thức post để thực hiện đăng ký khi submit form
    Route::post('register', [StudentController::class, 'post_register']);
    //Phương thức get để hiển thị form đăng xuất
    Route::get('logout', [StudentController::class, 'logout'])->name('student.logout');
    Route::middleware(['student'])->group(function () {
        //Phương thức get để hiển thị trang chủ
        Route::get('/', [StudentController::class, 'index'])->name('student.index');

        Route::get('classes', [StudentController::class, 'classes'])->name('student.classes');
        Route::get('classes_applied', [StudentController::class, 'classesapplied'])->name('student.classesapplied');
        Route::post('classes/{id}/register', [StudentController::class, 'classesregister'])->name('classes.register');
        
        Route::get('leave/{classId}',[StudentController::class,'create'])->name('leave.request');
        Route::post('leave/store', [StudentController::class, 'store'])->name('leave_requests.store');
        Route::get('leave-requests', [AbsentController::class, 'leaveRequests'])->name('student.leaveRequests');
        Route::post('withdraw-leave/{id}', [AbsentController::class, 'withdrawLeave'])->where(['id' => '[0-9]+'])->name('leave.withdraw');
        // Route::get('absent/create/{classId}', [AbsentController::class, 'create'])->name('absent.create');
        // Route::post('absent/{classId}', [AbsentController::class, 'store'])->name('absent.store');
    });
});
