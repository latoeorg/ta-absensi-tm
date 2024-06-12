@php
    switch ($status) {
        case 'PENDING':
            $color = 'bg-warning';
            break;
        case 'APPROVED':
            $color = 'bg-success';
            break;
        case 'REJECTED':
            $color = 'bg-danger';
            break;
    }
@endphp

<div class="badge {{ $color }}">
    {{ $status }}
</div>
