<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Ikan Premium | Solusi Kesehatan Ikan Terpercaya</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: #F8FAFC;
            color: #0F172A;
            overflow-x: hidden;
        }

        /* Glassmorphism Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
            transition: all 0.3s ease;
        }

        .glass-nav.scrolled {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        /* Hero Background Pattern */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" opacity="0.02"><path fill="%230B2B40" d="M500,100 Q600,200 700,150 Q800,100 850,200 Q900,300 800,400 Q700,500 600,450 Q500,400 400,450 Q300,500 200,400 Q100,300 150,200 Q200,100 300,150 Q400,200 500,100 Z"/><circle cx="250" cy="250" r="30"/><circle cx="750" cy="350" r="45"/><circle cx="500" cy="700" r="50"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
            z-index: 0;
        }

        /* Premium Fish Animation */
        .premium-fish {
            position: absolute;
            pointer-events: none;
            z-index: 1;
            opacity: 0.1;
        }

        .fish-1 { top: 20%; left: 10%; width: 120px; animation: swim 20s infinite linear; }
        .fish-2 { top: 60%; right: 10%; width: 100px; animation: swimRev 25s infinite linear; }

        @keyframes swim {
            0% { transform: translate(-100px, 0) rotate(0deg); }
            50% { transform: translate(100vw, 50px) rotate(5deg); }
            100% { transform: translate(-100px, 0) rotate(0deg); }
        }

        @keyframes swimRev {
            0% { transform: translate(100px, 0) scaleX(-1) rotate(0deg); }
            50% { transform: translate(-100vw, -50px) scaleX(-1) rotate(-5deg); }
            100% { transform: translate(100px, 0) scaleX(-1) rotate(0deg); }
        }

        .btn-premium {
            background: linear-gradient(135deg, #0B2B40 0%, #1B6B82 100%);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            font-weight: 700;
            box-shadow: 0 10px 20px -5px rgba(11, 43, 64, 0.2);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(11, 43, 64, 0.3);
        }

        .btn-teal {
            background: linear-gradient(135deg, #2DD4BF 0%, #14B8A6 100%);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            font-weight: 700;
            box-shadow: 0 10px 20px -5px rgba(45, 212, 191, 0.2);
        }

        .btn-teal:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(45, 212, 191, 0.3);
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

        .glass-card {
            background: white;
            border: 1px solid rgba(15, 23, 42, 0.05);
            border-radius: 32px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.02);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.05);
        }

        /* Bubble Effect */
        .bubble {
            position: absolute;
            background: rgba(11, 43, 64, 0.05);
            border-radius: 50%;
            pointer-events: none;
            animation: bubbleRise 10s infinite ease-in;
        }

        @keyframes bubbleRise {
            0% { transform: translateY(100vh) scale(0.5); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-20vh) scale(1.2); opacity: 0; }
        }

        /* Slow floating card animation */
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-bounce-slow {
            animation: bounceSlow 4s ease-in-out infinite;
        }

        /* Smooth mobile menu */
        #mobile-menu {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            border-top: 1px solid transparent;
        }
        #mobile-menu.active {
            max-height: 400px;
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-top: 1px solid rgba(15, 23, 42, 0.05);
        }

        /* Removed conflicting page transition to allow loader to remain visible */
    </style>
</head>
<body class="antialiased font-sans text-slate-800 bg-slate-50 relative">
    <div id="bubble-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>
    <!-- Premium Global Loader -->
    <style>
        .loader-bg { background: linear-gradient(135deg, #0B2B40 0%, #1A4D6B 100%); }
        @keyframes floatGlow {
            0%, 100% { transform: translateY(0) scale(0.95); filter: drop-shadow(0 0 15px rgba(45, 212, 191, 0.2)); }
            50% { transform: translateY(-10px) scale(1.05); filter: drop-shadow(0 0 30px rgba(45, 212, 191, 0.6)); }
        }
        .loader-logo { animation: floatGlow 4s ease-in-out infinite; }
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

    <!-- Navbar -->
    <nav class="glass-nav fixed top-0 w-full z-50 py-6 px-6 transition-all" id="navbar">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="#" class="flex items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-24 w-auto">
            </a>

            <div class="hidden lg:flex items-center gap-8">
                <a href="#home" class="text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors">Beranda</a>
                <a href="#layanan" class="text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors">Layanan</a>
                <a href="#cara-kerja" class="text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors">Cara Kerja</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-premium px-6 py-2.5 text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-teal px-8 py-3 text-sm">Daftar Sekarang</a>
                @endauth
            </div>

            <button id="mobile-menu-btn" class="lg:hidden flex items-center justify-center w-11 h-11 rounded-xl bg-[#0B2B40]/5 hover:bg-[#0B2B40]/10 border border-[#0B2B40]/10 transition-all focus:outline-none" aria-label="Menu">
                <i id="hamburger-icon" class="fa-solid fa-bars text-[#0B2B40] text-lg transition-transform duration-300"></i>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="lg:hidden flex flex-col gap-3">
            <a href="#home" class="mobile-link text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors py-2">Beranda</a>
            <a href="#layanan" class="mobile-link text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors py-2">Layanan</a>
            <a href="#cara-kerja" class="mobile-link text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors py-2">Cara Kerja</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-premium px-6 py-2.5 text-sm text-center">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-500 hover:text-[#0B2B40] transition-colors py-2">Masuk</a>
                <a href="{{ route('register') }}" class="btn-teal px-8 py-3 text-sm text-center">Daftar Sekarang</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="bg-pattern"></div>
        
        <!-- Animated Fish -->
        <div class="premium-fish fish-1">
            <svg viewBox="0 0 120 70" fill="#0B2B40" class="opacity-10">
                <path d="M100,35 C100,35 112,28 112,35 C112,42 100,35 100,35 Z"/>
                <ellipse cx="55" cy="35" rx="40" ry="28"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative z-10">
            <div data-aos="fade-right" data-aos-duration="1000">
                <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 px-4 py-2 rounded-2xl mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Solusi Kesehatan Ikan No. 1</span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight mb-6 text-[#0B2B40]">
                    Perawatan Ikan <br>
                    <span class="text-gradient-teal">Profesional</span> di Rumah Anda
                </h1>
                <p class="text-slate-500 text-lg mb-10 max-w-xl leading-relaxed font-medium">
                    Kami menghadirkan teknisi ahli langsung ke lokasi Anda untuk diagnosa, perawatan, dan pengobatan ikan hias kesayangan Anda dengan teknologi terkini.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-premium px-10 py-4 text-center">
                            Pesan Teknisi Sekarang <i class="fa-solid fa-calendar-check ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-premium px-10 py-4 text-center">
                            Pesan Teknisi Sekarang <i class="fa-solid fa-calendar-check ms-2"></i>
                        </a>
                    @endauth
                    <a href="#layanan" class="bg-white border border-slate-200 hover:bg-slate-50 px-10 py-4 rounded-2xl text-center font-bold text-[#0B2B40] transition-all shadow-sm">
                        Lihat Layanan
                    </a>
                </div>

                <div class="mt-12 flex items-center gap-6">
                    <div class="flex -space-x-4">
                        <img src="https://ui-avatars.com/api/?name=A&background=random" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=B&background=random" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=C&background=random" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                    </div>
                    <div>
                        <div class="flex gap-1 text-amber-400 text-sm mb-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Dipercaya oleh 500+ Pecinta Ikan</p>
                    </div>
                </div>
            </div>

            <div class="relative" data-aos="fade-left" data-aos-duration="1000">
                <div class="relative z-10 rounded-[40px] overflow-hidden border border-slate-100 shadow-2xl">
                    <img src="{{ asset('assets/images/hero-fish.jpg') }}" alt="Ikan Arwana" class="w-full h-auto transform hover:scale-105 transition-transform duration-1000">
                </div>
                <!-- Floating Card -->
                <div class="absolute -bottom-6 left-4 sm:-left-10 sm:-bottom-10 glass-card p-6 flex items-center gap-4 animate-bounce-slow shadow-xl z-20">
                    <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 text-xl shadow-sm">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Teknisi Ahli</p>
                        <p class="text-sm font-bold text-[#0B2B40]">Tersedia di Kota Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 relative overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="text-4xl lg:text-5xl font-black text-[#0B2B40] mb-2">500+</div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Klien Puas</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="text-4xl lg:text-5xl font-black text-[#0B2B40] mb-2">20+</div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Teknisi Ahli</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-4xl lg:text-5xl font-black text-[#0B2B40] mb-2">15+</div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Layanan Medis</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                <div class="text-4xl lg:text-5xl font-black text-[#0B2B40] mb-2">24/7</div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Support Siap</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-4 text-[#0B2B40]">Layanan <span class="text-gradient-teal">Terbaik</span> Kami</h2>
                <p class="text-slate-500 max-w-2xl mx-auto leading-relaxed font-medium">Berbagai pilihan layanan perawatan dan pengobatan ikan hias yang ditangani langsung oleh spesialis.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="glass-card p-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-3xl mb-8 group-hover:scale-110 transition-transform shadow-sm">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0B2B40]">Konsultasi Medis</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">Pemeriksaan fisik menyeluruh untuk mendeteksi penyakit luar maupun dalam pada ikan hias Anda.</p>
                    <div class="w-10 h-1 bg-[#0B2B40] rounded-full"></div>
                </div>

                <!-- Service 2 -->
                <div class="glass-card p-10" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 text-3xl mb-8 group-hover:scale-110 transition-transform shadow-sm">
                        <i class="fa-solid fa-vial"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0B2B40]">Pemberian Obat</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">Tindakan pengobatan langsung (injection/bath) untuk mengatasi infeksi jamur, parasit, dan bakteri.</p>
                    <div class="w-10 h-1 bg-teal-400 rounded-full"></div>
                </div>

                <!-- Service 3 -->
                <div class="glass-card p-10" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-3xl mb-8 group-hover:scale-110 transition-transform shadow-sm">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0B2B40]">Water Treatment</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">Analisa kualitas air parameter (pH, Ammonia, Nitrit) untuk memastikan lingkungan kolam yang sehat.</p>
                    <div class="w-10 h-1 bg-indigo-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section id="cara-kerja" class="py-24 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-extrabold mb-8 leading-tight text-[#0B2B40]">Gampang Banget! <br> Begini <span class="text-gradient-teal">Cara Kerjanya</span></h2>
                    
                    <div class="space-y-10">
                        <div class="flex gap-6">
                            <div class="w-12 h-12 bg-[#0B2B40] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-blue-900/20">1</div>
                            <div>
                                <h5 class="text-xl font-bold mb-2 text-[#0B2B40]">Pilih Layanan & Daftar</h5>
                                <p class="text-slate-500 text-sm font-medium">Pilih layanan yang Anda butuhkan dan daftarkan akun Anda hanya dalam 1 menit.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-teal-500/20">2</div>
                            <div>
                                <h5 class="text-xl font-bold mb-2 text-[#0B2B40]">Tentukan Jadwal & Teknisi</h5>
                                <p class="text-slate-500 text-sm font-medium">Pilih waktu yang sesuai dan teknisi spesialis yang Anda inginkan di wilayah Anda.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg shadow-blue-500/20">3</div>
                            <div>
                                <h5 class="text-xl font-bold mb-2 text-[#0B2B40]">Teknisi Datang & Selesai</h5>
                                <p class="text-slate-500 text-sm font-medium">Teknisi kami melakukan penanganan medis. Pembayaran aman & mudah via Midtrans.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left">
                    <div class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1535591273668-578e31182c4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Work" class="w-full h-[500px] object-cover">
                    </div>
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-400/5 rounded-full blur-3xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center mb-8">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-24 w-auto">
            </div>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-8">© {{ date('Y') }} Klinik Ikan Premium. Professional Fish Healthcare Provider.</p>
            <div class="flex justify-center gap-6">
                <a href="#" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-instagram text-xl"></i></a>
                <a href="#" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-facebook text-xl"></i></a>
                <a href="#" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-whatsapp text-xl"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
        
        // Navbar Scroll
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if(window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileMenu.classList.toggle('active');
                hamburgerIcon.classList.toggle('fa-bars');
                hamburgerIcon.classList.toggle('fa-xmark');
            });

            // Close menu when clicking on a link
            document.querySelectorAll('.mobile-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    hamburgerIcon.classList.remove('fa-xmark');
                    hamburgerIcon.classList.add('fa-bars');
                });
            });

            // Close menu when clicking outside navbar
            document.addEventListener('click', (e) => {
                if (!mobileMenuBtn.closest('nav').contains(e.target)) {
                    mobileMenu.classList.remove('active');
                    hamburgerIcon.classList.remove('fa-xmark');
                    hamburgerIcon.classList.add('fa-bars');
                }
            });
        }

        // Bubble Generator
        function createBubble() {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');
            const size = Math.random() * 20 + 10 + 'px';
            bubble.style.width = size;
            bubble.style.height = size;
            bubble.style.left = Math.random() * 100 + 'vw';
            bubble.style.animationDuration = Math.random() * 5 + 5 + 's';
            bubble.style.animationDuration = Math.random() * 10 + 10 + 's';
            const container = document.getElementById('bubble-container');
            if(container) container.appendChild(bubble);
            setTimeout(() => bubble.remove(), 20000);
        }
        setInterval(createBubble, 1000);

        // Page Transition Script
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
