@extends('layouts.app') @section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Welcome {{ request()->session()->get('user')['name'] }} </h1> --}}
                    <h1>Welcome</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
