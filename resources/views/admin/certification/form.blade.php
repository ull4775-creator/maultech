@extends('layouts.admin')
@section('title', isset($cert) ? 'Edit Certification' : 'Add Certification')
@section('page-title', isset($cert) ? 'Edit Certification' : 'Add New Certification')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($cert) ? route('admin.certification.update', $cert) : route('admin.certification.store') }}" method="POST">
                @csrf
                @if(isset($cert)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Certificate Name *</label>
                    <input type="text" name="name" class="form-control form-control-admin @error('name') is-invalid @enderror" 
                           value="{{ old('name', $cert->name ?? '') }}" required placeholder="CERTIFICATE OF COMPETENCY ASSESSMENT">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Judul sertifikat (wajib)</small>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company / Organization</label>
                        <input type="text" name="issuer" class="form-control form-control-admin" 
                               value="{{ old('issuer', $cert->issuer ?? '') }}" placeholder="PT. SUKA TEKNOLOGI GOBAL">
                        <small class="text-white-50">Nama perusahaan/lembaga (opsional)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Position / Role</label>
                        <input type="text" name="position" class="form-control form-control-admin" 
                               value="{{ old('position', $cert->position ?? '') }}" placeholder="Junior Web Programmer">
                        <small class="text-white-50">Posisi/jabatan (opsional)</small>
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Level / Grade</label>
                        <input type="text" name="level" class="form-control form-control-admin" 
                               value="{{ old('level', $cert->level ?? '') }}" placeholder="KOMPETEN">
                        <small class="text-white-50">Tingkat kompetensi (opsional)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Year</label>
                        <input type="text" name="year" class="form-control form-control-admin" 
                               value="{{ old('year', $cert->year ?? '') }}" placeholder="2026">
                        <small class="text-white-50">Tahun sertifikasi (opsional)</small>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Icon (Bootstrap Icon class)</label>
                    <input type="text" name="icon" class="form-control form-control-admin" 
                           value="{{ old('icon', $cert->icon ?? 'bi-patch-check-fill') }}" placeholder="bi-patch-check-fill">
                    <small class="text-white-50">Cari icon di: <a href="https://icons.getbootstrap.com" target="_blank" class="text-info">icons.getbootstrap.com</a></small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Credential URL</label>
                    <input type="url" name="credential_url" class="form-control form-control-admin" 
                           value="{{ old('credential_url', $cert->credential_url ?? '') }}" placeholder="https://...">
                    <small class="text-white-50">Link ke sertifikat digital (opsional)</small>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save Certificate
                    </button>
                    <a href="{{ route('admin.certification.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Information</h6>
            <p class="text-white-50 small mb-3">Form ini digunakan untuk menambah/edit sertifikat kompetensi Anda.</p>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Hanya <strong>Certificate Name</strong> yang wajib diisi</li>
                <li class="mb-2">✓ Field lainnya bersifat <strong>opsional</strong></li>
                <li class="mb-2">✓ Isi sesuai dengan sertifikat yang Anda miliki</li>
                <li class="mb-2">✓ Gunakan icon dari Bootstrap Icons</li>
                <li>✓ Data akan tampil di halaman home portfolio</li>
            </ul>
        </div>
    </div>
</div>
@endsection