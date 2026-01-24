@extends('layout')

@section('title', 'Dashboard')

@section('content')
<h2 class="page-title">
    <i class="bi bi-speedometer2"></i>
    Dashboard {{ Auth::user()->role === 'admin' ? 'Admin' : 'Warga' }}
</h2>

@if(Auth::user()->role === 'admin')
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $surat->where('status', 'pending')->count() }}</h3>
                    <p><i class="bi bi-clock-history"></i> Surat Pending</p>
                </div>
                <i class="bi bi-hourglass-split" style="font-size: 3rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $surat->where('status', 'disetujui')->count() }}</h3>
                    <p><i class="bi bi-check-circle"></i> Surat Disetujui</p>
                </div>
                <i class="bi bi-check2-circle" style="font-size: 3rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $surat->where('status', 'ditolak')->count() }}</h3>
                    <p><i class="bi bi-x-circle"></i> Surat Ditolak</p>
                </div>
                <i class="bi bi-x-circle" style="font-size: 3rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-file-earmark-text"></i>
            @if(Auth::user()->role === 'admin')
                Daftar Pengajuan Surat Masuk
            @else
                Riwayat Pengajuan Surat Saya
            @endif
        </h5>
    </div>
    <div class="card-body">
        @if($surat->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                            <i class="bi bi-person-fill text-primary"></i>
                            {{ $item->user->name }}
                        </td>
                        <td><small class="text-muted">{{ $item->user->nik }}</small></td>
                        @endif
                        <td>
                            <i class="bi bi-file-earmark-text text-info"></i>
                            {{ $item->suratJenis->nama_surat }}
                        </td>
                        <td>
                            <small>{{ Str::limit($item->keterangan, 40) }}</small>
                        </td>
                        <td>
                            @if($item->status == 'pending')
                            <span class="badge bg-warning">
                                <i class="bi bi-clock"></i> Pending
                            </span>
                            @elseif($item->status == 'disetujui')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Disetujui
                            </span>
                            @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle"></i> Ditolak
                            </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at->format('d/m/Y') }}
                            </small>
                        </td>
                        <td>
                            @if(Auth::user()->role === 'admin')
                                @if($item->status == 'pending')
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Update
                                </button>
                                @endif
                                @if($item->status == 'disetujui')
                                <a href="{{ route('surat.cetak', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                                @endif
                            @else
                                @if($item->status == 'disetujui')
                                <span class="badge bg-success">
                                    <i class="bi bi-check2-all"></i> Disetujui
                                </span>
                                @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x"></i> Ditolak
                                </span>
                                @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-hourglass-split"></i> Diproses
                                </span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 5rem; color: #e5e7eb;"></i>
            <p class="text-muted mt-3">Belum ada data pengajuan surat.</p>
            @if(Auth::user()->role === 'warga')
            <a href="{{ route('surat.create') }}" class="btn btn-primary mt-2">
                <i class="bi bi-plus-circle"></i> Ajukan Surat Sekarang
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

<!-- MODAL DI LUAR LOOP - Hanya untuk Admin -->
@if(Auth::user()->role === 'admin')
    @foreach($surat as $item)
        @if($item->status == 'pending')
        <div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="{{ route('surat.updateStatus', $item->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-pencil-square"></i>
                                Update Status Surat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-person"></i> Pemohon
                                </label>
                                <input type="text" class="form-control" value="{{ $item->user->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-file-text"></i> Jenis Surat
                                </label>
                                <input type="text" class="form-control" value="{{ $item->suratJenis->nama_surat }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-info-circle"></i> Keterangan Pemohon
                                </label>
                                <textarea class="form-control" rows="2" readonly>{{ $item->keterangan }}</textarea>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-check-square"></i> Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="disetujui">✓ Disetujui</option>
                                    <option value="ditolak">✗ Ditolak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-chat-left-text"></i> Catatan Admin (Opsional)
                                </label>
                                <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endif
@endsection