<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\User;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = User::all();
        $berkas = Berkas::all();
        return view('admin.berkas.index', compact('berkas', 'pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'cv' => 'required',
            'kk' => 'required',
            'akte' => 'required',
            'ktp' => 'required',
        ]);

        $berkas = new Berkas();
        $berkas->id_user = $request->id_user;

        // Proses upload file CV
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filePath = $file->store('cv', 'public'); // Menggunakan disk public
            $berkas->file_cv = $filePath;
        }
        // Proses upload file KK
        if ($request->hasFile('kk')) {
            $file = $request->file('kk');
            $filePath = $file->store('kk', 'public'); // Menggunakan disk public
            $berkas->file_kk = $filePath;
        }
        // Proses upload file KTP
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $filePath = $file->store('ktp', 'public'); // Menggunakan disk public
            $berkas->file_ktp = $filePath;
        }
        // Proses upload file AKTE
        if ($request->hasFile('akte')) {
            $file = $request->file('akte');
            $filePath = $file->store('akte', 'public'); // Menggunakan disk public
            $berkas->file_akte = $filePath;
        }

        $berkas->save();
        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $berkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berkas $berkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berkas $berkas)
    {
        //
    }
}
