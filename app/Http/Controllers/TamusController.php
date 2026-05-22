<?php

namespace App\Http\Controllers;

use App\Models\Tamus;
use Illuminate\Http\Request;

class TamusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tamuses = Tamus::query();

        if ($search) {
            $tamuses = $tamuses->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_identitas', 'like', "%{$search}%");
        }

        $tamuses = $tamuses->paginate(10);

        return view('tamus.index', compact('tamuses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tamus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:tamuses,email',
            'alamat' => 'required|string',
            'no_identitas' => 'required|string|unique:tamuses,no_identitas',
        ]);

        Tamus::create($validated);

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tamus $tamu)
    {
        return view('tamus.show', compact('tamu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tamus $tamu)
    {
        return view('tamus.edit', compact('tamu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tamus $tamu)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:tamuses,email,' . $tamu->id,
            'alamat' => 'required|string',
            'no_identitas' => 'required|string|unique:tamuses,no_identitas,' . $tamu->id,
        ]);

        $tamu->update($validated);

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tamus $tamu)
    {
        $tamu->delete();

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil dihapus');
    }
}
