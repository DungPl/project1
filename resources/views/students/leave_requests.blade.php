@extends('layouts.student')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Danh sách đơn xin nghỉ</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lớp học</th>
                                    <th>Ngày nghỉ</th>
                                    <th>Lý do</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absents as $absent)
                                    <tr>
                                        <td>{{ $absent->id }}</td>
                                        <td>{{ $absent->class->classname }}</td>
                                        <td>{{ $absent->leaveDate }}</td>
                                        <td>{{ $absent->reason }}</td>
                                        <td>
                                            @php
                                            $currentDateTime = now();
                                            
                                            $deadlineDateTime = \Carbon\Carbon::parse($absent->class->deadline);
                                        @endphp
                                        @if ($currentDateTime < $deadlineDateTime)
                                            {{-- @if ($absent->leaveDate == now()->format('Y-m-d') && now()->format('H:i') <= $absent->class->deadline) --}}
                                                <form action="{{ route('leave.withdraw',$absent->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    {{-- <input type="hidden" name="absent_id" value="{{  }}"> --}}
                                                    <button type="submit" class="btn btn-sm btn-danger">Rút đơn xin nghỉ</button>
                                                </form>
                                            @else
                                                Không thể rút đơn
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
