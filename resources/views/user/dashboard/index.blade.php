@extends('layouts.user.template')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <!-- Card Selamat Datang -->
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100 shadow-sm border-0">
                    <div class="card-header pb-0 pt-4 bg-gradient-primary text-white rounded-top">
                        <h4 class="text-capitalize mb-4">Selamat Datang, {{ Auth::user()->nama_pegawai }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-5">
                            <li class="text-sm mb-2 d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                <span class="font-weight-bold">Status:</span>
                                <span
                                    class="ms-1">{{ Auth::user()->status_pegawai == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </li>
                            <li class="text-sm mb-2 d-flex align-items-center">
                                <i class="fas fa-briefcase me-2 text-primary"></i>
                                <span class="font-weight-bold">Jabatan:</span>
                                <span class="ms-1">{{ Auth::user()->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}</span>
                            </li>
                            <li class="text-sm d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                <span class="font-weight-bold">Tanggal Masuk:</span>
                                <span class="ms-1">{{ Auth::user()->tanggal_masuk }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Kalender -->
            <div class="col-lg-8">
                <div class="card overflow-hidden h-100 p-0">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Kalender</h5>
                        <div class="dropdown">
                            <button id="prevMonth" class="btn btn-outline-primary btn-sm me-2">← Prev</button>
                            <button id="nextMonth" class="btn btn-outline-primary btn-sm">Next →</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar" class="table-responsive">
                            <!-- Kalender akan dirender di sini oleh JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
