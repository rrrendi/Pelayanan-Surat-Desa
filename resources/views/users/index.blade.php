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
                                <button class="btn btn-info" onclick="openViewModal({{ $user->id }})" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($user->id !== Auth::id())
                                <button class="btn btn-warning" onclick="openEditModal({{ $user->id }})" title="Edit">
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

<!-- View Modals - TANPA BOOTSTRAP MODAL, PAKAI DIV BIASA -->
@foreach($users as $user)
<div class="custom-modal" id="viewModal{{ $user->id }}" style="display: none;">
    <div class="custom-modal-backdrop" onclick="closeModal('viewModal{{ $user->id }}')"></div>
    <div class="custom-modal-dialog">
        <div class="custom-modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-circle"></i>
                    Detail Warga
                </h5>
                <button type="button" class="btn-close" onclick="closeModal('viewModal{{ $user->id }}')"></button>
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
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal{{ $user->id }}')">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="custom-modal" id="editModal{{ $user->id }}" style="display: none;">
    <div class="custom-modal-backdrop" onclick="closeModal('editModal{{ $user->id }}')"></div>
    <div class="custom-modal-dialog custom-modal-lg">
        <div class="custom-modal-content modern-modal">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Data Warga
                    </h5>
                    <button type="button" class="btn-close" onclick="closeModal('editModal{{ $user->id }}')"></button>
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
                            <small class="text-muted">Harus tepat 16 digit angka</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select" required>
                                <option value="warga" {{ $user->role === 'warga' ? 'selected' : '' }}>Warga</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $user->alamat }}</textarea>
                    </div>
                    <hr>
                    <p class="text-muted small">
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
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editModal{{ $user->id }}')">
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

.modern-card {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 16px;
}

.table-modern {
    margin: 0;
}

.table-modern thead {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
}

.table-modern thead th {
    border: none;
    padding: 1rem;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-modern tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s ease;
}

.table-modern tbody tr:hover {
    background: #f8fafc;
}

.table-modern tbody td {
    padding: 1rem;
    vertical-align: middle;
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

.alamat-text {
    color: #64748b;
    font-size: 0.9rem;
}

.badge-modern {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.5rem 0.85rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.8rem;
}

.badge-modern-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-modern-primary {
    background: #dbeafe;
    color: #1e40af;
}

.date-display {
    font-size: 0.9rem;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.time-display {
    font-size: 0.75rem;
    color: #64748b;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon i {
    font-size: 5rem;
    color: #cbd5e1;
}

.empty-state h3 {
    color: #0f172a;
    margin: 1rem 0 0.5rem;
    font-weight: 700;
}

.empty-state p {
    color: #64748b;
}

/* CUSTOM MODAL STYLES - TANPA BOOTSTRAP */
.custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 100000;
    overflow-y: auto;
}

.custom-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.custom-modal-dialog {
    position: relative;
    margin: 1.75rem auto;
    max-width: 500px;
    z-index: 2;
    animation: modalSlideIn 0.3s ease;
}

.custom-modal-lg {
    max-width: 800px;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.custom-modal-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
    border-radius: 16px 16px 0 0;
    border: none;
    padding: 1.25rem 1.5rem;
}

.modern-modal .modal-title {
    margin: 0;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-modal .modal-body {
    padding: 2rem;
}

.modern-modal .modal-footer {
    border-top: 1px solid #e2e8f0;
    padding: 1.25rem 2rem;
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
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
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
    align-items: center;
}

.info-label {
    font-weight: 600;
    color: #64748b;
    font-size: 0.85rem;
}

.info-value {
    color: #0f172a;
    font-weight: 500;
    text-align: right;
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
    
    .table-modern {
        font-size: 0.85rem;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .custom-modal-dialog {
        margin: 0.5rem;
        max-width: calc(100% - 1rem);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search Functionality
    const searchInput = document.getElementById('searchTable');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    }

    // Filter by Role
    const filterRole = document.getElementById('filterRole');
    if (filterRole) {
        filterRole.addEventListener('change', function() {
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
    }
    
    // Remove any leftover Bootstrap backdrops on page load
    cleanupBackdrops();
});

// Function to open view modal
function openViewModal(userId) {
    closeAllModals();
    cleanupBackdrops();
    
    const modal = document.getElementById('viewModal' + userId);
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

// Function to open edit modal
function openEditModal(userId) {
    closeAllModals();
    cleanupBackdrops();
    
    const modal = document.getElementById('editModal' + userId);
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

// Function to close specific modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
    
    // Check if all modals are closed
    const allModals = document.querySelectorAll('.custom-modal');
    const anyVisible = Array.from(allModals).some(m => m.style.display === 'block');
    
    if (!anyVisible) {
        document.body.style.overflow = '';
    }
    
    cleanupBackdrops();
}

// Function to close all modals
function closeAllModals() {
    const modals = document.querySelectorAll('.custom-modal');
    modals.forEach(modal => {
        modal.style.display = 'none';
    });
    document.body.style.overflow = '';
    cleanupBackdrops();
}

// Function to aggressively cleanup Bootstrap backdrops
function cleanupBackdrops() {
    // Remove any Bootstrap modal backdrops
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => {
        backdrop.remove();
    });
    
    // Remove modal-open class from body
    document.body.classList.remove('modal-open');
    
    // Reset body padding
    document.body.style.paddingRight = '';
}

// Confirm Delete Function
function confirmDelete(userId, userName) {
    closeAllModals();
    cleanupBackdrops();
    
    if (confirm(`Apakah Anda yakin ingin menghapus warga "${userName}"?\n\nData yang dihapus tidak dapat dikembalikan!`)) {
        const form = document.getElementById('deleteForm');
        form.action = `/users/${userId}`;
        form.submit();
    }
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAllModals();
    }
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    cleanupBackdrops();
});

// Periodic cleanup (setiap 1 detik cek backdrop yang tersisa)
setInterval(cleanupBackdrops, 1000);
</script>
@endsection