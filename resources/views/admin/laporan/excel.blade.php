<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .header {
            background-color: #0B2B40;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }
        .item {
            border: 1px solid #e2e8f0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="7" class="title">LAPORAN OPERASIONAL Fish Health +</td>
        </tr>
        <tr>
            <td colspan="7" class="text-center">Tanggal Laporan: {{ date('d F Y') }}</td>
        </tr>
        <tr><td></td></tr> <!-- Spacer -->
        <thead>
            <tr>
                <th class="header" width="50">No.</th>
                <th class="header" width="200">Nama Pelanggan</th>
                <th class="header" width="200">Jenis Layanan</th>
                <th class="header" width="150">Teknisi</th>
                <th class="header" width="120">Tanggal</th>
                <th class="header" width="100">Status</th>
                <th class="header" width="150">Total Bayar (IDR)</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($bookings as $b)
            <tr>
                <td class="item text-center">{{ $no++ }}</td>
                <td class="item">{{ $b->user->name ?? '-' }}</td>
                <td class="item">{{ $b->layanan->nama_layanan ?? '-' }}</td>
                <td class="item">{{ $b->teknisi->user->name ?? 'Belum Ada' }}</td>
                <td class="item text-center">{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</td>
                <td class="item text-center">{{ strtoupper($b->status) }}</td>
                <td class="item text-right">{{ number_format($b->pembayaran->jumlah ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tr><td></td></tr>
        <tr>
            <td colspan="6" class="text-right" style="font-weight: bold;">TOTAL PENDAPATAN:</td>
            <td class="text-right" style="font-weight: bold; background-color: #f1f5f9;">
                Rp {{ number_format($bookings->sum(fn($b) => $b->pembayaran->jumlah ?? 0), 0, ',', '.') }}
            </td>
        </tr>
    </table>
</body>
</html>
