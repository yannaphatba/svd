@extends('layouts.app')
@section('title','เพิ่มข้อมูลสาขา')
@section('content')
<div class="container mt-4 mb-5">
    <h4 class="fw-bold text-primary mb-3">เพิ่มข้อมูลสาขา</h4>
    <form method="POST" action="{{ route('admin.major.store') }}">
        @csrf
        <div class="mb-3">
            <label for="faculty_id" class="form-label">เลือกคณะ</label>
            <select name="faculty_id" id="faculty_id" class="form-select" required>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="major_name" class="form-label">ชื่อสาขา</label>
            <input type="text" name="major_name" id="major_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">กลับ</a>
    </form>
</div>
@endsection
