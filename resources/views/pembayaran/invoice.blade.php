<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $pembayaran->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1f2937;
            font-size: 28px;
        }
        .invoice-number {
            text-align: right;
        }
        .invoice-number h2 {
            color: #3b82f6;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .invoice-number p {
            color: #6b7280;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            color: #1f2937;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #4b5563;
        }
        .info-label {
            font-weight: 500;
            width: 40%;
        }
        .info-value {
            width: 60%;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead {
            background-color: #f3f4f6;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #d1d5db;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            margin-top: 30px;
            border-top: 2px solid #3b82f6;
            padding-top: 20px;
        }
        .total-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .total-label {
            width: 200px;
            font-weight: 500;
            color: #4b5563;
        }
        .total-amount {
            width: 150px;
            text-align: right;
            color: #4b5563;
        }
        .total-amount.grand {
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 12px;
        }
        .status-badge.lunas {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-badge.belum-lunas {
            background-color: #fee2e2;
            color: #991b1b;
        }
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏨 HOTEL BOOKING</h1>
            <div class="invoice-number">
                <h2>INVOICE</h2>
                <p>No. PMB-{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 30px;">
            <div>
                <div class="section">
                    <div class="section-title">Informasi Tamu</div>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $pembayaran->booking->tamu->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $pembayaran->booking->tamu->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telepon</span>
                        <span class="info-value">{{ $pembayaran->booking->tamu->no_telepon }}</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="section">
                    <div class="section-title">Informasi Pembayaran</div>
                    <div class="info-row">
                        <span class="info-label">Tanggal</span>
                        <span class="info-value">{{ $pembayaran->tanggal_pembayaran->format('d M Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Metode</span>
                        <span class="info-value">{{ $pembayaran->metode_pembayaran }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            <span class="status-badge {{ strtolower(str_replace(' ', '-', $pembayaran->status_pembayaran)) }}">
                                {{ $pembayaran->status_pembayaran }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Detail Pemesanan</div>
            <table>
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th class="text-right">Jumlah</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Kamar {{ $pembayaran->booking->kamar->nomor_kamar }}</strong><br>
                            <small>{{ $pembayaran->booking->kamar->tipeKamar->nama_tipe }}</small><br>
                            <small>{{ $pembayaran->booking->tanggal_checkin->format('d M Y') }} - {{ $pembayaran->booking->tanggal_checkout->format('d M Y') }}</small>
                        </td>
                        <td class="text-right">{{ $pembayaran->booking->lama_menginap }} malam</td>
                        <td class="text-right">Rp {{ number_format($pembayaran->booking->kamar->tipeKamar->harga_per_malam, 0, ',', '.') }}</td>
                        <td class="text-right"><strong>Rp {{ number_format($pembayaran->booking->total_harga, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Total Harga</div>
                <div class="total-amount">Rp {{ number_format($pembayaran->booking->total_harga, 0, ',', '.') }}</div>
            </div>
            <div class="total-row">
                <div class="total-label">Total Bayar</div>
                <div class="total-amount grand">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</div>
            </div>
            @if($pembayaran->total_bayar < $pembayaran->booking->total_harga)
                <div class="total-row" style="margin-top: 10px; color: #dc2626;">
                    <div class="total-label">Sisa Pembayaran</div>
                    <div class="total-amount" style="color: #dc2626; font-weight: bold;">Rp {{ number_format($pembayaran->booking->total_harga - $pembayaran->total_bayar, 0, ',', '.') }}</div>
                </div>
            @elseif($pembayaran->total_bayar > $pembayaran->booking->total_harga)
                <div class="total-row" style="margin-top: 10px; color: #f59e0b;">
                    <div class="total-label">Kelebian</div>
                    <div class="total-amount" style="color: #f59e0b; font-weight: bold;">Rp {{ number_format($pembayaran->total_bayar - $pembayaran->booking->total_harga, 0, ',', '.') }}</div>
                </div>
            @endif
        </div>

        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
            <p>Invoice ini dicetak pada {{ now()->format('d M Y H:i') }}</p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
