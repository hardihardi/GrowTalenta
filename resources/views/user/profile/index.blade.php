@extends('layouts.user.template')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Profile Card -->
            <div class="card shadow-lg mx-4 mb-4 card-profile-bottom">
                <div class="card-body p-3 text-center">
                    <div class="row d-flex justify-content-center align-items-center mb-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ asset('user/assets/img/team-1.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <h5 class="mb-1 font-weight-bold text-dark">
                                {{ Auth::user()->nama_pegawai }}
                            </h5>
                            <p class="mb-0 text-muted font-italic">
                                {{ Auth::user()->jabatan->nama_jabatan ?? 'Jabatan tidak ditemukan' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-center bg-light">
                    <h6 class="text-uppercase text-dark m-0 font-weight-bold">Personal Information</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Tempat Lahir</p>
                            <p class="text-muted">{{ Auth::user()->tempat_lahir }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Tanggal Lahir</p>
                            <p class="text-muted">{{ Auth::user()->tanggal_lahir }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Jenis Kelamin</p>
                            <p class="text-muted">{{ Auth::user()->jenis_kelamin }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Alamat</p>
                            <p class="text-muted">{{ Auth::user()->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Details Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-center bg-light">
                    <h6 class="text-uppercase text-dark m-0 font-weight-bold">Employment Details</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Tanggal Masuk</p>
                            <p class="text-muted">{{ Auth::user()->tanggal_masuk }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Umur</p>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->age }} tahun
                            </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Gaji</p>
                            <p class="text-muted">{{ Auth::user()->gaji }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-0 font-weight-bold text-dark">Status Pegawai</p>
                            <p class="text-muted">{{ Auth::user()->status_pegawai == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
