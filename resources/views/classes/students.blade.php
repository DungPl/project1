@extends('layouts.master')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $class->className }} - Danh sách học sinh - Ngày:
                        {{ now()->format('d/m/Y') }}// Thống kê điểm danh <a href="{{ route('attendance.report', ['classId' => $class->id]) }}">Xem báo cáo</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ và tên</th>

                                    <th>Email</th>

                                    <th>Ngày sinh</th>
                                    <th>Giới tính </th>
                                    <th>Tình trạng điểm danh</th>

                                    <!-- Thêm các cột khác nếu cần -->
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
                                        <td>
                                            @php
                                                $attendanceStatus = 'Chưa điểm danh';
                                                foreach ($student->attendance as $attendance) {
                                                    if ($attendance->AttendanceDate == now()->format('Y-m-d')) {
                                                        if ($attendance->present == '1') {
                                                            $attendanceStatus = 'Đã điểm danh';
                                                        } elseif ($attendance->present == '2') {
                                                            $attendanceStatus = 'Nghỉ có phép';
                                                        } else {
                                                            $attendanceStatus = 'Vắng';
                                                        }
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $attendanceStatus }}
                                        </td>
                                        <!-- Thêm các cột khác nếu cần -->
                                        <td>
                                            @php
                                                $hasNotMarked = true;
                                                foreach ($student->attendance as $attendance) {
                                                        if (
                                                            $attendance->AttendanceDate ==
                                                            now()->format('Y-m-d')
                                                        ) {
                                                            $hasNotMarked = false;
                                                            break;
                                                    }
                                                }
                                            @endphp

                                            @if ($hasNotMarked)
                                                <form
                                                    action="{{ route('attendance.mark', ['student_id' => $student->id, 'class_id' => $class->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Điểm danh</button>
                                                </form>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($hasNotMarked)
                                                <form
                                                    action="{{ route('attendance.absent', ['student_id' => $student->id, 'class_id' => $class->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">Nghỉ có phép</button>
                                                </form>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($hasNotMarked)
                                                <form
                                                    action="{{ route('attendance.leave', ['student_id' => $student->id, 'class_id' => $class->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="excuse" value="true">
                                                    <button type="submit" class="btn btn-danger">Nghỉ vắng</button>
                                                </form>
                                            @endif
                                        </td>
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
