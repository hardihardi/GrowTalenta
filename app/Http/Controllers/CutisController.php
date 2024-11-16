<?php

namespace App\Http\Controllers;

use App\Models\Cutis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutisController extends Controller
{
    public function index()
    {
        $pegawai = User::all();
        $cuti = Cutis::with(['pegawai.jabatan'])->get();
        $cutiNotifications = Cutis::where('status_cuti', 0)->get();
        confirmDelete('Hapus Cuti!', 'Apakah Anda Yakin?');
        return view('admin.cuti.index', compact('cuti', 'pegawai', 'cutiNotifications'));
    }
    public function index1()
    {
        $pegawai = User::all();
        $cuti = Cutis::with(['pegawai.jabatan'])->get();
        confirmDelete('Hapus Cuti!', 'Apakah Anda Yakin?');
        return view('user.cuti.index', compact('cuti', 'pegawai'));
    }

    public function menu()
    {
        $cuti = Cutis::all();
        $cutiNotifications = Cutis::where('status_cuti', 0)->get();

        // Hitung total hari cuti untuk setiap record cuti
        foreach ($cuti as $item) {
            $tanggalMulai = \Carbon\Carbon::parse($item->tanggal_mulai);
            $tanggalAkhir = \Carbon\Carbon::parse($item->tanggal_selesai);
            $item->total_hari_cuti = $tanggalMulai->diffInDays($tanggalAkhir) + 1; // +1 agar tanggal mulai juga terhitung
        }

        return view('admin.cuti.menu', compact('cuti', 'cutiNotifications'));
    }

    public function create()
    {
        $pegawai = User::where('is_admin', 0)->get();
        return view('cuti.create', compact('pegawai')); // Form untuk membuat cuti
    }

    // Di dalam CutisController.php

    public function store1(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_cuti' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_cuti',
            'alasan' => 'required|string',
        ]);

        // Simpan data cuti ke database
        Cutis::create([
            'id_user' => Auth::id(),
            'tanggal_mulai' => $validated['tanggal_cuti'], // Menyimpan tanggal mulai
            'tanggal_selesai' => $validated['tanggal_selesai'], // Menyimpan tanggal selesai
            'alasan' => $validated['alasan'], // Menyimpan alasan
            'status_cuti' => 0, // Status "Menunggu Konfirmasi"
        ]);

        return redirect()->route('cuti.index1')->with('success', 'Pengajuan cuti berhasil diajukan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $cuti = Cutis::findOrFail($id);
        $cuti->status = $request->status;
        $cuti->save();

        return redirect()->back()->with('success', 'Status cuti berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        $cuti = new Cutis();
        $cuti->id_user = $request->id_user;
        $cuti->tanggal_mulai = $request->tanggal_mulai;
        $cuti->tanggal_selesai = $request->tanggal_selesai;
        $cuti->alasan = $request->alasan;
        $cuti->save();

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diajukan.');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $cuti = Cutis::findOrFail($id);
        $cuti->delete();
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus.');
    }

    public function confirm($id)
    {
        $cuti = Cutis::findOrFail($id);
        $cuti->status_cuti = 1;
        $cuti->save();

        return redirect()->back()->with('success', 'Pengajuan cuti diterima.');
    }
    public function approve($id)
{
    $cuti = Cutis::findOrFail($id);
    $cuti->status_cuti = 1; // Assuming 1 indicates approved
    $cuti->save();

    return redirect()->back()->with('success', 'Cuti approved successfully.');
}


}