@extends('layouts.student')

@section('main')
    <div class="container">
        <h1>Chào mừng, {{ Auth::guard('student')->user()->name }}!</h1>
        <p>Đây là trang chủ của bạn. Từ đây, bạn có thể truy cập vào các chức năng chính.</p>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin cá nhân</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Họ tên:</strong>  {{ Auth::guard('student')->user()->lastname }}{{ Auth::guard('student')->user()->firstname }}</p>
                        <p><strong>Email:</strong> {{ Auth::guard('student')->user()->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ Auth::guard('student')->user()->phonenumber }}</p>
                        <p><strong>Địa chỉ:</strong> {{ Auth::guard('student')->user()->address }}</p>
                        <p><strong>Ngày sinh:</strong> {{ Auth::guard('student')->user()->birthday }}</p>
                        <p><strong>Giới tính:</strong> {{ Auth::guard('student')->user()->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                        {{-- <a href="{{ route('students.edit', Auth::guard('student')->user()->id) }}" class="btn btn-primary">Chỉnh sửa thông tin</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Lớp học</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('student.classes') }}" class="btn btn-secondary">Xem danh sách lớp học</a>
                    </div>
                </div>
            </div>
            <!-- Add more sections as needed -->
        </div>
    </div>
@stop
