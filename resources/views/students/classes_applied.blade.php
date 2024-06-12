@extends('layouts.student')

@section('main')
    <div class="container">
        <h1>Danh sách Lớp học  đã đăng kí </h1>
        <hr>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Giáo viên</th>
                    <th>Phòng học</th>
                    <th>Thời gian bắt đầu - Thời gian kết thúc</th>
                    <th>Ngày học </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->classcore }}</td>
                        <td>{{ $class->classname }}</td>
                        <td>{{ $class->teacher_lastname }} {{ $class->teacher_firstname }}</td>
                        <td>{{ $class->classroom_number }}-{{ $class->classroom_court }}</td>
                        <td>{{ $class->timestart }} - {{ $class->endtime }}</td>
                        <td>{{ $dayOfWeekMap[$class->dayOfWeek] }}</td>
                        <td>
                            @if(now()->lessThan($class->deadline))
                            <a href="{{ route('leave.request', ['classId' => $class->id]) }}" class="btn btn-primary">Nghỉ phép</a>
                            @else
                            <span>Hạn cuối đã qua</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
