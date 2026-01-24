<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $totalPengajuan = PengajuanSurat::whereMonth('created_at', now()->month)->count();
        
        return view('users.index', compact('users', 'totalPengajuan'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]+$/',
                'unique:users,nik'
            ],
            'alamat' => 'required|string|max:500',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus tepat 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar di sistem. Silakan gunakan NIK yang berbeda.',
            'alamat.required' => 'Alamat wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'warga', // Default role is warga
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Warga baru berhasil ditambahkan! Silakan informasikan kredensial login kepada warga.');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::with('pengajuanSurat')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]+$/',
                Rule::unique('users')->ignore($user->id)
            ],
            'alamat' => 'required|string|max:500',
            'role' => 'required|in:admin,warga',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'nik.size' => 'NIK harus tepat 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah digunakan oleh warga lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')
            ->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting own account
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        // Check if user has any pending submissions
        $hasPending = $user->pengajuanSurat()->where('status', 'pending')->exists();
        
        if ($hasPending) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus warga yang memiliki pengajuan surat pending!');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', "Warga \"{$userName}\" berhasil dihapus dari sistem.");
    }

    /**
     * Check if NIK is available (AJAX)
     */
    public function checkNik(Request $request)
    {
        $nik = $request->nik;
        $userId = $request->user_id ?? null;

        $query = User::where('nik', $nik);
        
        if ($userId) {
            $query->where('id', '!=', $userId);
        }

        $exists = $query->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'NIK sudah terdaftar di sistem' : 'NIK tersedia'
        ]);
    }

    /**
     * Reset password for a user
     */
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')
            ->with('success', "Password untuk {$user->name} berhasil direset!");
    }
}