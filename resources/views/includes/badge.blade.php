@php
    switch ($status) {
        case 'DRAFT':
            $color = 'badge-info';
            break;
        case 'WAITING_VALIDATION':
            $color = 'badge-warning';
            break;
        case 'DONE':
            $color = 'badge-success';
            break;
        case 'REJECTED':
            $color = 'badge-danger';
            break;
        default:
            $color = 'badge-primary';
    }
@endphp

<div class="badge {{ $color }}">
    {{ $status }}
</div>
