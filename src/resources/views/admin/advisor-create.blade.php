@extends('layouts.app')
@section('title','เพิ่มข้อมูลอาจารย์ที่ปรึกษา')
@section('content')
<div class="container mt-4 mb-5">
    <h4 class="fw-bold text-primary mb-3">เพิ่มข้อมูลอาจารย์ที่ปรึกษา</h4>
    <form method="POST" action="{{ route('admin.advisor.store') }}">
        @csrf
        <div class="mb-3">
            <label for="major_id" class="form-label">เลือกสาขา</label>
            <select name="major_id" id="major_id" class="form-select" required>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="advisor_name" class="form-label">ชื่ออาจารย์ที่ปรึกษา</label>
            <input type="text" name="advisor_name" id="advisor_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">กลับ</a>
    </form>
</div>
@endsection
