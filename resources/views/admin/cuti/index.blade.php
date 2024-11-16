@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu Absensi /</span> cuti</h4>

        {{-- UNTUK TOAST NOTIFIKASI --}}
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="validationToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                    <div class="me-auto fw-semibold">Error</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Data Tidak Valid!
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


        <div class="card">
            <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-info" data-bs-toggle="modal"
                    data-bs-target="#createModal"
                    style="float: right; padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                    <i class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left"
                        data-bs-html="true" title="Add cuti"></i>
                    Add cuti
                </button>
                Add cuti
            </h5>

            <!-- Table for cuti Data -->
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Tanggal Mulai Cuti</th>
                            <th>Tanggal Selesai Cuti</th>
                            <th>Alasan Cuti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            {{-- <th>Verifikasi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($cuti as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $data->pegawai->nama_pegawai }}</td>
                                {{-- <td></td> --}}
                                {{-- <td>{{ $data->pegawai->jabatan->nama_jabatan }}</td> --}}
                                <td>{{ $data->pegawai->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_selesai)->translatedFormat('d F Y') }}</td>
                                <td>{{ $data->alasan }}</td>
                                <td>
                                    @if ($data->status_cuti == 1)
                                        <span class="badge bg-label-info">— Diterima —</span>
                                    @else
                                        <span class="badge bg-label-dark">— Menunggu Konfirmasi —</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('cuti.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('cuti.destroy', $data->id) }}"
                                            class="btn rounded-pill btn-danger" data-confirm-delete="true"
                                            style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                            <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="right" data-bs-html="true" title="Delete cuti"></i>
                                            Delete
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create cuti -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cuti.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-0">
                                <label for="nameBasic" class="form-label">Nama Pegawai</label>
                                <select name="id_user" class="form-control" id="pegawai" required>
                                    <option selected disabled>-- Nama pegawai --</option>
                                    @foreach ($pegawai as $data)
                                        @if ($data->is_admin == 0)
                                            <option value="{{ $data->id }}"
                                                {{ session('id_user') && in_array($data->id, session('id_user')) ? 'disabled' : '' }}
                                                data-jabatan="{{ $data->jabatan ? $data->jabatan->nama_jabatan : 'Tidak ada jabatan' }}">
                                                {{ $data->nama_pegawai }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-0">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Jabatan</label>
                                <div class="col">
                                    <select name="jabatan" id="jabatan" class="form-control" disabled>
                                        <option>-- Pilih Jabatan --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col mb-0">
                                <label for="nameBasic" class="form-label">Tanggal Mulai Cuti</label>
                                <input type="date" class="form-control" name="tanggal_mulai" required>
                            </div>
                            <div class="col mb-0">
                                <label class="col col-form-label" for="basic-default-name">Tanggal Selesai Cuti</label>
                                <div class="col">
                                    <input type="date" class="form-control" name="tanggal_selesai" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label class="" for="basic-default-name">Alasan</label>
                            <div class="col mt-2">
                                <textarea name="alasan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

