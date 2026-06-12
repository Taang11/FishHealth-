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

        /* Floating animations for Gallery - Out-of-sync */
        @keyframes float-gallery-1 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-8px) rotate(0.4deg); } }
        @keyframes float-gallery-2 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-12px) rotate(-0.4deg); } }
        @keyframes float-gallery-3 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-7px) rotate(0.6deg); } }
        @keyframes float-gallery-4 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-10px) rotate(-0.6deg); } }
        @keyframes float-gallery-5 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-6px) rotate(0.3deg); } }
        @keyframes float-gallery-6 { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-14px) rotate(0.8deg); } }

        .float-anim-1 { animation: float-gallery-1 6s ease-in-out infinite; }
        .float-anim-2 { animation: float-gallery-2 6.5s ease-in-out infinite 0.5s; }
        .float-anim-3 { animation: float-gallery-3 5.5s ease-in-out infinite 0.2s; }
        .float-anim-4 { animation: float-gallery-4 7s ease-in-out infinite 0.7s; }
        .float-anim-5 { animation: float-gallery-5 5s ease-in-out infinite 0.4s; }
        .float-anim-6 { animation: float-gallery-6 7.5s ease-in-out infinite 0.9s; }

        /* 3D Perspective and Card definitions */
        :root {
            --card-width: 320px;
            --card-height: 420px;
        }
        @media (max-width: 640px) {
            :root {
                --card-width: 250px;
                --card-height: 330px;
            }
        }

        .perspective-container {
            perspective: 1200px;
        }
        .preserve-3d {
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }

        .gallery-3d-card {
            position: absolute;
            width: var(--card-width);
            height: var(--card-height);
            border-radius: 28px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.7s ease, z-index 0.7s ease, box-shadow 0.7s ease, filter 0.7s ease;
            transform-origin: center center;
            background: rgba(15, 23, 42, 0.45);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            user-select: none;
        }

        .card-float-wrapper {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform;
        }

        /* Neon Glow Shadows by Category */
        .glow-arwana {
            box-shadow: 0 10px 30px -10px rgba(239, 68, 68, 0.35), inset 0 0 15px rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.3);
        }
        .glow-arwana.active-card, .glow-arwana:hover {
            box-shadow: 0 0 45px rgba(239, 68, 68, 0.6), inset 0 0 20px rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.75);
        }

        .glow-koi {
            box-shadow: 0 10px 30px -10px rgba(249, 115, 22, 0.35), inset 0 0 15px rgba(249, 115, 22, 0.05);
            border-color: rgba(249, 115, 22, 0.3);
        }
        .glow-koi.active-card, .glow-koi:hover {
            box-shadow: 0 0 45px rgba(249, 115, 22, 0.6), inset 0 0 20px rgba(249, 115, 22, 0.25);
            border-color: rgba(249, 115, 22, 0.75);
        }

        .glow-maskoki {
            box-shadow: 0 10px 30px -10px rgba(234, 179, 8, 0.35), inset 0 0 15px rgba(234, 179, 8, 0.05);
            border-color: rgba(234, 179, 8, 0.3);
        }
        .glow-maskoki.active-card, .glow-maskoki:hover {
            box-shadow: 0 0 45px rgba(234, 179, 8, 0.6), inset 0 0 20px rgba(234, 179, 8, 0.25);
            border-color: rgba(234, 179, 8, 0.75);
        }

        .glow-tindakan {
            box-shadow: 0 10px 30px -10px rgba(45, 212, 191, 0.35), inset 0 0 15px rgba(45, 212, 191, 0.05);
            border-color: rgba(45, 212, 191, 0.3);
        }
        .glow-tindakan.active-card, .glow-tindakan:hover {
            box-shadow: 0 0 45px rgba(45, 212, 191, 0.6), inset 0 0 20px rgba(45, 212, 191, 0.25);
            border-color: rgba(45, 212, 191, 0.75);
        }

        /* Glass shimmer sweep effect */
        .gallery-3d-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.15) 30%,
                rgba(255, 255, 255, 0.35) 50%,
                rgba(255, 255, 255, 0.15) 70%,
                transparent
            );
            transform: skewX(-20deg);
            pointer-events: none;
            z-index: 4;
        }
        .gallery-3d-card.active-card:hover::after {
            left: 150%;
            transition: left 0.9s ease-in-out;
        }

        /* Non-active cards dimming & blur - smooth transition */
        .gallery-3d-card:not(.active-card) {
            filter: brightness(0.5) blur(1.5px);
            pointer-events: auto;
            transition: transform 0.85s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), filter 0.85s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .gallery-3d-card:not(.active-card):hover {
            filter: brightness(0.75) blur(0.5px);
        }
        /* Active card glow transition */
        .gallery-3d-card.active-card {
            transition: transform 0.85s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), filter 0.85s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Dots pagination styling */
        .gallery-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(11, 43, 64, 0.15);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .gallery-dot.active {
            width: 32px;
            border-radius: 6px;
            background: #14B8A6;
            box-shadow: 0 0 12px rgba(20, 184, 166, 0.6);
        }

        /* Glassmorphism details */
        .glass-pill {
            background: rgba(15, 23, 42, 0.03);
            border: 1px solid rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .glass-pill:hover {
            background: rgba(15, 23, 42, 0.06);
            border-color: rgba(15, 23, 42, 0.12);
            transform: translateY(-2px);
        }
        .glass-pill.active {
            background: linear-gradient(135deg, #0B2B40 0%, #1B6B82 100%);
            color: white !important;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(11, 43, 64, 0.3);
            transform: scale(1.08);
        }
        .glass-pill.active i {
            color: #2DD4BF;
        }

        /* Lightbox Info Panel */
        .glass-modal {
            background: rgba(11, 43, 64, 0.45);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
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
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="py-24 bg-white relative overflow-hidden">
        <!-- Floating background gradients -->
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-teal-300/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-[#0B2B40]/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-teal-50 border border-teal-100 px-4 py-2 rounded-2xl mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-teal-400 animate-pulse"></span>
                    <span class="text-xs font-bold text-teal-600 uppercase tracking-widest">Dokumentasi Nyata</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-6 text-[#0B2B40]">Galeri Kasus <span class="text-gradient-teal">Penanganan Medis</span></h2>
                <p class="text-slate-500 max-w-3xl mx-auto leading-relaxed font-medium text-lg">
                    Lihat puluhan kasus nyata penanganan medis ikan hias oleh teknisi spesialis kami. 
                    Dari diagnosis hingga kesembuhan, semua terdokumentasi dengan standar profesional tertinggi.
                </p>
            </div>

            <!-- Filter Controls - Enhanced Layout -->
            <div class="flex flex-wrap justify-center gap-3 mb-16" data-aos="fade-up" data-aos-delay="100">
                <button class="filter-btn active glass-pill px-6 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-white transition-all duration-300 hover:scale-105" data-filter="all">
                    <i class="fa-solid fa-th me-2"></i>Semua Kasus
                </button>
                <button class="filter-btn glass-pill px-6 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-white transition-all duration-300 hover:scale-105" data-filter="koi">
                    <i class="fa-solid fa-fish me-2"></i>Koi
                </button>
                <button class="filter-btn glass-pill px-6 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-white transition-all duration-300 hover:scale-105" data-filter="arwana">
                    <i class="fa-solid fa-fish me-2"></i>Arwana
                </button>
                <button class="filter-btn glass-pill px-6 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-white transition-all duration-300 hover:scale-105" data-filter="maskoki">
                    <i class="fa-solid fa-fish me-2"></i>Maskoki
                </button>
                <button class="filter-btn glass-pill px-6 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-white transition-all duration-300 hover:scale-105" data-filter="tindakan">
                    <i class="fa-solid fa-stethoscope me-2"></i>Tindakan Medis
                </button>
            </div>

            <!-- 3D Gallery Viewport -->
            <div class="relative w-full overflow-hidden py-10 px-2 flex flex-col items-center select-none" data-aos="fade-up" data-aos-delay="200">
                <!-- 3D Perspective Container -->
                <div class="relative w-full max-w-5xl h-[460px] sm:h-[500px] flex items-center justify-center perspective-container overflow-visible">
                    
                    <!-- Navigation Buttons -->
                    <button id="gallery-prev" class="absolute left-2 sm:left-6 z-40 w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-900/65 hover:bg-slate-900/90 text-white flex items-center justify-center border border-white/10 shadow-lg hover:shadow-teal-500/20 backdrop-blur-md transition-all focus:outline-none hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-chevron-left text-lg sm:text-xl"></i>
                    </button>
                    
                    <!-- Gallery 3D Track -->
                    <div id="gallery-track" class="relative w-full h-full flex items-center justify-center preserve-3d">
                        <!-- Cards will be dynamically generated by JS -->
                    </div>

                    <button id="gallery-next" class="absolute right-2 sm:right-6 z-40 w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-900/65 hover:bg-slate-900/90 text-white flex items-center justify-center border border-white/10 shadow-lg hover:shadow-teal-500/20 backdrop-blur-md transition-all focus:outline-none hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-chevron-right text-lg sm:text-xl"></i>
                    </button>
                </div>
                
                <!-- Dots Indicator -->
                <div id="gallery-dots" class="flex items-center justify-center gap-2.5 mt-8">
                    <!-- Dots will be dynamically generated by JS -->
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[100] glass-modal opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-4">
        <!-- Close button overlay -->
        <div class="absolute inset-0 cursor-pointer" id="lightbox-overlay"></div>
        
        <!-- Modal content -->
        <div class="relative z-10 w-full max-w-5xl bg-white/95 backdrop-blur-md rounded-[32px] overflow-hidden border border-white/20 shadow-2xl flex flex-col md:flex-row transform scale-95 transition-all duration-300 max-h-[90vh] md:max-h-[80vh]">
            
            <!-- Close Button -->
            <button id="close-lightbox" class="absolute top-4 right-4 md:top-6 md:right-6 w-11 h-11 rounded-full bg-black/10 hover:bg-black/20 text-slate-700 md:text-white md:bg-white/10 md:hover:bg-white/20 flex items-center justify-center transition-all z-20 focus:outline-none">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Image Panel -->
            <div class="relative w-full md:w-3/5 bg-slate-950 flex items-center justify-center overflow-hidden min-h-[250px] md:min-h-0">
                <img id="lightbox-img" src="" alt="" class="w-full h-full object-cover transition-opacity duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent pointer-events-none"></div>
                
                <!-- Navigations on Image -->
                <button id="prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all focus:outline-none border border-white/10">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button id="next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all focus:outline-none border border-white/10">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <!-- Details Panel -->
            <div class="w-full md:w-2/5 p-6 md:p-10 flex flex-col justify-between overflow-y-auto bg-gradient-to-b from-white to-slate-50">
                <div>
                    <span id="lightbox-badge" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-teal-50 to-teal-100 text-teal-700 border border-teal-200 mb-4"></span>
                    <h3 id="lightbox-title" class="text-xl md:text-2xl font-black text-[#0B2B40] mb-8 leading-tight"></h3>
                    
                    <div class="space-y-8">
                        <!-- Symptom -->
                        <div class="flex gap-4 pb-6 border-b border-slate-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-50 rounded-xl flex items-center justify-center text-amber-600 text-lg flex-shrink-0 shadow-sm">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Gejala & Diagnosis</h5>
                                <p id="lightbox-symptoms" class="text-sm font-medium text-slate-700 leading-relaxed"></p>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="flex gap-4 pb-6 border-b border-slate-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-lg flex-shrink-0 shadow-sm">
                                <i class="fa-solid fa-flask-vial"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Protokol Tindakan</h5>
                                <p id="lightbox-actions" class="text-sm font-medium text-slate-700 leading-relaxed"></p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg flex-shrink-0 shadow-sm">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Hasil Akhir</h5>
                                <p id="lightbox-status" class="text-sm font-bold text-emerald-600"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-200 space-y-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Percayakan kesehatan ikan Anda kepada spesialis</p>
                    <a href="{{ route('login') }}" class="block w-full btn-teal px-6 py-3 rounded-2xl text-center text-sm font-bold transition-all hover:shadow-lg">
                        <i class="fa-solid fa-calendar-check me-2"></i>Pesan Konsultasi Sekarang
                    </a>
                </div>
            </div>

        </div>
    </div>

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
                <a href="https://www.instagram.com/ryze1112/?utm_source=ig_web_button_share_sheet" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-instagram text-xl"></i></a>
                <a href="#" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-facebook text-xl"></i></a>
                <a href="https://www.tiktok.com/@sheesss_22?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-[#0B2B40] transition-colors"><i class="fa-brands fa-tiktok text-xl"></i></a>
                <a href="https://wa.me/6281319219038" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-[#25D366] transition-colors"><i class="fa-brands fa-whatsapp text-xl"></i></a>
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

        // Gallery Data - Using Local Assets
        const galleryData = [
            {
                id: 1,
                category: 'arwana',
                type: 'diagnosis',
                title: 'Operasi Mata Cloud Eye Arwana Super Red',
                symptoms: 'Mata berselaput putih keruh, nafsu makan menurun drastis, ikan cenderung diam di dasar aquarium.',
                actions: 'Pembersihan membran selaput steril, pemberian injeksi antibiotik intra-muskular, dan treatment karantina air khusus.',
                status: 'Sembuh Total (100% Clear)',
                icon: 'fa-eye',
                badge: 'Arwana Premium',
                img: '{{ asset("assets/images/Cloude eyes Arwana SR.png") }}',
                glowClass: 'glow-arwana',
                floatAnim: 'float-anim-1',
                bgcolor: 'from-red-500/20 to-red-600/10'
            },
            {
                id: 2,
                category: 'koi',
                type: 'parasit',
                title: 'Penanganan Kutu Jangkar (Lernaea) Koi Showa',
                symptoms: 'Kutu berbentuk jangkar menempel pada sirip dorsal, luka kemerahan akibat iritasi sekunder, ikan sering menggesekkan badan ke dinding kolam.',
                actions: 'Pencabutan parasit manual secara steril, desinfeksi luka dengan betadine & antiseptik topikal, dan treatment obat kutu (dimilin) dosis terukur pada kolam karantina.',
                status: 'Sembuh & Sirip Tumbuh Sempurna',
                icon: 'fa-bug',
                badge: 'Koi Championship',
                img: '{{ asset("assets/images/Penanganan Kutu Jangkar (Lernaea) Koi Showa.png") }}',
                glowClass: 'glow-koi',
                floatAnim: 'float-anim-2',
                bgcolor: 'from-orange-500/20 to-orange-600/10'
            },
            {
                id: 3,
                category: 'maskoki',
                type: 'therapy',
                title: 'Terapi Swim Bladder Disorder Maskoki Oranda',
                symptoms: 'Ikan kehilangan keseimbangan, berenang terbalik atau miring, perut terlihat kembung di satu sisi.',
                actions: 'Terapi akupuntur akupresur ikan khusus, puasa 3 hari dilanjutkan diet kacang polong rebus kupas, dan penurunan level air karantina dengan tambahan heater ke 30°C.',
                status: 'Kembali Seimbang & Aktif',
                icon: 'fa-water',
                badge: 'Maskoki Fancy',
                img: '{{ asset("assets/images/Terapi Swim Bladder Disorder Maskoki Oranda.png") }}',
                glowClass: 'glow-maskoki',
                floatAnim: 'float-anim-3',
                bgcolor: 'from-yellow-500/20 to-yellow-600/10'
            },
            {
                id: 4,
                category: 'tindakan',
                type: 'system',
                title: 'Instalasi Ultraviolet & Sterilisasi Bakteri Kolam',
                symptoms: 'Air kolam berwarna hijau pekat (algae bloom) dengan tingkat amonia tinggi yang mengancam kehidupan ikan.',
                actions: 'Pembongkaran media filtrasi mekanis dan biologi, pemasangan lampu ultraviolet (UV-C) berkapasitas 45 Watt, dan inokulasi bakteri starter pengurai amonia.',
                status: 'Air Jernih Kristal (Crystal Clear)',
                icon: 'fa-droplet',
                badge: 'Water Treatment Pro',
                img: '{{ asset("assets/images/Instalasi Ultraviolet & Sterilisasi Bakteri Kolam.png") }}',
                glowClass: 'glow-tindakan',
                floatAnim: 'float-anim-4',
                bgcolor: 'from-blue-500/20 to-blue-600/10'
            },
            {
                id: 5,
                category: 'koi',
                type: 'infection',
                title: 'Pengobatan Infeksi Aeromonas Koi Kohaku',
                symptoms: 'Luka borok (ulcer) kemerahan terbuka pada tubuh bagian samping, sisik mulai terkelupas, ikan lesu dan menyendiri.',
                actions: 'Pemberian obat perendam antibiotik berspektrum luas (Elbayou/Amoxicillin), kompres topikal hidrogen peroksida pada borok, serta peningkatan kadar oksigen terlarut kolam.',
                status: 'Borok Menutup & Sisik Tumbuh Baru',
                icon: 'fa-flask-vial',
                badge: 'Koi Premium',
                img: '{{ asset("assets/images/Pengobatan Infeksi Aeromonas Koi Kohaku.png") }}',
                glowClass: 'glow-koi',
                floatAnim: 'float-anim-5',
                bgcolor: 'from-pink-500/20 to-pink-600/10'
            },
            {
                id: 6,
                category: 'tindakan',
                type: 'diagnosis',
                title: 'Pemeriksaan Mikroskopis & Diagnosa Parasit Kulit',
                symptoms: 'Ikan koi memproduksi lendir berlebih (mucus) secara abnormal, permukaan tubuh terlihat kusam keabu-abuan.',
                actions: 'Kerokan kulit (skin scraping) tipis pada area berlendir, pemeriksaan mikroskopis mendeteksi parasit monogenea Gyrodactylus, dan treatment garam fisiologis 5 ppt disertai formalin.',
                status: 'Parasit Mati & Lendir Kembali Normal',
                icon: 'fa-microscope',
                badge: 'Lab Diagnosis',
                img: '{{ asset("assets/images/Pemeriksaan Mikroskopis & Diagnosa Parasit Kulit.png") }}',
                glowClass: 'glow-tindakan',
                floatAnim: 'float-anim-6',
                bgcolor: 'from-violet-500/20 to-violet-600/10'
            }
        ];

        let activeFilter = 'all';
        let currentIndex = 0;
        let filteredItems = [...galleryData];

        // 3D Parallax Tilt Logic
        // --- Lerp-based smooth tilt system ---
        const tiltState = new WeakMap(); // Per-card tilt targets
        let tiltRafId = null;

        function lerp(a, b, t) { return a + (b - a) * t; }

        function tiltLoop() {
            let anyActive = false;
            document.querySelectorAll('.gallery-3d-card').forEach(card => {
                const state = tiltState.get(card);
                if (!state) return;
                const wrapper = card.querySelector('.card-float-wrapper');
                if (!wrapper) return;

                // Smoothly interpolate current rotation toward target
                state.curX = lerp(state.curX, state.targetX, 0.09);
                state.curY = lerp(state.curY, state.targetY, 0.09);
                state.curS = lerp(state.curS, state.targetS, 0.09);

                const dx = Math.abs(state.curX - state.targetX);
                const dy = Math.abs(state.curY - state.targetY);

                // Disable CSS transition while lerp is running for butter-smooth tracking
                wrapper.style.transition = 'none';
                wrapper.style.transform = `rotateX(${state.curX}deg) rotateY(${state.curY}deg) scale(${state.curS})`;

                if (dx > 0.01 || dy > 0.01) anyActive = true;
            });

            tiltRafId = requestAnimationFrame(tiltLoop);
        }

        function startTiltLoop() {
            if (!tiltRafId) tiltRafId = requestAnimationFrame(tiltLoop);
        }

        function initTilt(cardEl) {
            tiltState.set(cardEl, { targetX: 0, targetY: 0, targetS: 1, curX: 0, curY: 0, curS: 1 });

            cardEl.addEventListener('mousemove', function(e) {
                if (!this.classList.contains('active-card')) return;
                const state = tiltState.get(this);
                if (!state) return;

                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const w = rect.width;
                const h = rect.height;

                const maxTilt = 10; // Reduced for subtlety
                state.targetY = ((x - w / 2) / (w / 2)) * maxTilt;
                state.targetX = -((y - h / 2) / (h / 2)) * maxTilt;
                state.targetS = 1.04;

                const wrapper = this.querySelector('.card-float-wrapper');
                if (wrapper) wrapper.style.animation = 'none'; // Pause float anim while tilting
            });

            cardEl.addEventListener('mouseleave', function() {
                const state = tiltState.get(this);
                if (state) {
                    state.targetX = 0;
                    state.targetY = 0;
                    state.targetS = 1;
                }
                // Re-enable CSS transition for snap-back and restore float anim after settle
                const wrapper = this.querySelector('.card-float-wrapper');
                if (wrapper) {
                    setTimeout(() => {
                        wrapper.style.transition = '';
                        if (this.classList.contains('active-card')) {
                            wrapper.style.animation = '';
                        }
                    }, 350);
                }
            });
        }

        startTiltLoop();

        // Render Gallery Items - 3D Perspective Coverflow
        function renderGallery() {
            const track = document.getElementById('gallery-track');
            const dotsContainer = document.getElementById('gallery-dots');
            if (!track) return;
            
            track.innerHTML = '';
            if (dotsContainer) dotsContainer.innerHTML = '';

            if (filteredItems.length === 0) {
                track.innerHTML = `
                    <div class="text-slate-400 font-medium text-center py-20">
                        <i class="fa-solid fa-folder-open text-5xl mb-4 block text-slate-300"></i>
                        Tidak ada dokumentasi kasus
                    </div>`;
                return;
            }

            if (currentIndex >= filteredItems.length) {
                currentIndex = 0;
            }

            filteredItems.forEach((item, index) => {
                const card = document.createElement('div');
                card.className = `gallery-3d-card preserve-3d ${item.glowClass}`;
                card.setAttribute('data-id', item.id);
                card.setAttribute('data-index', index);
                
                card.innerHTML = `
                    <div class="card-float-wrapper ${item.floatAnim}">
                        <div class="card-content-wrap w-full h-full relative">
                            <!-- Image Layer -->
                            <img src="${item.img}" alt="${item.title}" class="w-full h-full object-cover transition-transform duration-700 select-none pointer-events-none">
                            
                            <!-- Neon Color Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t ${item.bgcolor} opacity-40 mix-blend-overlay transition-opacity duration-300 pointer-events-none"></div>
                            
                            <!-- Dark Vignette Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/30 to-transparent opacity-85 transition-opacity duration-300 pointer-events-none"></div>
                            
                            <!-- Badge and Category -->
                            <div class="absolute top-4 left-4 right-4 z-20 flex items-start justify-between pointer-events-none">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center text-white text-sm border border-white/20">
                                        <i class="fa-solid ${item.icon}"></i>
                                    </div>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md text-white border border-white/15">
                                        ${item.badge}
                                    </span>
                                </div>
                            </div>

                            <!-- Text Details Overlay -->
                            <div class="absolute bottom-0 inset-x-0 p-6 z-20 space-y-2 pointer-events-none">
                                <div class="flex items-center gap-2">
                                    <span class="flex h-2 w-2 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                    <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest">${item.status}</p>
                                </div>
                                <h4 class="text-sm sm:text-base font-bold text-white leading-snug line-clamp-2">${item.title}</h4>
                            </div>
                        </div>
                    </div>
                `;
                
                card.addEventListener('click', (e) => {
                    const idx = parseInt(card.getAttribute('data-index'), 10);
                    if (idx === currentIndex) {
                        openLightbox(item.id);
                    } else {
                        currentIndex = idx;
                        updateGalleryTransforms();
                    }
                });

                track.appendChild(card);
                initTilt(card);

                // Re-create dots
                if (dotsContainer) {
                    const dot = document.createElement('div');
                    dot.className = `gallery-dot ${index === currentIndex ? 'active' : ''}`;
                    dot.addEventListener('click', () => {
                        currentIndex = index;
                        updateGalleryTransforms();
                    });
                    dotsContainer.appendChild(dot);
                }
            });

            updateGalleryTransforms();
        }

        // Apply 3D coordinates transformations based on currentIndex
        function updateGalleryTransforms() {
            const cards = document.querySelectorAll('.gallery-3d-card');
            const dots = document.querySelectorAll('.gallery-dot');
            const total = filteredItems.length;

            if (total === 0) return;

            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });

            const isMobile = window.innerWidth < 640;

            cards.forEach((card) => {
                const idx = parseInt(card.getAttribute('data-index'), 10);
                let diff = idx - currentIndex;

                // Handle circular carousel wrap
                if (total > 2) {
                    if (diff > total / 2) diff -= total;
                    else if (diff < -total / 2) diff += total;
                }

                card.classList.remove('active-card');

                if (diff === 0) {
                    // Active Card
                    card.classList.add('active-card');
                    card.style.transform = `translate3d(0, 0, 120px) rotateY(0deg) scale(1)`;
                    card.style.zIndex = '30';
                    card.style.opacity = '1';
                    card.style.pointerEvents = 'auto';
                } else if (diff === 1) {
                    // Right Card
                    const xOffset = isMobile ? 120 : 250;
                    const yRot = isMobile ? -20 : -35;
                    const scaleVal = isMobile ? 0.76 : 0.82;
                    card.style.transform = `translate3d(${xOffset}px, 0, -50px) rotateY(${yRot}deg) scale(${scaleVal})`;
                    card.style.zIndex = '20';
                    card.style.opacity = '0.7';
                    card.style.pointerEvents = 'auto';
                } else if (diff === -1) {
                    // Left Card
                    const xOffset = isMobile ? -120 : -250;
                    const yRot = isMobile ? 20 : 35;
                    const scaleVal = isMobile ? 0.76 : 0.82;
                    card.style.transform = `translate3d(${xOffset}px, 0, -50px) rotateY(${yRot}deg) scale(${scaleVal})`;
                    card.style.zIndex = '20';
                    card.style.opacity = '0.7';
                    card.style.pointerEvents = 'auto';
                } else if (diff === 2) {
                    // Far Right
                    const xOffset = isMobile ? 200 : 420;
                    const yRot = isMobile ? -30 : -45;
                    const scaleVal = isMobile ? 0.55 : 0.65;
                    card.style.transform = `translate3d(${xOffset}px, 0, -120px) rotateY(${yRot}deg) scale(${scaleVal})`;
                    card.style.zIndex = '10';
                    card.style.opacity = isMobile ? '0' : '0.35';
                    card.style.pointerEvents = isMobile ? 'none' : 'auto';
                } else if (diff === -2) {
                    // Far Left
                    const xOffset = isMobile ? -200 : -420;
                    const yRot = isMobile ? 30 : 45;
                    const scaleVal = isMobile ? 0.55 : 0.65;
                    card.style.transform = `translate3d(${xOffset}px, 0, -120px) rotateY(${yRot}deg) scale(${scaleVal})`;
                    card.style.zIndex = '10';
                    card.style.opacity = isMobile ? '0' : '0.35';
                    card.style.pointerEvents = isMobile ? 'none' : 'auto';
                } else {
                    // Fully hidden outer card
                    card.style.transform = `translate3d(0, 0, -400px) scale(0)`;
                    card.style.zIndex = '0';
                    card.style.opacity = '0';
                    card.style.pointerEvents = 'none';
                }
            });
        }

        // Swipe & Drag Controls
        let startX = 0;
        let isDragging = false;
        const dragThreshold = 55;

        function initSwipeControls() {
            const track = document.getElementById('gallery-track');
            if (!track) return;

            // Mouse Drag
            track.addEventListener('mousedown', (e) => {
                if (e.target.closest('a') || e.target.closest('button')) return;
                startX = e.clientX;
                isDragging = true;
            });

            track.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                const diffX = e.clientX - startX;

                if (Math.abs(diffX) > dragThreshold) {
                    if (diffX > 0) {
                        showPrevCard();
                    } else {
                        showNextCard();
                    }
                    isDragging = false;
                }
            });

            window.addEventListener('mouseup', () => {
                isDragging = false;
            });

            // Mobile Touch Events
            track.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
            }, { passive: true });

            track.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const diffX = e.touches[0].clientX - startX;

                if (Math.abs(diffX) > dragThreshold) {
                    if (diffX > 0) {
                        showPrevCard();
                    } else {
                        showNextCard();
                    }
                    isDragging = false;
                }
            }, { passive: true });

            track.addEventListener('touchend', () => {
                isDragging = false;
            });
        }

        function showNextCard() {
            if (filteredItems.length === 0) return;
            currentIndex = (currentIndex + 1) % filteredItems.length;
            updateGalleryTransforms();
        }

        function showPrevCard() {
            if (filteredItems.length === 0) return;
            currentIndex = (currentIndex - 1 + filteredItems.length) % filteredItems.length;
            updateGalleryTransforms();
        }

        // Attach Nav & Resize Listeners
        document.getElementById('gallery-prev')?.addEventListener('click', showPrevCard);
        document.getElementById('gallery-next')?.addEventListener('click', showNextCard);
        window.addEventListener('resize', updateGalleryTransforms);

        // Filtering Logic - Enhanced
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.transform = 'scale(1)';
                });
                this.classList.add('active');
                this.style.transform = 'scale(1.08)';
                
                activeFilter = this.getAttribute('data-filter');
                filteredItems = galleryData.filter(item => activeFilter === 'all' || item.category === activeFilter);
                
                currentIndex = 0; // Reset index to first item on filter change
                renderGallery();
            });
        });

        // Lightbox Logic
        const lightbox = document.getElementById('gallery-lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxBadge = document.getElementById('lightbox-badge');
        const lightboxTitle = document.getElementById('lightbox-title');
        const lightboxSymptoms = document.getElementById('lightbox-symptoms');
        const lightboxActions = document.getElementById('lightbox-actions');
        const lightboxStatus = document.getElementById('lightbox-status');
        
        function openLightbox(itemId) {
            currentIndex = filteredItems.findIndex(item => item.id === itemId);
            if (currentIndex === -1) return;
            
            updateLightboxContent();
            
            lightbox.classList.remove('opacity-0', 'pointer-events-none');
            lightbox.querySelector('.relative').classList.remove('scale-95');
            lightbox.querySelector('.relative').classList.add('scale-100');
            document.body.style.overflow = 'hidden'; // Lock screen scroll
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0', 'pointer-events-none');
            lightbox.querySelector('.relative').classList.remove('scale-100');
            lightbox.querySelector('.relative').classList.add('scale-95');
            document.body.style.overflow = ''; // Restore scroll
        }

        function updateLightboxContent() {
            const item = filteredItems[currentIndex];
            if (!item) return;
            
            lightboxImg.style.opacity = '0';
            setTimeout(() => {
                lightboxImg.src = item.img;
                lightboxImg.alt = item.title;
                lightboxImg.style.opacity = '1';
            }, 150);
            
            lightboxBadge.innerHTML = `<i class="fa-solid ${item.icon} me-1.5"></i>${item.badge}`;
            lightboxBadge.className = 'inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-teal-50 to-teal-100 text-teal-700 border border-teal-200 mb-4';
            
            lightboxTitle.textContent = item.title;
            lightboxSymptoms.textContent = item.symptoms;
            lightboxActions.textContent = item.actions;
            lightboxStatus.innerHTML = `<span class="inline-flex items-center gap-2"><i class="fa-solid fa-check-circle"></i>${item.status}</span>`;
        }

        function showNext() {
            if (filteredItems.length === 0) return;
            currentIndex = (currentIndex + 1) % filteredItems.length;
            updateLightboxContent();
            updateGalleryTransforms(); // Update the carousel behind the lightbox
        }

        function showPrev() {
            if (filteredItems.length === 0) return;
            currentIndex = (currentIndex - 1 + filteredItems.length) % filteredItems.length;
            updateLightboxContent();
            updateGalleryTransforms(); // Update the carousel behind the lightbox
        }

        // Event Listeners for Lightbox
        document.getElementById('close-lightbox')?.addEventListener('click', closeLightbox);
        document.getElementById('lightbox-overlay')?.addEventListener('click', closeLightbox);
        document.getElementById('next-btn')?.addEventListener('click', showNext);
        document.getElementById('prev-btn')?.addEventListener('click', showPrev);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('pointer-events-none')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        });

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
            renderGallery();
            initSwipeControls();
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
