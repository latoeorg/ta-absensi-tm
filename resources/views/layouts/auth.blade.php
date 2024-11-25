<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body class="hold-transition login-page bg-warning">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-none d-md-block border-r">
                <img src="data:image/png;base64,{{ $qrCode->code }}" alt="QR Code">
                <p>Date: {{ $qrCode->date }}</p>
            </div>
            <div class="col-md-6">
                @yield('content')
            </div>
        </div>
    </div>
    @include('includes.scripts')
</body>

</html>
