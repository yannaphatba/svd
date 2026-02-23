<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยืนยันอีเมล</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 24px;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px;">
        <h2 style="margin: 0 0 12px 0; color: #111827;">ยืนยันอีเมลของคุณ</h2>
        <p style="margin: 0 0 16px 0; color: #374151;">สวัสดี {{ $user->username }}</p>
        <p style="margin: 0 0 24px 0; color: #374151;">กรุณากดปุ่มด้านล่างเพื่อยืนยันอีเมลและเปิดใช้งานบัญชีของคุณ</p>
        <p style="margin: 0 0 24px 0;">
            <a href="{{ $verifyUrl }}" style="display: inline-block; padding: 10px 18px; background: #16a34a; color: #ffffff; text-decoration: none; border-radius: 6px;">ยืนยันอีเมล</a>
        </p>
        <p style="margin: 0; color: #6b7280; font-size: 12px;">ลิงก์นี้จะหมดอายุใน 60 นาที</p>
    </div>
</body>
</html>
