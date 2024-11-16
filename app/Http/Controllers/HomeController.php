<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pegawai = User::all();

        $totalPegawai = User::count('id');
        $totalPenggajian = User::sum('gaji');
        // $fasilitas = Fasilitas::count('id');
        // $artikel = Artikel::count('id');
        // $pendaftaran = Pendaftaran::count('id');

        return view('home', compact('pegawai', 'totalPegawai', 'totalPenggajian'));
    }
}
