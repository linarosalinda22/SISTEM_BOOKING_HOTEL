<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::with('tipeKamar')->get();

        return view('kamar.index', compact('kamar'));
    }

    public function create()
    {
        $tipeKamar = Tipe_kamar::all();

        return view('kamar.create', compact('tipeKamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required',
            'tipe_kamar_id' => 'required',
            'harga' => 'required',
            'status_kamar' => 'required'
        ]);

        Kamar::create($request->all());

        return redirect('/kamar')
            ->with('success', 'Data kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);

        $tipeKamar = TipeKamar::all();

        return view('kamar.edit', compact('kamar', 'tipeKamar'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $kamar->update($request->all());

        return redirect('/kamar')
            ->with('success', 'Data kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        $kamar->delete();

        return redirect('/kamar')
            ->with('success', 'Data kamar berhasil dihapus');
    }
}