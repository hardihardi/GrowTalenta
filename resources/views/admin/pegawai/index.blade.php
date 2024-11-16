@extends('layouts.admin.template')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Karyawan /</span> Pegawai</h4>

        {{-- UNTUK TOAST NOTIFIKASI --}}
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="validationToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                    <div class="me-auto fw-semibold">Success</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Data sudah ada!
                </div>
            </div>
        </div>

        <!-- Toast Untuk Success -->
        @if (session('success'))
            <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastSuccess">
                <div class="toast-header">
                    <i class="bi bi-check-circle me-2"></i>
                    <div class="me-auto fw-semibold">Success</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif

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


        {{-- Toast Untuk Danger --}}
        @if (session('danger'))
            <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastError">
                <div class="toast-header">
                    <i class="bx bx-error me-2"></i>
                    <div class="me-auto fw-semibold">Danger</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('danger') }}
                </div>
            </div>
        @endif

        {{-- Toast Untuk Warning --}}
        @if (session('warning'))
            <div class="bs-toast toast toast-placement-ex m-2 bg-warning top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastError">
                <div class="toast-header">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div class="me-auto fw-semibold">Warning</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
            </div>
        @endif


        <div class="card mb-4 pb-2">
            <h5 class="card-header">
                <a href="{{ route('pegawai.create') }}" class="btn rounded-pill btn-info" data-bs-toggle="tooltip"
                    data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Add pegawai"
                    style="float: right; padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                    <i class="bi bi-person-fill-add"></i>
                    Add pegawai
                </a>
                Table pegawai
            </h5>

            <!-- Table for pegawai Data -->
            <div class="table-responsive text-nowrap">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pegawai</th>
                            <th>Jabatan</th>
                            <th>Tanggal Lahir</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pegawai as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $data->nama_pegawai }}</td>
                                <td>{{ $data->jabatan ? $data->jabatan->nama_jabatan : 'Tidak ada jabatan' }}</td>
                                <td>
                                    {{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') : 'Tidak ada tanggal lahir' }}
                                </td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    @if ($data->status_pegawai == 1)
                                        <span class="badge bg-label-info">— Pegawai Aktif —</span>
                                    @else
                                        <span class="badge bg-label-dark">— Pegawai Tidak Aktif —</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('pegawai.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('pegawai.edit', $data->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#pegawaiDetailModal{{ $data->id }}">
                                                    <i class="bi bi-eye-fill"></i> Lihat Detail</a>
                                                <a href="{{ route('pegawai.destroy', $data->id) }}" type="submit"
                                                    class="dropdown-item" data-confirm-delete="true"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>


                            <!-- Modal Detail Pegawai -->
                            <div class="modal fade" id="pegawaiDetailModal{{ $data->id }}" tabindex="-1"
                                aria-labelledby="pegawaiDetailModalLabel{{ $data->id }}" aria-hidden="true"
                                data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pegawaiDetailModalLabel{{ $data->id }}">
                                                Detail Pegawai -
                                                {{ $data->nama_pegawai }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nama:</strong> {{ $data->nama_pegawai }} </p>
                                            <p><strong>Jabatan:</strong>
                                                {{ $data->jabatan ? $data->jabatan->nama_jabatan : 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Tempat Lahir:</strong>
                                                {{ $data->tempat_lahir ? $data->tempat_lahir : 'Tidak Ada' }} </p>
                                            <p><strong>Tanggal Lahir:</strong>
                                                {{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') : 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Email:</strong> {{ $data->email }} </p>
                                            <p><strong>Alamat:</strong> {{ $data->alamat ? $data->alamat : 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Tanggal Masuk:</strong>
                                                {{ $data->tanggal_masuk ? \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('d F Y') : 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Umur:</strong> {{ $data->umur }} Tahun </p>
                                            <p><strong>Gaji:</strong> {{ $data->gaji ?? 'Tidak Ada' }} </p>

                                            {{-- <p><strong>Provinsi:</strong>{{ $data->nama_provinsi ?? 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Kota/Kabupaten:</strong> {{ $data->nama_kota ?? 'Tidak Ada' }}
                                            </p>
                                            <p><strong>Kecamatan:</strong> {{ $data->nama_kecamatan ?? 'Tidak Ada' }} </p>
                                            <p><strong>Kelurahan:</strong> {{ $data->nama_kelurahan ?? 'Tidak Ada' }} </p> --}}

                                            <p><strong>Ditempatkan
                                                    di:</strong>{{ $data->nama_provinsi . ', ' . $data->nama_kota . ', ' . $data->nama_kecamatan . ', ' . $data->nama_kelurahan }}
                                            </p>

                                            <p><strong>Status:</strong>
                                                @if ($data->status_pegawai == 1)
                                                    <span class="badge bg-label-info">— Pegawai Aktif —</span>
                                                @else
                                                    <span class="badge bg-label-dark">— Pegawai Tidak Aktif —</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#example')
    </script>
@endpush
