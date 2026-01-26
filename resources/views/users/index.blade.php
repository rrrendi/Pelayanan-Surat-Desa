@extends('layout')

@section('title', 'Kelola Warga')

@section('content')
<div class="dashboard-header">
    <div>
        <h2 class="page-title">
            <i class="bi bi-people-fill"></i>
            Kelola Data Warga
        </h2>
        <p class="page-subtitle">Manajemen data warga yang terdaftar di sistem</p>
        <small class="text-muted">
            <i class="bi bi-info-circle"></i> Warga mendaftar sendiri melalui halaman registrasi
        </small>
    </div>
</div>

<div class="stats-grid mb-4">
    <div class="stat-card stat-info">
        <div class="stat-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $users->where('role', 'warga')->count() }}</div>
            <div class="stat-label">Total Warga</div>
        </div>
    </div>

    <div class="stat-card stat-success">
        <div class="stat-icon">
            <i class="bi bi-shield-check"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $users->where('role', 'admin')->count() }}</div>
            <div class="stat-label">Administrator</div>
        </div>
    </div>

    <div class="stat-card stat-warning">
        <div class="stat-icon">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $totalPengajuan ?? 0 }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </div>
    </div>
</div>

<div class="card modern-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0">
                <i class="bi bi-table"></i> Daftar Warga Terdaftar
            </h5>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" id="searchTable" 
                       placeholder="🔍 Cari nama, NIK, email..." style="width: 250px;">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern" id="usersTable">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th width="10%">Role</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ Str::limit($user->alamat, 40) }}</td>
                        <td>
                            @if($user->role === 'admin')
                            <span class="badge bg-danger">Admin</span>
                            @else
                            <span class="badge bg-primary">Warga</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @if($user->id !== Auth::id())
                                <button class="btn btn-warning" onclick="openEditModal({{ $user->id }})" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @else
                                <span class="badge bg-secondary">Anda</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <p>Belum ada warga terdaftar</p>
        </div>
        @endif
    </div>
</div>

<!-- MODAL EDIT -->
@foreach($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i> Edit Data Warga
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK (16 digit) <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" maxlength="16" pattern="[0-9]{16}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select" required>
                                <option value="warga" {{ $user->role === 'warga' ? 'selected' : '' }}>Warga</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $user->tempat_lahir }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" {{ $user->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $user->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Agama <span class="text-danger">*</span></label>
                            <select name="agama" class="form-select" required>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ $user->agama === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $user->pekerjaan }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                            <select name="status_perkawinan" class="form-select" required>
                                @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                <option value="{{ $status }}" {{ $user->status_perkawinan === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $user->alamat }}</textarea>
                    </div>

                    <hr>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-info-circle"></i> Kosongkan password jika tidak ingin mengubah
                    </p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" minlength="8" placeholder="Minimal 8 karakter">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<style>
.dashboard-header { 
    margin-bottom: 2rem; 
}
.page-title { 
    font-size: 1.8rem; 
    font-weight: bold; 
    color: #0f172a;
}
.page-subtitle { 
    color: #64748b; 
    margin: 0.5rem 0 0.25rem 0;
}
.stats-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
    gap: 1rem; 
}
.stat-card { 
    background: white; 
    padding: 1.5rem; 
    border-radius: 12px; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-4px);
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}
.stat-info .stat-icon {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}
.stat-success .stat-icon {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}
.stat-warning .stat-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}
.stat-number { 
    font-size: 2rem; 
    font-weight: bold; 
    color: #0f172a;
}
.stat-label { 
    color: #64748b;
    font-weight: 500;
}
.modern-card { 
    border: none; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: hidden;
}
.card-header {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
    padding: 1.25rem;
}
.table-modern { 
    margin: 0; 
}
.table-modern thead { 
    background: #f8fafc;
    color: #0f172a;
}
.table-modern thead th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    padding: 1rem;
}
.table-modern tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s ease;
}
.table-modern tbody tr:hover {
    background: #f8fafc;
}
.table-modern tbody td {
    padding: 1rem;
}
.empty-state { 
    text-align: center; 
    padding: 3rem;
    color: #64748b;
}
.modal-content {
    border-radius: 12px;
    border: none;
}
.modal-header {
    border-radius: 12px 12px 0 0;
}
.btn-group-sm .btn {
    padding: 0.35rem 0.6rem;
}
</style>

<script>
// Search functionality
document.getElementById('searchTable')?.addEventListener('keyup', function() {
    const value = this.value.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
    });
});

// Open Edit Modal
function openEditModal(userId) {
    const modal = new bootstrap.Modal(document.getElementById('editModal' + userId));
    modal.show();
}

// Confirm Delete
function confirmDelete(userId, userName) {
    if (confirm(`Apakah Anda yakin ingin menghapus warga "${userName}"?\n\nData yang dihapus tidak dapat dikembalikan!`)) {
        const form = document.getElementById('deleteForm');
        form.action = `/users/${userId}`;
        form.submit();
    }
}
</script>
@endsection