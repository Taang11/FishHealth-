@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-user text-teal-500 me-3"></i>Profil Saya
        </h1>
        <p class="text-slate-500 text-sm mt-1">Informasi detail mengenai akun Anda</p>
    </div>
    <div>
        <a href="{{ route('profile.edit') }}" class="btn-premium px-6 flex items-center gap-2">
            <i class="fa-solid fa-user-pen"></i> Edit Profil
        </a>
    </div>
</div>

<div class="glass-premium p-8 max-w-3xl">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Photo Profile -->
        <div class="flex flex-col items-center gap-4 w-full md:w-1/3">
            <div onclick="openLightbox()" class="w-40 h-40 rounded-full overflow-hidden border-4 border-white shadow-xl bg-slate-100 flex items-center justify-center relative group cursor-pointer">
                @if($user->avatar)
                    <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar) }}" alt="Avatar" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="text-6xl font-black text-slate-300 group-hover:scale-105 transition-transform duration-300">{{ substr($user->name, 0, 1) }}</div>
                @endif
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass-plus text-white opacity-0 group-hover:opacity-100 transition-opacity text-3xl drop-shadow-md"></i>
                </div>
            </div>
            <div class="text-center">
                <span class="inline-block px-3 py-1 bg-teal-50 text-teal-600 text-xs font-bold uppercase tracking-widest rounded-lg mb-1 border border-teal-100">Role</span>
                <p class="text-[#0B2B40] font-black uppercase tracking-widest text-lg">{{ $user->role }}</p>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="w-full md:w-2/3 flex flex-col justify-center space-y-6">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1"><i class="fa-regular fa-id-badge me-2"></i>Nama Lengkap</p>
                <p class="text-xl font-bold text-[#0B2B40] bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1"><i class="fa-regular fa-envelope me-2"></i>Email Address</p>
                <p class="text-lg font-semibold text-slate-700 bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">{{ $user->email }}</p>
            </div>
            
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1"><i class="fa-regular fa-calendar-check me-2"></i>Bergabung Sejak</p>
                <p class="text-sm font-semibold text-slate-600 bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">
                    {{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="profileLightbox" class="fixed inset-0 z-[9999] bg-black/95 hidden flex-col items-center justify-center transition-opacity opacity-0 duration-300">
    <div class="absolute top-4 right-4 z-10 flex gap-4">
        <button onclick="zoomOut()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-sm transition-colors" title="Zoom Out">
            <i class="fa-solid fa-minus"></i>
        </button>
        <button onclick="zoomIn()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-sm transition-colors" title="Zoom In">
            <i class="fa-solid fa-plus"></i>
        </button>
        <button onclick="closeLightbox()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-sm transition-colors" title="Tutup">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>
    
    <div class="relative w-full h-full flex items-center justify-center overflow-hidden cursor-move" id="lightboxContainer">
        @if($user->avatar)
            <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar) }}" id="lightboxImage" class="max-w-[90vw] max-h-[90vh] object-contain transition-transform duration-200 select-none shadow-2xl" style="transform: scale(1)">
        @else
            <div id="lightboxImage" class="w-64 h-64 bg-slate-800 rounded-full flex items-center justify-center text-8xl font-black text-slate-500 transition-transform duration-200 select-none shadow-2xl" style="transform: scale(1)">
                {{ substr($user->name, 0, 1) }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentScale = 1;
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;

    const lightbox = document.getElementById('profileLightbox');
    const lightboxImg = document.getElementById('lightboxImage');
    const container = document.getElementById('lightboxContainer');
    
    function openLightbox() {
        lightbox.classList.remove('hidden');
        // Small delay to allow display:block to apply before changing opacity
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden'; 
    }
    
    function closeLightbox() {
        lightbox.classList.add('opacity-0');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            // Reset zoom and position
            currentScale = 1;
            translateX = 0;
            translateY = 0;
            updateTransform();
        }, 300);
        document.body.style.overflow = '';
    }
    
    function zoomIn() {
        currentScale += 0.5;
        if (currentScale > 5) currentScale = 5;
        updateTransform();
    }
    
    function zoomOut() {
        currentScale -= 0.5;
        if (currentScale < 0.5) currentScale = 0.5;
        updateTransform();
    }
    
    function updateTransform() {
        lightboxImg.style.transform = `translate(${translateX}px, ${translateY}px) scale(${currentScale})`;
    }
    
    // Mouse wheel zoom
    container.addEventListener('wheel', (e) => {
        e.preventDefault();
        if (e.deltaY < 0) {
            zoomIn();
        } else {
            zoomOut();
        }
    });

    // Close on click outside
    container.addEventListener('click', (e) => {
        if (e.target === container) {
            closeLightbox();
        }
    });

    // Simple Dragging functionality
    lightboxImg.addEventListener('mousedown', (e) => {
        e.preventDefault();
        isDragging = true;
        startX = e.clientX - translateX;
        startY = e.clientY - translateY;
        lightboxImg.style.cursor = 'grabbing';
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        translateX = e.clientX - startX;
        translateY = e.clientY - startY;
        updateTransform();
    });

    window.addEventListener('mouseup', () => {
        isDragging = false;
        lightboxImg.style.cursor = '';
    });
</script>
@endpush
