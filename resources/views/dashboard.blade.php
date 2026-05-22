@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white flex flex-col">

        <div class="p-6 border-b border-blue-500">
            <h1 class="text-2xl font-bold">
                🏨 HotelApp
            </h1>

            <p class="text-sm text-blue-100 mt-1">
                Sistem Booking Hotel
            </p>
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-800 hover:bg-blue-900 transition">

                <i class="fas fa-home"></i>
                Dashboard
            </a>

            <a href="/tamus"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

                <i class="fas fa-users"></i>
                Data Tamu
            </a>

            <a href="/kamar"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

                <i class="fas fa-bed"></i>
                Data Kamar
            </a>

            <a href="/booking"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

                <i class="fas fa-calendar-check"></i>
                Booking
            </a>

            <a href="/pembayaran"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

                <i class="fas fa-money-bill-wave"></i>
                Pembayaran
            </a>
        </nav>

        <div class="p-4 border-t border-blue-500">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg transition">

                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">

        <!-- Header -->
        <div class="bg-white rounded-2xl shadow p-6 mb-6 flex items-center justify-between">

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Dashboard
                </h2>

                <p class="text-gray-500 mt-1">
                    Selamat datang di Sistem Booking Hotel
                </p>
            </div>

            <div class="bg-blue-100 p-4 rounded-xl">
                <i class="fas fa-hotel text-4xl text-blue-600"></i>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 mb-6">

            <!-- Tamu -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Total Tamu
                        </p>

                        <h2 class="text-3xl font-bold text-blue-600">
                            {{ $totalTamus }}
                        </h2>
                    </div>

                    <i class="fas fa-users text-3xl text-blue-500"></i>
                </div>
            </div>

            <!-- Kamar -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Total Kamar
                        </p>

                        <h2 class="text-3xl font-bold text-green-600">
                            {{ $totalKamar }}
                        </h2>
                    </div>

                    <i class="fas fa-bed text-3xl text-green-500"></i>
                </div>
            </div>

            <!-- Booking -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Total Booking
                        </p>

                        <h2 class="text-3xl font-bold text-yellow-500">
                            {{ $totalBooking }}
                        </h2>
                    </div>

                    <i class="fas fa-calendar-check text-3xl text-yellow-500"></i>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Pending
                        </p>

                        <h2 class="text-3xl font-bold text-orange-500">
                            {{ $pendingBookings }}
                        </h2>
                    </div>

                    <i class="fas fa-clock text-3xl text-orange-500"></i>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Pendapatan
                        </p>

                        <h2 class="text-2xl font-bold text-red-500">
                            Rp {{ number_format($totalPembayaran ?? 0,0,',','.') }}
                        </h2>
                    </div>

                    <i class="fas fa-money-bill-wave text-3xl text-red-500"></i>
                </div>
            </div>

        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Status -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-xl font-bold text-gray-700 mb-5">
                    Status Kamar
                </h3>

                <div class="space-y-4">

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Tersedia</span>
                            <span>{{ $roomAvailable }}</span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-500 h-3 rounded-full"
                                style="width: {{ $roomAvailable * 10 }}%">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Terisi</span>
                            <span>{{ $roomOccupied }}</span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-500 h-3 rounded-full"
                                style="width: {{ $roomOccupied * 10 }}%">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Maintenance</span>
                            <span>{{ $roomMaintenance }}</span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-yellow-500 h-3 rounded-full"
                                style="width: {{ $roomMaintenance * 10 }}%">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Chart -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

                <div class="flex justify-between items-center mb-5">

                    <h3 class="text-xl font-bold text-gray-700">
                        Grafik Pendapatan
                    </h3>

                    <i class="fas fa-chart-line text-green-500 text-2xl"></i>
                </div>

                <canvas id="incomeChart" height="100"></canvas>

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

                borderColor: '#2563eb',

                backgroundColor: 'rgba(37,99,235,0.1)',

                fill: true,

                tension: 0.4,

                pointRadius: 4
            }]
        },

        options: {
            responsive: true,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection