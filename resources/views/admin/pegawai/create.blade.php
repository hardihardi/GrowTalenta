@extends('layouts.admin.template')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Karyawan /</span> <span
                class="text-muted fw-light">Pegawai /</span> Create</h4>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah pegawai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Nama Lengkap" name="nama_pegawai" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-control">
                                <option value="" selected disabled>-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tempat & Tanggal
                            Lahir</label>
                        <div class="col-sm-5">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tempat Lahir" name="tempat_lahir" />
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tanggal Lahir" name="tanggal_lahir" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Alamat</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Masukan Alamat Anda"
                                    name="alamat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="email" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Email Anda" name="email" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukan Password">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="password-confirm"
                                    name="password_confirmation" placeholder="Masukan Password">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tanggal pegawai" name="tanggal_masuk" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Gaji</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="number" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Gaji Awal" name="gaji" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="provinsi">Lokasi yang akan ditempatkan</label>
                        <div class="col-sm-10">
                            <select id="provinsi" name="provinsi" class="form-control">
                                <option value="" selected disabled>-- Pilih Provinsi --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <select id="kabupaten" name="kabupaten" class="form-control">
                                <option value="" selected disabled>-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <select id="kecamatan" name="kecamatan" class="form-control">
                                <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <select id="kelurahan" name="kelurahan" class="form-control">
                                <option value="" selected disabled>-- Pilih Kelurahan --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('pegawai.index') }} " class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript(external.js resource or <script script script > tag)
        // $(document).ready(function() {
        //     $('#provinsi').select2();
        // });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';
            // const apiBaseUrl = 'https://wilayah.id/api';

            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Fetch data provinsi
            fetch(`${apiBaseUrl}/provinces.json`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(provinsi => {
                        provinsiSelect.innerHTML +=
                            `<option value="${provinsi.id}">${provinsi.name}</option>`;
                    });
                })
                .catch(error => console.error('Error fetching provinces:', error));

            // Event listener untuk kabupaten ketika provinsi dipilih
            provinsiSelect.addEventListener('change', () => {
                const provinsiId = provinsiSelect.value;
                kabupatenSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kabupaten --</option>';
                kecamatanSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kelurahan --</option>';

                fetch(`${apiBaseUrl}/regencies/${provinsiId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kabupaten => {
                            kabupatenSelect.innerHTML +=
                                `<option value="${kabupaten.id}">${kabupaten.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching regencies:', error));
            });

            // Event listener untuk kecamatan ketika kabupaten dipilih
            kabupatenSelect.addEventListener('change', () => {
                const kabupatenId = kabupatenSelect.value;
                kecamatanSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kelurahan --</option>';

                fetch(`${apiBaseUrl}/districts/${kabupatenId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kecamatan => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kecamatan.id}">${kecamatan.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            });

            // Event listener untuk kelurahan ketika kecamatan dipilih
            kecamatanSelect.addEventListener('change', () => {
                const kecamatanId = kecamatanSelect.value;
                kelurahanSelect.innerHTML =
                    '<option value="" selected disabled>-- Pilih Kelurahan --</option>';

                fetch(`${apiBaseUrl}/villages/${kecamatanId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kelurahan => {
                            kelurahanSelect.innerHTML +=
                                `<option value="${kelurahan.id}">${kelurahan.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching villages:', error));
            });
        });
    </script>
@endpush
