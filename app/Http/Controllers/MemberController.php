<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MemberController extends Controller
{
    // 1. Menampilkan daftar anggota dan fitur pencarian
    public function index(Request $request)
    {
        $members = Member::when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis_nim', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Members/Index', [
            'members' => $members,
            'search' => $request->search,
        ]);
    }

    // 2. Menampilkan form tambah anggota
    public function create()
    {
        return Inertia::render('Members/Create');
    }

    // 3. Menyimpan data anggota baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis_nim' => 'required|string|max:50|unique:members,nis_nim',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto jika tersedia
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('members', 'public');
        }

        // Simpan data anggota
        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    // 4. Menampilkan detail anggota
    public function show(Member $member)
    {
        return Inertia::render('Members/Show', [
            'member' => $member,
        ]);
    }

    // 5. Menampilkan form edit anggota
    public function edit(Member $member)
    {
        return Inertia::render('Members/Edit', [
            'member' => $member,
        ]);
    }

    // 6. Memperbarui data anggota
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis_nim' => 'required|string|max:50|unique:members,nis_nim,' . $member->id,
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto baru jika tersedia
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($member->foto) {
                Storage::disk('public')->delete($member->foto);
            }

            // Simpan foto baru
            $validated['foto'] = $request->file('foto')
                ->store('members', 'public');
        }

        // Update data anggota
        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // 7. Menghapus data anggota
    public function destroy(Member $member)
    {
        // Hapus foto dari storage
        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        // Hapus data dari database
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
