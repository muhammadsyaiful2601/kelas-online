<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Konfirmasi Status Pendaftaran Kelas</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #f4f7fb;
            color: #172033;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            -webkit-text-size-adjust: 100%;
        }
        table { border-spacing: 0; }
        img { border: 0; display: block; }
        a { color: #4f46e5; text-decoration: none; }
        .email-shell { width: 100%; padding: 36px 16px; }
        .email-card {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e5eaf2;
            border-radius: 16px;
            overflow: hidden;
        }
        .brand-bar {
            padding: 24px 40px;
            background-color: #172554;
        }
        .brand-mark {
            display: inline-block;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background-color: #6366f1;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            line-height: 34px;
            text-align: center;
            vertical-align: middle;
        }
        .brand-name {
            padding-left: 10px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            vertical-align: middle;
        }
        .content { padding: 40px; }
        .eyebrow {
            margin: 0 0 10px;
            color: #6366f1;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }
        h1 {
            margin: 0 0 14px;
            color: #172033;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.25;
        }
        .intro {
            margin: 0 0 28px;
            color: #61708a;
            font-size: 15px;
            line-height: 1.7;
        }
        .detail-card {
            width: 100%;
            background-color: #f8fafc;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
        }
        .detail-row td {
            padding: 15px 18px;
            border-bottom: 1px solid #e5eaf2;
            font-size: 14px;
            line-height: 1.4;
        }
        .detail-row:last-child td { border-bottom: 0; }
        .detail-label {
            width: 42%;
            color: #718096;
        }
        .detail-value {
            color: #172033;
            font-weight: 600;
            text-align: right;
            word-break: break-word;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }
        .badge-approved { background-color: #dcfce7; color: #166534; }
        .badge-rejected { background-color: #fee2e2; color: #b91c1c; }
        .badge-pending { background-color: #fef3c7; color: #92400e; }
        .notice-box {
            margin-top: 24px;
            padding: 16px 18px;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.6;
        }
        .notice-box p { margin: 0; }
        .notice-box-approved { background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .notice-box-rejected { background-color: #fff7f7; border: 1px solid #fecaca; color: #b91c1c; }
        .footer {
            padding: 24px 40px;
            background-color: #f8fafc;
            border-top: 1px solid #e5eaf2;
            text-align: center;
        }
        .footer p {
            margin: 0;
            color: #8a96a8;
            font-size: 12px;
            line-height: 1.6;
        }
        .footer .brand { color: #4f46e5; font-weight: 700; }
        @media only screen and (max-width: 640px) {
            .email-shell { padding: 16px 10px; }
            .brand-bar, .content { padding: 28px 22px; }
            .footer { padding: 20px 22px; }
            h1 { font-size: 24px; }
            .detail-row td { padding: 13px 14px; }
            .detail-label { width: 40%; }
        }
    </style>
</head>
<body>
    <table role="presentation" width="100%">
        <tr>
            <td class="email-shell">
                <table role="presentation" class="email-card" align="center">
                    <tr>
                        <td class="brand-bar">
                            <span class="brand-mark">KO</span>
                            <span class="brand-name">Kelas Online</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="content">
                            <p class="eyebrow">Pembaruan pendaftaran</p>
                            <h1>Konfirmasi status kelas Anda</h1>
                            <p class="intro">
                                Halo, <strong>{{ $enrollment->name }}</strong>.<br>
                                Status pendaftaran Anda untuk kelas
                                <strong>{{ $course->title }}</strong> telah diubah menjadi <strong>{{ $statusLabel }}</strong> oleh admin.
                            </p>

                            <table role="presentation" class="detail-card">
                                <tr class="detail-row">
                                    <td class="detail-label">Nama lengkap</td>
                                    <td class="detail-value">{{ $enrollment->name }}</td>
                                </tr>
                                <tr class="detail-row">
                                    <td class="detail-label">Email</td>
                                    <td class="detail-value"><a href="mailto:{{ $enrollment->email }}">{{ $enrollment->email }}</a></td>
                                </tr>
                                <tr class="detail-row">
                                    <td class="detail-label">Nama kelas</td>
                                    <td class="detail-value">{{ $course->title }}</td>
                                </tr>
                                <tr class="detail-row">
                                    <td class="detail-label">Status pendaftaran</td>
                                    <td class="detail-value">
                                        <span class="status-badge badge-{{ strtolower($status) }}">{{ $statusLabel }}</span>
                                    </td>
                                </tr>
                            </table>

                            @if ($status === 'APPROVED')
                                <div class="notice-box notice-box-approved">
                                    <p><strong>Pendaftaran disetujui.</strong> Anda sekarang dapat mengakses kelas ini.</p>
                                </div>
                            @elseif ($status === 'REJECTED')
                                <div class="notice-box notice-box-rejected">
                                    <p><strong>Pendaftaran belum dapat disetujui.</strong> Anda dapat mencoba mendaftar pada kelas lain.</p>
                                </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="footer">
                            <p>
                                Email ini dikirim oleh <a href="{{ config('app.url') }}" class="brand">Kelas Online</a>.<br>
                                &copy; {{ date('Y') }} Kelas Online. Semua hak cipta dilindungi.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
