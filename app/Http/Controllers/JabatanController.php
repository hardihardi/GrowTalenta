<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::latest()->get();
        confirmDelete('Hapus Jabatan!', 'Apakah Anda Yakin?');
        return view('admin.jabatan.index', compact('jabatan'));
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
            'nama_jabatan' => 'required|unique:jabatans',
            'additional_fields.*' => 'nullable|string|unique:jabatans,nama_jabatan',
        ], [
            'nama_jabatan.unique' => 'Nama jabatan sudah ada!',
            'additional_fields.*.unique' => 'Nama jabatan tambahan sudah ada!',
        ]
        );

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->save();

        // Simpan jabatan tambahan (jika ada)
        if ($request->has('additional_fields')) {
            foreach ($request->additional_fields as $additionalField) {
                if (!empty($additionalField)) {
                    // Buat instance baru untuk tiap jabatan tambahan
                    $newJabatan = new Jabatan();
                    $newJabatan->nama_jabatan = $additionalField;
                    $newJabatan->save();
                }
            }
        }

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan!');
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
        $request->validate([
            'nama_jabatan' => 'required|unique:jabatans,nama_jabatan',
        ], [
            'nama_jabatan.unique' => 'Nama jabatan sudah ada!',
        ]
        );

        $jabatan = Jabatan::find($id);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->save();
        return redirect()->route('jabatan.index')->with('warning', 'Jabatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        // Cek apakah ada pegawai yang menggunakan jabatan ini
        if ($jabatan->pegawai()->count() > 0) {
            return redirect()->route('jabatan.index')->with('error', 'Jabatan tidak bisa dihapus karena masih ada pegawai yang terkait.');
        }

        // Jika tidak ada pegawai terkait, lanjutkan penghapusan
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
