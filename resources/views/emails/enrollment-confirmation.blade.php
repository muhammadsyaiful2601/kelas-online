<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran Kelas</title>
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #374151; margin: 0; padding: 0; background-color: #f3f4f6; }
        .wrapper { width: 100%; padding: 40px 20px; background-color: #f3f4f6; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); overflow: hidden; }
        .header { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); padding: 40px 32px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; letter-spacing: -0.025em; }
        .content { padding: 32px; }
        .content h2 { color: #111827; font-size: 20px; font-weight: 600; margin: 0 0 12px 0; }
        .content p { color: #6b7280; font-size: 15px; margin: 0 0 24px 0; }
        .detail-card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px; margin-bottom: 24px; }
        .detail-row { display: flex; justify-content: space-between; align-items: baseline; padding: 12px 0; border-bottom: 1px solid #e5e7eb; }
        .detail-row:last-child { border-bottom: none; padding-bottom: 0; }
        .detail-label { font-size: 14px; font-weight: 500; color: #6b7280; }
        .detail-value { font-size: 14px; color: #111827; font-weight: 500; text-align: right; max-width: 60%; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .notice-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 16px; margin-top: 24px; }
        .notice-box p { color: #1e3a8a; font-size: 14px; margin: 0; font-weight: 500; }
        .footer { padding: 24px 32px; background: #f9fafb; border-top: 1px solid #e5e7eb; text-align: center; }
        .footer p { color: #9ca3af; font-size: 13px; margin: 0; }
        .footer .brand { color: #4f46e5; font-weight: 600; text-decoration: none; }
        a { color: #4f46e5; text-decoration: none; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Konfirmasi Pendaftaran Kelas</h1>
            </div>
            <div class="content">
                <h2>Halo, {{ $enrollment->name }}!</h2>
                <p>Terima kasih telah mendaftar ke kelas <strong>{{ $course->title }}</strong> di <a href="{{ config('app.url') }}" class="brand">Kelas Online</a>. Pendaftaran Anda telah kami terima dan sedang diproses.</p>

                <div class="detail-card">
                    <div class="detail-row">
                        <span class="detail-label">Nama Lengkap:</span>
                        <span class="detail-value">{{ $enrollment->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">{{ $enrollment->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Judul Kelas:</span>
                        <span class="detail-value">{{ $course->title }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Instruktur:</span>
                        <span class="detail-value">{{ $course->instructor }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Harga:</span>
                        <span class="detail-value">{{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status Pendaftaran:</span>
                        <span class="badge badge-pending">{{ strtoupper($enrollment->status->value ?? 'PENDING') }}</span>
                    </div>
                </div>

                <div class="notice-box">
                    <p>Status pendaftaran Anda saat ini <strong>PENDING</strong> dan menunggu verifikasi dari admin. Kami akan memberitahu Anda melalui email ketika pendaftaran disetujui atau ditolak.</p>
                </div>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} <a href="{{ config('app.url') }}" class="brand">Kelas Online</a>. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </div>
</body>
</html>
