@extends('layout')
@section('title', 'Manajemen Warga')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Kelola Data Warga</h3>
            <p class="text-muted mb-0">Daftar seluruh warga yang terdaftar pada sistem.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <input type="text" class="form-control rounded-pill bg-white border-0 px-4 shadow-sm" style="width: 250px;" id="searchWarga" placeholder="Cari nama atau NIK...">
        </div>
    </div>

    <div class="card-organic p-0 overflow-hidden">
        @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="wargaTable" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 ps-4 py-3 text-muted fw-semibold">No</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Identitas Warga</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Kontak</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Hak Akses</th>
                            <th class="border-0 py-3 text-muted fw-semibold">Tanggal Daftar</th>
                            <th class="border-0 pe-4 py-3 text-end text-muted fw-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td class="ps-4 py-3 fw-medium">{{ $index + 1 }}</td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 40px; height: 40px;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <div class="small text-muted font-monospace">{{ $user->nik ?? 'NIK Kosong' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <a href="mailto:{{ $user->email }}" class="text-decoration-none text-muted small"><i class="bi bi-envelope text-primary opacity-50 me-1"></i> {{ $user->email }}</a>
                                </td>
                                <td class="py-3">
                                    @if($user->role === 'admin')
                                        <span class="badge bg-primary rounded-pill px-3 py-2"><i class="bi bi-shield-lock me-1"></i> Admin</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 border border-success border-opacity-25">Warga</span>
                                    @endif
                                </td>
                                <td class="py-3 text-muted small">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="pe-4 py-3 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm fw-semibold" style="color: #92400e; background-color: #fcd34d; border: none;">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm fw-semibold" style="background-color: #ef4444; border: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini secara permanen?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people display-4 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold">Belum Ada Data Warga</h5>
                <p class="text-muted">Saat ini belum ada warga yang terdaftar selain Admin.</p>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('searchWarga').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('#wargaTable tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endsection