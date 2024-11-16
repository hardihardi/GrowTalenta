<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\User; // Pastikan menggunakan User
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = Penggajian::latest()->get();
        $pegawai = User::all(); // Mengambil semua pegawai
        confirmDelete('Hapus Penggajian!', 'Apakah Anda Yakin?');
        return view('admin.penggajian.index', compact('penggajian', 'pegawai'));
    }

    public function index1()
    {
        $penggajian = Penggajian::latest()->get();
        $pegawai = User::all(); // Mengambil semua pegawai
        confirmDelete('Hapus Penggajian!', 'Apakah Anda Yakin?');
        return view('user.penggajian.index', compact('penggajian', 'pegawai'));
    }

    public function create()
    {
        $penggajian = Penggajian::all();
        $pegawai = User::all(); // Mengambil semua pegawai
        return view('admin.penggajian.index', compact('penggajian', 'pegawai'));
    }

    public function create1()
    {
        $penggajian = Penggajian::all();
        $pegawai = User::all(); // Mengambil semua pegawai
        return view('user.penggajian.index1', compact('penggajian', 'pegawai'));
    }

    public function store(Request $request)
    {
        // Validasi input
        // $request->validate([...]);

        $penggajian = new Penggajian();
        $penggajian->id_user = $request->id_user; // Menggunakan id_user
        $penggajian->tanggal_gaji = $request->tanggal_gaji;
        $penggajian->jumlah_gaji = $request->jumlah_gaji;
        $penggajian->bonus = $request->bonus;
        $penggajian->potongan = $request->potongan;
        $penggajian->save();

        // Update total gaji pegawai
        $pegawai = User::find($request->id_user);
        if ($pegawai) {
            $total_gaji = $request->jumlah_gaji + ($request->bonus) - ($request->potongan);
            $pegawai->gaji += $total_gaji;
            $pegawai->save();
        }

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil ditambahkan dan total gaji diperbarui.');
    }

    public function store1(Request $request)
    {
        // Validasi input
        // $request->validate([...]);

        $penggajian = new Penggajian();
        $penggajian->id_user = $request->id_user; // Menggunakan id_user
        $penggajian->tanggal_gaji = $request->tanggal_gaji;
        $penggajian->jumlah_gaji = $request->jumlah_gaji;
        $penggajian->bonus = $request->bonus;
        $penggajian->potongan = $request->potongan;
        $penggajian->save();

        // Update total gaji pegawai
        $pegawai = User::find($request->id_user);
        if ($pegawai) {
            $total_gaji = $request->jumlah_gaji + ($request->bonus) - ($request->potongan);
            $pegawai->gaji += $total_gaji;
            $pegawai->save();
        }

        return redirect()->route('penggajian.index1')->with('success', 'Penggajian berhasil ditambahkan dan total gaji diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->id_user = $request->id_user; // Menggunakan id_user
        $penggajian->tanggal_gaji = $request->tanggal_gaji;
        $penggajian->jumlah_gaji = $request->jumlah_gaji;
        $penggajian->bonus = $request->bonus;
        $penggajian->potongan = $request->potongan;
        $penggajian->save();

        // Update total gaji pegawai
        $pegawai = User::find($request->id_user);
        if ($pegawai) {
            $pegawai->gaji = $penggajian->jumlah_gaji + ($request->bonus) - ($request->potongan);
            $pegawai->save();
        }

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil diperbarui dan total gaji diperbarui.');
    }

    public function destroy($id)
    {
        $penggajian = Penggajian::findOrFail($id);

        $pegawai = User::find($penggajian->id_user);
        if ($pegawai) {
            $pegawai->gaji -= ($penggajian->jumlah_gaji + $penggajian->bonus - $penggajian->potongan);
            $pegawai->save();
        }

        $penggajian->delete();
        return redirect()->route('penggajian.index')->with('danger', 'Penggajian berhasil dihapus dan gaji diperbarui!');
    }
}
