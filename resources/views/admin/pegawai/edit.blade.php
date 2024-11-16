@extends('layouts.admin.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Karyawan /</span> <span
                class="text-muted fw-light">Pegawai /</span> Edit</h4>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit pegawai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Nama Lengkap" name="nama_pegawai"
                                    value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-control">
                                <option selected disabled>-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $data->id == $pegawai->id_jabatan ? 'selected' : '' }}>
                                        {{ $data->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" {{ $pegawai->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tempat & Tanggal
                            Lahir</label>
                        <div class="col-sm-5">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tempat Lahir" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" />
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tanggal Lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Alamat</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Masukan Alamat Anda"
                                    name="alamat">{{ old('alamat', $pegawai->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="email" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Email Anda" name="email"
                                    value="{{ old('email', $pegawai->email) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Tanggal pegawai" name="tanggal_masuk"
                                    value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Gaji</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="number" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Masukan Gaji Awal" name="gaji"
                                    value="{{ old('gaji', $pegawai->gaji) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Status Pegawai</label>
                        <div class="col-sm-10">
                            <select name="status_pegawai" class="form-control">
                                <option selected disabled>-- Pilih Status Pegawai --</option>
                                <option value="1" {{ $pegawai->status_pegawai == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ $pegawai->status_pegawai == 0 ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- Menambahkan Field Provinsi -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="provinsi">Provinsi</label>
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
    
                    <!-- Save Button -->
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('pegawai.index') }}" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');
    
            // Fetch data provinsi and select the existing value if any
            fetch(`${apiBaseUrl}/provinces.json`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(provinsi => {
                        provinsiSelect.innerHTML += `<option value="${provinsi.id}">${provinsi.name}</option>`;
                    });
                    provinsiSelect.value = "{{ $pegawai->provinsi }}"; // Set selected value if available
                    loadKabupaten();
                });
    
            // Event listener for Kabupaten
            provinsiSelect.addEventListener('change', loadKabupaten);
    
            function loadKabupaten() {
                const provinsiId = provinsiSelect.value;
                kabupatenSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kabupaten --</option>';
                kecamatanSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kelurahan --</option>';
    
                if (provinsiId) {
                    fetch(`${apiBaseUrl}/regencies/${provinsiId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kabupaten => {
                                kabupatenSelect.innerHTML += `<option value="${kabupaten.id}">${kabupaten.name}</option>`;
                            });
                            kabupatenSelect.value = "{{ $pegawai->kabupaten }}";
                            loadKecamatan();
                        });
                }
            }
    
            kabupatenSelect.addEventListener('change', loadKecamatan);
    
            function loadKecamatan() {
                const kabupatenId = kabupatenSelect.value;
                kecamatanSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kelurahan --</option>';
    
                if (kabupatenId) {
                    fetch(`${apiBaseUrl}/districts/${kabupatenId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kecamatan => {
                                kecamatanSelect.innerHTML += `<option value="${kecamatan.id}">${kecamatan.name}</option>`;
                            });
                            kecamatanSelect.value = "{{ $pegawai->kecamatan }}";
                            loadKelurahan();
                        });
                }
            }
    
            kecamatanSelect.addEventListener('change', loadKelurahan);
    
            function loadKelurahan() {
                const kecamatanId = kecamatanSelect.value;
                kelurahanSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kelurahan --</option>';
    
                if (kecamatanId) {
                    fetch(`${apiBaseUrl}/villages/${kecamatanId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kelurahan => {
                                kelurahanSelect.innerHTML += `<option value="${kelurahan.id}">${kelurahan.name}</option>`;
                            });
                            kelurahanSelect.value = "{{ $pegawai->kelurahan }}";
                        });
                }
            }
        });
    </script>
    @endpush