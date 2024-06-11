@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance History</h1>
    {{-- <button id="clockInBtn" class="btn btn-primary">Clock In</button>
    <button id="clockOutBtn" class="btn btn-secondary">Clock Out</button> --}}
    <div id="message" class="mt-3"></div>
    {{-- <h2>History</h2> --}}
    <div style="overflow-y: auto; max-height: 80vh;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td data-time="{{ $attendance->clock_in }}">{{ $attendance->clock_in }}</td>
                    <td data-time="{{ $attendance->clock_out }}">{{ $attendance->clock_out ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    function convertToLocalTime(isoString) {
        if (!isoString) return 'N/A';
        const date = new Date(isoString);
        return date.toLocaleString();
    }

    $(document).ready(function() {
        $('td[data-time]').each(function() {
            const isoString = $(this).data('time');
            $(this).text(convertToLocalTime(isoString));
        });

        $('#clockInBtn').on('click', function() {
            const localTime = new Date().toISOString();
            $.post('{{ route('attendance.clock-in') }}', {
                _token: '{{ csrf_token() }}',
                local_time: localTime
            }, function(data) {
                $('#message').text(data.message);
                location.reload();
            }).fail(function(xhr) {
                $('#message').text(xhr.responseJSON.message);
            });
        });

        $('#clockOutBtn').on('click', function() {
            const localTime = new Date().toISOString();
            $.post('{{ route('attendance.clock-out') }}', {
                _token: '{{ csrf_token() }}',
                local_time: localTime
            }, function(data) {
                $('#message').text(data.message);
                location.reload();
            }).fail(function(xhr) {
                $('#message').text(xhr.responseJSON.message);
            });
        });
    });
</script> --}}
@endsection
