@extends('layouts.app')

@section('title', 'Buat Booking Baru')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-plus-circle text-teal-500 me-3"></i>Buat Booking Baru
            </h1>
            <p class="text-slate-500 text-sm mt-1">Jadwalkan kunjungan teknisi untuk kesehatan ikan Anda</p>
        </div>
        <a href="{{ route('booking.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    {{-- Map Section --}}
    <div class="glass-premium p-6 mb-8 border-l-4 border-teal-500">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600 shadow-sm flex-shrink-0">
                    <i class="fa-solid fa-map-location-dot text-lg"></i>
                </div>
                <div>
                    <h6 class="text-[#0B2B40] font-bold text-sm">Pilih Teknisi Terdekat</h6>
                    <p class="text-slate-400 text-[10px] uppercase tracking-widest font-bold">Gunakan peta untuk mencari teknisi</p>
                </div>
            </div>
            
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                <span id="gps-badge" class="px-3 py-1.5 bg-slate-50 border border-slate-100 rounded-full text-[10px] font-bold text-slate-500 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi Lokasi...
                </span>
                <span id="selected-teknisi-badge" class="hidden px-3 py-1.5 bg-emerald-50 border border-emerald-100 rounded-full text-[10px] font-bold text-emerald-600 flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-circle-check"></i> <span id="badge-nama"></span>
                </span>
            </div>
        </div>

        <div id="booking-map" class="w-full h-[400px] rounded-2xl border border-slate-200 shadow-inner z-10"></div>

        <div class="flex flex-wrap gap-6 mt-6 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-[#0B2B40] rounded-full shadow-sm"></div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lokasi Anda</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-amber-400 rounded-full shadow-sm"></div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Teknisi Tersedia</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-emerald-500 rounded-full shadow-sm"></div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilihan Anda</span>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="glass-premium p-8 relative overflow-hidden">
        <form action="{{ route('booking.store') }}" method="POST" id="booking-form" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Fish Name -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Nama Ikan</label>
                    <select id="ikan_nama_select" class="input-premium @error('ikan_nama') border-red-500 @enderror" onchange="syncManualInput('ikan_nama')">
                        <option value="">-- Pilih Nama Ikan --</option>
                        @foreach($master_ikan->unique('nama') as $mi)
                            <option value="{{ $mi->nama }}" {{ old('ikan_nama') == $mi->nama ? 'selected' : '' }}>{{ $mi->nama }}</option>
                        @endforeach
                        <option value="lainnya" {{ (old('ikan_nama') && !in_array(old('ikan_nama'), $master_ikan->pluck('nama')->toArray())) ? 'selected' : '' }}>Lainnya (Input Manual)</option>
                    </select>
                    <input type="text" name="ikan_nama" id="ikan_nama_hidden" value="{{ old('ikan_nama') }}" class="hidden">
                    <textarea id="ikan_nama_manual" class="input-premium mt-2 {{ (old('ikan_nama') && !in_array(old('ikan_nama'), $master_ikan->pluck('nama')->toArray())) ? '' : 'hidden' }}" rows="2" placeholder="Ketik nama ikan manual..." oninput="updateHidden('ikan_nama')">{{ old('ikan_nama') }}</textarea>
                    @error('ikan_nama')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fish Type -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Jenis Ikan</label>
                    <select id="ikan_jenis_select" class="input-premium @error('ikan_jenis') border-red-500 @enderror" onchange="syncManualInput('ikan_jenis')">
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach($master_ikan->unique('jenis') as $mi)
                            <option value="{{ $mi->jenis }}" {{ old('ikan_jenis') == $mi->jenis ? 'selected' : '' }}>{{ $mi->jenis }}</option>
                        @endforeach
                        <option value="lainnya" {{ (old('ikan_jenis') && !in_array(old('ikan_jenis'), $master_ikan->pluck('jenis')->toArray())) ? 'selected' : '' }}>Lainnya (Input Manual)</option>
                    </select>
                    <input type="text" name="ikan_jenis" id="ikan_jenis_hidden" value="{{ old('ikan_jenis') }}" class="hidden">
                    <textarea id="ikan_jenis_manual" class="input-premium mt-2 {{ (old('ikan_jenis') && !in_array(old('ikan_jenis'), $master_ikan->pluck('jenis')->toArray())) ? '' : 'hidden' }}" rows="2" placeholder="Ketik jenis ikan manual..." oninput="updateHidden('ikan_jenis')">{{ old('ikan_jenis') }}</textarea>
                    @error('ikan_jenis')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Photo Upload -->
            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Foto Ikan Bermasalah</label>
                <div class="relative group">
                    <input type="file" name="ikan_foto" id="ikan_foto" class="hidden" accept="image/*" required onchange="updateFileName(this)">
                    <label for="ikan_foto" class="flex flex-col items-center justify-center w-full py-12 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 hover:border-teal-400 transition-all shadow-sm @error('ikan_foto') border-red-500 @enderror">
                        <div id="upload-icon" class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#0B2B40] text-xl mb-4 shadow-sm">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <p id="file-name" class="text-sm font-bold text-[#0B2B40]">Pilih foto ikan dari perangkat Anda</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1">Format: JPG, PNG (Max 2MB)</p>
                    </label>
                </div>
                @error('ikan_foto')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Select Technician -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Pilih Teknisi</label>
                    <select name="teknisi_id" id="select-teknisi" class="input-premium @error('teknisi_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach($teknisi as $t)
                            <option value="{{ $t->teknisi_id }}" {{ old('teknisi_id') == $t->teknisi_id ? 'selected' : '' }}>{{ $t->nama }} ({{ ucfirst($t->subtype ?? 'teknisi') }})</option>
                        @endforeach
                    </select>
                    @error('teknisi_id')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Service -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Pilih Layanan</label>
                    <select name="layanan_id" id="select-layanan" class="input-premium @error('layanan_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanan as $l)
                            <option value="{{ $l->layanan_id }}" {{ old('layanan_id') == $l->layanan_id ? 'selected' : '' }}>{{ $l->nama_layanan }} - Rp {{ number_format($l->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <p id="layanan-filter-info" class="text-[10px] text-slate-400 mt-1.5 uppercase font-bold tracking-wider hidden"></p>
                    @error('layanan_id')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Date -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal" class="input-premium @error('tanggal') border-red-500 @enderror" value="{{ old('tanggal') }}" required min="{{ date('Y-m-d') }}">
                    @error('tanggal')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time -->
                <div class="space-y-2">
                    <label class="block text-[#0B2B40] text-sm font-bold mb-2">Jam Kunjungan</label>
                    <input type="time" name="jam" class="input-premium @error('jam') border-red-500 @enderror" value="{{ old('jam') }}" required>
                    @error('jam')
                        <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                <i class="fa-solid fa-circle-info text-[#0B2B40]"></i>
                <p class="text-xs text-slate-600 leading-relaxed font-medium">Informasi: Pastikan teknisi yang dipilih tersedia. Pesanan Anda akan dikonfirmasi segera oleh teknisi kami.</p>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="btn-premium px-12 py-4 group text-lg">
                    Konfirmasi Booking
                    <i class="fa-solid fa-chevron-right ms-2 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const teknisiData = @json($teknisi->filter(fn($t) => !is_null($t->lat) && !is_null($t->lng))->values());
    const allLayanan = @json($layanan);
    const allTeknisi = @json($teknisi);

    (function () {
        const DEFAULT_LAT  = -6.2088;
        const DEFAULT_LNG  = 106.8456;
        let map, userMarker;
        const teknisiLayers = [];

        function makeMarkerIcon(color, isBig = false) {
            const size = isBig ? 28 : 22;
            return L.divIcon({
                className: '',
                html: `<div style="width:${size}px;height:${size}px;background:${color};border-radius:50%;border:3px solid #fff;box-shadow:0 4px 10px rgba(0,0,0,0.15);cursor:pointer;transition:all 0.3s ease;"></div>`,
                iconSize: [size, size],
                iconAnchor: [size/2, size/2],
            });
        }

        window.updateFileName = function(input) {
            const fileName = input.files[0] ? input.files[0].name : 'Pilih foto ikan dari perangkat Anda';
            document.getElementById('file-name').textContent = fileName;
        };

        window.syncManualInput = function(field) {
            const select = document.getElementById(field + '_select');
            const manual = document.getElementById(field + '_manual');
            const hidden = document.getElementById(field + '_hidden');
            
            if (select.value === 'lainnya') {
                manual.classList.remove('hidden');
                manual.required = true;
                hidden.value = manual.value;
            } else {
                manual.classList.add('hidden');
                manual.required = false;
                hidden.value = select.value;
            }
        };

        window.updateHidden = function(field) {
            const select = document.getElementById(field + '_select');
            const manual = document.getElementById(field + '_manual');
            const hidden = document.getElementById(field + '_hidden');
            if (select.value === 'lainnya') {
                hidden.value = manual.value;
            }
        };

        function setGpsBadge(status, text) {
            const badge = document.getElementById('gps-badge');
            const classes = { 
                ok: 'text-emerald-700 bg-emerald-50 border-emerald-100', 
                error: 'text-red-700 bg-red-50 border-red-100', 
                loading: 'text-slate-500 bg-slate-50 border-slate-100' 
            };
            badge.className = `px-3 py-1.5 rounded-full text-[10px] font-bold flex items-center gap-2 transition-all shadow-sm ${classes[status]}`;
            badge.innerHTML = `<i class="fa-solid ${status === 'loading' ? 'fa-spinner fa-spin' : (status === 'ok' ? 'fa-location-dot' : 'fa-circle-xmark')}"></i> ${text}`;
        }

        function initMap(lat, lng, zoom) {
            map = L.map('booking-map', { zoomControl: false }).setView([lat, lng], zoom);
            
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            L.control.zoom({ position: 'bottomright' }).addTo(map);

            userMarker = L.marker([lat, lng], { 
                icon: makeMarkerIcon('#0B2B40', true),
                zIndexOffset: 1000 
            }).addTo(map).bindTooltip('Lokasi Anda', { direction: 'top', className: 'premium-tooltip' });

            teknisiData.forEach(t => {
                const marker = L.marker([t.lat, t.lng], { icon: makeMarkerIcon('#FBBF24') }).addTo(map);
                marker.on('click', () => {
                    const select = document.getElementById('select-teknisi');
                    select.value = t.teknisi_id;
                    select.dispatchEvent(new Event('change'));
                });
                teknisiLayers.push({ id: t.teknisi_id, marker, data: t });
            });

            // --- Dynamic Services Filtering by Subtype ---
            function filterLayananBySubtype(subtype) {
                const selectLayanan = document.getElementById('select-layanan');
                const infoText = document.getElementById('layanan-filter-info');
                
                selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
                
                if (infoText) {
                    infoText.classList.remove('hidden');
                    infoText.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-teal-500 me-1"></i> Memuat layanan...';
                }
                
                fetch(`/api/layanan-by-subtype?subtype=${subtype}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response not ok');
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.layanan_id;
                            option.textContent = `${item.nama_layanan} - Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}`;
                            selectLayanan.appendChild(option);
                        });
                        
                        if (infoText) {
                            const label = subtype === 'dokter' ? 'Dokter Ikan (Medis)' : 'Teknisi Kolam (Fisik)';
                            infoText.innerHTML = `<i class="fa-solid fa-filter text-teal-500 me-1"></i> Menampilkan layanan khusus <strong>${label}</strong>`;
                        }
                    })
                    .catch(err => {
                        console.warn('AJAX failed, falling back to local list:', err);
                        const filtered = allLayanan.filter(l => l.subtype === subtype);
                        filtered.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.layanan_id;
                            option.textContent = `${item.nama_layanan} - Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}`;
                            selectLayanan.appendChild(option);
                        });
                        
                        if (infoText) {
                            const label = subtype === 'dokter' ? 'Dokter Ikan (Medis)' : 'Teknisi Kolam (Fisik)';
                            infoText.innerHTML = `<i class="fa-solid fa-triangle-exclamation text-amber-500 me-1"></i> Menampilkan layanan khusus <strong>${label}</strong>`;
                        }
                    });
            }

            function resetLayananDropdown() {
                const selectLayanan = document.getElementById('select-layanan');
                const infoText = document.getElementById('layanan-filter-info');
                
                selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
                allLayanan.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.layanan_id;
                    option.textContent = `${item.nama_layanan} - Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}`;
                    selectLayanan.appendChild(option);
                });
                
                if (infoText) {
                    infoText.classList.add('hidden');
                }
            }

            document.getElementById('select-teknisi').addEventListener('change', function() {
                const val = parseInt(this.value);
                const selectedTeknisi = allTeknisi.find(t => t.teknisi_id === val);
                
                if (selectedTeknisi) {
                    filterLayananBySubtype(selectedTeknisi.subtype || 'teknisi');
                } else {
                    resetLayananDropdown();
                }
                
                teknisiLayers.forEach(obj => {
                    if (obj.id === val) {
                        obj.marker.setIcon(makeMarkerIcon('#10B981', true));
                        map.flyTo(obj.marker.getLatLng(), 15);
                        document.getElementById('selected-teknisi-badge').classList.remove('hidden');
                        document.getElementById('badge-nama').textContent = obj.data.nama + ' (' + (obj.data.subtype ? obj.data.subtype.charAt(0).toUpperCase() + obj.data.subtype.slice(1) : 'Teknisi') + ')';
                    } else {
                        obj.marker.setIcon(makeMarkerIcon('#FBBF24'));
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    pos => { initMap(pos.coords.latitude, pos.coords.longitude, 14); setGpsBadge('ok', 'Lokasi Aktif'); },
                    () => { initMap(DEFAULT_LAT, DEFAULT_LNG, 12); setGpsBadge('error', 'GPS Mati'); },
                    { timeout: 5000 }
                );
            } else {
                initMap(DEFAULT_LAT, DEFAULT_LNG, 12);
                setGpsBadge('error', 'GPS Tidak Support');
            }
            
            // Initial sync for old values
            syncManualInput('ikan_nama');
            syncManualInput('ikan_jenis');

            // Handle pre-selected technician on page load (e.g. from redirect with old inputs)
            const initialTeknisiVal = document.getElementById('select-teknisi').value;
            if (initialTeknisiVal) {
                const selectedTeknisi = allTeknisi.find(t => t.teknisi_id === parseInt(initialTeknisiVal));
                if (selectedTeknisi) {
                    const selectLayanan = document.getElementById('select-layanan');
                    const infoText = document.getElementById('layanan-filter-info');
                    const subtype = selectedTeknisi.subtype || 'teknisi';
                    
                    selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
                    const filtered = allLayanan.filter(l => l.subtype === subtype);
                    
                    const oldLayananId = "{{ old('layanan_id') }}";
                    filtered.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.layanan_id;
                        option.textContent = `${item.nama_layanan} - Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}`;
                        if (oldLayananId && parseInt(oldLayananId) == item.layanan_id) {
                            option.selected = true;
                        }
                        selectLayanan.appendChild(option);
                    });
                    
                    if (infoText) {
                        infoText.classList.remove('hidden');
                        const label = subtype === 'dokter' ? 'Dokter Ikan (Medis)' : 'Teknisi Kolam (Fisik)';
                        infoText.innerHTML = `<i class="fa-solid fa-filter text-teal-500 me-1"></i> Menampilkan layanan khusus <strong>${label}</strong>`;
                    }
                }
            } else {
                document.getElementById('select-layanan').innerHTML = '<option value="">-- Pilih Teknisi Terlebih Dahulu --</option>';
            }
        });
    })();
</script>

<style>
    .premium-tooltip { background: #0B2B40; border: none; color: white; font-weight: bold; border-radius: 6px; }
    .leaflet-container { border-radius: 16px; }
</style>
@endpush
