<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Tamus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $bookings = Booking::query()->with(['tamu', 'kamar', 'pembayaran']);

        if ($search) {
            $bookings = $bookings->whereHas('tamu', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $bookings = $bookings->where('status_booking', $status);
        }

        $bookings = $bookings->latest()->paginate(10);

        return view('booking.index', compact('bookings', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tamuses = Tamus::all();
        $kamars = Kamar::where('status_kamar', 'Tersedia')->get();

        return view('booking.create', compact('tamuses', 'kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tamu_id' => 'required|exists:tamuses,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ]);

        // Check if kamar is available
        $kamar = Kamar::find($validated['kamar_id']);
        if ($kamar->status_kamar !== 'Tersedia') {
            return redirect()->back()->withErrors('Kamar tidak tersedia');
        }

        // Check for booking conflicts
        $conflict = Booking::where('kamar_id', $validated['kamar_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('tanggal_checkin', [$validated['tanggal_checkin'], $validated['tanggal_checkout']])
                    ->orWhereBetween('tanggal_checkout', [$validated['tanggal_checkin'], $validated['tanggal_checkout']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('tanggal_checkin', '<=', $validated['tanggal_checkin'])
                            ->where('tanggal_checkout', '>=', $validated['tanggal_checkout']);
                    });
            })
            ->whereIn('status_booking', ['Pending', 'Check-in'])
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors('Kamar sudah dipesan pada tanggal tersebut');
        }

        $checkin = Carbon::parse($validated['tanggal_checkin']);
        $checkout = Carbon::parse($validated['tanggal_checkout']);
        $lama_menginap = $checkout->diffInDays($checkin);
        $total_harga = $kamar->tipeKamar->harga_per_malam * $lama_menginap;

        Booking::create([
            'tamu_id' => $validated['tamu_id'],
            'kamar_id' => $validated['kamar_id'],
            'tanggal_checkin' => $validated['tanggal_checkin'],
            'tanggal_checkout' => $validated['tanggal_checkout'],
            'lama_menginap' => $lama_menginap,
            'total_harga' => $total_harga,
            'status_booking' => 'Pending',
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $tamuses = Tamus::all();
        $kamars = Kamar::where('status_kamar', 'Tersedia')->orWhere('id', $booking->kamar_id)->get();

        return view('booking.edit', compact('booking', 'tamuses', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if ($booking->status_booking !== 'Pending') {
            return redirect()->back()->withErrors('Hanya booking dengan status Pending yang bisa diubah');
        }

        $validated = $request->validate([
            'tamu_id' => 'required|exists:tamuses,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ]);

        $checkin = Carbon::parse($validated['tanggal_checkin']);
        $checkout = Carbon::parse($validated['tanggal_checkout']);
        $lama_menginap = $checkout->diffInDays($checkin);

        $kamar = Kamar::find($validated['kamar_id']);
        $total_harga = $kamar->tipeKamar->harga_per_malam * $lama_menginap;

        $booking->update([
            'tamu_id' => $validated['tamu_id'],
            'kamar_id' => $validated['kamar_id'],
            'tanggal_checkin' => $validated['tanggal_checkin'],
            'tanggal_checkout' => $validated['tanggal_checkout'],
            'lama_menginap' => $lama_menginap,
            'total_harga' => $total_harga,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ($booking->status_booking !== 'Pending') {
            return redirect()->back()->withErrors('Hanya booking dengan status Pending yang bisa dihapus');
        }

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibatalkan');
    }

    /**
     * Update booking status to Check-in
     */
    public function checkIn(Booking $booking)
    {
        if ($booking->status_booking !== 'Pending') {
            return redirect()->back()->withErrors('Hanya booking dengan status Pending yang bisa di-check-in');
        }

        $booking->update(['status_booking' => 'Check-in']);
        $booking->kamar->update(['status_kamar' => 'Terisi']);

        return redirect()->route('booking.index')->with('success', 'Check-in berhasil');
    }

    /**
     * Update booking status to Complete
     */
    public function checkOut(Booking $booking)
    {
        if ($booking->status_booking !== 'Check-in') {
            return redirect()->back()->withErrors('Hanya booking dengan status Check-in yang bisa di-check-out');
        }

        $booking->update(['status_booking' => 'Selesai']);
        $booking->kamar->update(['status_kamar' => 'Tersedia']);

        return redirect()->route('booking.index')->with('success', 'Check-out berhasil');
    }
}
