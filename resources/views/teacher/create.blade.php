@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Thêm giảng viên mới </h2>
    <form action="{{ route('teacher.store') }}" method="POST" role="form">
        @csrf
        <div class="form-group">
            <label for="">Tên giảng viên </label>
            <input class="form-control" name="firstname" placeholder="tên giảng viên  ">
            @error('firstname')
                <small class="help-block text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Họ giảng viên </label>
            <input class="form-control" name="lastname" placeholder="Họ giảng viên  ">
            @error('lastname')
            <small class="help-block text-danger">{{ $message }}</small>
        @enderror
        </div>
        <div class="form-group">
            <label for="">Email </label>
            <input class="form-control" name="email">
            @error('email')
            <small class="help-block text-danger">{{ $message }}</small>
        @enderror
        </div>
        <div class="form-group">
            <label for="">Password </label>
            <input class="form-control" name="password">
            @error('password')
            <small class="help-block text-danger">{{ $message }}</small>
        @enderror
        </div>
        <div class="form-group">
            <label for="">Trạng thái</label>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked>
                    Đi làm+
                </label>
                <label>
                    <input type="radio" name="status" value="0">
                    Nghỉ
                </label>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@stop()
