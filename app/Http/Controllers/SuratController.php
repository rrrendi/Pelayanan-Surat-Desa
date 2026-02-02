<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\SuratJenis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuratLampiran;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $surat = PengajuanSurat::with(['user', 'suratJenis', 'lampiran'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $surat = PengajuanSurat::with('suratJenis')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('dashboard', compact('surat'));
    }

    public function create()
    {
        $jenisSurat = SuratJenis::all();
        return view('create', compact('jenisSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surat_jenis_id' => 'required|exists:surat_jenis,id',
            'keterangan' => 'required|string|max:1000',
            // Validasi Lampiran: Array, Maks 5 file, Tipe PDF/Gambar, Maks 2MB per file
            'lampiran' => 'array|max:5',
            'lampiran.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'lampiran.max' => 'Maksimal lampiran yang diperbolehkan adalah 5 file.',
            'lampiran.*.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            'lampiran.*.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG.'
        ]);

        // 1. Simpan Data Surat Utama
        $surat = PengajuanSurat::create([
            'user_id' => Auth::id(),
            'surat_jenis_id' => $request->surat_jenis_id,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        // 2. Proses Upload Lampiran (Jika Ada)
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                // Simpan ke folder 'public/lampiran'
                $path = $file->store('lampiran', 'public');

                // Simpan path ke database
                SuratLampiran::create([
                    'pengajuan_surat_id' => $surat->id,
                    'file_path' => $path,
                    'nama_file' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('dashboard')
            ->with('success', 'Pengajuan surat berhasil diajukan beserta lampirannya!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $surat = PengajuanSurat::findOrFail($id);
        $surat->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Status surat berhasil diupdate!');
    }

    public function cetakPdf($id)
    {
        $surat = PengajuanSurat::with(['user', 'suratJenis'])->findOrFail($id);

        if ($surat->status !== 'disetujui') {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya surat yang disetujui yang bisa dicetak!');
        }

        $pdf = Pdf::loadView('cetak_pdf', compact('surat'));
        return $pdf->download('surat-' . $surat->id . '.pdf');
    }

    // Method untuk update profile dengan validasi NIK
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => [
                'required',
                'string',
                'size:16', // NIK harus tepat 16 digit
                'regex:/^[0-9]+$/', // NIK harus angka semua
                'unique:users,nik,' . $user->id // Unique kecuali user ini sendiri
            ],
            'alamat' => 'required|string|max:500',
        ], [
            'nik.size' => 'NIK harus tepat 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar di sistem. Silakan gunakan NIK yang berbeda.',
        ]);

        $user->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    // Method untuk validasi NIK secara real-time (AJAX)
    public function checkNik(Request $request)
    {
        $nik = $request->nik;
        $userId = Auth::id();

        $exists = User::where('nik', $nik)
            ->where('id', '!=', $userId)
            ->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'NIK sudah terdaftar di sistem' : 'NIK tersedia'
        ]);
    }
}