@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Laporan Absensi</h4>
        <div class="card">
            <div class="card-header">
                <form method="GET" action="{{ route('laporan.absensi') }}">
                    <div class="row">
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" required>
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" required>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary form-control" type="submit">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row mt-3">
                    @if (!$absensi->isEmpty())
                        <div class="col-4">
                            <button id="lihatPdfButtonAbsensi" class="btn btn-secondary form-control" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                Lihat PDF
                            </button>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('laporan.absensi', ['download_pdf' => true, 'tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}" class="btn btn-info form-control">
                                Buat PDF
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('laporan.absensi', ['download_excel' => true, 'tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}" class="btn btn-success form-control">
                                Buat EXCEL
                            </a>
                        </div>
                    @endif
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
                            @forelse ($absensi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->user->nama_pegawai ?? "Tidak Ada Data"}}</td>
                                    <td>{{ $item->tanggal_absen ?? "Tidak Ada Data"}}</td>
                                    <td>{{ $item->jam_masuk ?? "Tidak Ada Data"}}</td>
                                    <td>{{ $item->jam_keluar ?? "Tidak Ada Data"}}</td>
                                    <td>{{ $item->note ?? "-" }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data absensi tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
