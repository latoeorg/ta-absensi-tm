@extends('layouts.app') @section('content')

<div class="container">
    <h1 class="mt-4">Attendance</h1>
    <div class="card mb-4">
        <div class="card-header">
            Clock In / Clock Out
        </div>
        <div class="card-body">
            <button id="clock-in-btn" class="btn btn-success mb-2">Clock In</button>
            <button id="clock-out-btn" class="btn btn-danger mb-2">Clock Out</button>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Attendance History
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- History will be populated here via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('clock-in-btn').addEventListener('click', function() {
        fetch('{{ route('attendance.clockIn') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadHistory();
        });
    });

    document.getElementById('clock-out-btn').addEventListener('click', function() {
        fetch('{{ route('attendance.clockOut') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadHistory();
        });
    });

    function loadHistory() {
        fetch('{{ route('attendance.history') }}')
        .then(response => response.json())
        .then(data => {
            const historyTableBody = document.querySelector('#history-table tbody');
            historyTableBody.innerHTML = '';
            data.attendances.forEach(attendance => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${attendance.date}</td>
                    <td>${attendance.clock_in ? new Date(attendance.clock_in).toLocaleString() : ''}</td>
                    <td>${attendance.clock_out ? new Date(attendance.clock_out).toLocaleString() : ''}</td>
                `;
                historyTableBody.appendChild(row);
            });
        });
    }

    // Load history on page load
    loadHistory();
</script>
@endsection
