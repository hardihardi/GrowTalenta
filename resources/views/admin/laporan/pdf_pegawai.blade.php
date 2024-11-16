<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pegawai</title>
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
    <h1>Laporan Pegawai</h1>
    <p>
        Dari: {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }} s/d
        {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}
    </p>
    <p>
        Tanggal Dibuat : {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Umur</th>
                <th>Email</th>
                <th>Gaji</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($pegawai as $item)
                @if ($item->is_admin == 0)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_pegawai }}</td>
                        <td>{{ $item->jabatan ? $item->jabatan->nama_jabatan : 'Tidak ada jabatan' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                        <td>{{ $item->umur }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ number_format($item->gaji, 2, ',', '.') }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
