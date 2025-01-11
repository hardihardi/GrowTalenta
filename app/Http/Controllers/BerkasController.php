<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = User::all(); // Mendapatkan semua pegawai
        $berkas = Berkas::with('pegawai')->get(); // Load relasi pegawai untuk setiap berkas

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
    public function edit($id)
    {
        $berkas = Berkas::findOrFail($id);
        return view('admin.berkas.edit', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file_cv' => 'nullable|file|mimes:pdf',
            'file_kk' => 'nullable|file|mimes:pdf',
            'file_ktp' => 'nullable|file|mimes:pdf',
            'file_akte' => 'nullable|file|mimes:pdf',
        ]);

        $berkas = Berkas::findOrFail($id);

        if ($request->hasFile('file_cv')) {
            Storage::delete($berkas->file_cv);
            $berkas->file_cv = $request->file('file_cv')->store('berkas', 'public');
        }
        if ($request->hasFile('file_kk')) {
            Storage::delete($berkas->file_kk);
            $berkas->file_kk = $request->file('file_kk')->store('berkas' , 'public');
        }
        if ($request->hasFile('file_ktp')) {
            Storage::delete($berkas->file_ktp);
            $berkas->file_ktp = $request->file('file_ktp')->store('berkas' , 'public');
        }
        if ($request->hasFile('file_akte')) {
            Storage::delete($berkas->file_akte);
            $berkas->file_akte = $request->file('file_akte')->store('berkas' , 'public');
        }

        $berkas->save();

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berkas = Berkas::findOrFail($id);

        Storage::delete([$berkas->file_cv, $berkas->file_kk, $berkas->file_ktp, $berkas->file_akte]);

        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil dihapus.');
    }

    public function viewFile($type, $id)
    {
        $berkas = Berkas::findOrFail($id);

        switch ($type) {
            case 'cv':
                $filePath = $berkas->file_cv;
                break;
            case 'kk':
                $filePath = $berkas->file_kk;
                break;
            case 'ktp':
                $filePath = $berkas->file_ktp;
                break;
            case 'akte':
                $filePath = $berkas->file_akte;
                break;
            default:
                abort(404, 'File tidak ditemukan.');
        }

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file(storage_path('app/public/' . $filePath));
    }

}
