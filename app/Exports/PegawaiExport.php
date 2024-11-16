<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PegawaiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $pegawai;

    public function __construct($pegawai)
    {
        $this->pegawai = $pegawai;
    }

    public function collection()
    {
        // Pilih hanya data yang ingin Anda ekspor
        return $this->pegawai->map(function ($item, $key) {
            return [
                'No' => $key + 1,
                'Nama Pegawai' => $item->nama_pegawai,
                'Jabatan' => $item->jabatan->nama_jabatan ?? 'Tidak Ada Jabatan',
                'Tanggal Masuk' => $item->tanggal_masuk,
                'Umur' => floor(\Carbon\Carbon::parse($item->tanggal_lahir)->diffInYears(\Carbon\Carbon::now())),
                'Email' => $item->email,
                'Gaji' => $item->gaji,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Pegawai', 'Jabatan', 'Tanggal Masuk', 'Umur', 'Email', 'Gaji'];
    }
    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->pegawai->count() + 1;

        return [
            // Styling untuk header (baris pertama)
            1 => ['font' => ['bold' => true, 'color' => ['argb' => '000000']], 'alignment' => ['horizontal' => 'center']],
            // Mengatur background header agar berwarna
            'A1:G1' => ['fill' => ['fillType' => 'solid', 'color' => ['argb' => 'CCFFFF']],
            ],
            "A1:G{$rowCount}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => Color::COLOR_BLACK],
                    ],
                ],
            ],
        ];

    }
}
