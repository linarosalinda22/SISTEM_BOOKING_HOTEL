<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Tamus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTamus = Tamus::count();
        $totalKamar = Kamar::count();
        $totalBooking = Booking::count();
        $totalPembayaran = Pembayaran::sum('total_bayar');

        // Pending bookings count
        $pendingBookings = Booking::where('status_booking', 'Pending')->count();

        // Room occupancy
        $roomOccupied = Kamar::where('status_kamar', 'Terisi')->count();
        $roomAvailable = Kamar::where('status_kamar', 'Tersedia')->count();
        $roomMaintenance = Kamar::where('status_kamar', 'Maintenance')->count();

        // Income data (last 7 days)
        $incomeData = [];
        $dateLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $income = Pembayaran::whereDate('created_at', $date)->sum('total_bayar');
            $incomeData[] = $income;
            $dateLabels[] = \Carbon\Carbon::parse($date)->format('d M');
        }

        return view('dashboard', compact(
            'totalTamus',
            'totalKamar',
            'totalBooking',
            'totalPembayaran',
            'pendingBookings',
            'roomOccupied',
            'roomAvailable',
            'roomMaintenance',
            'incomeData',
            'dateLabels'
        ));
    }
}
