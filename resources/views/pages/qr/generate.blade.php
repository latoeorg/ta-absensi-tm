@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generate QR Code</h1>
    <img src="data:image/png;base64,{{ $qrCode->code }}" alt="QR Code">
    <p>Date: {{ $qrCode->date }}</p>
</div>
@endsection
