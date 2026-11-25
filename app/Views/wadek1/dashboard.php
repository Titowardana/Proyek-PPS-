<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Wadek 1 Dashboard (Maritime Theme Matched) -->
<div class="space-y-6 pb-12">

    <!-- 1. Top Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#eff5ff] text-[#2563eb] border border-[#dce8ff]">
                    PIMPINAN FAKULTAS
                </span>
                <span class="text-xs text-[#90a4c3] font-medium">FTTK UMRAH</span>
            </div>
            <h1 class="text-2xl sm:text-[28px] font-bold text-[#172b4d] tracking-tight">
                Welcome back, Wakil Dekan I.
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-0.5">
                Pengawasan strategis magang fakultas, pemantauan pembimbing, dan pengesahan akhir konversi MK.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Realtime Clock -->
            <div class="text-right hidden sm:block bg-white px-3.5 py-1.5 rounded-2xl border border-[#e4ebf6] shadow-sm">
                <p id="realtimeClock" class="text-xs text-[#71819d] font-medium tabular-nums">
                    <?= format_indo(date('Y-m-d H:i:s'), true) ?>
                </p>
                <p class="text-[10px] text-[#90a4c3]">Sistem Akademik Terpadu</p>
            </div>

            <!-- Action Button: Pengesahan Konversi -->
            <a href="<?= base_url('wadek1/konversi') ?>"
               class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold rounded-xl shadow-sm transition active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Pengesahan Konversi (<?= $pendingConversionCount ?? 0 ?>)</span>
            </a>
        </div>
    </div>

    <!-- 2. Program Studi Hero Banner -->
    <div class="relative w-full rounded-2xl p-6 sm:p-7 overflow-hidden text-white shadow-xl shadow-blue-950/5 bg-gradient-to-r from-[#173369] via-[#1d3f7e] to-[#234b91]">
        <!-- Decorative Ambient Watermark -->
        <div class="absolute -right-8 -bottom-10 w-72 h-72 rounded-full bg-white/[0.04] blur-2xl pointer-events-none"></div>
        <div class="absolute right-24 top-1/2 -translate-y-1/2 w-80 h-36 opacity-10 pointer-events-none hidden md:block">
            <svg viewBox="0 0 400 172" fill="none" stroke="#93c5fd" stroke-width="2" class="w-full h-full">
                <path d="M0 86 Q100 20 200 86 T400 86" />
                <path d="M0 110 Q100 44 200 110 T400 110" opacity="0.6" />
                <path d="M0 134 Q100 68 200 134 T400 134" opacity="0.3" />
            </svg>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-6 lg:gap-8">
            <!-- Left Info -->
            <div class="space-y-1 max-w-sm">
                <span class="inline-block text-[10px] font-bold tracking-wider text-[#93c5fd] uppercase">
                    FAKULTAS TEKNIK &amp; TEKNOLOGI KEMARITIMAN
                </span>
                <h2 class="text-2xl sm:text-[26px] font-bold tracking-tight text-white">
                    Wakil Dekan I (Akademik)
                </h2>
                <p class="text-xs text-[#d3e3ff]/90 font-normal">
                    Pengawasan Program Magang &amp; MBKM Fakultas
                </p>
                <p class="text-[11px] text-[#93c5fd] pt-1">
                    Semester Ganjil · TA 2026 / 2027
                </p>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block w-px h-24 bg-white/15"></div>

            <!-- Stat 1: Magang Aktif -->
            <div class="space-y-1 min-w-[140px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Magang Aktif</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $totalActive ?? 0 ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">mahasiswa fakultas</p>
            </div>

            <!-- Stat 2: Pembimbing Ditugaskan -->
            <div class="space-y-1 min-w-[140px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Ada Pembimbing</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $totalSupervisorAssigned ?? 0 ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">sudah ditetapkan Kaprodi</p>
            </div>

            <!-- Stat 3: Konversi Menunggu -->
            <div class="space-y-1 min-w-[140px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Konversi Menunggu</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $pendingConversionCount ?? 0 ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">pengesahan Wadek 1</p>
            </div>
        </div>
    </div>

    <!-- 3. Four Metric Cards (Interactive Scroll & Navigate) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1: Magang Aktif -->
        <div onclick="smoothScrollTo('section-magang-aktif')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Magang Aktif</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $totalActive ?? 0 ?></span>
                    <a href="<?= base_url('wadek1/pemantauan-magang') ?>"
                       onclick="event.stopPropagation()"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Pantau →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">Sedang menjalani magang</span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat tabel ↓
                </span>
            </div>
        </div>

        <!-- Card 2: Pembimbing Ditugaskan -->
        <a href="<?= base_url('wadek1/pemantauan-magang') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Pembimbing Ditugaskan</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-[#2563eb] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $totalSupervisorAssigned ?? 0 ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Kelola →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Ditetapkan oleh Kaprodi</span>
                <span class="text-[#2563eb] font-semibold">Buka modul →</span>
            </div>
        </a>

        <!-- Card 3: Konversi Menunggu Pengesahan -->
        <a href="<?= base_url('wadek1/konversi') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Pengesahan Konversi</span>
                    <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $pendingConversionCount ?? 0 ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Sah kan →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]"><?= ($pendingConversionCount ?? 0) > 0 ? 'Menunggu tanda tangan' : 'Semua tervalidasi' ?></span>
                <span class="text-[#2563eb] font-semibold">Review MK →</span>
            </div>
        </a>

        <!-- Card 4: Total Pendaftaran Magang -->
        <div onclick="smoothScrollTo('section-distribusi-fakultas')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Total Pengajuan</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-[#173369] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $totalAll ?? 0 ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb]">Statistik ↓</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Semua prodi fakultas</span>
                <span class="text-[#2563eb] font-semibold">Lihat rasio ↓</span>
            </div>
        </div>

    </div>

    <!-- 4. Table: Magang Aktif Terbaru -->
    <div id="section-magang-aktif" class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden scroll-mt-24 transition-all duration-300">
        <div class="p-5 border-b border-[#e4ebf6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Magang Aktif Terbaru</h3>
                <p class="text-xs text-[#71819d] mt-0.5">Daftar mahasiswa fakultas yang sedang aktif melaksanakan kegiatan magang.</p>
            </div>
            <a href="<?= base_url('wadek1/pemantauan-magang') ?>"
               class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] flex-shrink-0 inline-flex items-center gap-1">
                <span>Lihat Semua Pemantauan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <?php if (!empty($recentActiveInternships)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] tracking-wider">
                            <th class="px-5 py-3.5">Mahasiswa</th>
                            <th class="px-5 py-3.5">Program Studi</th>
                            <th class="px-5 py-3.5">Instansi Magang</th>
                            <th class="px-5 py-3.5">Dosen Pembimbing</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($recentActiveInternships as $item): 
                            $words = explode(' ', trim($item['student_name'] ?? 'M'));
                            $initials = strtoupper(substr($words[0] ?? 'M', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        ?>
                            <tr class="hover:bg-[#f7f9fc] transition">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-[#eff5ff] text-[#2563eb] font-bold text-[11px] flex items-center justify-center flex-shrink-0">
                                            <?= esc($initials) ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-[#172b4d] text-xs"><?= esc($item['student_name']) ?></div>
                                            <div class="text-[10px] text-[#90a4c3]">NIM: <?= esc($item['nim']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-700">
                                        <?= esc($item['prodi_name']) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="font-semibold text-[#172b4d]"><?= esc($item['company_name']) ?></div>
                                    <div class="text-[10px] text-[#71819d] mt-0.5"><?= esc($item['position']) ?></div>
                                </td>
                                <td class="px-5 py-3.5 text-[#172b4d] font-medium">
                                    <?= esc($item['supervisor_name'] ?: 'Belum ditentukan') ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <?= view('components/status_badge', ['status' => $item['status']]) ?>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <a href="<?= base_url('wadek1/pemantauan-magang/detail/' . $item['id']) ?>"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-[#eff5ff] hover:bg-[#dce8ff] text-[#2563eb] text-xs font-semibold transition active:scale-95">
                                        <span>Detail</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-10 text-center">
                <div class="w-12 h-12 rounded-2xl bg-[#f7f9fc] border border-[#e4ebf6] text-[#90a4c3] mx-auto flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-[#172b4d]">Belum Ada Data Magang Aktif</p>
                <p class="text-xs text-[#71819d] mt-1">Saat ini belum ada mahasiswa yang berstatus magang aktif di fakultas.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 5. Bottom Info Cards Wadek 1 (2 Kolom) -->
    <div id="section-distribusi-fakultas" class="grid grid-cols-1 lg:grid-cols-2 gap-5 scroll-mt-24">
        <!-- Card Pengesahan Akhir Konversi SKS -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Pengesahan Akhir Konversi SKS</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Penetapan Surat Keputusan / Pengesahan Nilai Konversi Mata Kuliah</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-50 text-purple-700">
                        <?= $pendingConversionCount ?? 0 ?> Menunggu
                    </span>
                </div>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Sebagai pimpinan akademik fakultas, Wakil Dekan I melakukan review final atas kesesuaian nilai yang diajukan oleh dosen pembimbing dan dosen pengampu mata kuliah sebelum diinputkan secara definitif ke sistem SIAKAD UMRAH.
                </p>
            </div>
            <div class="mt-5 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Otorisasi Akademik Fakultas</span>
                <a href="<?= base_url('wadek1/konversi') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Buka modul pengesahan konversi →
                </a>
            </div>
        </div>

        <!-- Card Tata Kelola & Rekapitulasi MBKM -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Tata Kelola &amp; Rekapitulasi MBKM</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Statistik pendaftaran dan capaian program magang seluruh prodi</p>
                    </div>
                    <span class="text-xs text-[#90a4c3]">FTTK UMRAH</span>
                </div>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Pemantauan secara berkala memastikan rasio pembimbingan dosen seimbang di seluruh program studi serta mahasiswa magang mematuhi rambu-rambu kurikulum kemaritiman.
                </p>
            </div>
            <div class="mt-5 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Monitoring Terpadu Fakultas</span>
                <a href="<?= base_url('wadek1/pemantauan-magang') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Buka pemantauan lengkap →
                </a>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
const BULAN_INDO = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

function formatIndoRealtime(d = new Date(), withSeconds = false) {
    const day = String(d.getDate()).padStart(2, '0');
    const month = BULAN_INDO[d.getMonth()];
    const year = d.getFullYear();
    const hours = String(d.getHours()).padStart(2, '0');
    const minutes = String(d.getMinutes()).padStart(2, '0');
    const seconds = String(d.getSeconds()).padStart(2, '0');
    
    if (withSeconds) {
        return `${day} ${month} ${year}, ${hours}:${minutes}:${seconds} WIB`;
    }
    return `${day} ${month} ${year}, ${hours}:${minutes} WIB`;
}

// Live ticking clock in top header
function updateRealtimeClock() {
    const clockEl = document.getElementById('realtimeClock');
    if (clockEl) {
        clockEl.textContent = formatIndoRealtime(new Date(), true);
    }
}
setInterval(updateRealtimeClock, 1000);
document.addEventListener('DOMContentLoaded', updateRealtimeClock);
updateRealtimeClock();

// Smooth scrolling to section with attention pulse
function smoothScrollTo(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;

    const yOffset = -85;
    const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });

    el.classList.remove('section-highlight');
    void el.offsetWidth; // force DOM reflow
    el.classList.add('section-highlight');

    setTimeout(() => {
        el.classList.remove('section-highlight');
    }, 2000);
}
</script>
<?= $this->endSection() ?>
