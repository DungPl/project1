@extends('layouts.master')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $class->className }} - Thống kê điểm danh</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    {{-- <th>Số lần điểm danh</th>
                                    <th>Số lần nghỉ có phép</th>
                                    <th>Số lần nghỉ không phép</th> --}}
                                    <th>Số lần có mặt</th>
                                    <th>Số lần nghỉ có phép</th>
                                    <th>Số lần Vắng</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->birthday }}</td>
                                        <td>{{ $student->gender == '1' ? 'Nam' : 'Nữ' }}</td>
                                        {{-- <td>{{ $student->present_count }}</td>
                                        <td>{{ $student->excused_count }}</td>
                                        <td>{{ $student->unexcused_count }}</td> --}}
                                        <td>{{ $student->present_count }}</td>
                                        <td>{{ $student->excused_count }}</td>
                                        <td>{{ $student->unexcused_count }}</td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
