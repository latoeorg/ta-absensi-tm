@extends('layouts.app') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Cuti</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.error-card')
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (request()->session()->get('user')['role'] === 'KARYAWAN')
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#formCreate"><i
                                        class="fa fa-plus"></i> Ajukan</a>
                                @include('pages.pengajuan-cuti.create')
                            @endif
                            <table id="defaultTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        {{-- <th>Notes</th> --}}
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                {{ $i }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->date_start }}</td>
                                            <td>{{ $item->date_end }}</td>
                                            {{-- <td>{{ $item->notes }}</td> --}}
                                            <td>
                                                @include('includes.badge-status', [
                                                    'status' => $item->status,
                                                ])
                                            </td>
                                            <td>
                                                <a type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#detailModal{{ $item->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if (request()->session()->get('user')['role'] === 'ADMIN' && $item->status === 'PENDING')
                                                    <a type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#formUpdate{{ $item->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        @include('pages.pengajuan-cuti.detail')
                                        @include('pages.pengajuan-cuti.update')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
