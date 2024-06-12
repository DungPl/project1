@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Sửa phòng {{$classroom->number}} {{$classroom->court}}</h2>
    <form action="{{ route('classroom.update',$classroom->id) }}" method="POST" role="form">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="">Số phòng</label>
            <input class="form-control" name="number" value="{{$classroom->number}}">
        </div>
        <div class="form-group">
            <label for="">Toà nhà</label>
            <input class="form-control" name="court" value="{{$classroom->court}}">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop()
