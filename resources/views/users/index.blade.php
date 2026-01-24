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
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-person-plus"></i> Tambah Warga Baru
    </a>
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
        <div class="stat-badge badge-info">
            <i class="bi bi-person-check"></i> Terdaftar
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
        <div class="stat-badge badge-success">
            <i class="bi bi-shield"></i> Aktif
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
        <div class="stat-badge badge-warning">
            <i class="bi bi-graph-up"></i> Bulan ini
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
                <select class="form-select form-select-sm" id="filterRole" style="width: 150px;">
                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="warga">Warga</option>
                </select>
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
                        <th>Nama & Email</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th width="10%">Role</th>
                        <th width="12%">Terdaftar</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr data-role="{{ $user->role }}">
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar" style="background: linear-gradient(135deg, {{ $user->role === 'admin' ? '#ef4444, #dc2626' : '#3b82f6, #2563eb' }});">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="nik-badge">
                                <i class="bi bi-credit-card"></i>
                                {{ $user->nik ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="alamat-text">
                                {{ Str::limit($user->alamat ?? '-', 40) }}
                            </div>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                            <span class="badge-modern badge-modern-danger">
                                <i class="bi bi-shield-fill"></i> Admin
                            </span>
                            @else
                            <span class="badge-modern badge-modern-primary">
                                <i class="bi bi-person"></i> Warga
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="date-display">
                                <i class="bi bi-calendar3"></i>
                                {{ $user->created_at->format('d/m/Y') }}
                            </div>
                            <div class="time-display">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $user->id }}" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($user->id !== Auth::id())
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
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
            <div class="empty-icon">
                <i class="bi bi-people"></i>
            </div>
            <h3>Belum Ada Warga Terdaftar</h3>
            <p>Klik tombol "Tambah Warga Baru" untuk mendaftarkan warga pertama</p>
            <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-person-plus"></i> Tambah Warga Sekarang
            </a>
        </div>
        @endif
    </div>
</div>

<!-- View Modals -->
@foreach($users as $user)
<div class="modal fade" id="viewModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-circle"></i>
                    Detail Warga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="user-detail-card">
                    <div class="user-avatar-large" style="background: linear-gradient(135deg, {{ $user->role === 'admin' ? '#ef4444, #dc2626' : '#3b82f6, #2563eb' }});">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h4 class="text-center mt-3">{{ $user->name }}</h4>
                    <p class="text-center text-muted">{{ $user->email }}</p>
                    
                    <div class="info-grid mt-4">
                        <div class="info-item">
                            <span class="info-label">NIK</span>
                            <span class="info-value">{{ $user->nik ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Role</span>
                            <span class="info-value">{{ ucfirst($user->role) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">{{ $user->alamat ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terdaftar Sejak</span>
                            <span class="info-value">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modern-modal">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Data Warga
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK (16 digit)</label>
                            <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" maxlength="16" pattern="[0-9]{16}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="warga" {{ $user->role === 'warga' ? 'selected' : '' }}>Warga</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ $user->alamat }}</textarea>
                    </div>
                    <hr>
                    <p class="text-muted small">
                        <i class="bi bi-info-circle"></i> Kosongkan password jika tidak ingin mengubah
                    </p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" minlength="8">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
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

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<style>
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.page-subtitle {
    color: #64748b;
    margin: 0.5rem 0 0 0;
    font-size: 0.95rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1rem;
}

.stat-info .stat-icon {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.stat-success .stat-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.stat-warning .stat-icon {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #0f172a;
}

.stat-label {
    color: #64748b;
    font-size: 0.95rem;
    font-weight: 500;
}

.stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.35rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-top: 1rem;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
}

.user-name {
    font-weight: 600;
    color: #0f172a;
}

.user-email {
    color: #64748b;
    font-size: 0.85rem;
}

.nik-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: #f1f5f9;
    padding: 0.35rem 0.75rem;
    border-radius: 6px;
    font-size: 0.85rem;
    font-family: monospace;
    font-weight: 600;
}

.badge-modern-primary {
    background: #dbeafe;
    color: #1e40af;
}

.user-detail-card {
    text-align: center;
}

.user-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 20px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 3rem;
    margin: 0 auto;
}

.info-grid {
    display: grid;
    gap: 1rem;
}

.info-item {
    background: #f8fafc;
    padding: 1rem;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
}

.info-label {
    font-weight: 600;
    color: #64748b;
    font-size: 0.85rem;
}

.info-value {
    color: #0f172a;
    font-weight: 500;
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Search Functionality
document.getElementById('searchTable')?.addEventListener('keyup', function() {
    const value = this.value.toLowerCase();
    const rows = document.querySelectorAll('#usersTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
    });
});

// Filter by Role
document.getElementById('filterRole')?.addEventListener('change', function() {
    const value = this.value;
    const rows = document.querySelectorAll('#usersTable tbody tr');
    
    rows.forEach(row => {
        if (!value || row.dataset.role === value) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

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