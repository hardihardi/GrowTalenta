<!DOCTYPE html>
<html lang="en">

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

    <style>
        body {
            background-color: #f3f4f6;
        }

        .header-title {
            background-color: #0077b6;
            color: white;
            padding: 20px 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .btn-primary {
            background-color: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005f87;
        }

        button {
            align-content: center;
            align-items: center;
            text-align: center;
            justify-content: center;
            justify-items: center;
        }
    </style>

</head>

<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="header-title text-center mb-4">
            <h2>Gibran Gsnteng</h2>
        </div>

        <!-- Toast Untuk Success -->
        {{-- @if (session('success'))
            <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 fade show toast-custom"
                role="alert" aria-live="assertive" aria-atomic="true" id="toastSuccess">
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
        @endif --}}

        {{-- Toast Untuk Error --}}
        {{-- @if (session('error'))
            <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom"
                role="alert" aria-live="assertive" aria-atomic="true" id="toastError">
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
        @endif --}}

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
                                <input type="hidden" name="id_pegawai" value="{{ Auth::user()->id }}">
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
                                            <button type="submit" class="btn btn-outline-primary">Simpan Absen
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
                                                    <button type="submit" class="btn btn-warning"
                                                        id="btnAbsenPulang-{{ $data->id }}">Absen Pulang</button>
                                                </form>
                                                @php
                                                    $absenPulangDisplayed = true; // set ke true setelah tombol ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($absenPulangDisplayed == false)
                                            <button class="btn btn-secondary" disabled>Sudah Absen Pulang</button>
                                        @endif
                                    </td>

                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Daftar Absensi Card -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
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
                        <tr class="text-center">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $data->pegawai->nama_pegawai }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_absen)->translatedFormat('d F Y') }}</td>
                            <td>{{ $data->jam_masuk }}</td>
                            <td>
                                {{ $data->jam_keluar ?? 'Belum Absen Pulang' }}
                            </td>
                            <td>
                                @if (is_null($data->jam_keluar))
                                    <form action="{{ route('welcome.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="test" id="" va lue="wdsaads">
                                        <button type="submit" class="btn btn-warning">Absen Pulang</button>
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
    </div>

    <footer class="footer text-center mt-5">
        <p>© 2024 ITI - All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        function disableButton(form) {
            const button = form.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = 'Sedang diproses...'; // Ubah teks setelah klik
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                html: '<strong>{{ session('success') }}</strong>',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                html: '<strong>{{ session('error') }}</strong>',
                icon: 'error',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    @endif
    </script>
</body>

</html>