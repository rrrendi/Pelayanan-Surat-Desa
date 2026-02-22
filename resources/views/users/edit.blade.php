@extends('layout')
@section('title', 'Edit Data Warga')

@section('content')
    <div class="card-organic mb-4" style="background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); color: white;">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                <i class="bi bi-arrow-left fs-5 text-success"></i>
            </a>
            <div>
                <h3 class="fw-bold mb-1">Edit Identitas Warga</h3>
                <p class="mb-0 opacity-75">Perbarui data administratif milik {{ $user->name }}.</p>
            </div>
        </div>
    </div>

    <div class="card-organic">
        @if ($errors->any())
            <div class="alert alert-danger rounded-4 border-0 small">
                <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h5 class="fw-bold mb-4" style="color: var(--primary-green);"><i class="bi bi-person-lines-fill me-2"></i> Data Pribadi</h5>
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">NIK (16 Digit)</label>
                    <input type="text" name="nik" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('nik', $user->nik) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('tanggal_lahir', date('Y-m-d', strtotime($user->tanggal_lahir))) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select bg-light border-0 px-4 py-2" style="border-radius: 12px;" required>
                        <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Agama</label>
                    <select name="agama" class="form-select bg-light border-0 px-4 py-2" style="border-radius: 12px;" required>
                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ $user->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('pekerjaan', $user->pekerjaan) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Status Perkawinan</label>
                    <select name="status_perkawinan" class="form-select bg-light border-0 px-4 py-2" style="border-radius: 12px;" required>
                        @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                            <option value="{{ $status }}" {{ $user->status_perkawinan == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label text-muted small fw-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control bg-light border-0 px-4 py-2" rows="2" style="border-radius: 12px;" required>{{ old('alamat', $user->alamat) }}</textarea>
                </div>
            </div>

            <hr class="border-light my-5">

            <h5 class="fw-bold mb-4" style="color: var(--primary-green);"><i class="bi bi-shield-lock me-2"></i> Keamanan & Akun</h5>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Hak Akses (Role)</label>
                    <select name="role" class="form-select bg-light border-0 px-4 py-2" style="border-radius: 12px;" required>
                        <option value="warga" {{ $user->role == 'warga' ? 'selected' : '' }}>Warga</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold text-warning">Ganti Sandi (Opsional)</label>
                    <input type="password" name="password" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" placeholder="Kosongkan jika tidak diganti">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold text-warning">Ulangi Sandi Baru</label>
                    <input type="password" name="password_confirmation" class="form-control bg-light border-0 px-4 py-2" style="border-radius: 12px;" placeholder="Ulangi sandi baru">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold text-muted">Batal</a>
                <button type="submit" class="btn-green px-5"><i class="bi bi-save me-2"></i> Simpan Pembaruan</button>
            </div>
        </form>
    </div>
@endsection