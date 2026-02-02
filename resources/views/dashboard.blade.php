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
                                                <button class="btn btn-sm btn-success" onclick="openReviewModal({{ $item->id }})">
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
                    <p>{{ Auth::user()->role === 'admin' ? 'Belum ada pengajuan surat yang masuk' : 'Anda belum mengajukan surat apapun' }}
                    </p>
                    @if(Auth::user()->role === 'warga')
                        <a href="{{ route('surat.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Ajukan Surat Pertama
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

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

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.85rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .stat-card {
                padding: 1.25rem;
            }

            .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 1.5rem;
                margin-bottom: 0.85rem;
            }

            .stat-number {
                font-size: 1.75rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }

            .stat-badge {
                font-size: 0.7rem;
                padding: 0.3rem 0.65rem;
                margin-top: 0.85rem;
            }

            .table-modern {
                font-size: 0.85rem;
            }

            .table-modern thead th {
                padding: 0.85rem;
                font-size: 0.75rem;
            }

            .table-modern tbody td {
                padding: 0.85rem;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .user-name {
                font-size: 0.85rem;
            }

            .user-email {
                font-size: 0.75rem;
            }

            .badge-modern {
                padding: 0.4rem 0.7rem;
                font-size: 0.75rem;
            }

            .date-display {
                font-size: 0.85rem;
            }

            .time-display {
                font-size: 0.7rem;
            }

            .btn-sm {
                padding: 0.3rem 0.5rem;
                font-size: 0.8rem;
            }

            .empty-state {
                padding: 3rem 1.5rem;
            }

            .empty-icon i {
                font-size: 4rem;
            }

            .empty-state h3 {
                font-size: 1.25rem;
            }

            .empty-state p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-header {
                margin-bottom: 1.25rem;
            }

            .page-title {
                font-size: 1.15rem;
            }

            .page-subtitle {
                font-size: 0.8rem;
            }

            .btn-lg {
                padding: 0.65rem 1rem;
                font-size: 0.85rem;
            }

            .stats-grid {
                gap: 0.85rem;
                margin-bottom: 1.25rem;
            }

            .stat-card {
                padding: 1rem;
                border-radius: 10px;
            }

            .stat-icon {
                width: 42px;
                height: 42px;
                font-size: 1.35rem;
                margin-bottom: 0.75rem;
                border-radius: 10px;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            .stat-badge {
                font-size: 0.65rem;
                padding: 0.25rem 0.6rem;
                margin-top: 0.75rem;
            }

            .card-header {
                padding: 0.85rem;
            }

            .card-header h5 {
                font-size: 0.9rem;
            }

            .card-actions input {
                font-size: 0.8rem;
                padding: 0.4rem 0.6rem;
            }

            .table-modern {
                font-size: 0.8rem;
            }

            .table-modern thead th {
                padding: 0.75rem 0.5rem;
                font-size: 0.7rem;
            }

            .table-modern tbody td {
                padding: 0.75rem 0.5rem;
            }

            .user-info {
                gap: 0.5rem;
            }

            .user-avatar {
                width: 30px;
                height: 30px;
                font-size: 0.85rem;
                border-radius: 8px;
            }

            .user-name {
                font-size: 0.8rem;
            }

            .user-email {
                font-size: 0.7rem;
            }

            .surat-type {
                font-size: 0.8rem;
                gap: 0.4rem;
            }

            .surat-type i {
                font-size: 0.9rem;
            }

            .badge-modern {
                padding: 0.35rem 0.6rem;
                font-size: 0.7rem;
                border-radius: 6px;
            }

            .date-display {
                font-size: 0.8rem;
            }

            .time-display {
                font-size: 0.65rem;
            }

            .btn-sm {
                padding: 0.25rem 0.45rem;
                font-size: 0.75rem;
            }

            .empty-state {
                padding: 2.5rem 1rem;
            }

            .empty-icon i {
                font-size: 3.5rem;
            }

            .empty-state h3 {
                font-size: 1.15rem;
            }

            .empty-state p {
                font-size: 0.85rem;
            }
        }

        /* Mobile Table Optimization */
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 0;
            }

            .table-modern {
                min-width: 100%;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
@endsection

{{-- ============================================
MODAL REVIEW - DI LUAR @section('content')
Modal akan di-render SETELAH footer
z-index: 999999 (paling depan)
============================================ --}}
@section('modals')
    @if(Auth::user()->role === 'admin')
        @foreach($surat as $item)
            @if($item->status == 'pending')
                <div class="custom-modal" id="reviewModal{{ $item->id }}">
                    <div class="custom-modal-backdrop" onclick="closeReviewModal({{ $item->id }})"></div>
                    <div class="custom-modal-dialog">
                        <div class="custom-modal-content">
                            <form method="POST" action="{{ route('surat.updateStatus', $item->id) }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="bi bi-pencil-square"></i>
                                        Review Pengajuan Surat
                                    </h5>
                                    <button type="button" class="btn-close-custom" onclick="closeReviewModal({{ $item->id }})">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
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
                                        <div class="info-row">
                                            <span class="info-label">Lampiran</span>
                                            <div class="info-value">
                                                @if($item->lampiran->count() > 0)
                                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                                        @foreach($item->lampiran as $file)
                                                            <li class="mb-1">
                                                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                                                    class="text-decoration-none">
                                                                    <i class="bi bi-paperclip"></i> {{ $file->nama_file }}
                                                                    <small class="text-muted">
                                                                        <i class="bi bi-box-arrow-up-right"></i>
                                                                    </small>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-muted text-italic">Tidak ada lampiran</span>
                                                @endif
                                            </div>
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
                                        <textarea name="catatan_admin" class="form-control" rows="3"
                                            placeholder="Tambahkan catatan atau alasan jika diperlukan..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="closeReviewModal({{ $item->id }})">
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
        /* ===== MODAL REVIEW STYLES - z-index: 999999 (PALING DEPAN) ===== */
        .custom-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999999 !important;
            display: none;
            overflow-y: auto;
            padding: 2rem 1rem;
        }

        .custom-modal.show {
            display: block !important;
        }

        .custom-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.75);
            z-index: -1;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .custom-modal-dialog {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            z-index: 2;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-50px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .custom-modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 2rem;
        }

        .modal-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modal-title {
            margin: 0;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-close-custom {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
        }

        .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 2rem;
            overflow-y: visible;
            flex: 1;
        }

        .modal-footer {
            border-top: 2px solid #f1f5f9;
            padding: 1.25rem 2rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            flex-shrink: 0;
            position: sticky;
            bottom: 0;
            background: white;
            z-index: 10;
        }

        .review-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            margin-bottom: 1.5rem;
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
            text-align: right;
            max-width: 60%;
            word-wrap: break-word;
        }

        body.modal-open {
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .custom-modal {
                padding: 1rem 0.5rem;
            }

            .custom-modal-dialog {
                max-width: 100%;
                margin: 0;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .modal-footer {
                flex-direction: column;
                padding: 1rem 1.5rem;
            }

            .modal-footer .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search Functionality
            const searchInput = document.getElementById('searchTable');
            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const value = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#suratTable tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(value) ? '' : 'none';
                    });
                });
            }
        });

        // Open Review Modal
        function openReviewModal(itemId) {
            // Remove any existing Bootstrap modal backdrops
            const existingBackdrops = document.querySelectorAll('.modal-backdrop');
            existingBackdrops.forEach(backdrop => backdrop.remove());

            // Close any other open modals
            const allModals = document.querySelectorAll('.custom-modal');
            allModals.forEach(modal => {
                modal.classList.remove('show');
                modal.style.display = 'none';
            });

            // Open the selected modal
            const modal = document.getElementById('reviewModal' + itemId);
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
            }
        }

        // Close Review Modal
        function closeReviewModal(itemId) {
            const modal = document.getElementById('reviewModal' + itemId);
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';

                // Check if there are other modals open
                const openModals = document.querySelectorAll('.custom-modal.show');
                if (openModals.length === 0) {
                    document.body.classList.remove('modal-open');
                }
            }

            // Remove any lingering Bootstrap backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const openModals = document.querySelectorAll('.custom-modal.show');
                openModals.forEach(modal => {
                    const modalId = modal.id.replace('reviewModal', '');
                    closeReviewModal(modalId);
                });
            }
        });

        // Clean up any Bootstrap modal remnants on page load
        window.addEventListener('load', function () {
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
        });
    </script>
@endsection