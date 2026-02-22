@extends('layout')
@section('title', 'Dasbor')

@section('content')
    <div class="card-organic mb-4" style="background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); color: white;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm" style="color: var(--primary-green) !important;">
                    <i class="bi bi-shield-check"></i> Dasbor {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Warga' }}
                </span>
                <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->name }} 👋</h2>
                <p class="mb-0 opacity-75">Kelola dokumen administrasi Anda dengan mudah dan cepat.</p>
            </div>
            @if(Auth::user()->role === 'warga')
                <div class="mt-4 mt-md-0">
                    <a href="{{ route('surat.create') }}" class="btn-gold"><i class="bi bi-plus-circle me-2"></i> Ajukan Surat Baru</a>
                </div>
            @endif
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card-organic p-4 h-100 d-flex align-items-center flex-row gap-4" style="transition: all 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 2rem;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <p class="text-muted fw-semibold mb-0">Menunggu Review</p>
                        <h2 class="fw-bold text-dark mb-0">{{ $surat->where('status', 'pending')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-organic p-4 h-100 d-flex align-items-center flex-row gap-4" style="transition: all 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 2rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted fw-semibold mb-0">Disetujui</p>
                        <h2 class="fw-bold text-dark mb-0">{{ $surat->where('status', 'disetujui')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-organic p-4 h-100 d-flex align-items-center flex-row gap-4" style="transition: all 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 2rem;">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <p class="text-muted fw-semibold mb-0">Total Pengajuan</p>
                        <h2 class="fw-bold text-dark mb-0">{{ $surat->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card-organic p-0 overflow-hidden">
        <div class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-white border-bottom">
            <h5 class="fw-bold mb-3 mb-md-0" style="color: var(--primary-green);">Riwayat Dokumen</h5>
            <input type="text" class="form-control rounded-pill bg-light border-0 px-4" style="max-width: 300px;" id="searchTable" placeholder="Pencarian Cepat...">
        </div>
        
        @if($surat->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="suratTable" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 ps-4 py-3 text-muted fw-semibold">No</th>
                            @if(Auth::user()->role === 'admin') <th class="border-0 py-3 text-muted fw-semibold">Pemohon</th> @endif
                            <th class="border-0 py-3 text-muted fw-semibold">Jenis Surat</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Status</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Tanggal</th>
                            <th class="border-0 pe-4 py-3 text-end text-muted fw-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surat as $index => $item)
                            <tr>
                                <td class="ps-4 py-3 fw-medium">{{ $index + 1 }}</td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="py-3">
                                        <div class="fw-bold text-dark">{{ $item->user->name }}</div>
                                        <small class="text-muted">{{ $item->user->nik }}</small>
                                    </td>
                                @endif
                                <td class="py-3">
                                    <div class="fw-semibold" style="color: var(--primary-green);">{{ $item->suratJenis->nama_surat }}</div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 250px;">{{ $item->keterangan }}</small>
                                </td>
                                <td class="py-3">
                                    @if($item->status == 'pending') <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Menunggu</span>
                                    @elseif($item->status == 'disetujui') <span class="badge bg-success rounded-pill px-3 py-2">Disetujui</span>
                                    @else <span class="badge bg-danger rounded-pill px-3 py-2">Ditolak</span> @endif
                                </td>
                                <td class="py-3 text-muted small">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td class="pe-4 py-3 text-end">
                                    @if(Auth::user()->role === 'admin' && $item->status == 'pending')
                                        <button class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border fw-semibold" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $item->id }}">Review</button>
                                    @elseif($item->status == 'disetujui')
                                        <a href="{{ route('surat.cetak', $item->id) }}" class="btn btn-sm btn-gold px-3 py-1"><i class="bi bi-download me-1"></i> PDF</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                    <i class="bi bi-folder2-open display-4 text-muted"></i>
                </div>
                <h5 class="fw-bold">Belum Ada Pengajuan</h5>
                <p class="text-muted">Riwayat dokumen Anda masih kosong.</p>
            </div>
        @endif
    </div>
@endsection

@section('modals')
    @if(Auth::user()->role === 'admin')
        @foreach($surat as $item)
            @if($item->status == 'pending')
                <div class="modal fade" id="reviewModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 25px; border: none; overflow: hidden;">
                            <form method="POST" action="{{ route('surat.updateStatus', $item->id) }}">
                                @csrf
                                <div class="modal-header border-0 bg-light p-4">
                                    <h5 class="fw-bold mb-0" style="color: var(--primary-green);">Tinjau Dokumen</h5>
                                    <button type="button" class="btn-close rounded-circle bg-white p-2 shadow-sm" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="bg-white rounded-4 p-3 mb-4 shadow-sm border">
                                        <p class="mb-1 text-muted small">Pemohon</p>
                                        <h6 class="fw-bold mb-3">{{ $item->user->name }} ({{ $item->user->nik }})</h6>
                                        <p class="mb-1 text-muted small">Jenis Surat</p>
                                        <h6 class="fw-bold mb-3" style="color: var(--primary-green);">{{ $item->suratJenis->nama_surat }}</h6>
                                        <p class="mb-1 text-muted small">Keterangan / Keperluan</p>
                                        <p class="mb-0">{{ $item->keterangan }}</p>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold mb-2"><i class="bi bi-paperclip me-1"></i> Lampiran Warga</label>
                                        @if($item->lampiran && $item->lampiran->count() > 0)
                                            <div class="d-flex flex-column gap-2">
                                                @foreach($item->lampiran as $file)
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="text-decoration-none">
                                                        <div class="d-flex align-items-center justify-content-between p-2 px-3 bg-light border rounded-3 hover-shadow" style="transition: all 0.2s;">
                                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                                <i class="bi bi-file-earmark-text-fill text-primary fs-5"></i>
                                                                <span class="text-dark small fw-medium text-truncate" style="max-width: 250px;">{{ $file->nama_file }}</span>
                                                            </div>
                                                            <i class="bi bi-box-arrow-up-right text-muted small"></i>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="p-3 bg-light rounded-3 text-center" style="border: 2px dashed #cbd5e1;">
                                                <span class="text-muted small">Tidak ada dokumen lampiran.</span>
                                            </div>
                                        @endif
                                    </div>

                                    <hr class="border-light mb-4">

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Pilih Tindakan <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select rounded-pill px-3 py-2 bg-light border-0" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="disetujui">Setujui Dokumen</option>
                                            <option value="ditolak">Tolak Dokumen</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label fw-semibold">Catatan (Opsional)</label>
                                        <textarea name="catatan_admin" class="form-control rounded-4 p-3 bg-light border-0" rows="2" placeholder="Tulis alasan jika ditolak..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-4 pt-0">
                                    <button type="submit" class="btn-green w-100"><i class="bi bi-save me-2"></i> Simpan Keputusan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endsection

@section('scripts')
<script>
    document.getElementById('searchTable').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('#suratTable tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endsection