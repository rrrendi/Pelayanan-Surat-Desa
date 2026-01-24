@extends('layout')

@section('title', 'Ajukan Surat')

@section('content')
<h2 class="page-title">
    <i class="bi bi-file-earmark-plus"></i>
    Form Pengajuan Surat
</h2>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Lengkapi Data Pengajuan
                </h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('surat.store') }}">
                    @csrf

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill"></i>
                        <strong>Informasi Pemohon</strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-person"></i> Nama Lengkap
                        </label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-credit-card-2-front"></i> NIK
                            </label>
                            <input type="text" class="form-control" value="{{ Auth::user()->nik }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-geo-alt"></i> Alamat
                        </label>
                        <textarea class="form-control" rows="2" readonly>{{ Auth::user()->alamat }}</textarea>
                    </div>

                    <hr>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>Detail Pengajuan</strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-earmark-text"></i> Jenis Surat <span class="text-danger">*</span>
                        </label>
                        <select name="surat_jenis_id" class="form-select" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach($jenisSurat as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama_surat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-chat-left-text"></i> Keterangan/Keperluan <span class="text-danger">*</span>
                        </label>
                        <textarea name="keterangan" class="form-control" rows="4" required placeholder="Jelaskan secara detail keperluan surat ini...">{{ old('keterangan') }}</textarea>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i>
                            Jelaskan dengan jelas keperluan surat yang Anda butuhkan
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-send"></i> Ajukan Surat
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>