<!-- resources/views/pages/attendance/all.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Attendance Records</h1>

    <form method="GET" action="{{ route('attendance.all') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="from_date">From Date</label>
                    <input type="date" id="from_date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="to_date">To Date</label>
                    <input type="date" id="to_date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>
            </div>
            <div class="col-md-3 align-self-center">
                <button type="submit" class="btn btn-primary" style="margin-top:5%">Filter</button>
            </div>
        </div>
    </form>

    <div style="overflow-y: auto; max-height: 80vh;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->clock_in }}</td>
                    <td>{{ $attendance->clock_out ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
