@extends('layout')
@section('title', 'Profil Saya')

@section('content')
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card-organic text-center position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100" style="height: 100px; background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));"></div>
                
                <div class="position-relative mt-4 mb-3">
                    <div class="bg-white rounded-circle d-inline-flex justify-content-center align-items-center shadow-sm" style="width: 100px; height: 100px; border: 4px solid white;">
                        <span class="fw-bold text-success" style="font-size: 2.5rem;">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
                
                <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted small mb-3">NIK: {{ Auth::user()->nik ?? '-' }}</p>
                
                <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-primary' : 'bg-success' }} rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-person-badge"></i> Akun {{ ucfirst(Auth::user()->role) }}
                </span>
                
                <hr class="border-light">
                <p class="text-muted small mb-0"><i class="bi bi-envelope me-2"></i> {{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card-organic">
                <h5 class="fw-bold mb-4" style="color: var(--primary-green);"><i class="bi bi-gear me-2"></i> Pengaturan Akun</h5>
                
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4 border-0 small">
                        <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control border-0 bg-light px-4 py-2" style="border-radius: 12px;" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" class="form-control border-0 bg-light px-4 py-2" style="border-radius: 12px;" value="{{ Auth::user()->nik }}" readonly>
                            <small class="text-danger" style="font-size: 0.7rem;">*NIK tidak dapat diubah</small>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-muted small">Alamat Email</label>
                            <input type="email" name="email" class="form-control border-0 bg-light px-4 py-2" style="border-radius: 12px;" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mt-5 mb-3"><i class="bi bi-shield-lock me-2 text-warning"></i> Keamanan (Ubah Sandi)</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Kata Sandi Baru</label>
                            <input type="password" name="password" class="form-control border-0 bg-light px-4 py-2" style="border-radius: 12px;" placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Ulangi Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-control border-0 bg-light px-4 py-2" style="border-radius: 12px;" placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn-green px-4"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection