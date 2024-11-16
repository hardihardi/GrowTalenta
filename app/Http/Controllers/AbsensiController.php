<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::latest()->get();
        $pegawai = User::latest()->get();
        return view('admin.absensi.index', compact('absensi', 'pegawai'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $absensi = Absensi::all();
        $pegawai = User::where('is_admin', 0)->get();
        return view('admin.absensi.index', compact('absensi', 'pegawai'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        // $request->validate([
        //     'id_user' => 'required|exists:users,id',
        // ]);

        // untuk mengecek apakah user ditemukan
        $pegawai = User::find($request->id_user);
        if (!$pegawai) {
            return redirect()->route('absensi.create')->with('error', 'User tidak ditemukan!');
        }

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('id_user', $pegawai->id)->whereDate('created_at', today())->first();
        if ($sudahAbsen) {
            return redirect()->route('absensi.create')->with('error', 'Anda telah melakukan Absen Hari Ini!');
        }

        // Ambil waktu sekarang
        $jamMasuk = now()->format('H:i'); // atau bisa gunakan Carbon::now()

        Absensi::create([
            'id_user' => $request->id_user,
            'tanggal_absen' => now()->format('Y-m-d'), // format tanggal
            'jam_masuk' => $jamMasuk, // format jam
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absen Masuk berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $pegawai = User::all();
        return view('admin.absensi.index', compact('absensi', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $absensi = Absensi::find($id);

        if ($absensi && is_null($absensi->jam_keluar)) {
            $absensi->jam_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
            $absensi->save();

            Session::forget('absen_masuk');
            Session::put('absen_keluar', true);
            return redirect()->route('absensi.index')->with('success', 'Absen Pulang berhasil disimpan!');
        }
        return redirect()->route('absensi.index')->with('error', 'Absen Pulang gagal disimpan.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
