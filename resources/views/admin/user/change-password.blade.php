@extends('layouts.admin')
@section('title', 'Change Password')
@section('page-title', 'Change My Password')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <div class="mb-4">
                <h5 class="mb-1">Change Your Password</h5>
                <p class="text-white-50 small mb-0">Update password untuk akun: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</p>
            </div>
            
            <form action="{{ route('admin.change-password.update') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Current Password *</label>
                    <div class="position-relative">
                        <input type="password" name="current_password" id="current_password" class="form-control form-control-admin @error('current_password') is-invalid @enderror" 
                               required placeholder="Masukkan password saat ini" style="padding-right:45px;">
                        <span class="toggle-password" onclick="togglePassword('current_password', this)" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-secondary);">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">New Password *</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="new_password" class="form-control form-control-admin @error('password') is-invalid @enderror" 
                               required placeholder="Minimum 8 characters" style="padding-right:45px;">
                        <span class="toggle-password" onclick="togglePassword('new_password', this)" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-secondary);">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Minimum 8 karakter</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Confirm New Password *</label>
                    <div class="position-relative">
                        <input type="password" name="password_confirmation" id="confirm_password" class="form-control form-control-admin" 
                               required placeholder="Repeat new password" style="padding-right:45px;">
                        <span class="toggle-password" onclick="togglePassword('confirm_password', this)" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-secondary);">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-key me-2"></i>Update Password
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-shield-lock me-2"></i>Password Requirements</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Minimal <strong>8 karakter</strong></li>
                <li class="mb-2">✓ Gunakan kombinasi <strong>huruf besar & kecil</strong></li>
                <li class="mb-2">✓ Tambahkan <strong>angka</strong></li>
                <li class="mb-2">✓ Tambahkan <strong>simbol</strong> (!@#$%^&*)</li>
                <li>✓ Jangan gunakan password yang mudah ditebak</li>
            </ul>
            
            <div class="mt-4 p-3" style="background:rgba(230,126,34,0.1);border:1px solid rgba(230,126,34,0.3);border-radius:10px;">
                <h6 class="small mb-2" style="color:var(--accent);"><i class="bi bi-lightbulb me-1"></i>Contoh Password Kuat</h6>
                <small class="text-white-50">
                    • MaulTech2026!<br>
                    • P@ssw0rd#Secure<br>
                    • Admin@Maul2026
                </small>
            </div>
        </div>
    </div>
</div>

<style>
.toggle-password:hover {
    color: var(--accent) !important;
}
</style>

<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    const i = icon.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        i.classList.remove('bi-eye');
        i.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        i.classList.remove('bi-eye-slash');
        i.classList.add('bi-eye');
    }
}
</script>
@endsection