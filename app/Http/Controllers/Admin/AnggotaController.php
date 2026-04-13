<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')->latest()->get();
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:anggota,nis',
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Create user first
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa'
        ]);

        // Create anggota relation
        Anggota::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;

        $request->validate([
            'nis' => ['required', Rule::unique('anggota')->ignore($anggota->id_anggota, 'id_anggota')],
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $anggota->update([
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil diupdate.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->user->delete();
        
        return redirect()->route('anggota.index')->with('success', 'Data Anggota beserta akunnya berhasil dihapus.');
    }
}
