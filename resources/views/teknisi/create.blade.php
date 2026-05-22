@extends('layouts.app')

@section('title', 'Tambah Teknisi Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-user-plus text-teal-500 me-3"></i>Tambah Teknisi
            </h1>
            <p class="text-slate-500 text-sm mt-1">Daftarkan akun teknisi baru dan tentukan wilayah tugasnya</p>
        </div>
        <a href="{{ route('teknisi.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <form action="{{ route('teknisi.store') }}" method="POST" id="form-teknisi">
        @csrf

        <!-- Section 1: Account Info -->
        <div class="glass-premium p-8 mb-8 relative overflow-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-1.5 h-6 bg-[#0B2B40] rounded-full"></div>
                <h5 class="text-lg font-bold text-[#0B2B40]">Informasi Akun & Kontak</h5>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="input-premium @error('nama') border-red-500 @enderror" 
                           value="{{ old('nama') }}" placeholder="Masukkan nama teknisi..." required>
                    @error('nama')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Email (Login)</label>
                    <input type="email" name="email" class="input-premium @error('email') border-red-500 @enderror" 
                           value="{{ old('email') }}" placeholder="email@fishhealth.com" required>
                    @error('email')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="input-password" class="input-premium pr-12 @error('password') border-red-500 @enderror" 
                               placeholder="Minimal 8 karakter" required>
                        <button type="button" onclick="togglePassword('input-password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#0B2B40] transition-colors">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="input-password-confirm" class="input-premium pr-12" 
                               placeholder="Ulangi password" required>
                        <button type="button" onclick="togglePassword('input-password-confirm', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#0B2B40] transition-colors">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                    <p id="password-match-hint" class="text-[10px] font-bold mt-1 uppercase tracking-widest hidden"></p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" class="input-premium @error('no_hp') border-red-500 @enderror" 
                           value="{{ old('no_hp') }}" placeholder="Contoh: 62812..." required>
                    @error('no_hp')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Tipe Role</label>
                    <select name="subtype" class="input-premium @error('subtype') border-red-500 @enderror" required>
                        <option value="teknisi" {{ old('subtype') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="dokter" {{ old('subtype') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                    </select>
                    @error('subtype')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Address (Kemendagri API) -->
        <div class="glass-premium p-8 mb-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
                    <h5 class="text-lg font-bold text-[#0B2B40]">Wilayah Administratif</h5>
                </div>
                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold uppercase tracking-wider border border-blue-100">
                    Data Kemendagri API
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-2">
                    <label class="block text-slate-500 text-[10px] font-bold uppercase tracking-widest">Provinsi</label>
                    <select id="sel-provinsi" class="input-premium" required>
                        <option value="">— Pilih Provinsi —</option>
                    </select>
                    <div class="wilayah-loading hidden mt-1 text-slate-400 text-[10px]" id="load-provinsi">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>Memuat provinsi…
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-slate-500 text-[10px] font-bold uppercase tracking-widest">Kabupaten / Kota</label>
                    <select id="sel-kabupaten" class="input-premium" disabled required>
                        <option value="">— Pilih Kabupaten / Kota —</option>
                    </select>
                    <div class="wilayah-loading hidden mt-1 text-slate-400 text-[10px]" id="load-kabupaten">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>Memuat kabupaten…
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-2">
                    <label class="block text-slate-500 text-[10px] font-bold uppercase tracking-widest">Kecamatan</label>
                    <select id="sel-kecamatan" class="input-premium" disabled required>
                        <option value="">— Pilih Kecamatan —</option>
                    </select>
                    <div class="wilayah-loading hidden mt-1 text-slate-400 text-[10px]" id="load-kecamatan">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>Memuat kecamatan…
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-slate-500 text-[10px] font-bold uppercase tracking-widest">Kelurahan / Desa</label>
                    <select id="sel-kelurahan" class="input-premium" disabled required>
                        <option value="">— Pilih Kelurahan / Desa —</option>
                    </select>
                    <div class="wilayah-loading hidden mt-1 text-slate-400 text-[10px]" id="load-kelurahan">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>Memuat kelurahan…
                    </div>
                </div>
            </div>

            <div class="space-y-2 mb-6">
                <label class="block text-[#0B2B40] text-sm font-bold">Detail Alamat</label>
                <input type="text" id="input-detail" class="input-premium" placeholder="Nama jalan, nomor rumah, RT/RW (opsional)">
                <div class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">Contoh: Jl. Melati No. 12, RT 03/RW 05</div>
            </div>

            <!-- Hidden Address -->
            <input type="hidden" name="alamat" id="input-alamat">

            <div id="alamat-preview" class="hidden p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-start gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#0B2B40] shadow-sm flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Alamat Lengkap (akan disimpan)</p>
                    <p id="alamat-preview-text" class="text-sm text-[#0B2B40] font-bold mt-1"></p>
                </div>
            </div>
        </div>

        <!-- Section 3: GPS Map -->
        <div class="glass-premium p-8 mb-8 border-l-4 border-amber-500">
            <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                    <h5 class="text-lg font-bold text-[#0B2B40]">Koordinat Lokasi (GPS)</h5>
                </div>
                <button type="button" id="btn-my-location" class="btn-premium bg-gradient-to-r from-amber-500 to-orange-600 border-none shadow-amber-100 py-2 text-xs">
                    <i class="fa-solid fa-location-crosshairs me-2"></i> Gunakan Lokasi Saya
                </button>
            </div>

            <div class="mb-4">
                <span id="coord-badge" class="px-4 py-2 bg-slate-100 border border-slate-200 text-slate-500 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 w-fit">
                    <i class="fa-solid fa-crosshairs"></i> Belum ada titik dipilih — Klik pada peta
                </span>
            </div>

            <div id="teknisi-map" class="w-full h-[400px] rounded-2xl border border-slate-200 shadow-inner z-10 mb-4"></div>

            <div class="flex flex-wrap gap-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <span class="flex items-center gap-2"><i class="fa-solid fa-hand-pointer text-blue-500"></i> Klik peta untuk set titik</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-up-down-left-right text-amber-500"></i> Drag marker untuk presisi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-rotate text-emerald-500"></i> Klik peta → dropdown wilayah ikut terisi</span>
            </div>

            <input type="hidden" name="lat" id="input-lat">
            <input type="hidden" name="lng" id="input-lng">

            <!-- Readout display (hidden but preserved for logic) -->
            <div id="coord-display" class="row mb-4" style="display:none!important;">
                <div class="col-6">
                    <label class="form-label" style="font-size:0.8rem;color:#94a3b8;">Latitude</label>
                    <input type="text" id="show-lat" class="form-control form-control-sm" readonly
                           style="background:#f8fafc;font-size:0.85rem;color:#475569;">
                </div>
                <div class="col-6">
                    <label class="form-label" style="font-size:0.8rem;color:#94a3b8;">Longitude</label>
                    <input type="text" id="show-lng" class="form-control form-control-sm" readonly
                           style="background:#f8fafc;font-size:0.85rem;color:#475569;">
                </div>
            </div>
        </div>

        <div class="flex flex-col items-end gap-2 mb-12">
            <button type="submit" id="btn-submit" class="btn-premium px-12 py-4 text-lg group disabled:opacity-50 disabled:cursor-not-allowed" disabled
                    title="Pilih wilayah dan lokasi pada peta terlebih dahulu">
                <i class="fa-solid fa-floppy-disk me-2"></i>
                Simpan Data
            </button>
            <div id="hint-submit" class="text-right mt-1">
                <small class="text-slate-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-amber-500"></i>
                    Lengkapi wilayah dan pilih titik pada peta untuk mengaktifkan tombol Simpan
                </small>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
(function () {
    // ══ KONFIGURASI ══════════════════════════════════════════════════
    const API_BASE    = '/api/wilayah';
    const DEFAULT_LAT = -6.2088;
    const DEFAULT_LNG = 106.8456;

    // ══ STATE ═════════════════════════════════════════════════════════
    let map, marker;
    let isLocating      = false;
    let isAutoSetting   = false;  // Mencegah loop saat auto-fill
    let wilayahComplete = false;  // true jika kelurahan sudah dipilih
    let coordSet        = false;  // true jika koordinat sudah dipilih

    // ══ HELPER: Fetch JSON ════════════════════════════════════════════
    function fetchJSON(url) {
        return fetch(url).then(r => {
            if (!r.ok) throw new Error('Network error');
            return r.json();
        });
    }

    // ══ HELPER: Reset select ke bawah ════════════════════════════════
    function resetSelect(el, placeholder) {
        el.innerHTML = `<option value="">${placeholder}</option>`;
        el.disabled  = true;
    }

    // ══ HELPER: Populate select ═══════════════════════════════════════
    function populateSelect(el, items, valueKey, labelKey) {
        el.innerHTML = `<option value="">— Pilih —</option>`;
        items.forEach(item => {
            const opt = document.createElement('option');
            opt.value           = item[valueKey];
            opt.textContent     = item[labelKey];
            opt.dataset.nama    = item[labelKey];
            el.appendChild(opt);
        });
        el.disabled = false;
        el.dispatchEvent(new Event('options-loaded')); // Trigger custom event
    }

    // ══ HELPER: Tunggu sampai select punya opsi ════════════════════════
    function waitForOptions(el) {
        return new Promise((resolve) => {
            if (el.options.length > 1) return resolve();
            el.addEventListener('options-loaded', () => resolve(), { once: true });
            // Timeout fail-safe
            setTimeout(resolve, 5000);
        });
    }

    // ══ HELPER: Normalisasi Nama Wilayah ══════════════════════════════
    function normalize(str) {
        if (!str) return '';
        return str.toString().toUpperCase()
            .replace(/^PROVINSI\s+/i, '')
            .replace(/^KABUPATEN\s+/i, '')
            .replace(/^KOTA\s+/i, '')
            .replace(/^KECAMATAN\s+/i, '')
            .replace(/^KELURAHAN\s+/i, '')
            .replace(/^DESA\s+/i, '')
            .replace(/[^A-Z0-9]/g, '') // Hapus spasi, titik, dll
            .trim();
    }

    // ══ AUTO FOCUS MAP TO WILAYAH ═════════════════════════════════════
    let lastQuery = '';
    let mapGeocodeController = null;
    function focusMapToWilayah() {
        const prov = document.getElementById('sel-provinsi');
        const kab  = document.getElementById('sel-kabupaten');
        const kec  = document.getElementById('sel-kecamatan');
        const kel  = document.getElementById('sel-kelurahan');

        const parts = [];
        if (kel.value)  parts.push(kel.options[kel.selectedIndex].text);
        if (kec.value)  parts.push(kec.options[kec.selectedIndex].text);
        if (kab.value)  parts.push(kab.options[kab.selectedIndex].text);
        if (prov.value) parts.push(prov.options[prov.selectedIndex].text);
        
        if (parts.length === 0) return;

        const query = parts.join(', ') + ', Indonesia';
        if (query === lastQuery) return;
        lastQuery = query;

        if (mapGeocodeController) {
            mapGeocodeController.abort();
        }
        mapGeocodeController = new AbortController();

        // Cari koordinat wilayah via Nominatim (Free Geocoding)
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`, { signal: mapGeocodeController.signal })
            .then(r => r.json())
            .then(results => {
                if (results.length > 0) {
                    const loc = results[0];
                    const lat = parseFloat(loc.lat);
                    const lon = parseFloat(loc.lon);
                    
                    // Pan peta ke lokasi tersebut
                    let zoom = 8;
                    if (parts.length === 2) zoom = 11;
                    if (parts.length === 3) zoom = 14;
                    if (parts.length === 4) zoom = 16;
                    
                    map.flyTo([lat, lon], zoom);
                    
                    // Pindahkan marker otomatis ke lokasi tersebut tanpa memicu reverse geocode
                    moveMarker(lat, lon, false);
                }
            })
            .catch(err => {
                if (err.name !== 'AbortError') console.error(err);
            });
    }

    // ══ UPDATE ALAMAT PREVIEW & HIDDEN INPUT ══════════════════════════
    function updateAlamat() {
        const prov  = document.getElementById('sel-provinsi');
        const kab   = document.getElementById('sel-kabupaten');
        const kec   = document.getElementById('sel-kecamatan');
        const kel   = document.getElementById('sel-kelurahan');
        const detail = document.getElementById('input-detail').value.trim();

        const parts = [];
        if (detail)            parts.push(detail);
        if (kel.value)         parts.push(kel.options[kel.selectedIndex]?.dataset.nama || '');
        if (kec.value)         parts.push(kec.options[kec.selectedIndex]?.dataset.nama || '');
        if (kab.value)         parts.push(kab.options[kab.selectedIndex]?.dataset.nama || '');
        if (prov.value)        parts.push(prov.options[prov.selectedIndex]?.dataset.nama || '');

        const alamatLengkap = parts.filter(Boolean).join(', ');
        document.getElementById('input-alamat').value = alamatLengkap;

        // Tampilkan preview
        if (alamatLengkap) {
            document.getElementById('alamat-preview').classList.remove('hidden');
            document.getElementById('alamat-preview-text').textContent = alamatLengkap;
        } else {
            document.getElementById('alamat-preview').classList.add('hidden');
        }

        // Cek kelengkapan (minimal hingga kelurahan)
        wilayahComplete = !!(prov.value && kab.value && kec.value && kel.value);
        
        // Pindahkan fokus peta hanya jika user yang mengubah secara manual
        if (!isAutoSetting) {
            focusMapToWilayah();
        }

        checkSubmitReady();
    }

    // ══ CEK APAKAH FORM SIAP SUBMIT ═══════════════════════════════════
    function checkSubmitReady() {
        const btn  = document.getElementById('btn-submit');
        const hint = document.getElementById('hint-submit');
        if (wilayahComplete && coordSet) {
            btn.disabled = false;
            btn.removeAttribute('title');
            hint.style.display = 'none';
        } else {
            btn.disabled = true;
            hint.style.display = '';
        }
    }

    // ══ LOAD PROVINSI ═════════════════════════════════════════════════
    function loadProvinsi() {
        document.getElementById('load-provinsi').classList.remove('hidden');
        fetchJSON(`${API_BASE}/provinsi`)
            .then(data => populateSelect(
                document.getElementById('sel-provinsi'), data, 'id', 'nama'
            ))
            .catch(() => alert('Gagal memuat data provinsi. Periksa koneksi internet.'))
            .finally(() => document.getElementById('load-provinsi').classList.add('hidden'));
    }

    // ══ CASCADING EVENTS ══════════════════════════════════════════════
    document.getElementById('sel-provinsi').addEventListener('change', function () {
        resetSelect(document.getElementById('sel-kabupaten'), '— Pilih Kabupaten / Kota —');
        resetSelect(document.getElementById('sel-kecamatan'), '— Pilih Kecamatan —');
        resetSelect(document.getElementById('sel-kelurahan'), '— Pilih Kelurahan / Desa —');
        updateAlamat();
        if (!this.value) return;

        document.getElementById('load-kabupaten').classList.remove('hidden');
        fetchJSON(`${API_BASE}/kabupaten/${this.value}`)
            .then(data => populateSelect(
                document.getElementById('sel-kabupaten'), data, 'id', 'nama'
            ))
            .catch(() => alert('Gagal memuat data kabupaten.'))
            .finally(() => document.getElementById('load-kabupaten').classList.add('hidden'));
    });

    document.getElementById('sel-kabupaten').addEventListener('change', function () {
        resetSelect(document.getElementById('sel-kecamatan'), '— Pilih Kecamatan —');
        resetSelect(document.getElementById('sel-kelurahan'), '— Pilih Kelurahan / Desa —');
        updateAlamat();
        if (!this.value) return;

        document.getElementById('load-kecamatan').classList.remove('hidden');
        fetchJSON(`${API_BASE}/kecamatan/${this.value}`)
            .then(data => populateSelect(
                document.getElementById('sel-kecamatan'), data, 'id', 'nama'
            ))
            .catch(() => alert('Gagal memuat data kecamatan.'))
            .finally(() => document.getElementById('load-kecamatan').classList.add('hidden'));
    });

    document.getElementById('sel-kecamatan').addEventListener('change', function () {
        resetSelect(document.getElementById('sel-kelurahan'), '— Pilih Kelurahan / Desa —');
        updateAlamat();
        if (!this.value) return;

        document.getElementById('load-kelurahan').classList.remove('hidden');
        fetchJSON(`${API_BASE}/kelurahan/${this.value}`)
            .then(data => populateSelect(
                document.getElementById('sel-kelurahan'), data, 'id', 'nama'
            ))
            .catch(() => alert('Gagal memuat data kelurahan.'))
            .finally(() => document.getElementById('load-kelurahan').classList.add('hidden'));
    });

    document.getElementById('sel-kelurahan').addEventListener('change', updateAlamat);
    document.getElementById('input-detail').addEventListener('input', updateAlamat);

    // ══ PETA — PIN ICON ═══════════════════════════════════════════════
    function makePinIcon() {
        return L.divIcon({
            className : '',
            html      : `<div style="position:relative;width:32px;height:44px;">
                <div style="
                    position:absolute;width:32px;height:32px;
                    background:#0ea5e9;border-radius:50% 50% 50% 0;
                    transform:rotate(-45deg);transform-origin:bottom left;
                    bottom:0;left:0;
                    box-shadow:0 4px 14px rgba(14,165,233,0.5);
                    border:3px solid white;
                "></div>
                <div style="
                    position:absolute;bottom:8px;left:10px;
                    width:10px;height:10px;
                    background:white;border-radius:50%;
                "></div>
            </div>`,
            iconSize   : [32, 44],
            iconAnchor : [6, 44],
            popupAnchor: [8, -44],
        });
    }

    // ══ KOORDINAT DISET ═══════════════════════════════════════════════
    function onLocationSet(lat, lng, fromMap = false) {
        const latR = lat.toFixed(7);
        const lngR = lng.toFixed(7);

        document.getElementById('input-lat').value = latR;
        document.getElementById('input-lng').value = lngR;
        document.getElementById('show-lat').value  = latR;
        document.getElementById('show-lng').value  = lngR;
        document.getElementById('coord-display').style.display = 'flex';

        const badge = document.getElementById('coord-badge');
        badge.className = "px-4 py-2 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 w-fit shadow-sm";
        badge.innerHTML = `<i class="fa-solid fa-check-circle"></i> Lat: ${latR} | Lng: ${lngR}`;

        coordSet = true;
        checkSubmitReady();

        // Reverse geocode → coba isi dropdown wilayah otomatis jika dari map
        if (fromMap) {
            reverseGeocode(lat, lng);
        }
    }

    // ══ REVERSE GEOCODE + AUTO PILIH DROPDOWN ═════════════════════════
    async function reverseGeocode(lat, lng) {
        if (isAutoSetting) return;
        isAutoSetting = true;

        const dropdowns = ['sel-provinsi', 'sel-kabupaten', 'sel-kecamatan', 'sel-kelurahan'];
        dropdowns.forEach(id => {
            const el = document.getElementById(id);
            el.style.opacity = '0.5';
            el.style.border = '1px solid #0ea5e9';
        });

        try {
            const r = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1&accept-language=id`);
            const data = await r.json();
            if (!data || !data.address) throw new Error('No address');
            
            const addr = data.address;

            // 1. PROVINSI
            const selProv = document.getElementById('sel-provinsi');
            await waitForOptions(selProv);
            
            const nNamaProv = normalize(addr.state || addr.region || '');
            const matchProv = [...selProv.options].find(opt => {
                const dbNama = normalize(opt.dataset.nama);
                return (dbNama && nNamaProv) ? (dbNama === nNamaProv || dbNama.includes(nNamaProv) || nNamaProv.includes(dbNama)) : false;
            });

            if (matchProv) {
                selProv.value = matchProv.value;
                selProv.dispatchEvent(new Event('change'));
                
                // 2. KABUPATEN
                const selKab = document.getElementById('sel-kabupaten');
                await waitForOptions(selKab);
                const nNamaKab = normalize(addr.city || addr.county || addr.municipality || addr.city_district || '');
                
                const matchKab = [...selKab.options].find(opt => {
                    const dbNama = normalize(opt.dataset.nama);
                    return (dbNama && nNamaKab) ? (dbNama === nNamaKab || dbNama.includes(nNamaKab) || nNamaKab.includes(dbNama)) : false;
                });

                if (matchKab) {
                    selKab.value = matchKab.value;
                    selKab.dispatchEvent(new Event('change'));

                    // 3. KECAMATAN
                    const selKec = document.getElementById('sel-kecamatan');
                    await waitForOptions(selKec);
                    const nNamaKec = normalize(addr.suburb || addr.district || addr.town || addr.village || '');
                    
                    const matchKec = [...selKec.options].find(opt => {
                        const dbNama = normalize(opt.dataset.nama);
                        return (dbNama && nNamaKec) ? (dbNama === nNamaKec || dbNama.includes(nNamaKec) || nNamaKec.includes(dbNama)) : false;
                    });

                    if (matchKec) {
                        selKec.value = matchKec.value;
                        selKec.dispatchEvent(new Event('change'));

                        // 4. KELURAHAN
                        const selKel = document.getElementById('sel-kelurahan');
                        await waitForOptions(selKel);
                        const nNamaKel = normalize(addr.village || addr.suburb || addr.neighbourhood || addr.hamlet || '');
                        
                        const matchKel = [...selKel.options].find(opt => {
                            const dbNama = normalize(opt.dataset.nama);
                            return (dbNama && nNamaKel) ? (dbNama === nNamaKel || dbNama.includes(nNamaKel) || nNamaKel.includes(dbNama)) : false;
                        });

                        if (matchKel) {
                            selKel.value = matchKel.value;
                            selKel.dispatchEvent(new Event('change'));
                        }
                    }
                }
            }
        } catch (e) {
            console.error('Reverse geocode error:', e);
        } finally {
            dropdowns.forEach(id => {
                const el = document.getElementById(id);
                el.style.opacity = '1';
                el.style.border = '';
            });
            isAutoSetting = false;
            updateAlamat(); 
        }
    }

    // ══ MARKER PETA ═══════════════════════════════════════════════════
    function moveMarker(lat, lng, fromMap = false) {
        if (!marker) {
            marker = L.marker([lat, lng], {
                draggable : true,
                autoPan   : true,
                icon      : makePinIcon(),
            }).addTo(map);

            marker.bindTooltip('Seret untuk presisi lebih', {
                direction: 'top', offset: [8, -44],
            });

            marker.on('dragend', () => {
                const p = marker.getLatLng();
                onLocationSet(p.lat, p.lng, true);
            });

            marker.on('drag', () => {
                const p = marker.getLatLng();
                document.getElementById('coord-badge').innerHTML =
                    `<i class="fa-solid fa-up-down-left-right me-1"></i> Lat: ${p.lat.toFixed(5)} | Lng: ${p.lng.toFixed(5)}`;
            });
        } else {
            marker.setLatLng([lat, lng]);
        }
        if(fromMap) map.panTo([lat, lng]);
        onLocationSet(lat, lng, fromMap);
    }

    // ══ TOMBOL LOKASI SAYA ════════════════════════════════════════════
    document.getElementById('btn-my-location').addEventListener('click', function () {
        if (isLocating) return;
        isLocating = true;
        const btn  = this;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Mencari…';
        btn.disabled  = true;

        if (!navigator.geolocation) {
            alert('Browser Anda tidak mendukung geolocation.');
            resetBtn(btn); return;
        }

        navigator.geolocation.getCurrentPosition(
            pos => {
                map.setView([pos.coords.latitude, pos.coords.longitude], 16);
                moveMarker(pos.coords.latitude, pos.coords.longitude, true);
                resetBtn(btn);
            },
            () => {
                alert('Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin diberikan.');
                resetBtn(btn);
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    });

    function resetBtn(btn) {
        isLocating    = false;
        btn.disabled  = false;
        btn.innerHTML = '<i class="fa-solid fa-location-crosshairs me-1"></i> Gunakan Lokasi Saya';
    }

    // ══ INIT MAP + PROVINSI ═══════════════════════════════════════════
    function initAll() {
        // Init peta
        map = L.map('teknisi-map', { zoomControl: false }).setView([DEFAULT_LAT, DEFAULT_LNG], 12);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.control.zoom({ position: 'bottomright' }).addTo(map);

        map.on('click', e => moveMarker(e.latlng.lat, e.latlng.lng, true));

        // Auto-center ke lokasi user (silent)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                pos => map.setView([pos.coords.latitude, pos.coords.longitude], 14),
                () => {},
                { enableHighAccuracy: false, timeout: 5000, maximumAge: 60000 }
            );
        }

        // Muat provinsi dari Kemendagri API
        loadProvinsi();
    }

    // Aman: jalankan langsung jika DOM sudah siap, atau tunggu event
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

})();
</script>

<script>
    // ══ TOGGLE SHOW/HIDE PASSWORD ═════════════════════════════════════
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // ══ REALTIME PASSWORD MATCH ═══════════════════════════════════════
    document.getElementById('input-password-confirm').addEventListener('input', function () {
        const pw    = document.getElementById('input-password').value;
        const hint  = document.getElementById('password-match-hint');
        if (this.value === '') {
            hint.classList.add('hidden');
            return;
        }
        hint.classList.remove('hidden');
        if (this.value === pw) {
            hint.textContent = '✓ Password cocok';
            hint.className = 'text-[10px] font-bold mt-1 uppercase tracking-widest text-emerald-500';
        } else {
            hint.textContent = '✕ Password tidak cocok';
            hint.className = 'text-[10px] font-bold mt-1 uppercase tracking-widest text-red-500';
        }
    });
</script>

<style>
    .input-premium:disabled { background: #F8FAFC; color: #94A3B8; cursor: not-allowed; }
</style>
@endpush
