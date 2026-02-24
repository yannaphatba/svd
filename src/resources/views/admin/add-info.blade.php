@extends('layouts.app')
@section('title','เพิ่มข้อมูลคณะ/สาขา/อาจารย์')
@section('content')
<div class="container mt-4 mb-5">
    <h4 class="fw-bold text-primary mb-3">เพิ่มข้อมูลคณะ/สาขา/อาจารย์</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex flex-column gap-3">
        <a href="{{ route('admin.faculty.create') }}" class="btn btn-success btn-lg fw-bold">เพิ่มข้อมูลคณะ</a>
        <a href="{{ route('admin.major.create') }}" class="btn btn-primary btn-lg fw-bold">เพิ่มข้อมูลสาขา</a>
        <a href="{{ route('admin.advisor.create') }}" class="btn btn-info btn-lg fw-bold">เพิ่มข้อมูลอาจารย์ที่ปรึกษา</a>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold text-secondary mb-2">คณะ</h5>
    @if ($faculties->isEmpty())
        <div class="text-muted mb-3">ยังไม่มีข้อมูลคณะ</div>
    @else
        <ul class="list-group mb-4">
            @foreach ($faculties as $faculty)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $faculty->name }}</span>
                    <form method="POST" action="{{ route('admin.faculty.destroy', $faculty->id) }}" onsubmit="return confirm('ยืนยันลบคณะนี้?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <h5 class="fw-bold text-secondary mb-2">สาขา</h5>
    @if ($majors->isEmpty())
        <div class="text-muted mb-3">ยังไม่มีข้อมูลสาขา</div>
    @else
        <ul class="list-group mb-4">
            @foreach ($majors as $major)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $major->name }} <span class="text-muted">({{ $major->faculty?->name ?? '-' }})</span></span>
                    <form method="POST" action="{{ route('admin.major.destroy', $major->id) }}" onsubmit="return confirm('ยืนยันลบสาขานี้?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <h5 class="fw-bold text-secondary mb-2">อาจารย์ที่ปรึกษา</h5>
    @if ($advisors->isEmpty())
        <div class="text-muted mb-3">ยังไม่มีข้อมูลอาจารย์ที่ปรึกษา</div>
    @else
        <ul class="list-group mb-4">
            @foreach ($advisors as $advisor)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        {{ $advisor->name }}
                        <span class="text-muted">({{ $advisor->majors->pluck('name')->implode(', ') }})</span>
                    </span>
                    <form method="POST" action="{{ route('admin.advisor.destroy', $advisor->id) }}" onsubmit="return confirm('ยืนยันลบอาจารย์ที่ปรึกษานี้?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-2">กลับ</a>
</div>
@endsection
