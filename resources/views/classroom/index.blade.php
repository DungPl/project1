@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Danh sách Phòng học </h2>
    <table class="table table-bordered">
        <thead>
            <tr>

                <th>Number</th>
                <th>Court</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <!-- cú pháp của blade view -->
            @foreach ($classrooms as $classroom)
                {{-- <tr>
                    @php
                        $courtCount = 0;
                    @endphp
                   @foreach ($classrooms as $classroomCount)
                   @if ($classroomCount->court == $classroom->court)
                       @php
                           $courtCount++;
                       @endphp
                   @endif
               @endforeach --}}
                    <td> {{ $classroom->number }} </td>
                    <td>{{ $classroom->court }}</td>
                    <td>{{ $classroom->status }}</td>
                    <td>
                        <form action="{{ route('classroom.delete', $classroom->id) }}" method="POST">
                            @method('DELETE') @csrf
                            <button class="btn btn-xs btn-danger">Xóa</button>
                            <a href="{{ route('classroom.edit', $classroom->id) }}" class="btn btn-xs btnprimary">Sửa</a>

                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Hiển thị phân trang -->
    {{ $classrooms->links() }}
@stop()
