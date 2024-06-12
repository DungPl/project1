@extends('layouts.student')

@section('main')
<div class="container">
    <h1>Danh sách Lớp học </h1>
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
                    <td>{{ $class->lastname }} {{ $class->firstname }}</td>
                    <td>{{ $class->number }}-{{ $class->court }}</td>
                    <td>{{ $class->timestart }} - {{ $class->endtime }}</td>
                    <td>{{ $dayOfWeekMap[$class->dayOfWeek] }}</td>
                    <td>
                        @php
                            $isRegistered = DB::table('enrollments')
                                ->where('studentId', Auth::guard('student')->id())
                                ->where('classesId', $class->id)
                                ->exists();
                        @endphp
                        @if(!$isRegistered)
                            <form action="{{ route('classes.register', $class->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                            </form>
                        @else
                            <span class="text-success">Đã đăng ký</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop