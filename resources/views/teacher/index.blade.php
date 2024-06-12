@extends('Admin.master') <!-- Kế thừa master.blade.php -->
@section('main')
    <h2>Danh sách Giảng viên</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>Email</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <!-- cú pháp của blade view -->
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td> {{ $teacher->lastname }} {{ $teacher->firstname }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->status }}</td>
                    <td>
                        <form action="{{ route('teacher.delete', $teacher->id) }}" method="POST">
                            @method('DELETE') @csrf
                            <button class="btn btn-xs btn-danger">Xóa</button>
                            <a href="{{route('teacher.edit',$teacher->id)}}" class="btn btn-xs btnprimary">Sửa</a>

                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Hiển thị phân trang -->
    {{ $teachers->links() }}
@stop()
