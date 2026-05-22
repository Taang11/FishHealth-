@extends('layouts.app')

@section('title', 'Edit Data Teknisi')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-user-pen text-amber-500 me-3"></i>Edit Teknisi
            </h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi profil dan wilayah tugas teknisi FishHealth+</p>
        </div>
        <a href="{{ route('teknisi.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <form action="{{ route('teknisi.update', $data->teknisi_id) }}" method="POST" id="form-teknisi">
        @csrf
        @method('PUT')

        <!-- Section 1: Account Info -->
        <div class="glass-premium p-8 mb-8 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-amber-50 rounded-full blur-3xl opacity-50"></div>
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-1.5 h-6 bg-[#0B2B40] rounded-full"></div>
                <h5 class="text-lg font-bold text-[#0B2B40]">Informasi Akun & Kontak</h5>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="input-premium @error('nama') border-red-500 @enderror" 
                           value="{{ old('nama', $data->nama) }}" required>
                    @error('nama')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Email (Login)</label>
                    <input type="email" name="email" class="input-premium @error('email') border-red-500 @enderror" 
                           value="{{ old('email', $data->user->email ?? '') }}" required>
                    @error('email')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Password <span class="text-[10px] text-slate-400 font-normal uppercase tracking-widest ms-2">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="input-premium @error('password') border-red-500 @enderror" 
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" class="input-premium @error('no_hp') border-red-500 @enderror" 
                           value="{{ old('no_hp', $data->no_hp) }}" required>
                    @error('no_hp')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold">Tipe Role</label>
                    <select name="subtype" class="input-premium @error('subtype') border-red-500 @enderror" required>
                        <option value="teknisi" {{ old('subtype', $data->subtype) == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="dokter" {{ old('subtype', $data->subtype) == 'dokter' ? 'selected' : '' }}>Dokter</option>
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
            </div>

            <!-- Hidden Address -->
            <input type="hidden" name="alamat" id="input-alamat" value="{{ $data->alamat }}">

            <div id="alamat-preview" class="p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-start gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#0B2B40] shadow-sm flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Alamat Tersimpan saat ini</p>
                    <p id="alamat-preview-text" class="text-sm text-[#0B2B40] font-bold mt-1">{{ $data->alamat ?: '(belum ada alamat)' }}</p>
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
                <span id="coord-badge" class="px-4 py-2 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 w-fit shadow-sm">
                    @if($data->lat && $data->lng)
                        <i class="fa-solid fa-check-circle"></i> Lat: {{ $data->lat }} | Lng: {{ $data->lng }}
                    @else
                        <i class="fa-solid fa-crosshairs"></i> Belum ada koordinat — Klik pada peta
                    @endif
                </span>
            </div>

            <div id="teknisi-map" class="w-full h-[400px] rounded-2xl border border-slate-200 shadow-inner z-10 mb-4"></div>

            <div class="flex flex-wrap gap-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <span class="flex items-center gap-2"><i class="fa-solid fa-hand-pointer text-blue-500"></i> Klik peta untuk pindah marker</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-up-down-left-right text-amber-500"></i> Drag marker untuk presisi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-rotate text-emerald-500"></i> Klik peta → dropdown wilayah ikut terisi</span>
            </div>

            <input type="hidden" name="lat" id="input-lat" value="{{ $data->lat }}">
            <input type="hidden" name="lng" id="input-lng" value="{{ $data->lng }}">

            <!-- Readout display (hidden but preserved for logic) -->
            <div id="coord-display" class="row mb-4" style="{{ ($data->lat && $data->lng) ? 'display:flex;gap:1rem;' : 'display:none!important;' }}">
                <div class="col-6">
                    <label class="form-label" style="font-size:0.8rem;color:#94a3b8;">Latitude</label>
                    <input type="text" id="show-lat" class="form-control form-control-sm" readonly
                           value="{{ $data->lat }}"
                           style="background:#f8fafc;font-size:0.85rem;color:#475569;">
                </div>
                <div class="col-6">
                    <label class="form-label" style="font-size:0.8rem;color:#94a3b8;">Longitude</label>
                    <input type="text" id="show-lng" class="form-control form-control-sm" readonly
                           value="{{ $data->lng }}"
                           style="background:#f8fafc;font-size:0.85rem;color:#475569;">
                </div>
            </div>
        </div>

        <div class="flex flex-col items-end gap-2 mb-12">
            <button type="submit" id="btn-submit" class="btn-premium px-12 py-4 text-lg group bg-gradient-to-r from-amber-500 to-orange-600 border-none shadow-amber-200">
                <i class="fa-solid fa-floppy-disk me-2 group-hover:scale-110 transition-transform"></i>
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Data lama dari server untuk pre-fill --}}
<script>
    const EXISTING_LAT   = {{ $data->lat  ? $data->lat  : 'null' }};
    const EXISTING_LNG   = {{ $data->lng  ? $data->lng  : 'null' }};
</script>

<script>
(function () {
    // ══ KONFIGURASI ══════════════════════════════════════════════════
    const API_BASE    = '/api/wilayah';
    const DEFAULT_LAT = -6.2088;
    const DEFAULT_LNG = 106.8456;

    // ══ STATE ═════════════════════════════════════════════════════════
    let map, marker;
    let isLocating    = false;
    let isAutoSetting = false; // Mencegah loop saat auto-fill
    let coordSet      = true;  // Di form edit biasanya sudah ada koordinat

    // ══ HELPER ════════════════════════════════════════════════════════
    function fetchJSON(url) {
        return fetch(url).then(r => { if (!r.ok) throw new Error(); return r.json(); });
    }

    function resetSelect(el, placeholder) {
        el.innerHTML = `<option value="">${placeholder}</option>`;
        el.disabled  = true;
    }

    function populateSelect(el, items, valueKey, labelKey) {
        el.innerHTML = `<option value="">— Pilih —</option>`;
        items.forEach(item => {
            const opt = document.createElement('option');
            opt.value        = item[valueKey];
            opt.textContent  = item[labelKey];
            opt.dataset.nama = item[labelKey];
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
            setTimeout(resolve, 5000); // Fail-safe
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

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`, { signal: mapGeocodeController.signal })
            .then(r => r.json())
            .then(results => {
                if (results.length > 0) {
                    const loc = results[0];
                    const lat = parseFloat(loc.lat);
                    const lon = parseFloat(loc.lon);
                    
                    let zoom = 8;
                    if (parts.length === 2) zoom = 11;
                    if (parts.length === 3) zoom = 14;
                    if (parts.length === 4) zoom = 16;
                    
                    map.flyTo([lat, lon], zoom);
                    moveMarker(lat, lon, false);
                }
            })
            .catch(err => {
                if (err.name !== 'AbortError') console.error(err);
            });
    }

    // ══ UPDATE ALAMAT ═════════════════════════════════════════════════
    function updateAlamat() {
        const prov   = document.getElementById('sel-provinsi');
        const kab    = document.getElementById('sel-kabupaten');
        const kec    = document.getElementById('sel-kecamatan');
        const kel    = document.getElementById('sel-kelurahan');
        const detail = document.getElementById('input-detail').value.trim();

        const parts = [];
        if (detail)   parts.push(detail);
        if (kel.value)  parts.push(kel.options[kel.selectedIndex]?.dataset.nama  || '');
        if (kec.value)  parts.push(kec.options[kec.selectedIndex]?.dataset.nama  || '');
        if (kab.value)  parts.push(kab.options[kab.selectedIndex]?.dataset.nama  || '');
        if (prov.value) parts.push(prov.options[prov.selectedIndex]?.dataset.nama || '');

        const alamatLengkap = parts.filter(Boolean).join(', ');
        if (alamatLengkap) {
            document.getElementById('input-alamat').value = alamatLengkap;
            document.getElementById('alamat-preview-text').textContent = alamatLengkap;
            if (!isAutoSetting) {
                focusMapToWilayah();
            }
        }
    }

    // ══ LOAD PROVINSI ═════════════════════════════════════════════════
    function loadProvinsi() {
        document.getElementById('load-provinsi').classList.remove('hidden');
        fetchJSON(`${API_BASE}/provinsi`)
            .then(data => populateSelect(
                document.getElementById('sel-provinsi'), data, 'id', 'nama'
            ))
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
            .finally(() => document.getElementById('load-kelurahan').classList.add('hidden'));
    });

    document.getElementById('sel-kelurahan').addEventListener('change', updateAlamat);
    document.getElementById('input-detail').addEventListener('input', updateAlamat);

    // ══ PIN ICON ══════════════════════════════════════════════════════
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

    // ══ SET KOORDINAT ═════════════════════════════════════════════════
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
        badge.innerHTML = `<i class="fa-solid fa-check-circle me-1"></i> Lat: ${latR} &nbsp;|&nbsp; Lng: ${lngR}`;

        if (fromMap) {
            reverseGeocode(lat, lng);
        }
    }

    // ══ REVERSE GEOCODE → AUTO DROPDOWN ══════════════════════════════
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
            const matchProv = [...selProv.options].find(o => {
                const dbNama = normalize(o.dataset.nama);
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

    // ══ MOVE MARKER ═══════════════════════════════════════════════════
    function moveMarker(lat, lng, fromMap = false) {
        if (!marker) {
            marker = L.marker([lat, lng], {
                draggable : true,
                autoPan   : true,
                icon      : makePinIcon(),
            }).addTo(map);

            marker.bindTooltip('Seret untuk ubah posisi', { direction: 'top', offset: [8, -44] });

            marker.on('dragend', () => {
                const p = marker.getLatLng();
                onLocationSet(p.lat, p.lng, true);
            });

            marker.on('drag', () => {
                const p = marker.getLatLng();
                document.getElementById('coord-badge').innerHTML =
                    `<i class="fa-solid fa-up-down-left-right me-1"></i> ${p.lat.toFixed(5)} | ${p.lng.toFixed(5)}`;
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
            alert('Browser tidak mendukung geolocation.');
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

    // ══ INIT MAP ══════════════════════════════════════════════════════
    function initAll() {
        const initLat  = EXISTING_LAT || DEFAULT_LAT;
        const initLng  = EXISTING_LNG || DEFAULT_LNG;
        const initZoom = EXISTING_LAT ? 15 : 12;

        map = L.map('teknisi-map', { zoomControl: false }).setView([initLat, initLng], initZoom);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // Pre-fill marker dari data lama jika ada koordinat
        if (EXISTING_LAT && EXISTING_LNG) {
            moveMarker(EXISTING_LAT, EXISTING_LNG, false);
            // Auto reverse geocode dari koordinat lama
            reverseGeocode(EXISTING_LAT, EXISTING_LNG);
        }

        map.on('click', e => moveMarker(e.latlng.lat, e.latlng.lng, true));

        loadProvinsi();
    }

    initAll();

})();
</script>

<style>
    .input-premium:disabled { background: #F8FAFC; color: #94A3B8; cursor: not-allowed; }
</style>
@endpush
