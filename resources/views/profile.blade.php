@extends('layout')

@section('title', 'Edit Profil')

@section('content')
<div class="form-header">
    <div>
        <h2 class="page-title">
            <i class="bi bi-person-gear"></i> Edit Profil
        </h2>
        <p class="page-subtitle">Perbarui data diri Anda</p>
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card modern-card">
            <div class="card-body p-4">
                
                {{-- Tampilkan Alert Sukses/Error --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show modern-alert mb-4">
                    <div class="alert-icon"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="alert-content"><strong>Berhasil!</strong> {{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show modern-alert mb-4">
                    <div class="alert-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <div class="alert-content">
                        <strong>Perhatian!</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon section-icon-primary">
                                <i class="bi bi-person-vcard"></i>
                            </div>
                            <div>
                                <h5 class="section-title">Data Akun</h5>
                                <p class="section-description">Informasi dasar akun Anda</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-person"></i> Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-modern" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-envelope"></i> Email</label>
                            <input type="email" class="form-control form-control-modern" 
                                   value="{{ $user->email }}" disabled style="background-color: #e9ecef;">
                            <small class="text-muted ms-2"><i class="bi bi-info-circle"></i> Email tidak dapat diubah</small>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="bi bi-card-heading"></i>
                            </div>
                            <div>
                                <h5 class="section-title">Data Kependudukan</h5>
                                <p class="section-description">Data ini akan digunakan otomatis dalam surat</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-credit-card-2-front"></i> NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" class="form-control form-control-modern" 
                                   value="{{ old('nik', $user->nik) }}" required maxlength="16" minlength="16">
                            <small class="text-muted ms-2">Harus 16 digit angka</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-geo-alt"></i> Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control form-control-modern" rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Style CSS Tambahan (Ambil dari create.blade.php agar konsisten) --}}
<style>
/* Copy sebagian style yang diperlukan dari create.blade.php jika belum ada di layout global */
.modern-card { border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px; }
.section-icon { width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0; }
.section-icon-primary { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
.form-label-modern { font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; }
.form-control-modern { border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e2e8f0; }
.form-control-modern:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
.section-header { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
.section-title { font-weight: 700; margin: 0; }
.section-divider { height: 1px; background: #e2e8f0; margin: 2rem 0; }
</style>
@endsection