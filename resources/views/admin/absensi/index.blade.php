@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu Absensi /</span> Absensi</h4>

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

        <section class="attendance-list">
            <div class="card">
                <h5 class="card-header">
                    <button type="submit" href="{{ route('pegawai.create') }}" class="btn rounded-pill btn-info"
                        data-bs-toggle="modal" data-bs-target="#absenMasukModal"
                        style="float: right; padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px; margin-right: 30x">
                        <i class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-offset="0,4"
                            data-bs-placement="left" data-bs-html="true" title="Absen"></i>
                        Absen Masuk
                    </button>
                    Absen Masuk
                </h5>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $data->user->nama_pegawai }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_absen)->translatedFormat('d F Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->jam_masuk)->format('H.i') }}</td>
                                    <td>{{ $data->jam_keluar ? \Carbon\Carbon::parse($data->jam_keluar)->format('H.i') : 'Belum Absen Pulang' }}
                                    </td>
                                    <td>
                                        @if (is_null($data->jam_keluar))
                                            <form action="{{ route('absensi.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning" data-confirm-delete="true"
                                                    onclick="confirmAbsenPulang({{ $data->id }})">Absen
                                                    Pulang</button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary" disabled>Sudah Absen Pulang</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Absen Masuk -->
    <div class="modal fade" id="absenMasukModal" tabindex="-1" aria-labelledby="absenMasukLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="absenMasukLabel">Absen Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pegawai" class="form-label">Pegawai</label>
                            <select name="id_user" class="form-control" required>
                                <option selected disabled>-- Pilih Nama Pegawai --</option>
                                @foreach ($pegawai as $item)
                                    @if ($item->is_admin == 0)
                                        <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Absen Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script type="text/javascript">
            function confirmAbsenPulang(absenId) {
                Swal.fire({
                    title: 'Anda yakin ingin absen pulang?',
                    text: "Anda tidak dapat mengubahnya setelah absen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, absen sekarang!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form absen pulang
                        document.getElementById('absenPulangForm' + absenId).submit();
                    }
                })
            }
        </script>
    @endpush
@endsection
