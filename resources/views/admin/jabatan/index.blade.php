@extends('layouts.admin.template')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Karyawan /</span> Jabatan</h4>

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


        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold py-3">Tambah Jabatan</h5>
                        <form action="{{ route('jabatan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" name="nama_jabatan" placeholder="Enter jabatan"
                                    required>
                            </div>

                            <!-- Container untuk Field Tambahan -->
                            <div id="additionalFields"></div>

                            <button type="button" class="btn btn-secondary" onclick="addField()">Tambah Field</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold py-3">Tabel Jabatan</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($jabatan as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->nama_jabatan }}</td>
                                            <td>
                                                <form action="{{ route('jabatan.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0)" class="btn rounded-pill btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $data->id }}"
                                                        style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                                        <i class="bi bi-pencil-square" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4" data-bs-placement="left"
                                                            data-bs-html="true" title="Edit Jabatan"></i>

                                                    </a>

                                                    <a href="{{ route('jabatan.destroy', $data->id) }}"
                                                        class="btn rounded-pill btn-danger" data-confirm-delete="true"
                                                        style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                                        <i class="bi bi-trash-fill" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4" data-bs-placement="right"
                                                            data-bs-html="true" title="Delete Jabatan"></i>

                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Jabatan -->
                                        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
                                            aria-hidden="true" data-bs-backdrop="static">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Jabatan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jabatan.update', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_jabatan" class="form-label">Nama
                                                                    Jabatan</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_jabatan" value="{{ $data->nama_jabatan }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        let fieldCount = 0;
        // Fungsi untuk menambahkan field baru
        function addField() {
            fieldCount++;

            const additionalFields = document.getElementById('additionalFields');

            const fieldContainer = document.createElement('div');
            fieldContainer.setAttribute('id', `fieldContainer-${fieldCount}`);
            fieldContainer.className = 'd-flex align-items-center mb-3';

            const inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.name = `additional_fields[]`; // Gunakan array untuk multiple inputs
            inputField.className = 'form-control me-2';
            inputField.placeholder = `Enter Jabatan ${fieldCount}`;
            inputField.required = true;

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-danger';
            deleteButton.innerHTML = '<i class="bi bi-trash"></i>'; // Icon Sampah
            deleteButton.onclick = function () {
                removeField(fieldCount);
            };

            fieldContainer.appendChild(inputField);
            fieldContainer.appendChild(deleteButton);
            additionalFields.appendChild(fieldContainer);
        }

        // Fungsi untuk menghapus field tertentu
        function removeField(id) {
            const fieldContainer = document.getElementById(`fieldContainer-${id}`);
            if (fieldContainer) {
                fieldContainer.remove();
            }
        }
    </script>
    <script>
        new DataTable('#example')
    </script>
@endpush
