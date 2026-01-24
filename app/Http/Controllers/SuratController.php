<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\SuratJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $surat = PengajuanSurat::with(['user', 'suratJenis'])
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
        ]);

        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'surat_jenis_id' => $request->surat_jenis_id,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pengajuan surat berhasil diajukan!');
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
}