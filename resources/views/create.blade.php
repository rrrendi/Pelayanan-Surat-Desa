@extends('layout')

@section('title', 'Ajukan Surat')

@section('content')
    <div class="form-header">
        <div>
            <h2 class="page-title">
                <i class="bi bi-file-earmark-plus"></i>
                Form Pengajuan Surat
            </h2>
            <p class="page-subtitle">Lengkapi formulir di bawah untuk mengajukan surat</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card modern-card">
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show modern-alert">
                            <div class="alert-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('surat.store') }}" id="formPengajuan">
                        @csrf

                        <!-- Section 1: Informasi Pemohon -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div>
                                    <h5 class="section-title">Informasi Pemohon</h5>
                                    <p class="section-description">Data diri Anda yang terdaftar di sistem</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-modern">
                                        <i class="bi bi-person"></i> Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control form-control-modern"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-modern">
                                        <i class="bi bi-envelope"></i> Email
                                    </label>
                                    <input type="text" class="form-control form-control-modern"
                                        value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-modern">
                                        <i class="bi bi-credit-card-2-front"></i> NIK
                                    </label>
                                    <input type="text" class="form-control form-control-modern"
                                        value="{{ Auth::user()->nik }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-modern">
                                        <i class="bi bi-telephone"></i> Status
                                    </label>
                                    <div class="status-badge">
                                        <span class="badge-verified">
                                            <i class="bi bi-patch-check-fill"></i> Terverifikasi
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-modern">
                                    <i class="bi bi-geo-alt"></i> Alamat
                                </label>
                                <textarea class="form-control form-control-modern" rows="2"
                                    readonly>{{ Auth::user()->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <!-- Section 2: Detail Pengajuan -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon section-icon-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div>
                                    <h5 class="section-title">Detail Pengajuan Surat</h5>
                                    <p class="section-description">Pilih jenis surat dan jelaskan keperluan Anda</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-modern">
                                    <i class="bi bi-file-earmark-text"></i> Jenis Surat <span class="text-danger">*</span>
                                </label>
                                <select name="surat_jenis_id" class="form-select form-select-modern" required
                                    id="jenisSurat">
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    @foreach($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id }}" data-keterangan="{{ $jenis->keterangan }}">
                                            {{ $jenis->nama_surat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="surat-info" id="suratInfo" style="display: none;">
                                    <i class="bi bi-info-circle"></i>
                                    <span id="suratKeterangan"></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-modern">
                                    <i class="bi bi-chat-left-text"></i> Keterangan/Keperluan <span
                                        class="text-danger">*</span>
                                </label>
                                <textarea name="keterangan" class="form-control form-control-modern" rows="5" required
                                    placeholder="Jelaskan secara detail keperluan surat ini. Contoh: Untuk keperluan pembuatan rekening bank di Bank Mandiri..."
                                    id="keterangan">{{ old('keterangan') }}</textarea>
                                <div class="char-counter">
                                    <span id="charCount">0</span> / 1000 karakter
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <div>
                                    <strong>Tips Pengisian:</strong>
                                    <ul>
                                        <li>Jelaskan dengan lengkap dan jelas keperluan surat yang Anda butuhkan</li>
                                        <li>Sertakan informasi tambahan yang relevan untuk mempercepat proses review</li>
                                        <li>Pastikan data yang Anda masukkan sudah benar sebelum mengirim</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg" id="btnSubmit">
                                <i class="bi bi-send"></i> Ajukan Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="timeline-card">
                <h6 class="timeline-title">
                    <i class="bi bi-clock-history"></i> Proses Pengajuan Surat
                </h6>
                <div class="timeline">
                    <div class="timeline-item active">
                        <div class="timeline-marker">1</div>
                        <div class="timeline-content">
                            <strong>Pengajuan</strong>
                            <p>Isi formulir dan ajukan surat</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">2</div>
                        <div class="timeline-content">
                            <strong>Review Admin</strong>
                            <p>Admin akan mereview pengajuan Anda</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">3</div>
                        <div class="timeline-content">
                            <strong>Persetujuan</strong>
                            <p>Surat disetujui atau ditolak</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">4</div>
                        <div class="timeline-content">
                            <strong>Download</strong>
                            <p>Download surat yang sudah disetujui</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modern-card {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .section-icon-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .section-description {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0.25rem 0 0 0;
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 2rem 0;
        }

        .form-label-modern {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control-modern,
        .form-select-modern {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-size: 0.95rem;
        }

        .form-control-modern:focus,
        .form-select-modern:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .form-control-modern:read-only {
            background: #f1f5f9;
            cursor: not-allowed;
        }

        .status-badge {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .badge-verified {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .surat-info {
            margin-top: 0.75rem;
            padding: 0.75rem 1rem;
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            border-radius: 8px;
            color: #1e40af;
            font-size: 0.85rem;
            display: flex;
            gap: 0.5rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .char-counter {
            text-align: right;
            color: #64748b;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .info-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            gap: 1rem;
            border: 2px solid #fbbf24;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f59e0b;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-box strong {
            color: #92400e;
            display: block;
            margin-bottom: 0.5rem;
        }

        .info-box ul {
            margin: 0;
            padding-left: 1.25rem;
            color: #78350f;
        }

        .info-box li {
            margin-bottom: 0.35rem;
            font-size: 0.85rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }

        .timeline-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .timeline-title {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 30px;
            bottom: 30px;
            width: 2px;
            background: linear-gradient(180deg, #3b82f6, #e2e8f0);
        }

        .timeline-item {
            position: relative;
            padding-left: 60px;
            padding-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            width: 40px;
            height: 40px;
            background: #e2e8f0;
            color: #64748b;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .timeline-item.active .timeline-marker {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }
        }

        .timeline-content strong {
            display: block;
            color: #0f172a;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .timeline-content p {
            color: #64748b;
            font-size: 0.85rem;
            margin: 0;
        }

        .modern-alert {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            border: none;
            border-radius: 12px;
            border-left: 4px solid #ef4444;
        }

        .alert-icon {
            font-size: 1.5rem;
        }

        .alert-content {
            flex: 1;
        }

        @media (max-width: 768px) {
            .form-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }

            .section-header {
                flex-direction: column;
            }

            .timeline::before {
                left: 15px;
            }

            .timeline-item {
                padding-left: 50px;
            }

            .timeline-marker {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }

        /* MOBILE RESPONSIVE - COMPACT & FIT */
        @media (max-width: 992px) {
            .form-header {
                margin-bottom: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.85rem;
            }

            .modern-card {
                border-radius: 16px;
            }

            .form-section {
                margin-bottom: 1.75rem;
            }

            .section-header {
                gap: 0.85rem;
                margin-bottom: 1.25rem;
            }

            .section-icon {
                width: 42px;
                height: 42px;
                font-size: 1.35rem;
                border-radius: 10px;
            }

            .section-title {
                font-size: 1.15rem;
            }

            .section-description {
                font-size: 0.85rem;
            }

            .timeline-card {
                padding: 1.25rem;
            }

            .timeline-title {
                font-size: 0.95rem;
                margin-bottom: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .form-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                margin-bottom: 1.25rem;
            }

            .page-title {
                font-size: 1.35rem;
            }

            .page-title i {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.8rem;
            }

            .modern-card {
                border-radius: 14px;
                box-shadow: 0 2px 12px rgba(45, 106, 79, 0.1);
            }

            .card-body {
                padding: 1.5rem 1rem !important;
            }

            .form-section {
                margin-bottom: 1.5rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }

            .section-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .section-description {
                font-size: 0.8rem;
            }

            .section-divider {
                margin: 1.5rem 0;
            }

            .form-label-modern {
                font-size: 0.85rem;
            }

            .form-control-modern,
            .form-select-modern {
                padding: 0.65rem 0.85rem;
                font-size: 0.9rem;
                border-radius: 8px;
            }

            .status-badge {
                height: auto;
            }

            .badge-verified {
                padding: 0.4rem 0.85rem;
                font-size: 0.8rem;
            }

            .surat-info {
                padding: 0.65rem 0.85rem;
                font-size: 0.8rem;
            }

            .char-counter {
                font-size: 0.75rem;
            }

            .info-box {
                padding: 1rem;
                gap: 0.85rem;
            }

            .info-icon {
                width: 36px;
                height: 36px;
                font-size: 1.35rem;
            }

            .info-box strong {
                font-size: 0.9rem;
            }

            .info-box li {
                font-size: 0.8rem;
                margin-bottom: 0.3rem;
            }

            .form-actions {
                flex-direction: column;
                gap: 0.85rem;
                padding-top: 1.25rem;
            }

            .form-actions .btn {
                width: 100%;
            }

            .timeline-card {
                padding: 1rem;
                margin-top: 1.5rem;
            }

            .timeline-title {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .timeline::before {
                left: 15px;
                top: 25px;
                bottom: 25px;
            }

            .timeline-item {
                padding-left: 50px;
                padding-bottom: 1.25rem;
            }

            .timeline-marker {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
                border-radius: 8px;
            }

            .timeline-content strong {
                font-size: 0.9rem;
            }

            .timeline-content p {
                font-size: 0.8rem;
            }

            .modern-alert {
                padding: 1rem;
                gap: 0.85rem;
                border-radius: 10px;
            }

            .alert-icon {
                font-size: 1.35rem;
            }

            .alert-content strong {
                font-size: 0.9rem;
            }

            .alert-content ul li {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .form-header {
                margin-bottom: 1rem;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .page-title i {
                font-size: 1.35rem;
            }

            .page-subtitle {
                font-size: 0.75rem;
            }

            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }

            .card-body {
                padding: 1.25rem 0.85rem !important;
            }

            .form-section {
                margin-bottom: 1.25rem;
            }

            .section-icon {
                width: 36px;
                height: 36px;
                font-size: 1.15rem;
                border-radius: 8px;
            }

            .section-title {
                font-size: 1rem;
            }

            .section-description {
                font-size: 0.75rem;
            }

            .form-label-modern {
                font-size: 0.8rem;
                gap: 0.4rem;
            }

            .form-control-modern,
            .form-select-modern {
                padding: 0.6rem 0.8rem;
                font-size: 0.85rem;
            }

            .badge-verified {
                padding: 0.35rem 0.75rem;
                font-size: 0.75rem;
            }

            .char-counter {
                font-size: 0.7rem;
            }

            .info-box {
                padding: 0.9rem;
                border-radius: 10px;
            }

            .info-icon {
                width: 32px;
                height: 32px;
                font-size: 1.25rem;
            }

            .info-box strong {
                font-size: 0.85rem;
                margin-bottom: 0.4rem;
            }

            .info-box ul {
                padding-left: 1rem;
            }

            .info-box li {
                font-size: 0.75rem;
            }

            .timeline-card {
                padding: 0.9rem;
                border-radius: 12px;
            }

            .timeline-title {
                font-size: 0.85rem;
            }

            .timeline::before {
                left: 12px;
            }

            .timeline-item {
                padding-left: 45px;
                padding-bottom: 1rem;
            }

            .timeline-marker {
                width: 30px;
                height: 30px;
                font-size: 0.85rem;
                border-width: 2px;
            }

            .timeline-content strong {
                font-size: 0.85rem;
            }

            .timeline-content p {
                font-size: 0.75rem;
            }
        }

        /* Prevent horizontal scroll on mobile */
        @media (max-width: 768px) {
            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }

            .row>* {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Character counter for keterangan
            const keteranganField = document.getElementById('keterangan');
            const charCount = document.getElementById('charCount');

            if (keteranganField) {
                keteranganField.addEventListener('input', function () {
                    const count = this.value.length;
                    charCount.textContent = count;

                    if (count > 1000) {
                        charCount.style.color = '#ef4444';
                    } else if (count > 800) {
                        charCount.style.color = '#f59e0b';
                    } else {
                        charCount.style.color = '#64748b';
                    }
                });

                // Initial count
                charCount.textContent = keteranganField.value.length;
            }

            // Show surat info when jenis surat is selected
            const jenisSuratSelect = document.getElementById('jenisSurat');
            const suratInfo = document.getElementById('suratInfo');
            const suratKeterangan = document.getElementById('suratKeterangan');

            if (jenisSuratSelect) {
                jenisSuratSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const keterangan = selectedOption.getAttribute('data-keterangan');

                    if (keterangan && this.value) {
                        suratKeterangan.textContent = keterangan;
                        suratInfo.style.display = 'flex';
                    } else {
                        suratInfo.style.display = 'none';
                    }
                });
            }

            // Form validation
            const form = document.getElementById('formPengajuan');
            const btnSubmit = document.getElementById('btnSubmit');

            if (form) {
                form.addEventListener('submit', function (e) {
                    const jenisSurat = document.getElementById('jenisSurat').value;
                    const keterangan = document.getElementById('keterangan').value;

                    if (!jenisSurat) {
                        e.preventDefault();
                        alert('Silakan pilih jenis surat terlebih dahulu!');
                        return false;
                    }

                    if (!keterangan || keterangan.trim().length < 10) {
                        e.preventDefault();
                        alert('Keterangan minimal 10 karakter!');
                        return false;
                    }

                    // Show loading state
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengirim...';
                });
            }
        });
    </script>
@endsection