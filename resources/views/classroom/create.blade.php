@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Thêm phòng mới</h2>
    <form action="{{ route('classroom.store') }}" method="POST" role="form">
        @csrf
        <div class="form-group">
            <label for="">Số phòng</label>
            <input class="form-control" name="number" placeholder="Số phòng">
        </div>
        <div class="form-group">
            <label for="">Toà nhà</label>
            <input class="form-control" name="court" placeholder="Toà nhà D1">
        </div>
        <div class="form-group">
            <label for="">Trạng thái</label>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked>
                   Đã có lớp 
                </label>
                <label>
                    <input type="radio" name="status" value="0">
                    Vắng
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@stop()
