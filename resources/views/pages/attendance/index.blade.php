@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance</h1>
    <button id="clockInBtn">Clock In</button>
    <button id="clockOutBtn">Clock Out</button>
    <div id="message"></div>
    <h2>History</h2>
    <ul id="attendanceHistory">
        @foreach($attendances as $attendance)
        <li>
            Date: {{ $attendance->date }} |
            Clock In: {{ $attendance->clock_in }} |
            Clock Out: {{ $attendance->clock_out ?? 'N/A' }}
        </li>
        @endforeach
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#clockInBtn').on('click', function() {
        $.post('{{ route('attendance.clock-in') }}', {
            _token: '{{ csrf_token() }}'
        }, function(data) {
            $('#message').text(data.message);
            location.reload();
        }).fail(function(xhr) {
            $('#message').text(xhr.responseJSON.message);
        });
    });

    $('#clockOutBtn').on('click', function() {
        $.post('{{ route('attendance.clock-out') }}', {
            _token: '{{ csrf_token() }}'
        }, function(data) {
            $('#message').text(data.message);
            location.reload();
        }).fail(function(xhr) {
            $('#message').text(xhr.responseJSON.message);
        });
    });
</script>
@endsection
