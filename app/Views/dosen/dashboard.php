<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Dosen Dashboard (Dosbem & Dosen MK - Maritime Theme) -->
<div class="space-y-6 pb-12">

    <!-- 1. Top Welcome Header & Mode Switcher -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#eff5ff] text-[#2563eb] border border-[#dce8ff]">
                    PORTAL DOSEN
                </span>
                <span class="text-xs text-[#90a4c3] font-medium">NIDN: <?= esc($lecturer['nidn'] ?? '-') ?></span>
            </div>
            <h1 class="text-2xl sm:text-[28px] font-bold text-[#172b4d] tracking-tight">
                Welcome back, <?= esc($userName) ?>
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-0.5">
                <?php if ($activeRole === 'dosen_pembimbing'): ?>
                    Mode Aktif: <strong class="text-[#2563eb] font-semibold">Dosen Pembimbing</strong> &bull; Bimbingan magang, logbook mingguan, dan rekomendasi konversi.
                <?php else: ?>
                    Mode Aktif: <strong class="text-[#2563eb] font-semibold">Dosen Pengampu MK</strong> &bull; Verifikasi kesesuaian CPMK mata kuliah pilihan dan seminar magang.
                <?php endif; ?>
            </p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
            <!-- Mode Switcher Tabs -->
            <div class="inline-flex items-center bg-[#f7f9fc] p-1.5 rounded-2xl border border-[#e4ebf6] shadow-sm">
                <a href="<?= base_url('switch-role/dosen_pembimbing') ?>"
                   class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-200 <?= $activeRole === 'dosen_pembimbing' ? 'bg-white text-[#2563eb] shadow-sm border border-[#e4ebf6] font-bold' : 'text-[#71819d] hover:text-[#172b4d]' ?>">
                    <span>👨‍🏫 Pembimbing</span>
                    <?php if ($pendingAssignmentsCount > 0): ?>
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-amber-500 text-white font-extrabold animate-pulse">
                            <?= $pendingAssignmentsCount ?>
                        </span>
                    <?php endif; ?>
                </a>
                <a href="<?= base_url('switch-role/dosen_mk') ?>"
                   class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-200 <?= $activeRole === 'dosen_mk' ? 'bg-white text-[#2563eb] shadow-sm border border-[#e4ebf6] font-bold' : 'text-[#71819d] hover:text-[#172b4d]' ?>">
                    <span>📚 Pengampu MK</span>
                    <?php if ($pendingCourseConversionCount > 0): ?>
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-[#2563eb] text-white font-extrabold">
                            <?= $pendingCourseConversionCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Realtime Clock Widget -->
            <div class="text-right hidden xl:block bg-white px-3.5 py-1.5 rounded-2xl border border-[#e4ebf6] shadow-sm">
                <p id="realtimeClock" class="text-xs text-[#71819d] font-medium tabular-nums">
                    <?= format_indo(date('Y-m-d H:i:s'), true) ?>
                </p>
                <p class="text-[10px] text-[#90a4c3]">Sistem Akademik Terpadu</p>
            </div>
        </div>
    </div>

<?php if ($activeRole === 'dosen_pembimbing'): ?>
    <!-- ================================================================= -->
    <!-- MODE: DOSEN PEMBIMBING (DOSBEM)                                    -->
    <!-- ================================================================= -->

    <!-- 2. Hero Banner Dosen Pembimbing -->
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
                    PEMBIMBING AKADEMIK MAGANG
                </span>
                <h2 class="text-2xl sm:text-[26px] font-bold tracking-tight text-white truncate">
                    <?= esc($userName) ?>
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

            <!-- Stat 1: Mahasiswa Bimbingan Aktif -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Bimbingan Aktif</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $activeStudentsCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">sedang pelaksanaan magang</p>
            </div>

            <!-- Stat 2: Tawaran Baru -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Tawaran Bimbingan</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $pendingAssignmentsCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">
                    <?= $pendingAssignmentsCount > 0 ? 'perlu respon segera' : 'semua terkonfirmasi' ?>
                </p>
            </div>

            <!-- Stat 3: Verifikasi Konversi -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Verifikasi Konversi</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $pendingSupervisorConversionCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">menunggu rekomendasi</p>
            </div>
        </div>
    </div>

    <!-- 3. Four Metric Cards Dosbem (Interactive Scroll & Navigate) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

        <!-- Card 1: Tawaran Bimbingan -->
        <div onclick="smoothScrollTo('section-penugasan')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Tawaran Bimbingan</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $pendingAssignmentsCount ?></span>
                    <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
                       onclick="event.stopPropagation()"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Respon →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">Perlu respon persetujuan</span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat tabel ↓
                </span>
            </div>
        </div>

        <!-- Card 2: Bimbingan Aktif -->
        <div onclick="smoothScrollTo('section-penugasan')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Bimbingan Aktif</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $activeStudentsCount ?></span>
                    <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
                       onclick="event.stopPropagation()"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Pantau →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">Sedang pelaksanaan magang</span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Lihat daftar ↓
                </span>
            </div>
        </div>

        <!-- Card 3: Verifikasi Konversi -->
        <div onclick="smoothScrollTo('section-konversi-dosbem')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Verifikasi Konversi</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-[#2563eb] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $pendingSupervisorConversionCount ?></span>
                    <a href="<?= base_url('dosen-pembimbing/konversi') ?>"
                       onclick="event.stopPropagation()"
                       class="text-[11px] font-semibold text-[#2563eb] hover:text-[#1d4188] hover:underline transition inline-flex items-center gap-0.5 z-10">
                        <span>Validasi →</span>
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d] truncate">Rekomendasi konversi MK</span>
                <span class="text-[#2563eb] font-semibold flex items-center gap-0.5 opacity-90 group-hover:translate-y-0.5 transition-transform flex-shrink-0">
                    Buka modul →
                </span>
            </div>
        </div>

        <!-- Card 4: Jurnal & Logbook -->
        <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Jurnal &amp; Logbook</span>
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-xl font-bold text-[#172b4d]">Catatan Mingguan</span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Buka →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Pantau aktivitas berkala</span>
                <span class="text-[#2563eb] font-semibold">Semua bimbingan</span>
            </div>
        </a>

    </div>

    <!-- 4. Table: Daftar Mahasiswa Bimbingan -->
    <div id="section-penugasan" class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden scroll-mt-24 transition-all duration-300">
        <div class="p-5 border-b border-[#e4ebf6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Daftar Penugasan Mahasiswa Bimbingan</h3>
                <p class="text-xs text-[#71819d] mt-0.5">Penugasan dosen pembimbing magang yang ditentukan oleh Ketua Program Studi.</p>
            </div>
            <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
               class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] flex-shrink-0 inline-flex items-center gap-1">
                <span>Kelola di Pemantauan Logbook</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <?php if (!empty($assignments)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] tracking-wider">
                            <th class="px-5 py-3.5">Mahasiswa</th>
                            <th class="px-5 py-3.5">Instansi & Posisi</th>
                            <th class="px-5 py-3.5">Periode Magang</th>
                            <th class="px-5 py-3.5">Status Penugasan</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($assignments as $item): 
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
                                    <div class="font-semibold text-[#172b4d]"><?= esc($item['company_name']) ?></div>
                                    <div class="text-[10px] text-[#71819d] mt-0.5 flex items-center gap-2">
                                        <span><?= esc($item['position']) ?></span>
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-semibold <?= ($item['internship_type'] ?? 'Offline') === 'Online' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' ?>">
                                            <?= esc($item['internship_type'] ?? 'Offline') ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-[#71819d]">
                                    <div><?= format_indo($item['start_date'], false, true) ?> - <?= format_indo($item['end_date'], false, true) ?></div>
                                    <div class="mt-1"><?= view('components/status_badge', ['status' => $item['internship_status']]) ?></div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <?= view('components/status_badge', ['status' => $item['assignment_status']]) ?>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <?php if ($item['assignment_status'] === 'PENDING'): ?>
                                        <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold shadow-sm transition active:scale-95">
                                            <span>Respon Tawaran</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook/detail/' . $item['assignment_id']) ?>"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold shadow-sm transition active:scale-95">
                                            <span>Pantau Logbook</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-[#172b4d]">Belum Ada Mahasiswa Ditugaskan</p>
                <p class="text-xs text-[#71819d] mt-1">Saat ini belum ada mahasiswa magang yang ditugaskan kepada Anda oleh Kaprodi.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 5. Bottom Info Cards Dosbem (2 Kolom) -->
    <div id="section-konversi-dosbem" class="grid grid-cols-1 lg:grid-cols-2 gap-5 scroll-mt-24">
        <!-- Card Rekomendasi Konversi -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Rekomendasi Konversi Mahasiswa</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Penilaian capaian aktivitas magang untuk konversi SKS mata kuliah</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-[#eff5ff] text-[#2563eb]">
                        <?= $pendingSupervisorConversionCount ?> pending
                    </span>
                </div>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Sebagai dosen pembimbing, Anda bertindak memberikan verifikasi dan rekomendasi nilai atas ketercapaian kompetensi mahasiswa selama magang sebelum divalidasi oleh Dosen Pengampu MK dan disahkan oleh Wakil Dekan I.
                </p>
            </div>
            <div class="mt-5 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Modul Verifikasi Konversi Dosbem</span>
                <a href="<?= base_url('dosen-pembimbing/konversi') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Buka modul konversi →
                </a>
            </div>
        </div>

        <!-- Card Panduan Logbook -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-[#172b4d]">Monitoring Mingguan &amp; Logbook</h3>
                        <p class="text-xs text-[#71819d] mt-0.5">Pemeriksaan berkala aktivitas dan jurnal mahasiswa di mitra magang</p>
                    </div>
                    <span class="text-xs text-[#90a4c3]">E-Logbook</span>
                </div>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Pastikan mahasiswa mengisi logbook secara berkala setiap minggu beserta bukti dokumentasi kegiatan magang. Berikan catatan pembimbingan bila terdapat capaian yang perlu disempurnakan.
                </p>
            </div>
            <div class="mt-5 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Pemantauan Logbook Mingguan</span>
                <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Pantau logbook →
                </a>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- ================================================================= -->
    <!-- MODE: DOSEN PENGAMPU MK                                           -->
    <!-- ================================================================= -->

    <!-- 2. Hero Banner Dosen Pengampu MK -->
    <div class="relative w-full rounded-2xl p-6 sm:p-7 overflow-hidden text-white shadow-xl shadow-blue-950/5 bg-gradient-to-r from-[#173369] via-[#1d3f7e] to-[#234b91]">
        <!-- Decorative Ambient Watermark -->
        <div class="absolute -right-8 -bottom-10 w-72 h-72 rounded-full bg-white/[0.04] blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-6 lg:gap-8">
            <!-- Left Info -->
            <div class="space-y-1 max-w-sm">
                <span class="inline-block text-[10px] font-bold tracking-wider text-[#93c5fd] uppercase">
                    DOSEN PENGAMPU MATA KULIAH
                </span>
                <h2 class="text-2xl sm:text-[26px] font-bold tracking-tight text-white truncate">
                    <?= esc($userName) ?>
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

            <!-- Stat 1: MK Pilihan Diampu -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">MK Pilihan Diampu</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= count($courses) ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">mata kuliah semester ini</p>
            </div>

            <!-- Stat 2: Konversi Masuk -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Konversi CPMK Masuk</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $pendingCourseConversionCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">menunggu review CPMK</p>
            </div>

            <!-- Stat 3: Calon Seminar -->
            <div class="space-y-1 min-w-[150px]">
                <p class="text-xs text-[#d3e3ff] font-medium">Calon Seminar Magang</p>
                <div class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    <?= $candidateSeminarsCount ?>
                </div>
                <p class="text-[11px] text-[#d3e3ff]/80">mahasiswa terdaftar</p>
            </div>
        </div>
    </div>

    <!-- 3. Four Metric Cards Dosen MK -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

        <!-- Card 1: MK Diampu -->
        <div onclick="smoothScrollTo('section-mk-diampu')"
             class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 cursor-pointer flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">MK Pilihan Diampu</span>
                    <div class="w-8 h-8 rounded-lg bg-[#eff5ff] flex items-center justify-center text-[#2563eb] group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= count($courses) ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb]">Lihat daftar ↓</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Mata kuliah aktif</span>
                <span class="text-[#2563eb] font-semibold">Tabel MK ↓</span>
            </div>
        </div>

        <!-- Card 2: Konversi Masuk -->
        <a href="<?= base_url('dosen-mk/konversi') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Konversi Masuk</span>
                    <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $pendingCourseConversionCount ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Review CPMK →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Menunggu verifikasi nilai</span>
                <span class="text-[#2563eb] font-semibold">Buka modul →</span>
            </div>
        </a>

        <!-- Card 3: Seminar Magang -->
        <a href="<?= base_url('dosen-mk/seminar') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Seminar Magang</span>
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-3xl font-bold text-[#172b4d] tracking-tight"><?= $candidateSeminarsCount ?></span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Kelola →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Peserta seminar terdaftar</span>
                <span class="text-[#2563eb] font-semibold">Jadwal seminar →</span>
            </div>
        </a>

        <!-- Card 4: Evaluasi CPMK -->
        <a href="<?= base_url('dosen-mk/konversi') ?>"
           class="group bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md hover:border-[#b8d0ff] hover:-translate-y-0.5 transition-all duration-200 block flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-[#71819d] font-medium">Evaluasi CPMK</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline justify-between">
                    <span class="text-xl font-bold text-[#172b4d]">Sinkronisasi Nilai</span>
                    <span class="text-[11px] font-semibold text-[#2563eb] group-hover:translate-x-0.5 transition-transform inline-flex items-center gap-0.5">
                        Buka →
                    </span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[#f0f4f9] flex items-center justify-between text-[11px]">
                <span class="text-[#71819d]">Sesuai Silabus / RPS</span>
                <span class="text-[#2563eb] font-semibold">Verifikasi MK</span>
            </div>
        </a>

    </div>

    <!-- 4. Table: Mata Kuliah Pilihan yang Diampu -->
    <div id="section-mk-diampu" class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden scroll-mt-24 transition-all duration-300">
        <div class="p-5 border-b border-[#e4ebf6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base sm:text-[18px] font-semibold text-[#172b4d]">Mata Kuliah Pilihan yang Anda Ampu</h3>
                <p class="text-xs text-[#71819d] mt-0.5">Mata kuliah yang dapat dipilih mahasiswa untuk dikonversikan dengan kegiatan magang.</p>
            </div>
            <a href="<?= base_url('dosen-mk/konversi') ?>"
               class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] flex-shrink-0 inline-flex items-center gap-1">
                <span>Lihat Pengajuan Konversi</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <?php if (!empty($courses)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] tracking-wider">
                            <th class="px-5 py-3.5">Kode MK</th>
                            <th class="px-5 py-3.5">Nama Mata Kuliah</th>
                            <th class="px-5 py-3.5 text-center">Bobot SKS</th>
                            <th class="px-5 py-3.5 text-center">Jenis MK</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($courses as $course): ?>
                            <tr class="hover:bg-[#f7f9fc] transition">
                                <td class="px-5 py-3.5 font-mono font-bold text-[#173369]">
                                    <?= esc($course['code']) ?>
                                </td>
                                <td class="px-5 py-3.5 font-bold text-[#172b4d]">
                                    <?= esc($course['name']) ?>
                                </td>
                                <td class="px-5 py-3.5 text-center font-bold text-[#172b4d]">
                                    <?= esc($course['credits']) ?> SKS
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#eff5ff] text-[#2563eb]">
                                        MK Pilihan
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="<?= base_url('dosen-mk/konversi') ?>"
                                           class="inline-flex items-center px-2.5 py-1.5 rounded-lg bg-[#2563eb] hover:bg-[#1d4188] text-white text-xs font-semibold shadow-sm transition active:scale-95">
                                            Verifikasi Konversi
                                        </a>
                                        <a href="<?= base_url('dosen-mk/seminar') ?>"
                                           class="inline-flex items-center px-2.5 py-1.5 rounded-lg bg-white hover:bg-slate-50 text-[#172b4d] border border-[#e4ebf6] text-xs font-semibold shadow-sm transition active:scale-95">
                                            Seminar
                                        </a>
                                    </div>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-[#172b4d]">Belum Ada Mata Kuliah Diampu</p>
                <p class="text-xs text-[#71819d] mt-1">Tidak ada mata kuliah pilihan yang terdaftar di bawah pengampuan Anda saat ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 5. Bottom Info Cards Dosen MK (2 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-base font-semibold text-[#172b4d] mb-1">Panduan Evaluasi CPMK</h3>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Evaluasi kesesuaian capaian pembelajaran mata kuliah (CPMK) dilakukan dengan membandingkan portofolio, logbook, dan rekomendasi nilai dari mitra magang dengan rubrik kurikulum prodi.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Validasi Rubrik Kurikulum</span>
                <a href="<?= base_url('dosen-mk/konversi') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Lihat antrean validasi →
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-base font-semibold text-[#172b4d] mb-1">Seminar Hasil Magang</h3>
                <p class="text-xs text-[#71819d] leading-relaxed">
                    Mahasiswa yang telah menyelesaikan masa magang dan melengkapi laporan wajib mempresentasikan hasil magang dalam seminar sebelum nilai konversi MK diinput secara definitif.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-[#f0f4f9] flex items-center justify-between">
                <span class="text-[11px] text-[#71819d]">Penjadwalan & Pengujian</span>
                <a href="<?= base_url('dosen-mk/seminar') ?>" class="text-[11px] text-[#2563eb] font-semibold hover:underline">
                    Jadwal seminar →
                </a>
            </div>
        </div>
    </div>

<?php endif; ?>

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
