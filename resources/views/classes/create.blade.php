@extends('layouts.master')
@section('main')
    <div class="container">
        <h1>Tạo Lớp học mới</h1>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="classcore">Mã lớp</label>
                <input type="text" class="form-control" id="classcore" name="classcore" required>
            </div>
            <div class="form-group">
                <label for="classname">Tên lớp</label>
                <input type="text" class="form-control" id="classname" name="classname" required>
            </div>
            <div class="form-group">
                <label for="classroom">Phòng học</label>
                <select class="form-control" id="classroom" name="classroom" required>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->number }} - {{ $classroom->court }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="start_time">Thời gian bắt đầu</label>
                <input type="time" class="form-control" id="timestart" name="timestart" required>
            </div>
            <div class="form-group">
                <label for="end_time">Thời gian kết thúc</label>
                <input type="time" class="form-control" id="endtime" name="endtime" required>
            </div>
            <div class="form-group">
                <label for="day_of_week">Ngày học</label>
                <select class="form-control" id="dayOfWeek" name="dayOfWeek" required>
                    <option value="2">Thứ hai</option>
                    <option value="3">Thứ ba</option>
                    <option value="4">Thứ tư</option>
                    <option value="5">Thứ năm</option>
                    <option value="6">Thứ sáu</option>
                    <option value="7">Thứ bảy</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Hạn cuối nộp đơn vắng:</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline">
            </div>
            <button type="submit" class="btn btn-primary">Tạo Lớp học</button>
        </form>
    </div>
@stop()
