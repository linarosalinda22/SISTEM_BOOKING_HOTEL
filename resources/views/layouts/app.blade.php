<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Booking Hotel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white min-h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-hotel mr-2"></i> Hotel Booking
                </h1>
            </div>

            <nav class="mt-10">
                <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('dashboard') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>

                <div class="px-6 py-2 mt-4">
                    <p class="text-xs font-semibold text-blue-200 uppercase">Data Master</p>
                </div>

                <a href="{{ route('tamus.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('tamus.*') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-users mr-2"></i> Data Tamu
                </a>

                <a href="{{ route('tipe-kamar.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('tipe-kamar.*') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-door-open mr-2"></i> Tipe Kamar
                </a>

                <a href="{{ route('kamar.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('kamar.*') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-key mr-2"></i> Kamar
                </a>

                <div class="px-6 py-2 mt-4">
                    <p class="text-xs font-semibold text-blue-200 uppercase">Transaksi</p>
                </div>

                <a href="{{ route('booking.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('booking.*') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-calendar-check mr-2"></i> Booking
                </a>

                <a href="{{ route('pembayaran.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition {{ Route::is('pembayaran.*') ? 'bg-blue-700 border-l-4 border-white' : '' }}">
                    <i class="fas fa-credit-card mr-2"></i> Pembayaran
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 border-t border-blue-700 p-6">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-6 py-3 hover:bg-blue-700 transition rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Avatar" class="w-10 h-10 rounded-full">
                </div>
            </nav>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Sweet Alert for delete confirmation
        function confirmDelete(e) {
            e.preventDefault();
            const form = e.target;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Show success message
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000
            });
        @endif
    </script>

    @yield('scripts')
</body>
</html>
