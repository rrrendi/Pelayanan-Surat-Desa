@extends('layout')
@section('title', 'Ajukan Surat Baru')

@section('content')
    <div class="card-organic mb-4" style="background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); color: white;">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white text-success rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="bi bi-file-earmark-plus-fill" style="color: var(--primary-green);"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">Buat Pengajuan Surat</h2>
                <p class="mb-0 opacity-75">Isi formulir di bawah ini dengan lengkap dan benar.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-organic">
                <form id="formPengajuan" action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="fw-bold mb-4" style="color: var(--primary-green);">Detail Dokumen</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small"><i class="bi bi-card-list me-1"></i> Jenis Surat <span class="text-danger">*</span></label>
                        <select name="surat_jenis_id" class="form-select border-0 bg-light px-4 py-3" style="border-radius: 15px;" required>
                            <option value="">-- Pilih Jenis Layanan Surat --</option>
                            @foreach($jenisSurat as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama_surat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small"><i class="bi bi-pencil-square me-1"></i> Keterangan / Keperluan <span class="text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control border-0 bg-light px-4 py-3" rows="4" style="border-radius: 15px;" placeholder="Jelaskan secara singkat keperluan pembuatan surat ini..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small d-flex justify-content-between">
                            <span><i class="bi bi-paperclip me-1"></i> Lampiran Dokumen Pendukung</span>
                            <span id="file-counter" class="badge bg-light text-dark border">0 / 5 File</span>
                        </label>
                        
                        <div id="drop-area" class="border p-4 text-center bg-light" style="border-radius: 20px; border-style: dashed !important; border-width: 2px !important; border-color: #cbd5e1 !important; cursor: pointer; transition: all 0.3s;">
                            <i class="bi bi-cloud-arrow-up display-4" style="color: var(--primary-green);"></i>
                            <h6 class="fw-bold mt-2 mb-1">Klik atau Tarik File ke Sini</h6>
                            <p class="text-muted small mb-0">Format: JPG, PNG, PDF (Maks. 2MB per file)</p>
                        </div>

                        <input type="file" id="file_lampiran" name="lampiran[]" multiple class="d-none" accept=".jpg,.jpeg,.png,.pdf">

                        <div id="file-preview-list" class="mt-3 d-flex flex-column gap-2"></div>
                    </div>

                    <hr class="my-4 border-light">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 fw-semibold text-muted">Batal</a>
                        <button type="submit" class="btn-green px-5" id="btnSubmit"><i class="bi bi-send me-2"></i> Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card-organic bg-light border-0 shadow-none">
                <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb text-warning me-2"></i>Panduan Pengisian</h6>
                <ul class="text-muted small ps-3 mb-0" style="line-height: 1.8;">
                    <li class="mb-2">Pilih <strong>Jenis Surat</strong> yang sesuai dengan kebutuhan Anda.</li>
                    <li class="mb-2">Jika Anda membutuhkan lampiran (KTP/KK), foto dokumen tersebut dengan jelas lalu unggah.</li>
                    <li class="mb-2 text-danger fw-semibold">Maksimal Anda hanya bisa mengunggah 5 buah file.</li>
                    <li>Proses persetujuan biasanya memakan waktu 1x24 jam hari kerja.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Objek DataTransfer untuk memanipulasi file (Tambah/Hapus) tanpa menimpa
        const dataTransfer = new DataTransfer();
        const maxFiles = 5;
        const maxFileSize = 2 * 1024 * 1024; // 2MB dalam bytes

        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file_lampiran');
        const previewList = document.getElementById('file-preview-list');
        const fileCounter = document.getElementById('file-counter');

        // 1. Jika area drop diklik, buka dialog pemilihan file
        dropArea.addEventListener('click', () => fileInput.click());

        // 2. Efek visual saat file ditarik (drag & drop) ke atas area
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.style.backgroundColor = '#e2e8f0';
                dropArea.style.borderColor = 'var(--primary-green)';
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.style.backgroundColor = '#f8fafc'; // bg-light
                dropArea.style.borderColor = '#cbd5e1';
            }, false);
        });

        // 3. Menangani file yang di-drop
        dropArea.addEventListener('drop', function(e) {
            let dtDrop = e.dataTransfer;
            let files = dtDrop.files;
            handleFiles(files);
        });

        // 4. Menangani file yang dipilih lewat klik
        fileInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        });

        // 5. Logika utama pemrosesan file
        function handleFiles(newFiles) {
            let currentCount = dataTransfer.items.length;
            let addedCount = 0;
            let errorSize = false;
            let errorType = false;

            for (let i = 0; i < newFiles.length; i++) {
                // Cek Batas 5 File
                if (currentCount + addedCount >= maxFiles) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Maksimal!',
                        html: '<p style="font-family:\'Poppins\', sans-serif;">Anda hanya dapat mengunggah maksimal 5 file.</p>',
                        customClass: { popup: 'rounded-4 shadow-lg border-0' }
                    });
                    break;
                }

                let file = newFiles[i];

                // Validasi Ukuran File (Maks 2MB)
                if (file.size > maxFileSize) {
                    errorSize = true;
                    continue;
                }

                // Validasi Tipe File (JPG, PNG, PDF)
                if (!['image/jpeg', 'image/png', 'application/pdf'].includes(file.type)) {
                    errorType = true;
                    continue;
                }

                // Jika lolos semua validasi, tambahkan ke DataTransfer
                dataTransfer.items.add(file);
                addedCount++;
            }

            // Munculkan notifikasi jika ada file yang gagal masuk
            if (errorSize) {
                Swal.fire({ icon: 'error', title: 'Terlalu Besar!', html: '<p style="font-family:\'Poppins\', sans-serif;">Beberapa file diabaikan karena ukurannya melebihi 2MB.</p>', customClass: { popup: 'rounded-4 shadow-lg border-0' } });
            }
            if (errorType) {
                Swal.fire({ icon: 'error', title: 'Format Ditolak!', html: '<p style="font-family:\'Poppins\', sans-serif;">Beberapa file diabaikan karena format tidak didukung (Hanya JPG, PNG, PDF).</p>', customClass: { popup: 'rounded-4 shadow-lg border-0' } });
            }

            // Perbarui UI
            updateUI();
        }

        // 6. Logika memperbarui daftar visual dan input asli
        window.removeFile = function(index) {
            dataTransfer.items.remove(index);
            updateUI();
        };

        function updateUI() {
            // Salin file dari DataTransfer ke input file asli yang disembunyikan
            fileInput.files = dataTransfer.files;
            
            // Bersihkan daftar visual
            previewList.innerHTML = '';

            // Render ulang daftar file
            for (let i = 0; i < dataTransfer.files.length; i++) {
                let file = dataTransfer.files[i];
                let sizeInMB = (file.size / 1024 / 1024).toFixed(2);
                
                // Tentukan Ikon berdasarkan tipe
                let iconClass = file.type === 'application/pdf' ? 'bi-file-earmark-pdf-fill text-danger' : 'bi-image-fill text-primary';

                let fileElement = document.createElement('div');
                fileElement.className = 'd-flex justify-content-between align-items-center p-3 bg-white border rounded-4 shadow-sm';
                fileElement.innerHTML = `
                    <div class="d-flex align-items-center gap-3 overflow-hidden">
                        <i class="bi ${iconClass} fs-3"></i>
                        <div class="text-truncate">
                            <p class="mb-0 fw-bold text-dark text-truncate" style="font-size: 0.9rem;">${file.name}</p>
                            <small class="text-muted">${sizeInMB} MB</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-light rounded-circle text-danger ms-2 shadow-sm border" onclick="removeFile(${i})" style="width: 35px; height: 35px; flex-shrink: 0;" title="Hapus File">
                        <i class="bi bi-x-lg fw-bold"></i>
                    </button>
                `;
                previewList.appendChild(fileElement);
            }

            // Perbarui Counter
            fileCounter.innerText = `${dataTransfer.files.length} / 5 File`;
            if (dataTransfer.files.length >= maxFiles) {
                fileCounter.classList.replace('bg-light', 'bg-warning');
                fileCounter.classList.replace('text-dark', 'text-dark');
            } else {
                fileCounter.classList.replace('bg-warning', 'bg-light');
            }
        }
    });
</script>
@endsection