@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-user-pen text-teal-500 me-3"></i>Edit Profil
        </h1>
        <p class="text-slate-500 text-sm mt-1">Perbarui informasi profil dan foto Anda</p>
    </div>
</div>

<div class="glass-premium p-8 max-w-3xl">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <!-- Photo Upload Area -->
            <div class="flex flex-col items-center gap-4 w-full md:w-1/3">
                <div class="relative group cursor-pointer" onclick="document.getElementById('avatar').click()">
                    <div class="w-40 h-40 rounded-2xl overflow-hidden border-4 border-white shadow-xl bg-slate-100 flex items-center justify-center group-hover:opacity-75 transition-opacity relative">
                        @if($user->avatar)
                            <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar) }}" alt="Avatar" class="w-full h-full object-cover" id="avatar-preview">
                        @else
                            <div class="text-6xl font-black text-slate-300" id="avatar-initial">{{ substr($user->name, 0, 1) }}</div>
                            <img src="" alt="Avatar" class="w-full h-full object-cover hidden" id="avatar-preview">
                        @endif
                        
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20">
                            <i class="fa-solid fa-camera text-3xl text-white drop-shadow-md"></i>
                        </div>
                    </div>
                    <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-widest rounded-lg mb-1">Role</span>
                    <p class="text-[#0B2B40] font-black uppercase tracking-widest">{{ $user->role }}</p>
                </div>
                @error('avatar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Form Area -->
            <div class="w-full md:w-2/3 space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-user text-slate-400"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-premium pl-11" required>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-slate-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-premium pl-11" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-100 my-6">

                <div>
                    <h3 class="text-sm font-bold text-[#0B2B40] mb-4"><i class="fa-solid fa-lock text-slate-400 me-2"></i>Ubah Password</h3>
                    <p class="text-xs text-slate-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-key text-slate-400"></i>
                        </div>
                        <input type="password" name="password" class="input-premium pl-11" placeholder="Minimal 8 karakter">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-check-double text-slate-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" class="input-premium pl-11" placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
            <button type="button" onclick="history.back()" class="btn-premium-outline">Batal</button>
            <button type="submit" class="btn-premium px-8">
                <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                document.getElementById('avatar-preview').classList.remove('hidden');
                
                var initial = document.getElementById('avatar-initial');
                if (initial) {
                    initial.classList.add('hidden');
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
