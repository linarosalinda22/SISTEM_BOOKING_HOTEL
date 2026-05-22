<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tipeKamars = TipeKamar::query();

        if ($search) {
            $tipeKamars = $tipeKamars->where('nama_tipe', 'like', "%{$search}%");
        }

        $tipeKamars = $tipeKamars->paginate(10);

        return view('tipe-kamar.index', compact('tipeKamars', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe-kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('tipe-kamar', 'public');
            $validated['foto'] = $path;
        }

        TipeKamar::create($validated);

        return redirect()->route('tipe-kamar.index')->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipeKamar $tipeKamar)
    {
        return view('tipe-kamar.show', compact('tipeKamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipeKamar $tipeKamar)
    {
        return view('tipe-kamar.edit', compact('tipeKamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipeKamar $tipeKamar)
    {
        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($tipeKamar->foto) {
                Storage::disk('public')->delete($tipeKamar->foto);
            }
            $path = $request->file('foto')->store('tipe-kamar', 'public');
            $validated['foto'] = $path;
        }

        $tipeKamar->update($validated);

        return redirect()->route('tipe-kamar.index')->with('success', 'Tipe kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipeKamar $tipeKamar)
    {
        if ($tipeKamar->foto) {
            Storage::disk('public')->delete($tipeKamar->foto);
        }

        $tipeKamar->delete();

        return redirect()->route('tipe-kamar.index')->with('success', 'Tipe kamar berhasil dihapus');
    }
}
