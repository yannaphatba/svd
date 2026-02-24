@extends('layouts.app')
@section('title','เพิ่มข้อมูลคณะ')
@section('content')
<div class="container mt-4 mb-5">
    <h4 class="fw-bold text-primary mb-3">เพิ่มข้อมูลคณะ</h4>
    <form method="POST" action="{{ route('admin.faculty.store') }}">
        @csrf
        <div class="mb-3">
            <label for="faculty_name" class="form-label">ชื่อคณะ</label>
            <input type="text" name="faculty_name" id="faculty_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">กลับ</a>
    </form>
</div>
@endsection
