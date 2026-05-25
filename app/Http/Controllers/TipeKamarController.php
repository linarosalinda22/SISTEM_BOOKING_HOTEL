<?php

namespace App\Http\Controllers;

use App\Models\Tipe_kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? '';

        $tipeKamars = Tipe_kamar::when($search, function ($query) use ($search) {
            $query->where('nama_tipe', 'like', "%$search%");
        })->paginate(10);

        return view('tipe-kamar.index', compact('tipeKamars', 'search'));
    }

    public function create()
    {
        return view('tipe-kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $foto = null;

        // Upload foto
        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')
                ->store('tipe-kamar', 'public');
        }

        Tipe_kamar::create([
            'nama_tipe' => $request->nama_tipe,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Data tipe kamar berhasil ditambahkan');
    }

    public function show($id)
    {
        $tipeKamar = Tipe_kamar::findOrFail($id);

        return view('tipe-kamar.show', compact('tipeKamar'));
    }

    public function edit($id)
    {
        $tipeKamar = Tipe_kamar::findOrFail($id);

        return view('tipe-kamar.edit', compact('tipeKamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tipe' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $tipeKamar = Tipe_kamar::findOrFail($id);

        $foto = $tipeKamar->foto;

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($tipeKamar->foto) {

                Storage::disk('public')->delete($tipeKamar->foto);
            }

            // Upload foto baru
            $foto = $request->file('foto')
                ->store('tipe-kamar', 'public');
        }

        $tipeKamar->update([
            'nama_tipe' => $request->nama_tipe,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Data tipe kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $tipeKamar = Tipe_kamar::findOrFail($id);

        // Hapus foto
        if ($tipeKamar->foto) {

            Storage::disk('public')->delete($tipeKamar->foto);
        }

        $tipeKamar->delete();

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Data berhasil dihapus');
    }
}