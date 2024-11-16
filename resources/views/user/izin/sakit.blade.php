@extends('layouts.user.template')

@section('content')
    <div class="container-fluid py-4">
        <h3 class="mb-4">Daftar Izin Sakit</h3>

        <!-- Tampilkan notifikasi jika tidak ada izin sakit -->
        @if($izinSakitCount == 0)
            <div class="alert alert-info" role="alert">
                Belum ada izin sakit.
            </div>
        @endif

        <!-- Daftar izin sakit -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Izin Sakit</h5>
            </div>
            <div class="card-body">
                @if($izinSakit->isEmpty())
                    <p class="text-muted">Tidak ada data izin sakit.</p>
                @else
                    <table class="table table-bordered table-hover text-nowrap text-center">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Surat Sakit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensi as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->user->nama_pegawai }}</td>
                                    <td class="align-items-center">
                                        <!-- Gambar diperbesar -->
                                        @if($data->photo)
                                            <!-- Tombol Lihat Selengkapnya di sebelah kanan -->
                                            <button type="button" class="btn btn-outline-primary btn-sm ms-auto align-items-center" data-bs-toggle="modal" data-bs-target="#photoModal{{ $data->id }}">
                                                <i class='bx bx-show me-1'></i> Lihat Selengkapnya
                                            </button>
                                            {{-- <div style="flex: 2;">
                                                <img src="{{ asset('uploads/' . $data->photo) }}" alt="Surat Sakit" width="200" class="img-thumbnail">
                                            </div> --}}
                                            

                                            <!-- Modal Lihat Selengkapnya -->
                                            <div class="modal fade" id="photoModal{{ $data->id }}" tabindex="-1" aria-labelledby="photoModalLabel{{ $data->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="photoModalLabel{{ $data->id }}">Surat Sakit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('uploads/' . $data->photo) }}" alt="Surat Sakit" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">Tidak ada surat sakit</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
