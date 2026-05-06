<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Klinik Ikan Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0B2B40 0%, #144B5E 50%, #1B6B82 100%);
            position: relative;
            overflow-x: hidden;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" opacity="0.05"><path fill="white" d="M500,100 Q600,200 700,150 Q800,100 850,200 Q900,300 800,400 Q700,500 600,450 Q500,400 400,450 Q300,500 200,400 Q100,300 150,200 Q200,100 300,150 Q400,200 500,100 Z"/><circle cx="250" cy="250" r="30"/><circle cx="750" cy="350" r="45"/><circle cx="500" cy="700" r="50"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
        }

        .premium-fish {
            position: absolute;
            pointer-events: none;
            z-index: 1;
            opacity: 0.35;
            transition: opacity 0.5s ease;
        }

        .premium-fish:hover {
            opacity: 0.6;
        }

        .fish-koi {
            top: 20%;
            right: -120px;
            width: 100px;
            animation: swimKoiRight 30s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        .fish-arowana {
            bottom: 15%;
            left: -140px;
            width: 110px;
            animation: swimArowanaLeft 35s cubic-bezier(0.4, 0, 0.2, 1) infinite 4s;
        }

        .fish-betta {
            top: 50%;
            right: -80px;
            width: 70px;
            animation: swimBettaRight 25s ease-in-out infinite 2s;
        }

        @keyframes swimKoiRight {
            0% { transform: translateX(0) translateY(0) scaleX(-1) rotate(0deg); }
            25% { transform: translateX(-35vw) translateY(-25px) scaleX(-1) rotate(4deg); }
            50% { transform: translateX(-70vw) translateY(20px) scaleX(-1) rotate(-3deg); }
            75% { transform: translateX(-105vw) translateY(-15px) scaleX(-1) rotate(3deg); }
            100% { transform: translateX(-140vw) translateY(0) scaleX(-1) rotate(0deg); }
        }

        @keyframes swimArowanaLeft {
            0% { transform: translateX(0) translateY(0) rotate(0deg); }
            25% { transform: translateX(35vw) translateY(20px) rotate(-4deg); }
            50% { transform: translateX(70vw) translateY(-25px) rotate(3deg); }
            75% { transform: translateX(105vw) translateY(15px) rotate(-3deg); }
            100% { transform: translateX(140vw) translateY(0) rotate(0deg); }
        }

        @keyframes swimBettaRight {
            0% { transform: translateX(0) translateY(0) scaleX(-1) rotate(0deg); }
            33% { transform: translateX(-30vw) translateY(-20px) scaleX(-1) rotate(3deg); }
            66% { transform: translateX(-60vw) translateY(15px) scaleX(-1) rotate(-3deg); }
            100% { transform: translateX(-90vw) translateY(0) scaleX(-1) rotate(0deg); }
        }

        .bubble-premium {
            position: absolute;
            background: linear-gradient(135deg, rgba(255,255,255,0.4), rgba(255,255,255,0.05));
            border-radius: 50%;
            pointer-events: none;
            animation: bubbleFloat 8s ease-in-out infinite;
            backdrop-filter: blur(2px);
        }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(100vh) scale(0.3);
                opacity: 0;
            }
            20% {
                opacity: 0.5;
            }
            80% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-20vh) scale(1.1);
                opacity: 0;
            }
        }

        .glass-premium {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-premium:hover {
            border-color: rgba(255, 255, 255, 0.25);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.3);
        }

        .input-premium {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            transition: all 0.3s ease;
            color: white;
        }

        .input-premium:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #2DD4BF;
            outline: none;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
        }

        .input-premium::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .btn-premium {
            background: linear-gradient(135deg, #2DD4BF 0%, #14B8A6 100%);
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-premium:hover::before {
            left: 100%;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -12px rgba(45, 212, 191, 0.3);
        }

        .benefit-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
        }

        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background: repeat-x;
            animation: waveMove 20s linear infinite;
        }

        .wave-1 {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120"><path fill="rgba(45,212,191,0.08)" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"/></svg>') repeat-x;
            background-size: 1440px 120px;
            animation-duration: 25s;
        }

        .wave-2 {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120"><path fill="rgba(20,184,166,0.05)" d="M0,96L80,90.7C160,85,320,75,480,80C640,85,800,107,960,112C1120,117,1280,107,1360,101.3L1440,96L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"/></svg>') repeat-x;
            background-size: 1440px 120px;
            animation-duration: 35s;
            opacity: 0.7;
        }

        @keyframes waveMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .text-gradient-premium {
            background: linear-gradient(135deg, #2DD4BF, #14B8A6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-dot {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .step-dot.active {
            width: 24px;
            background: #2DD4BF;
            border-radius: 4px;
        }

        /* ========== PERBAIKAN CAPTCHA SEDERHANA & PROFESIONAL ========== */
        .captcha-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            width: 100%;
        }
        
        .g-recaptcha {
            display: inline-block !important;
        }
        
        .grecaptcha-badge {
            visibility: visible !important;
            position: fixed !important;
            bottom: 15px !important;
            right: 15px !important;
            z-index: 999 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
            border-radius: 8px !important;
            opacity: 0.85 !important;
        }
        
        @media (max-width: 640px) {
            .g-recaptcha {
                transform: scale(0.92);
                transform-origin: center;
            }
            .grecaptcha-badge {
                bottom: 8px !important;
                right: 8px !important;
                transform: scale(0.9) !important;
            }
        }

        /* Removed conflicting page transition to allow loader to remain visible */
    </style>
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
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

    <div class="bg-pattern"></div>

    <!-- Premium Fish -->
    <div class="premium-fish fish-koi">
        <svg viewBox="0 0 120 70" class="w-full h-auto">
            <defs>
                <linearGradient id="koiGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#FF6B6B;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#FF8E8E;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M100,35 C100,35 112,28 112,35 C112,42 100,35 100,35 Z" fill="#FF6B6B"/>
            <ellipse cx="55" cy="35" rx="40" ry="28" fill="url(#koiGrad)"/>
            <circle cx="38" cy="28" r="5" fill="white"/>
            <circle cx="35" cy="27" r="2.5" fill="#2D3436"/>
            <path d="M94,22 L106,15 L100,28 Z" fill="#FF6B6B"/>
            <path d="M94,48 L106,55 L100,42 Z" fill="#FF6B6B"/>
        </svg>
    </div>

    <div class="premium-fish fish-arowana">
        <svg viewBox="0 0 140 80" class="w-full h-auto">
            <defs>
                <linearGradient id="arowanaGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#4A90E2;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#357ABD;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M120,40 C120,40 135,32 135,40 C135,48 120,40 120,40 Z" fill="#4A90E2"/>
            <ellipse cx="65" cy="40" rx="48" ry="32" fill="url(#arowanaGrad)"/>
            <circle cx="45" cy="32" r="6" fill="white"/>
            <circle cx="42" cy="31" r="3" fill="#2D3436"/>
            <path d="M112,25 L128,17 L120,32 Z" fill="#4A90E2"/>
            <path d="M112,55 L128,63 L120,48 Z" fill="#4A90E2"/>
        </svg>
    </div>

    <div class="premium-fish fish-betta">
        <svg viewBox="0 0 80 50" class="w-full h-auto">
            <defs>
                <linearGradient id="bettaGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#9B59B6;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#8E44AD;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M70,25 C70,25 78,20 78,25 C78,30 70,25 70,25 Z" fill="#9B59B6"/>
            <ellipse cx="38" cy="25" rx="28" ry="20" fill="url(#bettaGrad)"/>
            <circle cx="25" cy="20" r="4" fill="white"/>
            <circle cx="23" cy="19" r="2" fill="#2D3436"/>
        </svg>
    </div>

    <!-- Bubbles -->
    <div class="bubble-premium" style="width: 12px; height: 12px; left: 15%; animation-duration: 7s; animation-delay: 1s;"></div>
    <div class="bubble-premium" style="width: 20px; height: 20px; left: 35%; animation-duration: 9s; animation-delay: 0s;"></div>
    <div class="bubble-premium" style="width: 15px; height: 15px; left: 50%; animation-duration: 6s; animation-delay: 3s;"></div>
    <div class="bubble-premium" style="width: 25px; height: 25px; left: 65%; animation-duration: 8s; animation-delay: 2s;"></div>
    <div class="bubble-premium" style="width: 10px; height: 10px; left: 80%; animation-duration: 5.5s; animation-delay: 4s;"></div>

    <!-- Waves -->
    <div class="wave-container">
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-10 items-center">
            
            <!-- Left Side - Benefits Area -->
            <div class="space-y-8">
                <div class="flex items-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-28 w-auto">
                </div>

                <div class="space-y-4">
                    <h2 class="text-5xl lg:text-6xl font-bold text-white leading-tight">
                        Mulai Perjalanan
                        <span class="text-gradient-premium">Bersama Kami</span>
                    </h2>
                    <p class="text-white/70 text-lg leading-relaxed">
                        Daftar sekarang dan dapatkan akses ke layanan kesehatan ikan terbaik dengan berbagai keuntungan eksklusif.
                    </p>
                </div>

                <!-- Benefit List -->
                <div class="space-y-3">
                    <div class="benefit-card p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-teal-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold">Konsultasi 24/7 dengan Dokter Ikan</p>
                                <p class="text-white/50 text-xs">Akses chat dengan ahli kapan saja</p>
                            </div>
                        </div>
                    </div>
                    <div class="benefit-card p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-teal-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold">Diskon 20% untuk Member Baru</p>
                                <p class="text-white/50 text-xs">Promo khusus pendaftaran pertama</p>
                            </div>
                        </div>
                    </div>
                    <div class="benefit-card p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-teal-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold">E-Voucher Gratis Cek Kesehatan</p>
                                <p class="text-white/50 text-xs">Senilai Rp 150.000 untuk member baru</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badge -->
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-white/60 text-sm">4.9 Rating (500+ ulasan)</span>
                    </div>
                    <div class="w-px h-4 bg-white/20"></div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-white/60 text-sm">Terverifikasi & Terpercaya</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="glass-premium p-8 lg:p-10">
                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-400/20 to-emerald-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Buat Akun Baru</h3>
                    <p class="text-white/50 text-sm mt-1">Isi formulir di bawah untuk mendaftar</p>
                </div>

                <!-- Step Indicator -->
                <div class="flex justify-center gap-2 mb-8">
                    <div class="step-dot active"></div>
                    <div class="step-dot"></div>
                    <div class="step-dot"></div>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 rounded-2xl p-4 mb-6">
                        <div class="flex items-center gap-2 text-red-400 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4" id="register-form">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label class="block text-white/70 text-sm font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Budi Santoso"
                            class="input-premium w-full px-5 py-3.5 text-white placeholder-white/30">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-white/70 text-sm font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="budi@email.com"
                            class="input-premium w-full px-5 py-3.5 text-white placeholder-white/30">
                        <p class="text-white/30 text-xs mt-1">Kami tidak akan membagikan email Anda</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-white/70 text-sm font-semibold mb-2">Password</label>
                        <input type="password" name="password" required
                            placeholder="Minimal 8 karakter"
                            class="input-premium w-full px-5 py-3.5 text-white placeholder-white/30">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-white/70 text-sm font-semibold mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            placeholder="Ketik ulang password Anda"
                            class="input-premium w-full px-5 py-3.5 text-white placeholder-white/30">
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start gap-3 mb-4">
                        <input type="checkbox" required
                            class="mt-1 w-4 h-4 rounded border-white/20 bg-white/5 text-teal-500 focus:ring-teal-500/20">
                        <label class="text-white/60 text-xs">
                            Saya menyetujui <a href="#" class="text-teal-400 hover:text-teal-300">Syarat & Ketentuan</a> 
                            dan <a href="#" class="text-teal-400 hover:text-teal-300">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <!-- Captcha - Original tanpa kotak tambahan -->
                    <div class="captcha-wrapper">
                        {!! NoCaptcha::display() !!}
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-4">
                        <button type="submit" class="btn-premium w-full py-4 font-bold text-white uppercase tracking-wider flex items-center justify-center gap-2 shadow-xl hover:shadow-teal-500/20 mt-4">
                            <span>Daftar Akun</span>
                        </button>

                        <!-- Google Login Button -->
                        <a href="{{ route('google.login') }}" 
                           class="w-full py-4 bg-white hover:bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.01] shadow-sm font-bold text-slate-700">
                            <svg class="w-5 h-5" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                                <path fill="none" d="M0 0h48v48H0z"/>
                            </svg>
                            <span>Daftar dengan Google</span>
                        </a>
                    </div>

                    @if ($errors->has('g-recaptcha-response'))
                        <p class="text-red-400 text-xs mt-3 text-center font-semibold bg-red-400/10 py-2 rounded-lg">{{ $errors->first('g-recaptcha-response') }}</p>
                    @endif
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-transparent text-white/40 text-xs uppercase tracking-wider font-semibold">Atau</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-white/60 text-sm">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="text-teal-400 font-semibold hover:text-teal-300 transition-colors ml-1">
                            Masuk Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Force reload if page is accessed via back/forward cache
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>

    <!-- Footer -->
    <div class="relative z-10 text-center py-6">
        <p class="text-white/30 text-xs">
            © 2024 Klinik Ikan Premium. Professional Fish Healthcare Provider
        </p>
    </div>

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