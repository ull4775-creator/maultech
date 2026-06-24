@extends('layouts.admin')
@section('title', isset($skill) ? 'Edit Skill' : 'Add Skill')
@section('page-title', isset($skill) ? 'Edit Skill' : 'Add New Skill')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($skill) ? route('admin.skill.update', $skill) : route('admin.skill.store') }}" method="POST">
                @csrf
                @if(isset($skill)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Skill Name *</label>
                    <input type="text" name="name" class="form-control form-control-admin @error('name') is-invalid @enderror" 
                           value="{{ old('name', $skill->name ?? '') }}" required placeholder="Laravel / PHP / Communication">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Nama skill (wajib)</small>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-control form-control-admin" required>
                            <option value="technical" @selected(old('category', $skill->category ?? '') == 'technical')>Technical Skill</option>
                            <option value="soft" @selected(old('category', $skill->category ?? '') == 'soft')>Soft Skill</option>
                            <option value="tool" @selected(old('category', $skill->category ?? '') == 'tool')>Tool</option>
                        </select>
                        <small class="text-white-50">Kategori skill</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Level (0-100) *</label>
                        <input type="number" name="level" class="form-control form-control-admin @error('level') is-invalid @enderror" 
                               value="{{ old('level', $skill->level ?? 80) }}" min="0" max="100" required>
                        @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-white-50">Tingkat keahlian (0-100%)</small>
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Icon (Bootstrap Icon class)</label>
                        <input type="text" name="icon" class="form-control form-control-admin" 
                               value="{{ old('icon', $skill->icon ?? 'bi-lightning-fill') }}" placeholder="bi-lightning-fill">
                        <small class="text-white-50">Cari icon di: <a href="https://icons.getbootstrap.com" target="_blank" class="text-info">icons.getbootstrap.com</a></small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Color (Progress Bar)</label>
                        <input type="color" name="color" class="form-control form-control-admin" 
                               value="{{ old('color', $skill->color ?? '#e67e22') }}" style="height:45px;">
                        <small class="text-white-50">Warna progress bar</small>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Preview</label>
                    <div class="p-3" style="background:rgba(255,255,255,0.05);border-radius:10px;">
                        <div class="d-flex justify-content-between mb-2">
                            <span id="previewName" class="fw-bold">{{ old('name', $skill->name ?? 'Skill Name') }}</span>
                            <span id="previewLevel" class="text-white-50">{{ old('level', $skill->level ?? 80) }}%</span>
                        </div>
                        <div style="height:10px;background:rgba(255,255,255,0.1);border-radius:10px;overflow:hidden;">
                            <div id="previewBar" style="width:{{ old('level', $skill->level ?? 80) }}%;height:100%;background:{{ old('color', $skill->color ?? '#e67e22') }};border-radius:10px;transition:all 0.3s;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save Skill
                    </button>
                    <a href="{{ route('admin.skill.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ <strong>Technical Skill</strong>: Programming, framework, database</li>
                <li class="mb-2">✓ <strong>Soft Skill</strong>: Communication, leadership, teamwork</li>
                <li class="mb-2">✓ <strong>Tool</strong>: Git, Docker, Figma, dll</li>
                <li class="mb-2">✓ Level 80-95% untuk skill yang Anda kuasai</li>
                <li class="mb-2">✓ Gunakan warna yang berbeda untuk setiap skill</li>
                <li>✓ Icon opsional - gunakan dari Bootstrap Icons</li>
            </ul>
            
            <div class="mt-4 p-3" style="background:rgba(230,126,34,0.1);border:1px solid rgba(230,126,34,0.3);border-radius:10px;">
                <h6 class="small mb-2" style="color:var(--accent);"><i class="bi bi-lightbulb me-1"></i>Contoh Icon</h6>
                <div class="text-white-50 small">
                    <code>bi-filetype-php</code> - PHP<br>
                    <code>bi-filetype-jsx</code> - React<br>
                    <code>bi-database</code> - Database<br>
                    <code>bi-palette</code> - Design<br>
                    <code>bi-camera-video</code> - CCTV
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview
document.querySelector('input[name="name"]').addEventListener('input', function() {
    document.getElementById('previewName').textContent = this.value || 'Skill Name';
});

document.querySelector('input[name="level"]').addEventListener('input', function() {
    const level = this.value || 80;
    document.getElementById('previewLevel').textContent = level + '%';
    document.getElementById('previewBar').style.width = level + '%';
});

document.querySelector('input[name="color"]').addEventListener('input', function() {
    document.getElementById('previewBar').style.background = this.value;
});
</script>
@endsection