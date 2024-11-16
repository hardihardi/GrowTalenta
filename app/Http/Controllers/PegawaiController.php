<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $responseProvinsi = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinsis = $responseProvinsi->json(); // Mengubah response menjadi array

        $pegawai = User::where('is_admin', 0)->get()->map(function ($pegawai) use ($provinsis) {
            $pegawai->umur = floor(Carbon::parse($pegawai->tanggal_lahir)->diffInYears(Carbon::now()));

            // Mencari nama provinsi berdasarkan ID provinsi
            $provinsi = collect($provinsis)->firstWhere('id', (string) $pegawai->provinsi);
            $pegawai->nama_provinsi = $provinsi ? $provinsi['name'] : 'Provinsi tidak ditemukan';

            // Mengambil data kota berdasarkan ID provinsi
            $responseKota = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$pegawai->provinsi}.json");
            $kotas = $responseKota->json(); // Mengubah response menjadi array

            // Mencari nama kota berdasarkan ID kota pegawai
            $kota = collect($kotas)->firstWhere('id', (string) $pegawai->kabupaten);
            $pegawai->nama_kota = $kota ? $kota['name'] : 'Kota tidak ditemukan';

            // Mengambil data kecamatan berdasarkan ID kabupaten
            $responseKecamatan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$pegawai->kabupaten}.json");
            $kecamatans = $responseKecamatan->json(); // Mengubah response menjadi array

            // Mencari nama kecamatan berdasarkan ID kecamatan pegawai
            $kecamatan = collect($kecamatans)->firstWhere('id', (string) $pegawai->kecamatan);
            $pegawai->nama_kecamatan = $kecamatan ? $kecamatan['name'] : 'Kecamatan tidak ditemukan';

            // Mengambil data kecamatan berdasarkan ID kabupaten
            $responseKelurahan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$pegawai->kecamatan}.json");
            $kelurahans = $responseKelurahan->json(); // Mengubah response menjadi array

            // Mencari nama kecamatan berdasarkan ID kecamatan pegawai
            $kelurahan = collect($kelurahans)->firstWhere('id', (string) $pegawai->kelurahan);
            $pegawai->nama_kelurahan = $kelurahan ? $kelurahan['name'] : 'Kelurahan tidak ditemukan';

            return $pegawai;
        });

        $jabatan = Jabatan::all();
        confirmDelete('Hapus Pegawai!', 'Apakah Anda Yakin?');

        return view('admin.pegawai.index', compact('pegawai', 'jabatan'));
    }

    public function indexAdmin()
    {
        $pegawai = User::where('is_admin', 1)->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = User::all();
        $jabatan = Jabatan::all();
        return view('admin.pegawai.create', compact('pegawai', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_pegawai' => 'required|unique:pegawais,nama_pegawai',
        //     'tanggal_lahir' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'alamat' => 'required',
        //     'email' => 'required',
        //     'tanggal_masuk' => 'required',
        //     'status' => 'nullable',
        //     'id_jabatan' => 'required',
        //     'provinsi' => 'required',
        //     'kota' => 'required',
        //     'kabupaten' => 'required',
        //     'kecamatan' => 'required',
        //     'kelurahan' => 'required',
        // ], [
        //     'nama_pegawai.unique' => 'Nama jabatan sudah ada!',
        //     'tanggal_lahir.required' => 'Tanggal Lahir Harus Diisi!',
        //     'jenis_kelamin.required' => 'Tanggal Lahir Harus Diisi!',
        //     'alamat.required' => 'Tanggal Lahir Harus Diisi!',
        //     'email.required' => 'Tanggal Lahir Harus Diisi!',
        //     'tanggal_masuk.required' => 'Tanggal Lahir Harus Diisi!',
        //     'umur.required' => 'Tanggal Lahir Harus Diisi!',
        //     'id_jabatan.required' => 'Jabatan Harus Diisi!',
        // ]
        // );

        $pegawai = new User();
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->alamat = $request->alamat;
        $pegawai->email = $request->email;
        $pegawai->password = Hash::make($request->password);
        $pegawai->tanggal_masuk = $request->tanggal_masuk;
        $pegawai->gaji = $request->gaji;
        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->id_jabatan = $request->id_jabatan;

        $pegawai->provinsi = $request->provinsi;
        $pegawai->kabupaten = $request->kabupaten;
        $pegawai->kecamatan = $request->kecamatan;
        $pegawai->kelurahan = $request->kelurahan;

        $pegawai->save();
        return redirect()->route('pegawai.index')->with('success', 'pegawai berhasil ditambahkan!');

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
        $pegawai = User::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('admin.pegawai.edit', compact('pegawai', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'tanggal_masuk' => 'required|date',
            'gaji' => 'required|numeric',
            'status_pegawai' => 'required|boolean',
            'id_jabatan' => 'required|exists:jabatans,id',
        ]);
    
        // Select only the fields you want to update, excluding 'umur'
        $data = $request->only([
            'nama_pegawai', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
            'alamat', 'email', 'tanggal_masuk', 'gaji', 'status_pegawai', 'id_jabatan',
            'provinsi', 'kabupaten', 'kecamatan', 'kelurahan'
        ]);
    
        // Find the Pegawai record and update it
        $pegawai = User::findOrFail($id);
        $pegawai->update($data);
    
        // Redirect back with a success message
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diubah!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = User::find($id);

        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('danger', 'Pegawai tidak ditemukan!');
        }

        if (Auth::user()->id !== $pegawai->id) {
            $pegawai->delete();
            return redirect()->route('pegawai.index')->with('danger', 'pegawai berhasil dihapus!');
        }

        return redirect()->route('pegawai.index')->with('danger', 'Anda tidak bisa menghapus diri sendiri!');

    }
}
