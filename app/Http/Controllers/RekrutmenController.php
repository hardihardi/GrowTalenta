<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekrutmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekrutmen = Rekrutmen::latest()->get();
        confirmDelete('Hapus Rekrutmen!', 'Apakah Anda Yakin?');
        return view('admin.rekrutmen.index', compact('rekrutmen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rekrutmen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lamaran' => 'required',
        ]);

        $rekrutmen = new Rekrutmen();
        $rekrutmen->nama = $request->nama;
        $rekrutmen->tanggal_lamaran = $request->tanggal_lamaran;

        // Proses upload file CV
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filePath = $file->store('cv', 'public'); // Menggunakan disk public
            $rekrutmen->cv = $filePath;
        }

        // $rekrutmen->cv = $filePath;
        $rekrutmen->save();

        return redirect()->route('rekrutmen.index')->with('success', 'Rekrutmen berhasil diajukan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rekrutmen = Rekrutmen::find($id);
        $rekrutmen->status_rekrutmen = $request->status_rekrutmen;
        $rekrutmen->save();

        return redirect()->route('rekrutmen.index')->with('success', 'Rekrutmen telah diterima.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rekrutmen = Rekrutmen::findOrFail($id);
        if ($rekrutmen->cv && Storage::disk('public')->exists($rekrutmen->cv)) {
            Storage::disk('public')->delete($rekrutmen->cv);
        }
        $rekrutmen->delete();
        return redirect()->route('rekrutmen.index')->with('success', 'Rekrutmen berhasil dihapus.');
    }
}
