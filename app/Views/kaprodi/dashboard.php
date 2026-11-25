<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Kaprodi Dashboard (Figma Design Matched) -->
<div class="space-y-6 pb-12">

    <!-- 1. Top Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-[28px] font-bold text-[#172b4d] tracking-tight">
                Welcome back, Kaprodi.
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-1 leading-relaxed">
                Arahkan pengalaman magang. Pastikan setiap keputusan akademik tepat waktu.
            </p>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p id="realtimeClock" class="text-xs text-[#71819d] font-medium tabular-nums">
                    <?= format_indo(date('Y-m-d H:i:s'), true) ?>
                </p>
                <p class="text-[10px] text-[#90a4c3]">
                    Sistem Akademik Terpadu
                </p>
            </div>
            <button type="button" onclick="openLaporanModal()" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white hover:bg-slate-50 text-[#2563eb] text-xs font-semibold rounded-xl border border-[#e4ebf6] shadow-sm transition active:scale-95 cursor-pointer">
                <svg class="w-4 h-4 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Unduh laporan</span>
            </button>
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
                    PROGRAM STUDI
                </span>
                <h2 class="text-2xl sm:text-[26px] font-bold tracking-tight text-white">
                    <?= esc($prodi['name'] ?? 'Informatika') ?>
                </h2>
                <p class="text-xs text-[#d3e3ff]/90 font-normal">
                    Fakultas Teknik dan Teknologi Kemaritiman
                </p>
                <p class="text-[11px] text-[#93c5fd] pt-1">
                    Semester Ganjil · TA 2026 / 2027
                </p>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block w-px h-24 bg-white/15"></div>

            <!-- Stat 1: Total magang aktif -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Total magang aktif</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $activeCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">
                    <?= $assignedCount ?> sudah memiliki pembimbing
                </p>
            </div>

            <!-- Stat 2: Menunggu persetujuan -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Menunggu persetujuan</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $pendingAssignments ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">
                    <?= $pendingAssignments > 0 ? $pendingAssignments . ' prioritas hari ini' : 'Semua tertangani' ?>
                </p>
            </div>

            <!-- Stat 3: Konversi MK -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Konversi MK diajukan</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $conversionCount ?? 0 ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">dalam proses pemantauan</p>
            </div>
        </div>
    </div>

    <!-- 3. Four Metric Cards (Interactive Scroll & Navigate) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1: Menunggu Persetujuan -->
        <div onclick="smoothScrollTo('section-antrean')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Menunggu Persetujuan</span>
                    <div class="w-8 h-8 rounded-lg bg-[#eff5ff] flex items-center justify-center text-[#2563eb] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $pendingAssignments ?></span>
                    <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>"
                       onclick="event.stopPropagation()"
                       title="Buka halaman fitur penentuan pembimbing"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Buka Fitur →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">
                    <?= $pendingAssignments > 0 ? $pendingAssignments . ' pengajuan perlu ditinjau' : 'Tidak ada antrean tertunda' ?>
                </span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat tabel ↓
                </span>
            </div>
        </div>

        <!-- Card 2: Belum Ada Dosen Pembimbing -->
        <div onclick="smoothScrollTo('section-beban-dosen')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Belum Ada Pembimbing</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= max(0, $activeCount - $assignedCount) ?></span>
                    <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>"
                       onclick="event.stopPropagation()"
                       title="Buka halaman fitur penetapan pembimbing"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Tetapkan →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">
                    Dari <?= $activeCount ?> mahasiswa aktif
                </span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat beban ↓
                </span>
            </div>
        </div>

        <!-- Card 3: Konversi MK Menunggu Review -->
        <div onclick="smoothScrollTo('section-konversi')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Konversi MK Menunggu</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $conversionCount ?? 0 ?></span>
                    <a href="<?= base_url('kaprodi/konversi') ?>"
                       onclick="event.stopPropagation()"
                       title="Buka modul konversi mata kuliah"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Buka Modul →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">
                    <?= ($conversionCount ?? 0) > 0 ? $conversionCount . ' permintaan mendekati tenggat' : 'Semua tervalidasi' ?>
                </span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat review ↓
                </span>
            </div>
        </div>

        <!-- Card 4: Dosen Pembimbing Terdaftar -->
        <div onclick="smoothScrollTo('section-beban-dosen')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Dosen Pembimbing</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-[#173369] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= count($prodiLecturers ?? []) ?></span>
                    <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>"
                       onclick="event.stopPropagation()"
                       title="Buka halaman fitur kelola pembimbing"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Kelola →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">
                    Kapasitas 20 mhs / dosen
                </span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat beban ↓
                </span>
            </div>
        </div>

    </div>

    <!-- 4. Prioritas Hari Ini (Figma Matched) -->
    <?php if (!empty($queueList)): ?>
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Prioritas hari ini</h3>
                <p class="text-xs text-[#71819d] mt-0.5">
                    Pengajuan mendekati tanggal mulai. Dokumen telah diverifikasi oleh tata usaha.
                </p>
            </div>
            <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>" class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] transition">
                Lihat semua tugas →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach (array_slice($queueList, 0, 3) as $idx => $p): 
                $words = explode(' ', trim($p['student_name'] ?? 'M'));
                $initials = strtoupper(substr($words[0] ?? 'M', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
            ?>
            <div class="bg-white rounded-2xl border border-[#e4ebf6] p-4 sm:p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] transition flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold <?= $idx === 0 ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-blue-50 text-blue-700 border border-blue-200' ?>">
                            <?= $idx === 0 ? 'Segera ditinjau' : 'Prioritas minggu ini' ?>
                        </span>
                        <span class="text-[11px] text-[#90a4c3]">
                            <?= !empty($p['created_at']) ? date('d M Y', strtotime($p['created_at'])) : date('d M Y') ?>
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#173369] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">
                            <?= esc($initials) ?>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-[#172b4d] truncate"><?= esc($p['student_name']) ?></h4>
                            <p class="text-[10px] text-[#90a4c3]"><?= esc($p['nim']) ?></p>
                        </div>
                    </div>

                    <div class="bg-[#f7f9fc] rounded-xl p-2.5 space-y-1">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-[#71819d] text-[11px] font-medium truncate"><?= esc($p['company_name'] ?? 'Perusahaan Mitra') ?></span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-white text-[#173369] border border-[#e4ebf6] font-medium">
                                <?= esc($p['internship_type'] ?? 'Mandiri') ?>
                            </span>
                        </div>
                        <p class="text-[11px] text-[#2563eb] font-semibold flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Mulai: <?= !empty($p['start_date']) ? date('d M Y', strtotime($p['start_date'])) : 'Segera' ?></span>
                        </p>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                    <span class="text-[10px] text-[#71819d]">Status: <strong class="text-[#172b4d]"><?= esc($p['status']) ?></strong></span>
                    <a href="<?= base_url('kaprodi/penentuan-pembimbing/detail/' . $p['id']) ?>"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold transition shadow-sm active:scale-95">
                        <span>Tinjau</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- 5. Antrean Persetujuan Magang (Figma Matched Table) -->
    <div id="section-antrean" class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden scroll-mt-24 transition-all duration-300">
        <div class="p-5 border-b border-[#e4ebf6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Antrean persetujuan magang</h3>
                <p class="text-xs text-[#71819d] mt-0.5">
                    <?= count($queueList) ?> pengajuan menunggu keputusan Kaprodi
                </p>
            </div>
            <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>"
               class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] flex-shrink-0 inline-flex items-center gap-1">
                <span>Buka persetujuan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <?php if (!empty($queueList)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] tracking-wider">
                            <th class="px-5 py-3.5">Nama Mahasiswa</th>
                            <th class="px-5 py-3.5">Perusahaan</th>
                            <th class="px-5 py-3.5">Jenis Magang</th>
                            <th class="px-5 py-3.5">Tanggal Pengajuan</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf6]">
                        <?php foreach (array_slice($queueList, 0, 6) as $q): 
                            $words = explode(' ', trim($q['student_name'] ?? 'M'));
                            $initials = strtoupper(substr($words[0] ?? 'M', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        ?>
                            <tr class="hover:bg-[#f7f9fc] transition">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-[#eff5ff] text-[#2563eb] font-bold text-[11px] flex items-center justify-center flex-shrink-0">
                                            <?= esc($initials) ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-[#172b4d] text-xs"><?= esc($q['student_name']) ?></div>
                                            <div class="text-[10px] text-[#90a4c3]"><?= esc($q['nim']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-[#172b4d] font-medium">
                                    <?= esc($q['company_name'] ?? '-') ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#eff5ff] text-[#173369]">
                                        <?= esc($q['internship_type'] ?? 'Magang Mandiri') ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-[#71819d]">
                                    <?= !empty($q['created_at']) ? date('d M Y', strtotime($q['created_at'])) : date('d M Y') ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                        <?= in_array($q['status'], ['INTERNSHIP_ACTIVE','SUPERVISOR_ASSIGNED']) ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' ?>">
                                        <?= esc($q['status']) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <a href="<?= base_url('kaprodi/penentuan-pembimbing/detail/' . $q['id']) ?>"
                                       class="inline-flex items-center gap-1 text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline">
                                        <span>Tinjau</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-[#e4ebf6] bg-[#f7f9fc] flex items-center justify-between text-xs text-[#71819d]">
                <span>Menampilkan 1–<?= min(6, count($queueList)) ?> dari <?= count($queueList) ?> pengajuan</span>
                <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>" class="font-semibold text-[#2563eb] hover:underline">
                    Buka antrean lengkap →
                </a>
            </div>
        <?php else: ?>
            <div class="p-10 text-center">
                <div class="w-12 h-12 rounded-2xl bg-[#f7f9fc] border border-[#e4ebf6] text-emerald-600 mx-auto flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-[#172b4d]">Semua pengajuan telah tertangani</p>
                <p class="text-xs text-[#71819d] mt-1">Tidak ada antrean persetujuan magang saat ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 6. Penentuan Dosen Pembimbing (Figma Matched Section) -->
    <div id="section-beban-dosen" class="space-y-4 scroll-mt-24 transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Penentuan dosen pembimbing</h3>
                <p class="text-xs text-[#71819d] mt-0.5">
                    <?= $assignedCount ?> mahasiswa telah ditetapkan · Kapasitas acuan 20 mahasiswa per dosen
                </p>
            </div>
            <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>" class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] transition">
                Kelola pembimbing →
            </a>
        </div>

        <!-- Warning / Action Banner if unassigned students exist -->
        <?php $unassigned = max(0, $activeCount - $assignedCount); ?>
        <?php if ($unassigned > 0): ?>
        <div class="flex items-center justify-between p-4 bg-[#eff5ff] border border-[#dce8ff] rounded-2xl gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-[#2563eb] text-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <p class="text-xs text-[#173369] font-medium">
                    <strong class="font-bold"><?= $unassigned ?> mahasiswa magang aktif</strong> belum memiliki dosen pembimbing. Tetapkan sesuai bidang dan kapasitas.
                </p>
            </div>
            <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>" class="px-3.5 py-1.5 rounded-xl bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold whitespace-nowrap transition shadow-sm active:scale-95">
                Tetapkan pembimbing
            </a>
        </div>
        <?php endif; ?>

        <!-- Lecturer Load Cards -->
        <?php if (!empty($prodiLecturers)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach (array_slice($prodiLecturers, 0, 6) as $lec): 
                    $words = explode(' ', trim($lec['name']));
                    $initials = strtoupper(substr($words[0] ?? 'D', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                    $percent = min(100, round(($lec['student_count'] / max(1, $lec['capacity'])) * 100));
                    $isAvailable = $lec['remaining'] > 0;
                ?>
                <div class="bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] transition flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-[#173369] text-[#93c5fd] font-bold text-xs flex items-center justify-center">
                                    <?= esc($initials) ?>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-[#172b4d] truncate"><?= esc($lec['name']) ?></h4>
                                    <p class="text-[10px] text-[#90a4c3]">NIDN: <?= esc($lec['nidn'] ?? '-') ?></p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold <?= $isAvailable ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' ?>">
                                <?= $isAvailable ? 'Tersedia' : 'Penuh' ?>
                            </span>
                        </div>

                        <div class="mt-4 space-y-2">
                            <div class="flex items-baseline justify-between">
                                <span class="text-sm font-bold text-[#172b4d]"><?= $lec['student_count'] ?> <span class="text-[11px] font-normal text-[#71819d]">mahasiswa</span></span>
                                <span class="text-[11px] font-semibold text-[#71819d]"><?= $percent ?>% kapasitas</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full h-2 rounded-full bg-[#eff5ff] overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 <?= $percent >= 90 ? 'bg-red-500' : ($percent >= 70 ? 'bg-amber-500' : 'bg-[#2563eb]') ?>"
                                     style="width: <?= $percent ?>%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                        <span class="text-[#71819d]">
                            <?= $isAvailable ? 'Dapat menerima <strong class="text-[#172b4d]">' . $lec['remaining'] . '</strong> lagi' : '<strong class="text-red-600">Kapasitas tercapai</strong>' ?>
                        </span>
                        <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>" class="text-[#2563eb] font-semibold hover:underline">
                            Tetapkan →
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-2xl border border-[#e4ebf6] p-8 text-center">
                <p class="text-sm font-bold text-[#172b4d]">Belum ada dosen terdaftar</p>
                <p class="text-xs text-[#71819d] mt-1">Data dosen pembimbing untuk program studi ini belum diisi.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 7. Monitoring Magang & Pengesahan Konversi MK (2 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        <!-- Column A: Monitoring Magang -->
        <div id="section-monitoring" class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between scroll-mt-24 transition-all duration-300">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Monitoring magang</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Perkembangan program dan distribusi akademik dalam satu pandangan</p>
                    </div>
                    <button type="button" onclick="openLaporanModal()" class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] transition">
                        Laporan akademik →
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-3 my-4">
                    <div class="bg-[#eff5ff] rounded-xl p-3 text-center border border-[#dce8ff]">
                        <div class="text-2xl font-bold text-[#173369]"><?= $activeCount ?></div>
                        <div class="text-[11px] text-[#71819d] mt-0.5">Magang Aktif</div>
                    </div>
                    <div class="bg-[#f0fdf4] rounded-xl p-3 text-center border border-[#bbf7d0]">
                        <div class="text-2xl font-bold text-[#166534]"><?= $assignedCount ?></div>
                        <div class="text-[11px] text-[#71819d] mt-0.5">Ada Pembimbing</div>
                    </div>
                    <div class="bg-[#fffbeb] rounded-xl p-3 text-center border border-[#fde68a]">
                        <div class="text-2xl font-bold text-[#92400e]"><?= $pendingAssignments ?></div>
                        <div class="text-[11px] text-[#71819d] mt-0.5">Menunggu</div>
                    </div>
                </div>

                <!-- Status Progress Breakdown -->
                <div class="space-y-2 mt-4">
                    <div class="flex items-center justify-between text-xs text-[#71819d]">
                        <span>Kelengkapan Pembimbing</span>
                        <span class="font-bold text-[#172b4d]">
                            <?= $activeCount > 0 ? round(($assignedCount / $activeCount) * 100) : 0 ?>%
                        </span>
                    </div>
                    <div class="w-full h-2.5 rounded-full bg-[#f0f4f9] overflow-hidden flex">
                        <?php 
                            $assignedPct = $activeCount > 0 ? round(($assignedCount / $activeCount) * 100) : 0;
                            $unassignedPct = 100 - $assignedPct;
                        ?>
                        <div class="bg-emerald-500 h-full transition-all" style="width: <?= $assignedPct ?>%;"></div>
                        <div class="bg-amber-400 h-full transition-all" style="width: <?= $unassignedPct ?>%;"></div>
                    </div>
                    <div class="flex items-center justify-between text-[10px] text-[#90a4c3] pt-1">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Sudah ditetapkan (<?= $assignedCount ?>)
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span> Belum ditetapkan (<?= max(0, $activeCount - $assignedCount) ?>)
                        </span>
                    </div>
                </div>
            </div>

            <p class="text-[11px] text-[#71819d] mt-5 pt-3 border-t border-[#f0f4f9]">
                Distribusi akademik diperbarui secara realtime berdasarkan catatan kemahasiswaan dan koordinasi tata usaha.
            </p>
        </div>

        <!-- Column B: Pengesahan Konversi MK -->
        <div id="section-konversi" class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between scroll-mt-24 transition-all duration-300">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Pengesahan konversi MK</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Validasi capaian magang ke kurikulum program studi</p>
                    </div>
                    <a href="<?= base_url('kaprodi/konversi') ?>" class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] transition">
                        Lihat semua →
                    </a>
                </div>

                <div class="bg-[#f7f9fc] rounded-2xl p-4 border border-[#e4ebf6] mb-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#172b4d]">Permintaan Menunggu Review</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#eff5ff] text-[#2563eb]">
                            <?= $conversionCount ?? 0 ?> pengajuan
                        </span>
                    </div>
                    <p class="text-xs text-[#71819d] leading-relaxed">
                        Pengesahan konversi dilakukan berdasarkan kesesuaian capaian pembelajaran, bukti logbook berkala, dan rekomendasi dosen pembimbing akademik.
                    </p>
                    <div class="pt-2">
                        <a href="<?= base_url('kaprodi/konversi') ?>"
                           class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold transition shadow-sm active:scale-95">
                            <span>Review konversi</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between text-xs text-[#71819d]">
                        <span>Alur Validasi SKS</span>
                        <span class="text-[#2563eb] font-semibold">Tersinkronisasi Kurikulum</span>
                    </div>
                    <p class="text-[11px] text-[#90a4c3]">
                        Mahasiswa dapat mengonversi hingga 20 SKS mata kuliah yang relevan setelah diverifikasi oleh Kaprodi dan dosen pengampu MK.
                    </p>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Pedoman konversi mata kuliah MBKM / Reguler</span>
                <a href="<?= base_url('kaprodi/konversi') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Buka modul konversi →
                </a>
            </div>
        </div>

    </div>

    <!-- 8. Aktivitas Akademik Terbaru (Figma Matched) -->
    <?php if (!empty($recentActivities)): ?>
    <div class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden">
        <div class="p-5 border-b border-[#e4ebf6] flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Aktivitas Akademik Terbaru</h3>
                <p class="text-xs text-[#71819d] mt-0.5">Update terkini status magang mahasiswa prodi</p>
            </div>
            <span class="text-[11px] text-[#90a4c3]">10 pembaruan terakhir</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] tracking-wider">
                        <th class="px-5 py-3.5">Mahasiswa</th>
                        <th class="px-5 py-3.5">Perusahaan</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Terakhir Diperbarui</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4ebf6]">
                    <?php foreach ($recentActivities as $act): ?>
                        <tr class="hover:bg-[#f7f9fc] transition">
                            <td class="px-5 py-3.5">
                                <div class="font-bold text-[#172b4d] text-xs"><?= esc($act['student_name']) ?></div>
                                <div class="text-[10px] text-[#90a4c3]"><?= esc($act['nim']) ?></div>
                            </td>
                            <td class="px-5 py-3.5 text-[#71819d] font-medium"><?= esc($act['company_name'] ?? '-') ?></td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#eff5ff] text-[#2563eb]">
                                    <?= esc($act['status']) ?>
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-[#71819d]">
                                <?= !empty($act['updated_at']) ? format_indo(date('Y-m-d', strtotime($act['updated_at']))) : '-' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

</div>
<?= $this->endSection() ?>

<!-- ===== LAPORAN MODAL ===== -->
<?= $this->section('modals') ?>
<!-- Modal Backdrop -->
<div id="laporanModal"
    style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; padding:1rem; background:rgba(23,43,77,0.55); backdrop-filter:blur(4px);"
    onclick="if(event.target===this)closeLaporanModal()">

    <!-- Modal Box -->
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[92vh] overflow-y-auto shadow-2xl border border-slate-100" style="box-shadow:0 24px 64px rgba(23,43,77,0.18);">

        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-[#e4ebf6] bg-[#f7f9fc] rounded-t-2xl">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-[#173369] flex items-center justify-center">
                    <svg width="18" height="18" fill="none" stroke="#93c5fd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-bold text-[#172b4d]">Laporan Akademik Magang</div>
                    <div class="text-xs text-[#71819d]">Program Studi <?= esc($prodi['name'] ?? 'Informatika') ?></div>
                </div>
            </div>
            <div class="flex gap-2 items-center">
                <button onclick="printLaporan()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#173369] hover:bg-[#112756] text-white text-xs font-semibold rounded-xl cursor-pointer transition shadow-sm">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Cetak / Download PDF
                </button>
                <button onclick="closeLaporanModal()"
                    class="w-8 h-8 rounded-lg border border-[#e4ebf6] bg-white hover:bg-slate-50 flex items-center justify-center cursor-pointer text-[#71819d] transition">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>

        <!-- Printable Content -->
        <div id="printableArea" class="p-6 sm:p-8 font-sans text-[#172b4d]">

            <!-- Report Header -->
            <div class="text-center mb-6 pb-5 border-b-2 border-[#173369]">
                <div class="flex items-center justify-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white border border-[#e4ebf6] rounded-xl flex items-center justify-center p-1 shadow-sm">
                        <img src="<?= base_url('assets/images/logo-simagang.png') ?>?v=2" alt="Logo SIMAGANG" class="w-full h-full object-contain">
                    </div>
                    <div class="text-left">
                        <div class="text-lg font-extrabold text-[#173369] tracking-tight">SIMAGANG</div>
                        <div class="text-[10px] text-[#71819d] uppercase tracking-wider">Portal Magang Terpadu</div>
                    </div>
                </div>
                <h1 class="text-base font-bold text-[#172b4d] my-1">LAPORAN AKADEMIK MAGANG</h1>
                <p class="text-xs text-[#71819d]">Program Studi <?= esc($prodi['name'] ?? 'Informatika') ?> · Fakultas Teknik dan Teknologi Kemaritiman</p>
                <p class="text-[11px] text-[#90a4c3] mt-1">
                    Digenerate: <span class="report-timestamp-now"><?= format_indo(date('Y-m-d H:i:s'), true) ?></span>
                </p>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                <div class="bg-[#eff5ff] border border-[#dce8ff] rounded-xl p-3.5 text-center">
                    <div class="text-2xl font-extrabold text-[#173369]"><?= $activeCount ?></div>
                    <div class="text-xs text-[#71819d] mt-0.5">Magang Aktif</div>
                </div>
                <div class="bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl p-3.5 text-center">
                    <div class="text-2xl font-extrabold text-[#166534]"><?= $assignedCount ?></div>
                    <div class="text-xs text-[#71819d] mt-0.5">Sudah Ada Pembimbing</div>
                </div>
                <div class="bg-[#fffbeb] border border-[#fde68a] rounded-xl p-3.5 text-center">
                    <div class="text-2xl font-extrabold text-[#92400e]"><?= $pendingAssignments ?></div>
                    <div class="text-xs text-[#71819d] mt-0.5">Belum Ada Pembimbing</div>
                </div>
            </div>
                    <div style="font-size:11px; color:#71819d; margin-top:2px;">Menunggu Pembimbing</div>
                </div>
            </div>

            <!-- Section A: Antrian Pengajuan -->
            <?php if (!empty($queueList)): ?>
            <div style="margin-bottom:20px;">
                <h3 style="font-size:12px; font-weight:700; color:#173369; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e4ebf6;">
                    A. Antrian Pengajuan Terkini
                </h3>
                <table style="width:100%; border-collapse:collapse; font-size:11px;">
                    <thead>
                        <tr style="background:#f7f9fc;">
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">No</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Nama Mahasiswa</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">NIM</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Perusahaan</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($queueList as $i => $q): ?>
                        <tr>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= $i + 1 ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; font-weight:600;"><?= esc($q['student_name']) ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($q['nim']) ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($q['company_name'] ?? '-') ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($q['status']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <!-- Section B: Beban Dosen -->
            <?php if (!empty($prodiLecturers)): ?>
            <div style="margin-bottom:20px;">
                <h3 style="font-size:12px; font-weight:700; color:#173369; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e4ebf6;">
                    B. Beban Pembimbingan Dosen
                </h3>
                <table style="width:100%; border-collapse:collapse; font-size:11px;">
                    <thead>
                        <tr style="background:#f7f9fc;">
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">No</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Nama Dosen</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">NIDN</th>
                            <th style="padding:8px; text-align:center; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Dibimbing</th>
                            <th style="padding:8px; text-align:center; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Kapasitas</th>
                            <th style="padding:8px; text-align:center; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Sisa Slot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prodiLecturers as $li => $lec): ?>
                        <tr>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= $li + 1 ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; font-weight:600;"><?= esc($lec['name']) ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($lec['nidn'] ?? '-') ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; text-align:center; font-weight:700;"><?= $lec['student_count'] ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; text-align:center;"><?= $lec['capacity'] ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; text-align:center; font-weight:700; color:<?= $lec['remaining'] < 5 ? '#dc2626' : '#059669' ?>;"><?= $lec['remaining'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <!-- Section C: Aktivitas Terbaru -->
            <?php if (!empty($recentActivities)): ?>
            <div style="margin-bottom:20px;">
                <h3 style="font-size:12px; font-weight:700; color:#173369; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e4ebf6;">
                    C. Aktivitas Akademik Terbaru
                </h3>
                <table style="width:100%; border-collapse:collapse; font-size:11px;">
                    <thead>
                        <tr style="background:#f7f9fc;">
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">No</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Mahasiswa</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Perusahaan</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Status</th>
                            <th style="padding:8px; text-align:left; border:1px solid #e4ebf6; color:#71819d; font-weight:600;">Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentActivities as $ai => $act): ?>
                        <tr>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= $ai + 1 ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6; font-weight:600;"><?= esc($act['student_name']) ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($act['company_name'] ?? '-') ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= esc($act['status']) ?></td>
                            <td style="padding:8px; border:1px solid #e4ebf6;"><?= !empty($act['updated_at']) ? date('d M Y', strtotime($act['updated_at'])) : '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <!-- Footer Signature -->
            <div class="border-t border-[#e4ebf6] pt-5 flex justify-between items-end">
                <div class="text-[11px] text-[#71819d] space-y-0.5">
                    <p class="font-semibold text-[#172b4d]">SISTEM INFORMASI MAGANG</p>
                    <p>Fakultas Teknik dan Teknologi Kemaritiman</p>
                    <p>Digenerate otomatis: <span class="report-timestamp-now"><?= format_indo(date('Y-m-d H:i:s'), true) ?></span></p>
                </div>
                <div class="text-right text-[11px] text-[#71819d]">
                    <p class="mb-8">Kaprodi,</p>
                    <p class="font-semibold text-[#172b4d] border-t border-[#172b4d] pt-1 min-w-[160px]">(...........................)</p>
                </div>
            </div>

        </div><!-- end #printableArea -->
    </div><!-- end modal box -->
</div><!-- end modal -->
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

// Smooth scrolling to dashboard section with attention pulse
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

function openLaporanModal() {
    const modal = document.getElementById('laporanModal');
    if (modal) {
        // Sync modal timestamps to the exact current moment
        const nowFormatted = formatIndoRealtime(new Date(), false);
        document.querySelectorAll('.report-timestamp-now').forEach(el => {
            el.textContent = nowFormatted;
        });

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeLaporanModal() {
    const modal = document.getElementById('laporanModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function printLaporan() {
    const formattedPrintTime = formatIndoRealtime(new Date(), false);
    const prodiName = <?= json_encode($prodi['name'] ?? 'Informatika') ?>;
    const activeCount = <?= (int)$activeCount ?>;
    const assignedCount = <?= (int)$assignedCount ?>;
    const pendingAssignments = <?= (int)$pendingAssignments ?>;

    // Build queue rows
    let queueRows = '';
    <?php if (!empty($queueList)): ?>
    <?php foreach ($queueList as $i => $q): ?>
    queueRows += `<tr>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= $i+1 ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;font-weight:600;"><?= addslashes(esc($q['student_name'])) ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= addslashes(esc($q['nim'])) ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= addslashes(esc($q['company_name'] ?? '-')) ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= addslashes(esc($q['status'])) ?></td>
    </tr>`;
    <?php endforeach; ?>
    <?php endif; ?>

    // Build lecturer rows
    let lecRows = '';
    <?php if (!empty($prodiLecturers)): ?>
    <?php foreach ($prodiLecturers as $li => $lec): ?>
    lecRows += `<tr>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= $li+1 ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;font-weight:600;"><?= addslashes(esc($lec['name'])) ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;"><?= addslashes(esc($lec['nidn'] ?? '-')) ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;text-align:center;font-weight:700;"><?= $lec['student_count'] ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;text-align:center;"><?= $lec['capacity'] ?></td>
        <td style="padding:8px;border:1px solid #e4ebf6;text-align:center;font-weight:700;color:<?= $lec['remaining'] < 5 ? '#dc2626' : '#059669' ?>;"><?= $lec['remaining'] ?></td>
    </tr>`;
    <?php endforeach; ?>
    <?php endif; ?>

    const printWin = window.open('', '_blank', 'width=900,height=700');
    printWin.document.write(`
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Laporan Akademik Magang</title>
            <style>
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body { font-family: 'Inter', Arial, sans-serif; color: #172b4d; font-size: 12px; padding: 24px 32px; }
                h1 { font-size: 18px; font-weight: 800; }
                h3 { font-size: 11px; color: #173369; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin: 16px 0 6px; padding-bottom: 6px; border-bottom: 1px solid #e4ebf6; }
                table { width: 100%; border-collapse: collapse; font-size: 11px; margin-bottom: 16px; }
                th, td { padding: 7px 10px; border: 1px solid #e4ebf6; text-align: left; }
                th { background: #f7f9fc; color: #71819d; font-weight: 600; }
                .header { text-align: center; border-bottom: 2px solid #173369; padding-bottom: 16px; margin-bottom: 20px; }
                .stats { display: flex; gap: 10px; margin-bottom: 20px; }
                .stat { flex:1; background: #eff5ff; border: 1px solid #dce8ff; border-radius: 10px; padding: 12px; text-align: center; }
                .stat-num { font-size: 26px; font-weight: 800; color: #173369; }
                .stat-lbl { font-size: 10px; color: #71819d; margin-top: 2px; }
                .footer { margin-top: 24px; padding-top: 16px; border-top: 1px solid #e4ebf6; display: flex; justify-content: space-between; }
                .sign-line { margin-top: 40px; border-top: 1px solid #172b4d; padding-top: 4px; min-width: 160px; font-weight: 600; }
                .badge { display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: 700; }
                .badge-green { background: #f0fdf4; color: #166534; }
                .badge-amber { background: #fffbeb; color: #92400e; }
                .badge-blue  { background: #eff5ff; color: #1e40af; }
                @media print { body { padding: 12px; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>LAPORAN AKADEMIK MAGANG</h1>
                <p style="color:#71819d; margin-top:4px;">Program Studi ${prodiName} · Fakultas Teknik dan Teknologi Kemaritiman</p>
                <p style="color:#90a4c3; font-size:11px; margin-top:4px;">Digenerate: ${formattedPrintTime}</p>
            </div>

            <div class="stats">
                <div class="stat">
                    <div class="stat-num">${activeCount}</div>
                    <div class="stat-lbl">Magang Aktif</div>
                </div>
                <div class="stat" style="background:#f0fdf4; border-color:#bbf7d0;">
                    <div class="stat-num" style="color:#166534;">${assignedCount}</div>
                    <div class="stat-lbl">Sudah Ada Pembimbing</div>
                </div>
                <div class="stat" style="background:#fffbeb; border-color:#fde68a;">
                    <div class="stat-num" style="color:#92400e;">${pendingAssignments}</div>
                    <div class="stat-lbl">Menunggu Pembimbing</div>
                </div>
            </div>

            ${queueRows ? `
            <h3>A. Antrian Pengajuan Terkini</h3>
            <table>
                <thead><tr><th>No</th><th>Nama Mahasiswa</th><th>NIM</th><th>Perusahaan</th><th>Status</th></tr></thead>
                <tbody>${queueRows}</tbody>
            </table>` : ''}

            ${lecRows ? `
            <h3>B. Beban Pembimbingan Dosen</h3>
            <table>
                <thead><tr><th>No</th><th>Nama Dosen</th><th>NIDN</th><th style="text-align:center">Dibimbing</th><th style="text-align:center">Kapasitas</th><th style="text-align:center">Sisa Slot</th></tr></thead>
                <tbody>${lecRows}</tbody>
            </table>` : ''}

            <div class="footer">
                <div>
                    <p style="font-weight:700;font-size:12px">SISTEM INFORMASI MAGANG</p>
                    <p style="color:#71819d">Fakultas Teknik dan Teknologi Kemaritiman</p>
                    <p style="color:#90a4c3;font-size:10px">Digenerate: ${formattedPrintTime}</p>
                </div>
                <div style="text-align:right">
                    <p style="color:#71819d">Kaprodi,</p>
                    <div class="sign-line">(...........................)</div>
                </div>
            </div>
        </body>
        </html>
    `);
    printWin.document.close();
    printWin.focus();
    setTimeout(() => { printWin.print(); printWin.close(); }, 600);
}

// Close modal on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLaporanModal();
});
</script>
<?= $this->endSection() ?>
