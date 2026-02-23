<?php

namespace App\Models;

// ✅ 1. เพิ่มบรรทัดนี้ เพื่อเรียกใช้ระบบ Factory
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // เพิ่ม Notifiable ไว้ด้วยตามมาตรฐาน (เผื่ออนาคตใช้แจ้งเตือน)
use Illuminate\Validation\ValidationException;

class User extends Authenticatable
{
    // ✅ 2. เพิ่มบรรทัดนี้ เพื่อเปิดใช้งานในตัว Class
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verification_expires_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $user): void {
            if (empty($user->email)) {
                return;
            }

            $normalizedEmail = strtolower(trim((string) $user->email));
            $parts = explode('@', $normalizedEmail);
            $domain = count($parts) === 2 ? $parts[1] : '';

            if ($domain !== 'rmuti.ac.th') {
                throw ValidationException::withMessages([
                    'email' => 'กรุณาใช้อีเมลมหาวิทยาลัยที่ลงท้ายด้วย @rmuti.ac.th เท่านั้น',
                ]);
            }

            $user->email = $normalizedEmail;
        });
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}