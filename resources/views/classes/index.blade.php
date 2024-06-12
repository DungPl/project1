@extends('layouts.master')
@section('main')
    <div class="container">
        <h1>Danh sách Lớp học </h1>
        <hr>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Phòng học</th>
                    <th>Thời gian bắt đầu - Thời gian kết thúc</th>
                    <th>Ngày học </th>
                    <th>Hạn nộp đơn vắng có phép</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->classcore }}</td>
                        <td><a href="{{ route('classes.students', ['id' => $class->id]) }}">{{ $class->classname }}</td>
                        <td>{{ $class->number }}-{{ $class->court }}</td>
                        <td>{{ $class->timestart }} - {{ $class->endtime }}</td>
                        <td>{{ $dayOfWeekMap[$class->dayOfWeek] }}</td>
                        <td>{{$class->deadline}}</td>
                        <td>
                            <form action="{{ route('classes.delete', $class->id) }}" method="POST">
                                @method('DELETE') @csrf
                                <button class="btn btn-xs btn-danger">Xóa</button>
                                <a href="{{route('classes.edit',$class->id)}}" class="btn btn-xs btnprimary">Sửa</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
