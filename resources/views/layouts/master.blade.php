<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Booking Hotel')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#EFF3FF',  
                            200: '#C6DBEF',
                            400: '#9ECAE1',
                            500: '#6BAED6', 
                            700: '#3182BD',
                            900: '#08519C', 
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Scrollbar styling agar lebih rapi */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-brand-500 selection:text-white">

    <div class="w-full min-h-screen">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>