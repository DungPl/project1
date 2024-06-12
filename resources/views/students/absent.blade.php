@extends('layouts.student')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Submit Leave Request for {{ $class->classname }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('leave_requests.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="studentId" value="{{ $studentId }}">
                            <input type="hidden" name="classId" value="{{ $class->id }}">
                            <div class="form-group">
                                <label for="leave_date">Leave Date</label>
                                <input type="date" name="leaveDate" id="leaveDate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
