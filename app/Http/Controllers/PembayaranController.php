<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $pembayarans = Pembayaran::query()->with(['booking.tamu', 'booking.kamar']);

        if ($search) {
            $pembayarans = $pembayarans->whereHas('booking.tamu', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $pembayarans = $pembayarans->where('status_pembayaran', $status);
        }

        $pembayarans = $pembayarans->latest()->paginate(10);

        return view('pembayaran.index', compact('pembayarans', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::whereDoesntHave('pembayaran')
            ->where('status_booking', '!=', 'Dibatalkan')
            ->with('tamu')
            ->get();

        return view('pembayaran.create', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:booking,id',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|in:Transfer Bank,Cash,E-Wallet',
            'total_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        Pembayaran::create($validated);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $bookings = Booking::where('status_booking', '!=', 'Dibatalkan')->get();
        return view('pembayaran.edit', compact('pembayaran', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:booking,id',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|in:Transfer Bank,Cash,E-Wallet',
            'total_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        $pembayaran->update($validated);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus');
    }

    /**
     * Print invoice
     */
    public function printInvoice(Pembayaran $pembayaran)
    {
        return view('pembayaran.invoice', compact('pembayaran'));
    }
}
