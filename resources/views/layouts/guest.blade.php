<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            @keyframes gradient-shift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient-shift 15s ease infinite;
            }
        </style>
    <body class="font-sans text-slate-900 antialiased" style="font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #00d084 0%, #00ff99 100%); min-height: 100vh;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
            
            <div class="mb-6">
                <a href="/">
                    <x-application-logo class="text-3xl font-bold text-white tracking-tight drop-shadow-lg" />
                </a>
            </div>



            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg border border-gray-200 rounded-lg overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
