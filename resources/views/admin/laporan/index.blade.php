@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee /</span> Absensi</h4>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            <form action="{{ route('laporan.filter') }}" method="post">
                                @csrf
                                <div class="mb-4 form-group">
                                    <label for="jenisLaporan">Jenis Laporan</label>
                                    <select name="jenisLaporan" id="jenisLaporan" class="form-control">
                                        <option selected disabled>- Pilih Laporan -</option>
                                        <option value="pegawai">Pegawai</option>
                                        <option value="absensi">Absensi</option>
                                        <option value="penggajian">Penggajian</option>
                                    </select>
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="tanggalAwal">Tanggal Awal</label>
                                    <input type="date" name="tanggalAwal" id="tanggalAwal" class="form-control">
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="tanggalAkhir">Tanggal Akhir</label>
                                    <input type="date" name="tanggalAkhir" id="tanggalAkhir" class="form-control">
                                </div>
                                <div class="mb-4 form-group">
                                    <button type="button" class="btn rounded-pill btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#createModal">
                                        <i class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="left" data-bs-html="true" title="Cari Filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- UNTUK HASIL TAMPILAN PDF LAPORAN --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($data) && count($data) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        @if ($request->jenisLaporan == 'pegawai')
                                            <th>ID</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                        @elseif($request->jenisLaporan == 'absensi')
                                            <th>ID</th>
                                            <th>Nama Pegawai</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        @elseif($request->jenisLaporan == 'penggajian')
                                            <th>ID</th>
                                            <th>Nama Pegawai</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Gaji</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            @if ($request->jenisLaporan == 'pegawai')
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nama_pegawai }}</td>
                                                <td>{{ $item->jabatan }}</td>
                                            @elseif($request->jenisLaporan == 'absensi')
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->pegawai->nama_pegawai }}</td>
                                                <!-- Asumsi ada relasi ke model Pegawai -->
                                                <td>{{ $item->tanggal_absen }}</td>
                                                <td>{{ $item->status }}</td>
                                            @elseif($request->jenisLaporan == 'penggajian')
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->pegawai->nama_pegawai }}</td>
                                                <td>{{ $item->tanggal_gaji }}</td>
                                                <td>{{ $item->jumlah_gaji }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    @endif
                </div>
                <button>Bikin PDF</button>
                <button>Lihat PDF</button>
                </form>
            </div>
        </div>
    </div>
@endsection
