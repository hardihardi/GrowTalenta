@extends('layouts.admin.template')

@section('content')
    {{-- Toast Untuk Error --}}
    @if (session('error'))
        <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
            aria-live="assertive" aria-atomic="true" id="toastError">
            <div class="toast-header">
                <i class="bx bx-error me-2"></i>
                <div class="me-auto fw-semibold">Error</div>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Laporan Cuti</h4>
        <div class="card">
            <div class="card-header">
                <form action="{{ route('laporan.cuti') }}" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_awal"
                                value="{{ request('tanggal_awal') }}">
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_akhir"
                                value="{{ request('tanggal_akhir') }}">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary form-control" type="submit">Filter</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('laporan.cuti') }}" class="btn btn-danger form-control">Reset</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-9">
                            <select id="jabatan" name="jabatan" class="form-control">
                                <option value="" disabled {{ request('jabatan') ? '' : 'selected' }}>
                                    -- Pilih Jabatan--
                                </option>
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}"
                                        {{ request('jabatan') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('laporan.pegawai') }}" class="btn btn-danger form-control"
                                type="submit">Reset Filter Jabatan</a>
                        </div>
                    </div>
                </form>
                <div class="row mt-3">
                    @if (!$cuti->isEmpty())
                        <div class="col-4">
                            <button id="lihatPdfButtonCuti" class="btn btn-secondary form-control" data-bs-toggle="modal"
                                data-bs-target="#pdfModal">Lihat PDF</button>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('laporan.cuti', ['download_pdf' => true, 'tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                                class="btn btn-info form-control">Buat PDF</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('laporan.cuti', ['download_excel' => true, 'tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                                class="btn btn-success form-control" type="submit">Buat EXCEL</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if ($cuti->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data pegawai yang cuti ditemukan untuk tanggal yang dipilih atau jabatan yang dipilih.
                    </div>
                @else
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Mulai Cuti</th>
                                    <th>Tanggal Akhir Cuti</th>
                                    <th>Total Cuti</th>
                                    <th>Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($cuti as $item)
                                    @if ($item->pegawai->is_admin == 0)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->pegawai->nama_pegawai }}</td>
                                            <td>{{ $item->pegawai->jabatan ? $item->pegawai->jabatan->nama_jabatan : 'Tidak ada jabatan' }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $item->total_hari_cuti }} Hari</td>
                                            <td>{{ $item->alasan }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk melihat PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Lihat PDF - Cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('lihatPdfButtonCuti').addEventListener('click', function() {
            // Ambil tanggal awal dan tanggal akhir dari request
            var tanggalAwal = '{{ request('tanggal_awal') }}';
            var tanggalAkhir = '{{ request('tanggal_akhir') }}';

            // Buat URL untuk iframe
            var url = "{{ route('laporan.cuti', ['view_pdf' => true]) }}&tanggal_awal=" + tanggalAwal +
                "&tanggal_akhir=" + tanggalAkhir;

            // Set URL ke iframe
            document.getElementById('pdfFrame').src = url;
        });
    </script>
@endpush
