@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="flex min-h-screen bg-slate-50"> <aside class="w-64 bg-brand-900 text-white flex flex-col shrink-0 shadow-xl">

        <div class="p-6 border-b border-white/10">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                🏨 HotelApp
            </h1>

            <p class="text-sm text-brand-200 mt-1">
                Sistem Booking Hotel
            </p>
        </div>

        <nav class="flex-1 p-4 space-y-1.5">

            <a href="/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-brand-700 hover:bg-brand-500 text-white transition font-medium shadow-md">
                <i class="fas fa-home w-5"></i>
                Dashboard
            </a>

            <a href="/tamus"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-brand-50 hover:bg-brand-700/40 transition font-medium">
                <i class="fas fa-users w-5"></i>
                Data Tamu
            </a>

            <a href="/kamar"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-brand-50 hover:bg-brand-700/40 transition font-medium">
                <i class="fas fa-bed w-5"></i>
                Data Kamar
            </a>

            <a href="/tipe-kamar"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-brand-50 hover:bg-brand-700/40 transition font-medium">
                <i class="fas fa-door-open w-5"></i>
                Tipe Kamar
            </a>

            <a href="/booking"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-brand-50 hover:bg-brand-700/40 transition font-medium">
                <i class="fas fa-calendar-check w-5"></i>
                Booking
            </a>

            <a href="/pembayaran"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-brand-50 hover:bg-brand-700/40 transition font-medium">
                <i class="fas fa-money-bill-wave w-5"></i>
                Pembayaran
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 py-2.5 rounded-lg text-white font-medium transition shadow-md">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 p-8 overflow-y-auto">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight">
                    Dashboard
                </h2>
                <p class="text-slate-500 mt-1">
                    Selamat datang di Sistem Booking Hotel
                </p>
            </div>

            <div class="bg-brand-50 p-4 rounded-xl text-brand-700 shadow-inner">
                <i class="fas fa-hotel text-4xl"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5 mb-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        Total Tamu
                    </p>
                    <h2 class="text-3xl font-bold text-brand-700 mt-1">
                        {{ $totalTamus }}
                    </h2>
                </div>
                <div class="text-brand-400 text-2xl"><i class="fas fa-users"></i></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        Total Kamar
                    </p>
                    <h2 class="text-3xl font-bold text-emerald-600 mt-1">
                        {{ $totalKamar }}
                    </h2>
                </div>
                <div class="text-emerald-400 text-2xl"><i class="fas fa-bed"></i></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        Total Booking
                    </p>
                    <h2 class="text-3xl font-bold text-amber-500 mt-1">
                        {{ $totalBooking }}
                    </h2>
                </div>
                <div class="text-amber-400 text-2xl"><i class="fas fa-calendar-check"></i></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        Pending
                    </p>
                    <h2 class="text-3xl font-bold text-orange-500 mt-1">
                        {{ $pendingBookings }}
                    </h2>
                </div>
                <div class="text-orange-400 text-2xl"><i class="fas fa-clock"></i></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        Pendapatan
                    </p>
                    <h2 class="text-xl font-bold text-rose-600 mt-2">
                        Rp {{ number_format($totalPembayaran ?? 0,0,',','.') }}
                    </h2>
                </div>
                <div class="text-rose-400 text-2xl"><i class="fas fa-money-bill-wave"></i></div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-base font-bold text-slate-800 mb-5 border-b border-slate-100 pb-3">
                    Status Kamar
                </h3>

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm font-medium mb-1">
                            <span class="text-slate-600">Tersedia</span>
                            <span class="text-slate-800 font-bold">{{ $roomAvailable }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-brand-500 h-full rounded-full"
                                style="width: {{ $roomAvailable * 10 }}%">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-1">
                            <span class="text-slate-600">Terisi</span>
                            <span class="text-slate-800 font-bold">{{ $roomOccupied }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-brand-200 h-full rounded-full"
                                style="width: {{ $roomOccupied * 10 }}%">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-1">
                            <span class="text-slate-600">Maintenance</span>
                            <span class="text-slate-800 font-bold">{{ $roomMaintenance }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-slate-300 h-full rounded-full"
                                style="width: {{ $roomMaintenance * 10 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-center mb-5 border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-800">
                        Grafik Pendapatan
                    </h3>
                    <div class="text-brand-500"><i class="fas fa-chart-line text-xl"></i></div>
                </div>

                <div class="relative h-64">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>

        </div>

    </main>

</div>

@endsection

@section('scripts')

<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dateLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($incomeData) !!},
                // Mengubah warna grafik sesuai palet baru
                borderColor: '#3182BD',           // brand-700
                backgroundColor: 'rgba(107, 174, 214, 0.15)', // brand-500 dengan opasitas rendah
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointBackgroundColor: '#08519C',   // brand-900
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#08519C'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#94a3b8' },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    ticks: { color: '#94a3b8' },
                    grid: { display: false }
                }
            }
        }
    });
</script>

@endsection