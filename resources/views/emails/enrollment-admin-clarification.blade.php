<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klarifikasi Perubahan Status</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="100%" max-width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1); border: 1px solid #e2e8f0;">
                    <tr>
                        <td style="padding: 32px 32px 24px 32px;">
                            <h1 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0 0 16px 0; line-height: 1.2;">Klarifikasi Perubahan Status</h1>
                            <p style="font-size: 16px; color: #334155; line-height: 1.6; margin: 0 0 24px 0;">
                                Admin <strong>{{ $adminName }}</strong> telah mengubah status pendaftaran dari <strong>{{ ucfirst(strtolower($previousStatus)) }}</strong>.
                                Berikut detail perubahan untuk diklarifikasi apakah terdapat kesalahan input dari admin.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 24px; font-size: 14px; color: #334155;">
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; width: 30%; font-weight: 600; color: #64748b;">Pendaftar</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">{{ $enrollment->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">Email</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">{{ $enrollment->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">Kelas</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">{{ $course->title }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">Status Sebelumnya</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                                        @if($previousStatus === 'PENDING')
                                            <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Pending</span>
                                        @elseif($previousStatus === 'APPROVED')
                                            <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Disetujui</span>
                                        @elseif($previousStatus === 'REJECTED')
                                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Ditolak</span>
                                        @else
                                            <span style="background: #e2e8f0; color: #475569; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">{{ ucfirst(strtolower($previousStatus)) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">Status Baru</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                                        @if($newStatus === 'APPROVED')
                                            <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Disetujui</span>
                                        @elseif($newStatus === 'REJECTED')
                                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Ditolak</span>
                                        @else
                                            <span style="background: #e2e8f0; color: #475569; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">{{ ucfirst(strtolower($newStatus)) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">Diubah Oleh</td>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e2e8f0;">{{ $adminName }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Tanggal Perubahan</td>
                                    <td style="padding: 12px 0;">{{ now()->format('d M Y, H:i') }} WIB</td>
                                </tr>
                            </table>

                            <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                                <p style="font-size: 14px; color: #92400e; margin: 0 0 8px 0; font-weight: 600;">⚠️ Perlu Klarifikasi</p>
                                <p style="font-size: 14px; color: #92400e; margin: 0;">
                                    Status pendaftaran telah diubah dari <strong>{{ ucfirst(strtolower($previousStatus)) }}</strong> menjadi <strong>{{ ucfirst(strtolower($newStatus)) }}</strong>. Silakan verifikasi kembali apakah perubahan ini sudah benar atau terdapat kesalahan input dari admin. Jika terdapat kesalahan, silakan segera memperbaiki status pendaftaran tersebut.
                                </p>
                            </div>

                            <p style="font-size: 14px; color: #64748b; margin: 0;">
                                Sistem Kelas Online<br>
                                Email ini dikirimkan secara otomatis sebagai notifikasi klarifikasi admin.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 32px; border-top: 1px solid #e2e8f0;">
                            <p style="font-size: 12px; color: #94a3b8; margin: 0;">© {{ date('Y') }} Kelas Online. Semua hak cipta dilindungi.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>