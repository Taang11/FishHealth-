<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Implementation Demo</title>
    <style>
        body { font-family: sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background: #f4f7f6; }
        .card { background: white; padding: 2rem; border-radius: 8px; shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        .btn { display: inline-block; padding: 0.5rem 1rem; background: #0B2B40; color: white; text-decoration: none; border-radius: 4px; margin: 0.5rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Klinik Ikan Auth Demo</h1>
        <p>Halaman ini mendemonstrasikan proteksi route dan redirect otomatis.</p>
        
        @auth
            <p>Halo, <strong>{{ auth()->user()->name }}</strong>! Anda sudah login.</p>
            <a href="{{ route('dashboard') }}" class="btn">Buka Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="border:none; cursor:pointer;">Logout</button>
            </form>
        @else
            <p>Anda belum login.</p>
            <a href="{{ route('login') }}" class="btn">Login Sekarang</a>
            <a href="{{ route('register') }}" class="btn">Daftar Akun</a>
        @endauth
    </div>
</body>
</html>
