<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | FishHealth +</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #F8FAFC;
            min-height: 100vh;
            color: #0F172A;
            position: relative;
            overflow-x: hidden;
        }

        /* Dekorasi Background Pattern */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" opacity="0.02"><path fill="#0B2B40" d="M500,100 Q600,200 700,150 Q800,100 850,200 Q900,300 800,400 Q700,500 600,450 Q500,400 400,450 Q300,500 200,400 Q100,300 150,200 Q200,100 300,150 Q400,200 500,100 Z"/><circle cx="250" cy="250" r="30"/><circle cx="750" cy="350" r="45"/><circle cx="500" cy="700" r="50"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
            z-index: 0;
        }

        /* Glassmorphism Sidebar/Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
            z-index: 50;
        }

        /* Glass Card Premium - Light Version */
        .glass-premium {
            background: white;
            border: 1px solid rgba(15, 23, 42, 0.05);
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-premium:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -5px rgba(15, 23, 42, 0.04);
        }

        /* Table Styling */
        .table-premium {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table-premium thead th {
            padding: 12px 20px;
            text-align: left;
            color: #64748B;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .table-premium tbody tr {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .table-premium tbody tr:hover {
            background: #F1F5F9;
            transform: scale(1.01);
        }

        .table-premium tbody td {
            padding: 16px 20px;
            color: #1E293B;
        }

        .table-premium tbody tr td:first-child { border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
        .table-premium tbody tr td:last-child { border-top-right-radius: 16px; border-bottom-right-radius: 16px; }

        /* Button Premium */
        .btn-premium {
            background: linear-gradient(135deg, #0B2B40 0%, #1B6B82 100%);
            border-radius: 12px;
            transition: all 0.3s ease;
            color: white;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(11, 43, 64, 0.4);
            color: white;
        }

        .btn-teal {
            background: linear-gradient(135deg, #2DD4BF 0%, #14B8A6 100%);
            border-radius: 12px;
            transition: all 0.3s ease;
            color: white;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
        }

        .btn-teal:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(45, 212, 191, 0.4);
            color: white;
        }

        .btn-premium-outline {
            background: transparent;
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: #64748B;
            font-weight: 600;
            padding: 10px 24px;
        }

        .btn-premium-outline:hover {
            background: #F1F5F9;
            border-color: #CBD5E1;
            color: #0F172A;
        }

        /* Input Field */
        .input-premium {
            background: white;
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            padding: 12px 16px;
            color: #0F172A;
            transition: all 0.3s ease;
            width: 100%;
        }

        .input-premium:focus {
            background: white;
            border-color: #0B2B40;
            outline: none;
            box-shadow: 0 0 0 4px rgba(11, 43, 64, 0.05);
        }

        .text-gradient-premium {
            background: linear-gradient(135deg, #0B2B40, #1B6B82);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gradient-teal {
            background: linear-gradient(135deg, #2DD4BF, #14B8A6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* Animation for notifications */
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }

        /* Removed conflicting page transition to allow loader to remain visible */
        /* Smooth mobile menu */
        #mobile-menu {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            border-top: 1px solid transparent;
        }
        #mobile-menu.active {
            max-height: 600px;
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-top: 1px solid rgba(15, 23, 42, 0.05);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F8FAFC]">
    <!-- Premium Global Loader -->
    <style>
        .loader-bg { background: linear-gradient(135deg, #0B2B40 0%, #1A4D6B 100%); }
        @keyframes floatGlow {
            0%, 100% { transform: translateY(0) scale(0.95); filter: drop-shadow(0 0 15px rgba(45, 212, 191, 0.2)); }
            50% { transform: translateY(-10px) scale(1.05); filter: drop-shadow(0 0 30px rgba(45, 212, 191, 0.6)); }
        }
        .loader-logo { animation: floatGlow 3s ease-in-out infinite; }
        @keyframes loaderBubbleRise {
            0% { transform: translateY(0) scale(0); opacity: 0; }
            20% { opacity: 0.5; }
            100% { transform: translateY(-120vh) scale(1); opacity: 0; }
        }
        .loader-bubble {
            position: absolute;
            bottom: -50px;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.1));
            border-radius: 50%;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
            animation: loaderBubbleRise linear infinite;
        }
        .loader-fish-silhouette {
            position: absolute; width: 300px; height: 300px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50"><path fill="rgba(255,255,255,0.03)" d="M80,25 C70,10 40,0 20,20 C10,30 0,25 0,25 C0,25 10,20 20,30 C40,50 70,40 80,25 Z M80,25 L100,10 L90,25 L100,40 Z"/></svg>');
            background-repeat: no-repeat; background-size: contain; opacity: 0.5;
            animation: swimBg 35s linear infinite;
        }
        @keyframes swimBg {
            0% { transform: translate(-10vw, 20vh) scale(1); }
            50% { transform: translate(50vw, -10vh) scale(1.2); }
            100% { transform: translate(110vw, 30vh) scale(1); }
        }
        .loader-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }
    </style>
    <div id="global-loader" class="fixed inset-0 z-[9999] loader-bg flex flex-col items-center justify-center overflow-hidden transition-opacity duration-500 ease-in-out">
        <div class="loader-fish-silhouette" style="top: 20%; left: -20%;"></div>
        <div class="loader-fish-silhouette" style="top: 60%; left: -30%; transform: scale(0.6); animation-duration: 45s; animation-delay: 5s;"></div>
        <div class="loader-bubble" style="width: 15px; height: 15px; left: 20%; animation-duration: 8s; animation-delay: 0s;"></div>
        <div class="loader-bubble" style="width: 25px; height: 25px; left: 50%; animation-duration: 12s; animation-delay: 1s;"></div>
        <div class="loader-bubble" style="width: 10px; height: 10px; left: 80%; animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="loader-bubble" style="width: 20px; height: 20px; left: 35%; animation-duration: 14s; animation-delay: 3s;"></div>
        
        <div class="relative z-10 flex flex-col items-center justify-center">
            <div class="loader-glass p-8 md:p-12 rounded-[2rem] flex flex-col items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Klinik Ikan Premium" class="h-20 md:h-28 w-auto loader-logo">
                <div class="mt-8 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></div>
                    <p class="text-xs md:text-sm font-bold text-teal-300 uppercase tracking-[0.3em] font-sans">Memuat</p>
                    <div class="w-2 h-2 rounded-full bg-teal-400 animate-ping" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-pattern"></div>

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 w-full py-4 px-6 mb-8 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center group">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Fish Health+ Logo" class="h-20 w-auto group-hover:scale-110 transition-transform">
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-6">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Dashboard</a>
                        <a href="{{ route('layanan.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Layanan</a>
                        <a href="{{ route('teknisi.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Teknisi</a>
                        <a href="{{ route('ikan.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Ikan</a>
                        <a href="{{ route('booking.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Booking</a>
                        <a href="{{ route('pembayaran.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Pembayaran</a>
                    @elseif(Auth::user()->isTeknisi())
                        <a href="{{ route('teknisi.dashboard') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Dashboard</a>
                        <a href="{{ route('pembayaran.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Riwayat</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Dashboard</a>
                        <a href="{{ route('booking.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Booking</a>
                        <a href="{{ route('pembayaran.index') }}" class="text-slate-600 hover:text-[#0B2B40] transition-colors text-sm font-semibold">Pembayaran</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center gap-3">
                @auth
                    {{-- User dropdown (desktop) --}}
                    <div class="relative group hidden lg:block">
                        <button class="flex items-center gap-3 bg-slate-100 hover:bg-slate-200 border border-slate-200 p-1.5 pr-4 rounded-xl transition-all">
                            @if(Auth::user()->avatar)
                                <img src="{{ str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(Auth::user()->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-lg object-cover">
                            @else
                                <div class="w-8 h-8 bg-[#0B2B40] rounded-lg flex items-center justify-center text-xs font-bold text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="flex flex-col items-start leading-tight">
                                <span class="text-sm font-bold text-[#0B2B40]">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">
                                    @if(Auth::user()->isTeknisi() && Auth::user()->teknisi)
                                        {{ ucfirst(Auth::user()->teknisi->subtype ?? 'teknisi') }}
                                    @else
                                        {{ Auth::user()->role }}
                                    @endif
                                </span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>
                        
                        <div class="absolute right-0 top-full mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden">
                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition-colors font-semibold border-b border-slate-100">
                                <i class="fa-solid fa-user"></i>
                                Profil Saya
                            </a>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors font-semibold">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>

                    {{-- Hamburger button (mobile only) --}}
                    <button id="mobile-menu-btn" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all" aria-label="Menu">
                        <i id="hamburger-icon" class="fa-solid fa-bars text-[#0B2B40]"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-[#0B2B40] text-sm font-bold">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-premium py-2 px-6 text-sm">Daftar</a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu Panel --}}
        @auth
        <div id="mobile-menu" class="lg:hidden space-y-1">
            {{-- User info --}}
            <div class="flex items-center gap-3 px-3 py-3 mb-2 bg-slate-50 rounded-xl">
                @if(Auth::user()->avatar)
                    <img src="{{ str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(Auth::user()->avatar) }}" alt="Avatar" class="w-9 h-9 rounded-lg object-cover">
                @else
                    <div class="w-9 h-9 bg-[#0B2B40] rounded-lg flex items-center justify-center text-sm font-bold text-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <p class="text-sm font-bold text-[#0B2B40]">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                        @if(Auth::user()->isTeknisi() && Auth::user()->teknisi)
                            {{ ucfirst(Auth::user()->teknisi->subtype ?? 'teknisi') }}
                        @else
                            {{ Auth::user()->role }}
                        @endif
                    </p>
                </div>
            </div>

            {{-- Nav links --}}
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-gauge-high w-4 text-teal-500"></i> Dashboard</a>
                <a href="{{ route('layanan.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-stethoscope w-4 text-teal-500"></i> Layanan</a>
                <a href="{{ route('teknisi.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-user-gear w-4 text-teal-500"></i> Teknisi</a>
                <a href="{{ route('ikan.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-fish w-4 text-teal-500"></i> Ikan</a>
                <a href="{{ route('booking.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-regular fa-calendar-check w-4 text-teal-500"></i> Booking</a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-money-bill-wave w-4 text-teal-500"></i> Pembayaran</a>
            @elseif(Auth::user()->isTeknisi())
                <a href="{{ route('teknisi.dashboard') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-gauge-high w-4 text-teal-500"></i> Dashboard</a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-clock-rotate-left w-4 text-teal-500"></i> Riwayat</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-gauge-high w-4 text-teal-500"></i> Dashboard</a>
                <a href="{{ route('booking.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-regular fa-calendar-check w-4 text-teal-500"></i> Booking</a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-money-bill-wave w-4 text-teal-500"></i> Pembayaran</a>
            @endif

            {{-- Profile & Logout --}}
            <div class="border-t border-slate-100 pt-2 mt-2 space-y-1">
                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 rounded-xl transition-colors"><i class="fa-solid fa-user w-4 text-slate-400"></i> Profil Saya</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                   class="flex items-center gap-3 px-3 py-3 text-sm font-semibold text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                    <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>
        @endauth
    </nav>




    <!-- Main Content -->
    <main class="relative z-10 max-w-7xl mx-auto px-6 pb-12">
        <!-- Alerts -->
        <div class="fixed top-24 right-6 w-80 space-y-3 z-[100]">
            @if(session('success'))
            <div class="bg-white border-l-4 border-emerald-500 shadow-2xl p-4 flex gap-3 items-start animate-slide-in rounded-r-xl">
                <i class="fa-solid fa-check-circle text-emerald-500 mt-0.5"></i>
                <div>
                    <p class="text-sm font-bold text-[#0B2B40]">Berhasil</p>
                    <p class="text-xs text-slate-500 mt-1">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-white border-l-4 border-red-500 shadow-2xl p-4 flex gap-3 items-start animate-slide-in rounded-r-xl">
                <i class="fa-solid fa-triangle-exclamation text-red-500 mt-0.5"></i>
                <div>
                    <p class="text-sm font-bold text-[#0B2B40]">Gagal</p>
                    <p class="text-xs text-slate-500 mt-1">{{ session('error') }}</p>
                </div>
            </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative z-10 py-12 border-t border-slate-200 mt-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-xs font-medium">
                © {{ date('Y') }} Klinik Ikan Premium. Professional Fish Healthcare Provider.
            </p>
        </div>
    </footer>

    @stack('scripts')

    <!-- Page Transition Script -->
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('global-loader');
            if (loader) {
                // Waktu tampil sedang (medium)
                setTimeout(() => {
                    loader.classList.add('opacity-0');
                    setTimeout(() => {
                        loader.classList.add('pointer-events-none');
                    }, 500);
                }, 800);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            // ══ HAMBURGER MOBILE MENU ════════════════════════════════════
            const mobileBtn  = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamIcon    = document.getElementById('hamburger-icon');
            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('active');
                    hamIcon.classList.toggle('fa-bars');
                    hamIcon.classList.toggle('fa-xmark');
                });
                // Tutup menu jika klik di luar navbar
                document.addEventListener('click', function(e) {
                    if (!mobileBtn.closest('nav').contains(e.target)) {
                        mobileMenu.classList.remove('active');
                        hamIcon.classList.remove('fa-xmark');
                        hamIcon.classList.add('fa-bars');
                    }
                });
            }

            // ══ PAGE TRANSITION ══════════════════════════════════════════
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (!href) return;
                    
                    const isInternal = this.hostname === window.location.hostname;
                    const isHash = href.includes('#');
                    const hasTarget = this.getAttribute('target') === '_blank';
                    const hasOnClick = this.hasAttribute('onclick');
                    const isDownload = this.hasAttribute('download');

                    if (isInternal && !isHash && !hasTarget && !hasOnClick && !isDownload) {
                        e.preventDefault();
                        
                        const loader = document.getElementById('global-loader');
                        if (loader) {
                            loader.classList.remove('pointer-events-none', 'opacity-0');
                        }
                        
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 600);
                    }
                });
            });

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!e.defaultPrevented && !this.hasAttribute('target')) {
                        const loader = document.getElementById('global-loader');
                        if (loader) {
                            loader.classList.remove('pointer-events-none', 'opacity-0');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
