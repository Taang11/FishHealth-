<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Fish Health +</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #0B2B40 0%, #144B5E 50%, #1B6B82 100%);
            padding: 40px 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        }
        
        /* Header dengan gradien */
        .email-header {
            background: linear-gradient(135deg, #0B2B40 0%, #144B5E 50%, #1B6B82 100%);
            padding: 48px 40px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(45, 212, 191, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .email-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 180px;
            height: 180px;
            background: rgba(45, 212, 191, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }
        
        /* Logo dengan Gambar */
        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }
        
        .logo-image {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-image img {
            height: 100%;
            width: auto;
            border-radius: 4px;
        }
        
        .logo-text {
            font-size: 28px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
        }
        
        .logo-text span {
            color: #2DD4BF;
        }
        
        .logo-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 4px;
            letter-spacing: 0.5px;
        }
        
        /* Header Title */
        .header-title {
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin: 20px 0 12px;
            position: relative;
            z-index: 1;
            line-height: 1.2;
        }
        
        .wave-decoration {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #2DD4BF, #14B8A6);
            margin: 16px auto 0;
            border-radius: 4px;
            position: relative;
            z-index: 1;
        }
        
        /* Konten Utama */
        .email-content {
            padding: 48px 40px;
            background: white;
        }
        
        /* Nama User */
        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #0B2B40;
            margin-bottom: 16px;
        }
        
        .greeting span {
            color: #2DD4BF;
        }
        
        /* Deskripsi */
        .description {
            color: #4A5568;
            line-height: 1.6;
            margin-bottom: 24px;
            font-size: 16px;
        }
        
        .description strong {
            color: #0B2B40;
            font-weight: 700;
        }
        
        /* Welcome Box */
        .welcome-box {
            background: linear-gradient(135deg, rgba(45, 212, 191, 0.08), rgba(20, 184, 166, 0.05));
            border: 1px solid rgba(45, 212, 191, 0.2);
            border-radius: 20px;
            padding: 24px;
            margin: 32px 0;
            text-align: center;
        }
        
        .welcome-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #2DD4BF, #14B8A6);
            border-radius: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        
        .welcome-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }
        
        .welcome-title {
            font-size: 18px;
            font-weight: 700;
            color: #0B2B40;
            margin-bottom: 8px;
        }
        
        .welcome-text {
            font-size: 14px;
            color: #718096;
        }
        
        /* Benefit Cards */
        .benefits-title {
            font-size: 18px;
            font-weight: 700;
            color: #0B2B40;
            margin: 32px 0 20px;
            text-align: center;
        }
        
        .benefits {
            background: #F7FAFC;
            border-radius: 20px;
            padding: 24px;
            margin: 0 0 32px;
        }
        
        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .benefit-item:last-child {
            margin-bottom: 0;
        }
        
        .benefit-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(45, 212, 191, 0.15), rgba(20, 184, 166, 0.1));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .benefit-icon svg {
            width: 22px;
            height: 22px;
            color: #2DD4BF;
        }
        
        .benefit-text {
            flex: 1;
        }
        
        .benefit-title {
            font-weight: 700;
            color: #0B2B40;
            font-size: 15px;
            margin-bottom: 4px;
        }
        
        .benefit-desc {
            font-size: 13px;
            color: #718096;
        }
        
        /* Button */
        .btn-wrapper {
            text-align: center;
            margin: 40px 0 32px;
        }
        
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #2DD4BF 0%, #14B8A6 100%);
            color: white;
            font-weight: 700;
            text-decoration: none;
            padding: 14px 36px;
            border-radius: 50px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -8px rgba(45, 212, 191, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -10px rgba(45, 212, 191, 0.5);
        }
        
        /* Credentials Box */
        .credentials-box {
            background: #F0F9FF;
            border-radius: 16px;
            padding: 20px;
            margin: 32px 0;
            border: 1px solid #D0F0FD;
        }
        
        .credentials-title {
            font-size: 14px;
            font-weight: 700;
            color: #0B2B40;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .credentials-title svg {
            width: 18px;
            height: 18px;
            color: #2DD4BF;
        }
        
        .credential-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #D0F0FD;
            font-size: 14px;
        }
        
        .credential-item:last-child {
            border-bottom: none;
        }
        
        .credential-label {
            color: #718096;
            font-weight: 500;
        }
        
        .credential-value {
            color: #0B2B40;
            font-weight: 600;
        }
        
        /* Support Info */
        .support-box {
            background: #FFF8F0;
            border-left: 4px solid #F59E0B;
            padding: 16px 20px;
            border-radius: 12px;
            margin: 32px 0 24px;
        }
        
        .support-box p {
            font-size: 13px;
            color: #92400E;
            margin-bottom: 8px;
        }
        
        .support-box p:last-child {
            margin-bottom: 0;
        }
        
        .support-box a {
            color: #F59E0B;
            text-decoration: none;
            font-weight: 600;
        }
        
        .support-box a:hover {
            text-decoration: underline;
        }
        
        /* Footer */
        .email-footer {
            background: #F7F9FC;
            padding: 32px 40px;
            text-align: center;
            border-top: 1px solid #E2E8F0;
        }
        
        .footer-text {
            font-size: 12px;
            color: #A0AEC0;
            line-height: 1.6;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin: 16px 0;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #E2E8F0;
            border-radius: 50%;
            color: #A0AEC0;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: #2DD4BF;
            color: white;
        }
        
        .copyright {
            font-size: 11px;
            color: #CBD5E0;
            margin-top: 16px;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-header {
                padding: 32px 24px;
            }
            .email-content {
                padding: 32px 24px;
            }
            .email-footer {
                padding: 24px;
            }
            .header-title {
                font-size: 26px;
            }
            .greeting {
                font-size: 20px;
            }
            .logo-text {
                font-size: 24px;
            }
            .logo-image {
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header dengan Gradien - Menggunakan Gambar Logo -->
        <div class="email-header">
            <div class="logo-wrapper">
                <div class="logo-image">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo.png'))) }}" alt="Fish Health Logo">
                </div>
            </div>
            <h1 class="header-title">Selamat Datang! 🐠</h1>
            <div class="wave-decoration"></div>
        </div>
        
        <!-- Konten Utama -->
        <div class="email-content">
            <div class="greeting">
                Halo, <span>{{ $user->name }}</span>!
            </div>
            
            <div class="description">
                Selamat datang di <strong>Fish Health +</strong>. Kami sangat senang Anda bergabung dengan komunitas pecinta ikan yang peduli akan kesehatan ikan kesayangan.
            </div>
            
            <div class="description">
                Akun Anda telah berhasil dibuat. Sekarang Anda dapat mulai menggunakan layanan kami untuk menjaga kesehatan ikan kesayangan Anda dengan lebih mudah dan profesional.
            </div>
            
            <!-- Welcome Box -->
            <div class="welcome-box">
                <div class="welcome-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                    </svg>
                </div>
                <div class="welcome-title">Member Premium</div>
                <div class="welcome-text">Anda sekarang adalah bagian dari keluarga Fish Health +</div>
            </div>
            
            <!-- Credentials Info -->
            <div class="credentials-box">
                <div class="credentials-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Akun Anda
                </div>
                <div class="credential-item">
                    <span class="credential-label">Nama Lengkap</span>
                    <span class="credential-value">{{ $user->name }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Email Address</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Bergabung Sejak</span>
                    <span class="credential-value">{{ date('d F Y') }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Status Member</span>
                    <span class="credential-value" style="color: #2DD4BF;">✓ Active</span>
                </div>
            </div>
            
            <!-- Benefit Cards -->
            <div class="benefits-title">
                🎁 Keuntungan Bergabung
            </div>
            <div class="benefits">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <div class="benefit-title">Konsultasi 24/7</div>
                        <div class="benefit-desc">Akses chat dengan dokter ikan berpengalaman kapan saja</div>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <div class="benefit-title">Layanan Cepat & Profesional</div>
                        <div class="benefit-desc">Tim dokter ikan siap membantu dengan respon cepat</div>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <div class="benefit-title">Promo Member Baru</div>
                        <div class="benefit-desc">Dapatkan diskon 20% untuk layanan pertama Anda</div>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <div class="benefit-title">Riwayat Kesehatan Digital</div>
                        <div class="benefit-desc">Catat dan pantau kesehatan ikan kesayangan Anda</div>
                    </div>
                </div>
            </div>
            
            <!-- Button CTA -->
            <div class="btn-wrapper">
                <a href="{{ config('app.url') }}/login" class="btn-primary">
                    Mulai Sekarang →
                </a>
            </div>
            
            <!-- Support Box -->
            <div class="support-box">
                <p>💡 <strong>Butuh bantuan?</strong></p>
                <p>Jika ada pertanyaan, jangan ragu untuk menghubungi tim support kami:</p>
                <p>📧 Email: <a href="mailto:support@fishhealth.com">support@fishhealth.com</a><br>
                💬 WhatsApp: <a href="https://wa.me/6281234567890">+62 812-3456-7890</a><br>
                📞 Hotline: <a href="tel:+62211234567">(021) 123-4567</a></p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="social-links">
                <a href="#">📘</a>
                <a href="#">📷</a>
                <a href="#">🐦</a>
                <a href="#">💬</a>
            </div>
            <div class="footer-text">
                Terima kasih telah bergabung dengan Fish Health +.<br>
                Kami berkomitmen untuk memberikan layanan terbaik bagi kesehatan ikan Anda.
            </div>
            <div class="copyright">
                © {{ date('Y') }} Fish Health +. All rights reserved.<br>
                Professional Fish Healthcare Provider
            </div>
        </div>
    </div>
</body>
</html>