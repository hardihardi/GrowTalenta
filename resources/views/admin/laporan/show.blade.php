@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee /</span> Absensi</h4>
        <div class="card">
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
        </div>
        <p>Tidak ada data yang ditemukan.</p>
        @endif
    </div>
@endsection
