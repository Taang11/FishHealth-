<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Fish Health + | {{ $date }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
            color: #1e293b; 
            line-height: 1.6; 
            margin: 0; 
            padding: 50px;
            background: #fff;
        }

        .header { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #0B2B40; 
            padding-bottom: 25px; 
            margin-bottom: 40px; 
        }

        .brand-section h1 { 
            color: #0B2B40; 
            margin: 0; 
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .brand-section p { 
            color: #64748b; 
            margin: 4px 0 0; 
            font-size: 13px;
            font-weight: 500;
        }

        .report-info {
            text-align: right;
        }

        .report-info h2 {
            margin: 0;
            font-size: 14px;
            color: #0D9488;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .summary-container { 
            display: flex; 
            gap: 20px; 
            margin-bottom: 40px; 
        }

        .summary-card { 
            flex: 1; 
            padding: 20px; 
            background: #f8fafc; 
            border-radius: 16px; 
            border: 1px solid #f1f5f9;
        }

        .summary-card h4 { 
            margin: 0; 
            color: #64748b; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.05em; 
            font-weight: 700;
        }

        .summary-card p { 
            margin: 8px 0 0; 
            color: #0F172A; 
            font-size: 24px; 
            font-weight: 800; 
        }

        .summary-card.highlight {
            background: #0B2B40;
            border-color: #0B2B40;
        }

        .summary-card.highlight h4 { color: rgba(255,255,255,0.6); }
        .summary-card.highlight p { color: #fff; }

        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0;
            margin-bottom: 40px; 
        }

        th { 
            background-color: #f8fafc; 
            color: #475569; 
            text-align: left; 
            padding: 16px 12px; 
            font-size: 11px; 
            text-transform: uppercase; 
            font-weight: 700;
            border-bottom: 2px solid #e2e8f0;
        }

        td { 
            padding: 16px 12px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 12px; 
            color: #334155;
        }

        .user-name { font-weight: 700; color: #0F172A; }
        .service-name { color: #64748b; }

        .status { 
            display: inline-block;
            padding: 4px 10px; 
            border-radius: 99px; 
            font-size: 10px; 
            font-weight: 700; 
            text-transform: uppercase; 
        }
        
        .status-pending { background: #fffbeb; color: #b45309; }
        .status-accepted { background: #f0fdf4; color: #15803d; }
        .status-selesai, .status-completed { background: #f0f9ff; color: #0369a1; }

        .nominal { font-weight: 800; color: #0D9488; text-align: right; }

        .footer-section { 
            margin-top: 60px; 
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer-note {
            font-size: 11px;
            color: #94a3b8;
            max-width: 300px;
        }

        .signature-box { 
            text-align: center;
        }

        .signature-line {
            margin-bottom: 10px;
            height: 80px;
            width: 200px;
            border-bottom: 1px solid #e2e8f0;
        }

        .signature-name {
            font-size: 14px;
            font-weight: 700;
            color: #0F172A;
        }

        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
            .summary-card { border: 1px solid #eee !important; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 30px; text-align: right;">
        <button onclick="window.print()" style="padding: 12px 24px; background: #0D9488; color: white; border: none; border-radius: 12px; cursor: pointer; font-weight: 700; box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);">
            Cetak Laporan (PDF)
        </button>
    </div>

    <div class="header">
        <div class="brand-section">
            <h1>Fish Health +</h1>
            <p>Professional Fish Healthcare Management System</p>
        </div>
        <div class="report-info">
            <h2>Laporan Operasional</h2>
            <p style="font-size: 12px; color: #94a3b8; margin: 4px 0 0;">{{ $date }}</p>
        </div>
    </div>

    <div class="summary-container">
        <div class="summary-card">
            <h4>Total Aktivitas</h4>
            <p>{{ $bookings->count() }} Booking</p>
        </div>
        <div class="summary-card highlight">
            <h4>Total Revenue</h4>
            <p>Rp {{ number_format($total_revenue, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <h4>Status Laporan</h4>
            <p style="font-size: 18px; color: #0D9488;">Terverifikasi</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No.</th>
                <th width="25%">Data Pelanggan</th>
                <th width="25%">Layanan</th>
                <th width="15%">Tanggal</th>
                <th width="12%">Status</th>
                <th width="15%" style="text-align: right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="user-name">{{ $b->user->name ?? '-' }}</div>
                    <div style="font-size: 10px; color: #94a3b8;">Email: {{ $b->user->email ?? '-' }}</div>
                </td>
                <td class="service-name">{{ $b->layanan->nama_layanan ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</td>
                <td>
                    <span class="status status-{{ strtolower($b->status) }}">
                        {{ $b->status }}
                    </span>
                </td>
                <td class="nominal">
                    Rp {{ number_format($b->pembayaran->jumlah ?? 0, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-section">
        <div class="footer-note">
            Laporan ini dihasilkan secara otomatis oleh sistem Fish Health + dan merupakan dokumen resmi yang sah untuk keperluan administrasi internal Klinik Ikan Premium.
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-name">Manager Operational</div>
            <div style="font-size: 11px; color: #94a3b8;">Fish Health + Indonesia</div>
        </div>
    </div>
</body>
</html>
