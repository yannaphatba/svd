@extends('layouts.app')
@section('title','เพิ่มข้อมูลคณะ/สาขา/อาจารย์')
@section('content')
<div class="container mt-4 mb-5">
    <h4 class="fw-bold text-primary mb-3">เพิ่มข้อมูลคณะ/สาขา/อาจารย์</h4>
    <div class="d-flex flex-column gap-3">
        <a href="{{ route('admin.faculty.create') }}" class="btn btn-success btn-lg fw-bold">เพิ่มข้อมูลคณะ</a>
        <a href="{{ route('admin.major.create') }}" class="btn btn-primary btn-lg fw-bold">เพิ่มข้อมูลสาขา</a>
        <a href="{{ route('admin.advisor.create') }}" class="btn btn-info btn-lg fw-bold">เพิ่มข้อมูลอาจารย์ที่ปรึกษา</a>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-4">กลับ</a>
</div>
@endsection
