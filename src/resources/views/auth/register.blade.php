@extends('layouts.app')
@section('title','สมัครสมาชิก')
@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700&family=Sarabun:wght@300;400;600&display=swap');

  :root {
    --brand-ink: #0f172a;
    --brand-teal: #0f766e;
    --brand-gold: #f59e0b;
    --brand-mist: #eef2f7;
    --brand-cloud: #f8fafc;
    --brand-line: rgba(15, 23, 42, 0.12);
  }

  .register-section {
    margin: 32px auto 56px;
  }

  .register-wrap {
    position: relative;
    padding: 28px;
    border-radius: 28px;
    background: linear-gradient(135deg, #f8fbff 0%, #e7f1f6 45%, #fef6e8 100%);
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
  }

  .register-wrap::before,
  .register-wrap::after {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    opacity: 0.2;
    pointer-events: none;
  }

  .register-wrap::before {
    top: -80px;
    right: -60px;
    background: radial-gradient(circle, rgba(15, 118, 110, 0.8), transparent 70%);
  }

  .register-wrap::after {
    bottom: -100px;
    left: -60px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.7), transparent 70%);
  }

  .register-grid {
    display: grid;
    gap: 24px;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    position: relative;
    z-index: 1;
  }

  .register-hero {
    padding: 18px;
    color: var(--brand-ink);
    font-family: 'Kanit', sans-serif;
  }

  .register-hero h1 {
    font-weight: 700;
    font-size: clamp(1.8rem, 2.6vw, 2.4rem);
    margin-bottom: 12px;
  }

  .register-hero p {
    font-family: 'Sarabun', sans-serif;
    color: #475569;
    margin-bottom: 16px;
  }

  .register-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(15, 118, 110, 0.12);
    color: #0f766e;
    font-weight: 600;
    font-size: 0.9rem;
  }

  .register-list {
    margin: 18px 0 0;
    padding: 0;
    list-style: none;
    display: grid;
    gap: 12px;
  }

  .register-list li {
    padding: 12px 14px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid var(--brand-line);
    font-family: 'Sarabun', sans-serif;
    font-size: 0.95rem;
    color: #1f2937;
  }

  .register-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 22px;
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
  }

  .register-card h3 {
    font-family: 'Kanit', sans-serif;
    font-weight: 700;
    color: var(--brand-ink);
    margin-bottom: 6px;
  }

  .register-subtitle {
    font-family: 'Sarabun', sans-serif;
    color: #64748b;
    margin-bottom: 18px;
  }

  .register-card label {
    font-weight: 600;
    color: #334155;
  }

  .register-card .form-control {
    border-radius: 14px;
    border: 1px solid rgba(15, 23, 42, 0.15);
    padding: 10px 12px;
  }

  .register-card .form-control:focus {
    border-color: var(--brand-teal);
    box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
  }

  .register-note {
    font-family: 'Sarabun', sans-serif;
    color: #64748b;
    font-size: 0.85rem;
  }

  .register-alert {
    border-radius: 16px;
    border: 1px solid rgba(239, 68, 68, 0.3);
    background: rgba(254, 226, 226, 0.5);
    color: #991b1b;
    padding: 14px 16px;
    font-family: 'Sarabun', sans-serif;
  }

  .register-actions .btn-primary {
    background: linear-gradient(135deg, #0f766e 0%, #0b4f5a 100%);
    border: none;
    border-radius: 14px;
    padding: 10px 16px;
    font-weight: 700;
  }

  .register-actions .btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    border-radius: 14px;
    padding: 10px 16px;
    border: 1px solid rgba(15, 23, 42, 0.16);
    color: #1f2937;
    text-decoration: none;
    font-weight: 600;
    margin-top: 10px;
    background: #fff;
  }

  @media (max-width: 576px) {
    .register-wrap {
      padding: 20px;
      border-radius: 20px;
    }

    .register-card {
      padding: 18px;
    }
  }
</style>

<div class="register-section">
  <div class="register-wrap">
    <div class="register-grid">
      <div class="register-hero">
        <span class="register-badge">ระบบลงทะเบียนยานพาหนะหอพัก</span>
        <h1>สมัครสมาชิกนักศึกษา</h1>
        <p>กรอกข้อมูลให้ครบถ้วนเพื่อใช้งานระบบตรวจสอบทะเบียนยานพาหนะของหอพัก มทร.อีสาน</p>
        <ul class="register-list">
          <li>ใช้รหัสนักศึกษาเป็นชื่อผู้ใช้ (ตัวเลข 12 หลัก)</li>
          <li>ยืนยันตัวตนด้วยอีเมล @rmuti.ac.th เท่านั้น</li>
          <li>บันทึกข้อมูลแล้วระบบจะส่งลิงก์ยืนยันอีเมลทันที</li>
        </ul>
      </div>

      <div class="register-card">
        <h3>สร้างบัญชีใหม่</h3>
        <div class="register-subtitle">กรอกข้อมูลสำหรับเข้าใช้งานระบบ</div>

        @if($errors->any())
          <div class="register-alert mb-3">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
          @csrf

          <div class="mb-3">
            <label class="mb-1">ชื่อผู้ใช้ (รหัสนักศึกษา)</label>
            <input type="text" name="username" class="form-control" placeholder="เช่น 66172310374-8" value="{{ old('username') }}" inputmode="text" maxlength="13" pattern="^\d{12}$|^\d{11}-\d$" required>
            <div class="register-note">กรอกตัวเลข 12 หลัก และใส่ - ได้ไม่เกิน 1 ตัว</div>
          </div>

          <div class="mb-3">
            <label class="mb-1">อีเมล</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" pattern="^[A-Za-z0-9._%+-]+@rmuti\.ac\.th$" title="กรุณาใช้อีเมลที่ลงท้ายด้วย @rmuti.ac.th" required>
            <div class="register-note">กรอกได้เฉพาะอีเมลที่ลงท้ายด้วย @rmuti.ac.th</div>
          </div>

          <div class="mb-3">
            <label class="mb-1">รหัสผ่าน</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="mb-1">ยืนยันรหัสผ่าน</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>

          <input type="hidden" name="role" value="student">

          <div class="register-actions">
            <button type="submit" class="btn btn-primary w-100">สมัครสมาชิก</button>
            <a href="{{ route('login') }}" class="btn-outline">เข้าสู่ระบบ</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.querySelector('input[name="username"]');
    if (!usernameInput) return;

    usernameInput.addEventListener("input", () => {
      let value = usernameInput.value.replace(/[^0-9-]/g, "");
      const parts = value.split("-");
      if (parts.length > 2) {
        value = parts.shift() + "-" + parts.join("").replace(/-/g, "");
      }
      const digits = value.replace(/\D+/g, "");
      if (digits.length > 12) {
        const trimmed = digits.slice(0, 12);
        value = trimmed;
      }
      usernameInput.value = value;
    });
  });
</script>
@endpush