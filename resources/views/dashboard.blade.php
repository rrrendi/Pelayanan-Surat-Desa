@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-header">
    <div>
        <h2 class="page-title">
            <i class="bi bi-grid-fill"></i>
            Dashboard {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Warga' }}
        </h2>
        <p class="page-subtitle">Selamat datang kembali, {{ Auth::user()->name }}! 👋</p>
    </div>
    @if(Auth::user()->role === 'warga')
    <a href="{{ route('surat.create') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-file-earmark-plus"></i> Ajukan Surat Baru
    </a>
    @endif
</div>

@if(Auth::user()->role === 'admin')
<div class="stats-grid">
    <div class="stat-card stat-warning">
        <div class="stat-icon">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $surat->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-badge badge-warning">
            <i class="bi bi-clock"></i> Menunggu Review
        </div>
    </div>

    <div class="stat-card stat-success">
        <div class="stat-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $surat->where('status', 'disetujui')->count() }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat-badge badge-success">
            <i class="bi bi-arrow-up"></i> +12% bulan ini
        </div>
    </div>

    <div class="stat-card stat-danger">
        <div class="stat-icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $surat->where('status', 'ditolak')->count() }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
        <div class="stat-badge badge-danger">
            <i class="bi bi-exclamation-triangle"></i> Perlu Tindak Lanjut
        </div>
    </div>

    <div class="stat-card stat-info">
        <div class="stat-icon">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $surat->count() }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </div>
        <div class="stat-badge badge-info">
            <i class="bi bi-calendar"></i> Bulan ini
        </div>
    </div>
</div>
@endif

<div class="card modern-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-file-earmark-text"></i>
                @if(Auth::user()->role === 'admin')
                    Daftar Pengajuan Surat
                @else
                    Riwayat Pengajuan Saya
                @endif
            </h5>
            <div class="card-actions">
                <input type="text" class="form-control form-control-sm" id="searchTable" placeholder="Cari...">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($surat->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern" id="suratTable">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        @if(Auth::user()->role === 'admin')
                        <th>Pemohon</th>
                        <th>NIK</th>
                        @endif
                        <th>Jenis Surat</th>
                        <th>Keterangan</th>
                        <th width="12%">Status</th>
                        <th>Tanggal</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surat as $index => $item)
                    <tr>
                        <td><strong>{{ $index + 1 }}</strong></td>
                        @if(Auth::user()->role === 'admin')
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($item->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $item->user->name }}</div>
                                    <div class="user-email">{{ $item->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $item->user->nik }}</span></td>
                        @endif
                        <td>
                            <div class="surat-type">
                                <i class="bi bi-file-earmark-text text-primary"></i>
                                {{ $item->suratJenis->nama_surat }}
                            </div>
                        </td>
                        <td>
                            <div class="keterangan-text">
                                {{ Str::limit($item->keterangan, 50) }}
                            </div>
                        </td>
                        <td>
                            @if($item->status == 'pending')
                            <span class="badge-modern badge-modern-warning">
                                <i class="bi bi-clock"></i> Pending
                            </span>
                            @elseif($item->status == 'disetujui')
                            <span class="badge-modern badge-modern-success">
                                <i class="bi bi-check-circle"></i> Disetujui
                            </span>
                            @else
                            <span class="badge-modern badge-modern-danger">
                                <i class="bi bi-x-circle"></i> Ditolak
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="date-display">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at->format('d/m/Y') }}
                            </div>
                            <div class="time-display">
                                {{ $item->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td>
                            @if(Auth::user()->role === 'admin')
                                @if($item->status == 'pending')
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Review
                                </button>
                                @endif
                                @if($item->status == 'disetujui')
                                <a href="{{ route('surat.cetak', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                                @endif
                            @else
                                @if($item->status == 'disetujui')
                                <a href="{{ route('surat.cetak', $item->id) }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i> Download
                                </a>
                                @elseif($item->status == 'ditolak')
                                <button class="btn btn-sm btn-secondary" disabled>
                                    <i class="bi bi-x"></i> Ditolak
                                </button>
                                @else
                                <button class="btn btn-sm btn-warning" disabled>
                                    <i class="bi bi-hourglass-split"></i> Proses
                                </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h3>Belum Ada Data</h3>
            <p>{{ Auth::user()->role === 'admin' ? 'Belum ada pengajuan surat yang masuk' : 'Anda belum mengajukan surat apapun' }}</p>
            @if(Auth::user()->role === 'warga')
            <a href="{{ route('surat.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Ajukan Surat Pertama
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

@if(Auth::user()->role === 'admin')
    @foreach($surat as $item)
        @if($item->status == 'pending')
        <div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">
                    <form method="POST" action="{{ route('surat.updateStatus', $item->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-pencil-square"></i>
                                Review Pengajuan Surat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="review-info">
                                <div class="info-row">
                                    <span class="info-label">Pemohon</span>
                                    <span class="info-value">{{ $item->user->name }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">NIK</span>
                                    <span class="info-value">{{ $item->user->nik }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Jenis Surat</span>
                                    <span class="info-value">{{ $item->suratJenis->nama_surat }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Keterangan</span>
                                    <span class="info-value">{{ $item->keterangan }}</span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-check-square"></i> Status Keputusan <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="disetujui">✓ Disetujui</option>
                                    <option value="ditolak">✗ Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-chat-left-text"></i> Catatan Admin
                                </label>
                                <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan atau alasan jika diperlukan..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan Keputusan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endif

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
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
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

.stat-warning .stat-icon {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.stat-success .stat-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.stat-danger .stat-icon {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.stat-info .stat-icon {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.25rem;
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

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.modern-card {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
    font-size: 0.9rem;
}

.user-email {
    color: #64748b;
    font-size: 0.8rem;
}

.surat-type {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
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

.badge-modern-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-modern-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-modern-danger {
    background: #fee2e2;
    color: #991b1b;
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

.modern-modal .modal-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
    border-radius: 16px 16px 0 0;
}

.review-info {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #64748b;
    font-size: 0.85rem;
}

.info-value {
    color: #0f172a;
    font-weight: 500;
    font-size: 0.9rem;
}

.card-actions input {
    border-radius: 8px;
    border: 2px solid #e2e8f0;
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
}
</style>

<script>
document.getElementById('searchTable')?.addEventListener('keyup', function() {
    const value = this.value.toLowerCase();
    const rows = document.querySelectorAll('#suratTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
    });
});
</script>
@endsection