<?php

namespace App\Http\Controllers;

use App\Exports\CutiExport;
use App\Exports\PegawaiExport;
use App\Models\Absensi;
use App\Models\Cutis;
use App\Models\Jabatan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    // public function indexPegawai()
    // {
    //     $absensi = Absensi::latest()->get();
    //     $pegawai = User::all();
    //     return view('admin.laporan.pegawai', compact('absensi', 'pegawai'));
    // }

    // LAPORAN BUAT PEGAWAI DAN FILTER
    // public function pegawai(Request $request)
    // {
    //     $jabatan = Jabatan::all();
    //     $tanggalAwal = $request->input('tanggal_awal');
    //     $tanggalAkhir = $request->input('tanggal_akhir');
    //     $jabatanId = $request->input('jabatan');

    //     if (!$tanggalAwal || !$tanggalAkhir) {
    //         $pegawai = User::where('is_admin', 0)->get()->map(function ($pegawai) {
    //             $pegawai->umur = floor(Carbon::parse($pegawai->tanggal_lahir)->diffInYears(Carbon::now()));
    //             return $pegawai;
    //         });
    //     } else {
    //         $pegawai = User::whereBetween('tanggal_masuk', [$tanggalAwal, $tanggalAkhir])->get('*')->map(function ($pegawai) {
    //             $pegawai->umur = floor(Carbon::parse($pegawai->tanggal_lahir)->diffInYears(Carbon::now()));
    //             return $pegawai;
    //         });
    //     }

    //     // tampil pdf
    //     if ($request->has('pdf')) {
    //         $pdf = PDF::loadView('admin.laporan.pdf_pegawai', compact('pegawai'));
    //         return $pdf->stream('laporan_pegawai.pdf'); //ini buat show pdf
    //     }
    //     // download pdf
    //     if ($request->has('download_pdf')) {
    //         $pdf = PDF::loadView('admin.laporan.pdf_pegawai', compact('pegawai'));
    //         return $pdf->download('laporan_pegawai.pdf'); //ini buat download pdf
    //     }

    //     // download excel
    //     if ($request->has('download_excel')) {
    //         return Excel::download(new PegawaiExport($pegawai), 'laporan_pegawai.xlsx');
    //     }

    //     return view('admin.laporan.pegawai', compact('pegawai', 'jabatan'));
    // }

    public function pegawai(Request $request)
    {
        $jabatan = Jabatan::all();
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $jabatanId = $request->input('jabatan');

        if (!$tanggalAwal || !$tanggalAkhir) {
            $pegawai = User::where('is_admin', 0)
                ->when($jabatanId, function ($query) use ($jabatanId) {
                    return $query->where('id_jabatan', $jabatanId);
                })
                ->get()
                ->map(function ($pegawai) {
                    $pegawai->umur = floor(Carbon::parse($pegawai->tanggal_lahir)->diffInYears(Carbon::now()));
                    return $pegawai;
                });
        } else {
            $pegawai = User::whereBetween('tanggal_masuk', [$tanggalAwal, $tanggalAkhir])
                ->when($jabatanId, function ($query) use ($jabatanId) {
                    return $query->where('id_jabatan', $jabatanId);
                })
                ->get()
                ->map(function ($pegawai) {
                    $pegawai->umur = floor(Carbon::parse($pegawai->tanggal_lahir)->diffInYears(Carbon::now()));
                    return $pegawai;
                });
        }

        // Tampilkan atau unduh PDF
        if ($request->has('pdf')) {
            $pdf = PDF::loadView('admin.laporan.pdf_pegawai', compact('pegawai'));
            return $pdf->stream('laporan_pegawai.pdf');
        }
        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('admin.laporan.pdf_pegawai', compact('pegawai'));
            return $pdf->download('laporan_pegawai.pdf');
        }

        // Unduh Excel
        if ($request->has('download_excel')) {
            return Excel::download(new PegawaiExport($pegawai), 'laporan_pegawai.xlsx');
        }

        return view('admin.laporan.pegawai', compact('pegawai', 'jabatan'));
    }

    // LAPORAN BUAT ABSENSI DAN FILTER
    public function absensi()
    {
        $pegawai = User::all();
        $jabatan = Jabatan::all();
        $absensi = Absensi::all();
        return view('admin.laporan.absensi', compact('pegawai', 'jabatan', 'absensi'));
    }

    //LAPORAN BUAT CUTI DAN FILTER
    public function cuti(Request $request)
    {
        $jabatan = Jabatan::all();
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $jabatanId = $request->input('jabatan');

        if (!$tanggalAwal || !$tanggalAkhir) {
            $cuti = Cutis::with(['pegawai.jabatan'])->get();
        } else {
            $cuti = Cutis::with(['pegawai.jabatan'])
                ->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir])
                ->get();
        }

        /// Export ke Excel
        if ($request->has('download_excel')) {
            return Excel::download(new CutiExport($tanggalAwal, $tanggalAkhir), 'laporan_cuti.xlsx');
        }

        // Hitung total hari cuti untuk setiap record cuti
        foreach ($cuti as $item) {
            $tanggalMulai = \Carbon\Carbon::parse($item->tanggal_mulai);
            $tanggalAkhir = \Carbon\Carbon::parse($item->tanggal_selesai);
            $item->total_hari_cuti = $tanggalMulai->diffInDays($tanggalAkhir) + 1; // +1 agar tanggal mulai juga terhitung
        }

        // tampil pdf
        if ($request->has('view_pdf')) {
            $pdf = PDF::loadView('admin.laporan.pdf_cuti', compact('cuti'));
            return $pdf->stream('laporan_cuti.pdf'); // untuk menampilkan PDF
        }

        // download pdf
        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('admin.laporan.pdf_cuti', compact('cuti'));
            return $pdf->download('laporan_cuti.pdf'); // untuk mendownload PDF
        }

        return view('admin.laporan.cuti', compact('cuti', 'jabatan'));
    }
}
