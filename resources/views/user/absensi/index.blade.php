@extends('layouts.user.template')

@section('content')

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Human Resource</title>
        <link rel="shortcut icon"
            href="https://https://i.pinimg.com/736x/f9/94/e5/f994e55f17392b8d6e204be294ffc4dc.jpg"
            type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <!-- Absen Sakit Modal -->
        <div class="modal fade" id="sickLeaveModal" tabindex="-1" aria-labelledby="sickLeaveModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sickLeaveModalLabel">Upload Surat Izin Sakit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('welcome.absenSakit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="sickLeaveFile" class="form-label">Upload File Surat Sakit</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('sickLeaveForm').addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(this);

                fetch("{{ route('welcome.absenSakit') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Trigger a success alert or feedback
                            Swal.fire('Berhasil', 'Surat sakit berhasil dikirim!', 'success');
                            document.getElementById("sickLeaveForm").reset();
                            // Close modal manually
                            let sickLeaveModal = new bootstrap.Modal(document.getElementById("sickLeaveModal"));
                            sickLeaveModal.hide();
                        } else {
                            Swal.fire('Gagal', 'Gagal mengirim surat sakit!', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Terjadi kesalahan!', 'error');
                    });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <section class="attendance-list">
            <div class="" id="absenMasukModal" tabindex="-1" aria-labelledby="absenMasukLabel" aria-hidden="true"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('welcome.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="absenMasukLabel">Absen Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                {{-- <div class="mb-3">
                                <label for="pegawai" class="form-label">Pegawai</label>
                                <select name="id_pegawai" class="form-control" required>
                                    <option selected disabled>-- Pilih Nama Pegawai --</option>
                                    @foreach ($pegawai as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            </div>
                            <div class="mb-3">
                                <table class="table table-hover text-center">
                                    <td>
                                        <form action="{{ route('welcome.store') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary"
                                                style="width: 200px">Simpan Absen
                                                Masuk</button>
                                        </form>
                                    </td>
                                    {{-- <td>
                                    <!-- Tombol Reset Semua Data -->
                                    <form action="{{ route('welcome.reset') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Reset Semua Data</button>
                                    </form>
                                </td> --}}
                                    <td>
                                        @php
                                            $today = \Carbon\Carbon::today('Asia/Jakarta')->format('Y-m-d');
                                            $absenPulangDisplayed = false; // variabel untuk melacak apakah tombol sudah ditampilkan
                                        @endphp

                                        @foreach ($absensi as $data)
                                            @if ($data->tanggal_absen == $today && is_null($data->jam_keluar) && !$absenPulangDisplayed)
                                                <form action="{{ route('welcome.update', $data->id) }}" method="POST"
                                                    onsubmit="disableButton(this)">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-outline-warning"
                                                        style="width: 200px" id="btnAbsenPulang-{{ $data->id }}">Absen
                                                        Pulang</button>
                                                </form>
                                                @php
                                                    $absenPulangDisplayed = true; // set ke true setelah tombol ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($absenPulangDisplayed == false)
                                            <button class="btn btn-outline-secondary" style="width: 200px" disabled>Sudah
                                                Absen Pulang</button>
                                        @endif
                                    </td>
                                    <!-- Form Absen Sakit -->
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#sickLeaveModal" style="width: 200px">Absen Sakit</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Attendance List Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Jam Absen</th>
                        <th>Jam Selesai</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi as $data)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->nama_pegawai }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_absen)->format('d-m-Y') }}</td>
                            <td>
                                @if ($data->status === 'sakit')
                                    Sakit
                                @else
                                    {{ $data->jam_masuk ?? 'Belum Absen Masuk' }}
                                @endif
                            </td>
                            <td>
                                @if ($data->status === 'sakit')
                                    Sakit
                                @else
                                    {{ $data->jam_keluar ?? 'Belum Absen Pulang' }}
                                @endif
                            </td>
                            <td>
                                {{ $data->note ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            @endif
        </script>
    </body>
@endsection
