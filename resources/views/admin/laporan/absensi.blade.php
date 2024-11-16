@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Laporan Cuti</h4>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input type="date" class="form-control" name="tanggal_selesai" required>
                    </div>
                    <div class="col-4">
                        <input type="date" class="form-control" name="tanggal_selesai" required>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary form-control">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
