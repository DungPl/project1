@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Thêm giảng viên mới </h2>
    <form action="{{ route('teacher.update',$teacher->id) }}" method="POST" role="form">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="">Tên giảng viên </label>
            <input class="form-control" name="firstname" value="{{$teacher->firstname}}">
            @error('firstname')
                <small class="help-block text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Họ giảng viên </label>
            <input class="form-control" name="lastname" value="{{$teacher->lastname}}">
            @error('lastname')
            <small class="help-block text-danger">{{ $message }}</small>
        @enderror
        </div>
        <div class="form-group">
            <label for="">Email </label>
            <input class="form-control" name="email" value="{{$teacher->email}}">
            @error('email')
            <small class="help-block text-danger">{{ $message }}</small>
        @enderror
        </div>
        <div class="form-group">
            <label for="">Password </label>
            <input class="form-control" name="password"value="{{$teacher->password}}">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop()
