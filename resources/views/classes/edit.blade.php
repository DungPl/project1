@extends('layouts.master')
@section('main')
    <div class="container">
        <h1>Chỉnh sửa Lớp học</h1>
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
        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="classcore">Mã lớp</label>
                <input type="text" class="form-control" id="classcore" name="classcore" value="{{ old('classcore', $class->classcore) }}" required>
            </div>
            <div class="form-group">
                <label for="classname">Tên lớp</label>
                <input type="text" class="form-control" id="classname" name="classname" value="{{ old('classname', $class->classname) }}" required>
            </div>
            <div class="form-group">
                <label for="classroom">Phòng học</label>
                <select class="form-control" id="classroom" name="classroom" required>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ $classroom->id == $class->classroomId ? 'selected' : '' }}>
                            {{ $classroom->number }} - {{ $classroom->court }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="timestart">Thời gian bắt đầu</label>
                <input type="time" class="form-control" id="timestart" name="timestart" value="{{ old('timestart', $class->timestart) }}" required>
            </div>
            <div class="form-group">
                <label for="endtime">Thời gian kết thúc</label>
                <input type="time" class="form-control" id="endtime" name="endtime" value="{{ old('endtime', $class->endtime) }}" required>
            </div>
            <div class="form-group">
                <label for="dayOfWeek">Ngày học</label>
                <select class="form-control" id="dayOfWeek" name="dayOfWeek" required>
                    <option value="2" {{ $class->dayOfWeek == 2 ? 'selected' : '' }}>Thứ hai</option>
                    <option value="3" {{ $class->dayOfWeek == 3 ? 'selected' : '' }}>Thứ ba</option>
                    <option value="4" {{ $class->dayOfWeek == 4 ? 'selected' : '' }}>Thứ tư</option>
                    <option value="5" {{ $class->dayOfWeek == 5 ? 'selected' : '' }}>Thứ năm</option>
                    <option value="6" {{ $class->dayOfWeek == 6 ? 'selected' : '' }}>Thứ sáu</option>
                    <option value="7" {{ $class->dayOfWeek == 7 ? 'selected' : '' }}>Thứ bảy</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Hạn cuối nộp đơn vắng:</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline"value="{{ old('deadline', $class->deadline) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật Lớp học</button>
        </form>
    </div>
@stop()
