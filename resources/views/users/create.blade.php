@extends('layout')

@section('title', 'Tambah Warga Baru')

@section('content')
<div class="form-header">
    <div>
        <h2 class="page-title">
            <i class="bi bi-person-plus-fill"></i>
            Tambah Warga Baru
        </h2>
        <p class="page-subtitle">Daftarkan warga baru ke sistem</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card modern-card">
            <div class="card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show modern-alert">
                    <div class="alert-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}" id="formAddUser">
                    @csrf

                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div>
                                <h5 class="section-title">Data Pribadi</h5>
                                <p class="section-description">Informasi identitas warga</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern">
                                <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control form-control-modern" 
                                   value="{{ old('name') }}" required placeholder="Masukkan nama lengkap sesuai KTP">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-modern">
                                    <i class="bi bi-credit-card-2-front"></i> NIK <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nik" id="nikInput" class="form-control form-control-modern" 
                                       value="{{ old('nik') }}" required placeholder="16 digit NIK" 
                                       maxlength="16" pattern="[0-9]{16}">
                                <div class="nik-feedback mt-2" id="nikFeedback" style="display: none;">
                                    <small class="text-muted">
                                        <span id="nikCount">0</span>/16 digit
                                    </small>
                                </div>
                                <div class="nik-status mt-2" id="nikStatus" style="display: none;"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-modern">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" class="form-control form-control-modern" 
                                       value="{{ old('email') }}" required placeholder="contoh@email.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern">
                                <i class="bi bi-geo-alt"></i> Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea name="alamat" class="form-control form-control-modern" rows="3" 
                                      required placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan, Kecamatan">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon section-icon-primary">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div>
                                <h5 class="section-title">Akun & Keamanan</h5>
                                <p class="section-description">Informasi login untuk warga</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-modern">
                                    <i class="bi bi-lock"></i> Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" id="password" class="form-control form-control-modern" 
                                       required placeholder="Minimal 8 karakter" minlength="8">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i> Minimal 8 karakter
                                </small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-modern">
                                    <i class="bi bi-lock-fill"></i> Konfirmasi Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control form-control-modern" required placeholder="Ulangi password">
                                <div class="password-match mt-2" id="passwordMatch" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-icon">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div>
                                <strong>Tips Keamanan:</strong>
                                <ul>
                                    <li>Password minimal 8 karakter</li>
                                    <li>Gunakan kombinasi huruf, angka, dan simbol</li>
                                    <li>Jangan gunakan password yang mudah ditebak</li>
                                    <li>Informasikan password kepada warga dengan aman</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg" id="btnSubmit">
                            <i class="bi bi-person-plus"></i> Tambah Warga
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="info-card mt-4">
            <div class="info-card-header">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Informasi Penting</strong>
            </div>
            <div class="info-card-body">
                <p><strong>Setelah warga ditambahkan:</strong></p>
                <ol>
                    <li>Warga akan mendapat akses ke sistem</li>
                    <li>Warga dapat login menggunakan email dan password yang dibuat</li>
                    <li>Warga dapat mengajukan surat melalui sistem</li>
                    <li>Pastikan memberitahu warga tentang kredensial login mereka</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<style>
.modern-card {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 16px;
}

.form-section {
    margin-bottom: 2rem;
}

.section-header {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.section-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.section-icon-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.section-description {
    color: #64748b;
    font-size: 0.9rem;
    margin: 0.25rem 0 0 0;
}

.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    margin: 2rem 0;
}

.form-label-modern {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.form-control-modern {
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    background: #f8fafc;
    font-size: 0.95rem;
}

.form-control-modern:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    background: white;
}

.info-box {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    gap: 1rem;
    border: 2px solid #fbbf24;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f59e0b;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.info-box strong {
    color: #92400e;
    display: block;
    margin-bottom: 0.5rem;
}

.info-box ul {
    margin: 0;
    padding-left: 1.25rem;
    color: #78350f;
}

.info-box li {
    margin-bottom: 0.35rem;
    font-size: 0.85rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1.5rem;
    border-top: 2px solid #f1f5f9;
}

.info-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.info-card-header {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
}

.info-card-body {
    padding: 1.5rem;
}

.info-card-body p {
    margin-bottom: 0.75rem;
    color: #0f172a;
}

.info-card-body ol {
    margin: 0;
    padding-left: 1.5rem;
    color: #64748b;
}

.info-card-body li {
    margin-bottom: 0.5rem;
}

.nik-status {
    font-size: 0.85rem;
    padding: 0.5rem;
    border-radius: 6px;
}

.nik-valid {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #10b981;
}

.nik-invalid {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #ef4444;
}

.password-match {
    font-size: 0.85rem;
    padding: 0.5rem;
    border-radius: 6px;
}

.password-valid {
    background: #d1fae5;
    color: #065f46;
}

.password-invalid {
    background: #fee2e2;
    color: #991b1b;
}

@media (max-width: 768px) {
    .form-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nikInput = document.getElementById('nikInput');
    const nikCount = document.getElementById('nikCount');
    const nikFeedback = document.getElementById('nikFeedback');
    const nikStatus = document.getElementById('nikStatus');
    const passwordInput = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const passwordMatch = document.getElementById('passwordMatch');
    const btnSubmit = document.getElementById('btnSubmit');

    // NIK Input Validation
    if (nikInput) {
        nikInput.addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            const length = this.value.length;
            nikCount.textContent = length;
            nikFeedback.style.display = 'block';
            
            // Check length
            if (length === 16) {
                checkNikAvailability(this.value);
            } else if (length > 0) {
                nikStatus.style.display = 'block';
                nikStatus.className = 'nik-status nik-invalid';
                nikStatus.innerHTML = '<i class="bi bi-x-circle"></i> NIK harus tepat 16 digit';
            } else {
                nikStatus.style.display = 'none';
            }
        });
    }

    // Check NIK availability via AJAX
    function checkNikAvailability(nik) {
        fetch('/check-nik', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nik: nik })
        })
        .then(response => response.json())
        .then(data => {
            nikStatus.style.display = 'block';
            if (data.available) {
                nikStatus.className = 'nik-status nik-valid';
                nikStatus.innerHTML = '<i class="bi bi-check-circle"></i> NIK tersedia';
            } else {
                nikStatus.className = 'nik-status nik-invalid';
                nikStatus.innerHTML = '<i class="bi bi-x-circle"></i> ' + data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Password Match Validation
    function checkPasswordMatch() {
        if (passwordConfirmation.value.length > 0) {
            passwordMatch.style.display = 'block';
            if (passwordInput.value === passwordConfirmation.value) {
                passwordMatch.className = 'password-match password-valid';
                passwordMatch.innerHTML = '<i class="bi bi-check-circle"></i> Password cocok';
            } else {
                passwordMatch.className = 'password-match password-invalid';
                passwordMatch.innerHTML = '<i class="bi bi-x-circle"></i> Password tidak cocok';
            }
        } else {
            passwordMatch.style.display = 'none';
        }
    }

    if (passwordInput && passwordConfirmation) {
        passwordInput.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);
    }

    // Form Validation
    const form = document.getElementById('formAddUser');
    if (form) {
        form.addEventListener('submit', function(e) {
            const nik = nikInput.value;
            const password = passwordInput.value;
            const passwordConf = passwordConfirmation.value;

            if (nik.length !== 16) {
                e.preventDefault();
                alert('NIK harus tepat 16 digit!');
                nikInput.focus();
                return false;
            }

            if (!/^[0-9]+$/.test(nik)) {
                e.preventDefault();
                alert('NIK hanya boleh berisi angka!');
                nikInput.focus();
                return false;
            }

            if (password !== passwordConf) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                passwordConfirmation.focus();
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter!');
                passwordInput.focus();
                return false;
            }

            // Show loading
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
        });
    }
});
</script>
@endsection