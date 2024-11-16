<?php
namespace App\Exports;

use App\Models\Cutis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CutiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal, $tanggalAkhir)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function collection()
    {
        if (!$this->tanggalAwal || !$this->tanggalAkhir) {
            return Cutis::with(['pegawai.jabatan'])->get();
        } else {
            return Cutis::with(['pegawai.jabatan'])
                ->whereBetween('tanggal_mulai', [$this->tanggalAwal, $this->tanggalAkhir])
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pegawai',
            'Jabatan',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Total Hari Cuti',
            'Alasan',
        ];
    }

    public function map($cuti): array
    {
        $tanggalMulai = \Carbon\Carbon::parse($cuti->tanggal_mulai);
        $tanggalAkhir = \Carbon\Carbon::parse($cuti->tanggal_selesai);
        $totalHariCuti = $tanggalMulai->diffInDays($tanggalAkhir) + 1;

        return [
            $cuti->id,
            $cuti->pegawai->nama_pegawai ?? 'Tidak ada pegawai',
            $cuti->pegawai->jabatan->nama_jabatan ?? 'Tidak ada jabatan',
            $cuti->tanggal_mulai,
            $cuti->tanggal_selesai,
            $totalHariCuti,
            $cuti->alasan,
        ];
    }
}
