<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cuti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Cuti</h1>
    <p>
        Laporan Cuti ini berdasarkan rentang tanggal yang dipilih.
    </p>
    <p>
        Dari: {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }} s/d
        {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal Mulai Cuti</th>
                <th>Tanggal Akhir Cuti</th>
                <th>Total Cuti</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($cuti as $item)
                @if ($item->pegawai->is_admin == 0)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->pegawai->nama_pegawai }}</td>
                        <td>{{ $item->pegawai->jabatan ? $item->pegawai->jabatan->nama_jabatan : 'Tidak ada jabatan' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                        </td>
                        <td>{{ $item->total_hari_cuti }} Hari</td>
                        <td>{{ $item->alasan }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
