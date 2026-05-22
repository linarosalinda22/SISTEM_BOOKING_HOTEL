<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $kamars = Kamar::query()->with('tipeKamar');

        if ($search) {
            $kamars = $kamars->where('nomor_kamar', 'like', "%{$search}%");
        }

        if ($status) {
            $kamars = $kamars->where('status_kamar', $status);
        }

        $kamars = $kamars->paginate(10);

        return view('kamar.index', compact('kamars', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipeKamars = TipeKamar::all();
        return view('kamar.create', compact('tipeKamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'lantai' => 'required|integer|min:1',
            'status_kamar' => 'required|in:Tersedia,Terisi,Maintenance',
        ]);

        Kamar::create($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        $tipeKamars = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipeKamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar,' . $kamar->id,
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'lantai' => 'required|integer|min:1',
            'status_kamar' => 'required|in:Tersedia,Terisi,Maintenance',
        ]);

        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}
