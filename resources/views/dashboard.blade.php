@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <!-- Total Tamu -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Tamu</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalTamus }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Kamar -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Kamar</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalKamar }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fas fa-key text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Booking -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Booking</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBooking }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-lg">
                <i class="fas fa-calendar-check text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Booking -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Booking Pending</p>
                <p class="text-3xl font-bold text-gray-800">{{ $pendingBookings }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-lg">
                <i class="fas fa-hourglass-half text-orange-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pendapatan</p>
                <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalPembayaran ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-lg">
                <i class="fas fa-money-bill-wave text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Status Kamar -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Status Kamar</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    <span>Tersedia</span>
                </div>
                <span class="font-bold">{{ $roomAvailable }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                    <span>Terisi</span>
                </div>
                <span class="font-bold">{{ $roomOccupied }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                    <span>Maintenance</span>
                </div>
                <span class="font-bold">{{ $roomMaintenance }}</span>
            </div>
        </div>
    </div>

    <!-- Income Chart -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Pendapatan 7 Hari Terakhir</h3>
        <canvas id="incomeChart"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');
    const incomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dateLabels) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($incomeData) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#3b82f6'
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
