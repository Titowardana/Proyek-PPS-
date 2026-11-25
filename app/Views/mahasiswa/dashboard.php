<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
// Process dynamic data from controller
$totalInternships       = count($internships);
$activeInternships      = array_filter($internships, fn($i) => ($i['status'] ?? '') === 'INTERNSHIP_ACTIVE');
$activeInternship       = reset($activeInternships) ?: null;
$latestInternship       = reset($internships) ?: null;
$activePercent          = $totalInternships > 0 ? round(($activeInternshipsCount / $totalInternships) * 100) : 0;
$academicYear           = $latestInternship['academic_year'] ?? '2025/2026';

// Indonesian month map for upcoming deadlines
$bulanMap = [
    1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MEI', 6 => 'JUN',
    7 => 'JUL', 8 => 'AGU', 9 => 'SEP', 10 => 'OKT', 11 => 'NOV', 12 => 'DES'
];

// Determine Alur Layanan Magang active step
// 1: Pendaftaran, 2: Verifikasi TU, 3: Penentuan Pembimbing, 4: Magang Aktif, 5: Logbook, 6: Konversi, 7: Seminar
$currentStep = 1;
if ($activeInternship) {
    $currentStep = 4;
} elseif ($latestInternship) {
    switch ($latestInternship['status']) {
        case 'SUBMITTED':
        case 'ADMIN_REVIEW':
            $currentStep = 2;
            break;
        case 'ADMIN_APPROVED':
        case 'SUPERVISOR_ASSIGNED':
            $currentStep = 3;
            break;
        case 'INTERNSHIP_ACTIVE':
            $currentStep = 4;
            break;
        case 'INTERNSHIP_COMPLETED':
        case 'REPORT_SUBMITTED':
            $currentStep = 6;
            break;
        case 'COMPLETED':
            $currentStep = 7;
            break;
        default:
            $currentStep = 1;
            break;
    }
}

// Generate Action Items ("Perlu ditindaklanjuti")
$actionItems = [];
foreach ($internships as $item) {
    if (in_array($item['status'], ['REVISION_REQUIRED', 'REJECTED'])) {
        $actionItems[] = [
            'type'      => 'revision',
            'title'     => 'Tinjau pengajuan yang perlu revisi',
            'desc'      => esc($item['company_name']) . ' · Status: ' . ($item['status'] === 'REVISION_REQUIRED' ? 'Perlu Revisi' : 'Ditolak'),
            'badge'     => 'Revisi',
            'badge_cls' => 'bg-[#fff7e8] text-[#a46a12]',
            'icon_bg'   => 'bg-[#fff7e8] text-[#a46a12]',
            'url'       => base_url('mahasiswa/pendaftaran/detail/' . $item['id']),
            'btn_label' => 'Detail',
            'btn_cls'   => 'bg-[#2563eb] text-white',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
        ];
    } elseif ($item['assignment_status'] === 'PENDING' || $item['status'] === 'SUPERVISOR_ASSIGNED') {
        $actionItems[] = [
            'type'      => 'pending_supervisor',
            'title'     => 'Pantau konfirmasi pembimbing',
            'desc'      => esc($item['company_name']) . ' · Menunggu verifikasi dosen pembimbing',
            'badge'     => 'Menunggu',
            'badge_cls' => 'bg-[#eff5ff] text-[#2563eb]',
            'icon_bg'   => 'bg-[#eff5ff] text-[#2563eb]',
            'url'       => base_url('mahasiswa/pendaftaran/detail/' . $item['id']),
            'btn_label' => 'Detail',
            'btn_cls'   => 'bg-white text-[#2563eb] border border-[#e4ebf6]',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>',
        ];
    }
}

if ($activeInternshipsCount > 0) {
    $actionItems[] = [
        'type'      => 'logbook',
        'title'     => 'Lengkapi jurnal & logbook magang',
        'desc'      => $activeInternshipsCount . ' periode aktif · ' . $logbookCount . ' entri logbook terisi',
        'badge'     => 'Aktif',
        'badge_cls' => 'bg-[#eff5ff] text-[#2563eb]',
        'icon_bg'   => 'bg-[#eff5ff] text-[#2563eb]',
        'url'       => base_url('mahasiswa/logbook' . ($activeInternship ? '?internship_id=' . $activeInternship['id'] : '')),
        'btn_label' => 'Isi Logbook',
        'btn_cls'   => 'bg-white text-[#2563eb] border border-[#e4ebf6]',
        'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>',
    ];
}
?>

<div class="space-y-4 sm:space-y-6 pb-8 sm:pb-12 font-['Inter',_sans-serif]">

    <!-- 1. Top Header & Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-xl sm:text-[27px] font-normal text-[#172b4d] tracking-tight">
                Selamat pagi, <?= esc(explode(' ', $userName)[0] ?? $userName) ?>.
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-0.5 sm:mt-1">
                Perjalanan magang Anda, terarah dalam satu tempat.
            </p>
        </div>

        <div class="flex items-center justify-between sm:justify-end gap-3">
            <span class="text-[11px] sm:text-xs text-[#71819d] font-normal">
                TA <?= esc($academicYear) ?>
            </span>
            <a href="<?= base_url('mahasiswa/pendaftaran/baru') ?>"
               class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3.5 py-2 sm:py-2.5 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs font-semibold rounded-[10px] border border-[#2563eb] shadow-sm transition active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Ajukan Magang Baru</span>
            </a>
        </div>
    </div>

    <!-- 2. Hero Student Profile Card -->
    <div class="relative w-full rounded-[18px] sm:rounded-[20px] p-5 sm:p-7 overflow-hidden text-white shadow-[0px_8px_24px_rgba(37,99,235,0.09)] bg-gradient-to-r from-[#173369] via-[#234b91] to-[#2563eb]">
        <!-- Watermarks SVG -->
        <div class="absolute -right-10 -bottom-10 w-96 h-48 opacity-10 pointer-events-none hidden md:block">
            <svg viewBox="0 0 400 172" fill="none" stroke="#b8deff" stroke-width="2" class="w-full h-full">
                <path d="M0 86 Q100 20 200 86 T400 86" />
                <path d="M0 110 Q100 44 200 110 T400 110" opacity="0.6" />
                <path d="M0 134 Q100 68 200 134 T400 134" opacity="0.3" />
            </svg>
        </div>
        <div class="absolute right-32 top-8 w-12 h-12 opacity-30 pointer-events-none hidden lg:block">
            <svg viewBox="0 0 100 100" fill="none" stroke="#b8deff" stroke-width="1.5">
                <circle cx="50" cy="50" r="45" stroke-dasharray="3 3"/>
                <circle cx="50" cy="50" r="30"/>
                <circle cx="50" cy="50" r="10"/>
                <line x1="50" y1="5" x2="50" y2="95"/>
                <line x1="5" y1="50" x2="95" y2="50"/>
            </svg>
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-6 lg:gap-8">
            <!-- Left Info Block -->
            <div class="flex-1 space-y-5">
                <!-- User Profile Row -->
                <div class="flex items-start sm:items-center gap-3.5 sm:gap-4">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/10 border border-white/20 p-1 flex items-center justify-center flex-shrink-0 shadow-inner">
                        <div class="w-full h-full rounded-full bg-[#173369] text-white flex items-center justify-center font-bold text-base sm:text-xl uppercase">
                            <?= strtoupper(substr($userName, 0, 1)) ?>
                        </div>
                    </div>
                    <div class="space-y-1 min-w-0 flex-1">
                        <p class="text-[#b8d8fc] text-[10px] font-normal tracking-wider uppercase">
                            MAHASISWA · TA <?= esc($academicYear) ?>
                        </p>
                        <h2 class="text-lg sm:text-[25px] font-normal tracking-tight text-white leading-tight truncate">
                            <?= esc($userName) ?>
                        </h2>
                        <p class="text-[#d3e3ff] text-[11px] sm:text-xs font-normal truncate">
                            NIM <?= esc($student['nim'] ?? '-') ?> · <?= esc($student['prodi_name'] ?? 'Informatika') ?>
                        </p>
                    </div>
                    <div class="ml-auto flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full border border-white/15 bg-white/[0.07] flex-shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#a7f3d0] animate-pulse"></span>
                        <span class="text-white text-[10px] sm:text-[11px] font-semibold whitespace-nowrap"><?= $activeInternshipsCount ?> aktif</span>
                    </div>
                </div>

                <!-- Active Internship Highlights -->
                <div class="border-t border-white/15 pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-[#b8d8fc] text-[11px] font-normal">Periode magang pilihan</p>
                        <p class="text-white text-sm font-semibold mt-0.5 truncate">
                            <?= esc($activeInternship['company_name'] ?? ($latestInternship['company_name'] ?? 'Belum ada magang terdaftar')) ?>
                        </p>
                        <p class="text-[#d3e3ff] text-[11px] font-normal mt-0.5 truncate">
                            <?= esc($activeInternship['position'] ?? ($latestInternship['position'] ?? '-')) ?> · 
                            <?= esc($activeInternship['internship_type'] ?? ($latestInternship['internship_type'] ?? 'Offline')) ?> · 
                            <?php if (!empty($activeInternship['start_date']) && !empty($activeInternship['end_date'])): ?>
                                <?= format_indo($activeInternship['start_date'], false, true) ?> – <?= format_indo($activeInternship['end_date'], false, true) ?>
                            <?php else: ?>
                                <?= !empty($latestInternship['start_date']) ? format_indo($latestInternship['start_date'], false, true) : '-' ?>
                            <?php endif; ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-[#b8d8fc] text-[11px] font-normal">Dosen pembimbing</p>
                        <p class="text-white text-sm font-semibold mt-0.5 truncate">
                            <?= esc($activeInternship['supervisor_name'] ?? ($latestInternship['supervisor_name'] ?? 'Belum ditentukan')) ?>
                        </p>
                        <p class="text-[#d3e3ff] text-[11px] font-normal mt-0.5 truncate">
                            <?= !empty($activeInternship['supervisor_name']) ? 'Dosen pembimbing · ' . esc($activeInternship['company_name']) : 'Menunggu penugasan Kaprodi' ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block w-px h-36 bg-white/15"></div>

            <!-- Right Proportion Stat Block -->
            <div class="w-full lg:w-[280px] space-y-2.5 flex-shrink-0">
                <p class="text-[#d3e3ff] text-[11px] font-semibold tracking-wider uppercase">
                    PROPORSI MAGANG AKTIF
                </p>
                <div class="flex items-baseline justify-between">
                    <span class="text-white text-4xl sm:text-[52px] font-normal leading-none">
                        <?= $activePercent ?>%
                    </span>
                    <span class="text-[#d3e3ff] text-[11px]">
                        <?= $activeInternshipsCount ?> dari <?= $totalInternships ?> periode
                    </span>
                </div>
                <!-- Progress bar -->
                <div class="w-full h-1.5 rounded-[4px] bg-white/15 overflow-hidden">
                    <div class="h-full rounded-[4px] bg-[#b8d8fc] transition-all duration-500" style="width: <?= $activePercent ?>%;"></div>
                </div>
                <p class="text-white text-xs font-normal">
                    <?= $activeInternshipsCount ?> periode sedang dalam pelaksanaan
                </p>
                <p class="text-[#d3e3ff] text-[11px]">
                    Riwayat tersedia untuk <?= $totalInternships ?> periode
                </p>
                <div class="pt-1">
                    <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="inline-flex items-center gap-1 text-white hover:text-[#d3e3ff] text-[11px] font-semibold transition">
                        Lihat semua periode &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Four Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <!-- Card 1: Total Magang -->
        <div class="bg-white p-4 sm:p-5 rounded-[14px] sm:rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[#71819d] text-xs font-medium">Total Magang</span>
                <span class="text-[#90a4c3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
            </div>
            <div class="my-2.5">
                <span class="text-[#172b4d] text-2xl font-normal"><?= $totalInternships ?></span>
                <p class="text-[#71819d] text-[11px] mt-0.5">Total periode magang terdaftar</p>
            </div>
            <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[11px] font-normal transition">
                Lihat semua periode &rarr;
            </a>
        </div>

        <!-- Card 2: Magang Aktif -->
        <div class="bg-white p-4 sm:p-5 rounded-[14px] sm:rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[#71819d] text-xs font-medium">Magang Aktif</span>
                <span class="text-[#90a4c3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </span>
            </div>
            <div class="my-2.5">
                <span class="text-[#172b4d] text-2xl font-normal"><?= $activeInternshipsCount ?></span>
                <p class="text-[#71819d] text-[11px] mt-0.5">Sedang dalam masa pelaksanaan</p>
            </div>
            <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[11px] font-normal transition">
                Lihat periode aktif &rarr;
            </a>
        </div>

        <!-- Card 3: Logbook Terisi -->
        <div class="bg-white p-4 sm:p-5 rounded-[14px] sm:rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[#71819d] text-xs font-medium">Logbook Terisi</span>
                <span class="text-[#90a4c3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <div class="my-2.5">
                <span class="text-[#172b4d] text-2xl font-normal"><?= $logbookCount ?></span>
                <p class="text-[#71819d] text-[11px] mt-0.5">Entri jurnal &amp; logbook</p>
            </div>
            <a href="<?= base_url('mahasiswa/logbook') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[11px] font-normal transition">
                Buka entri logbook &rarr;
            </a>
        </div>

        <!-- Card 4: Konversi MK -->
        <div class="bg-white p-4 sm:p-5 rounded-[14px] sm:rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[#71819d] text-xs font-medium">Konversi MK</span>
                <span class="text-[#90a4c3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </span>
            </div>
            <div class="my-2.5">
                <span class="text-[#172b4d] text-2xl font-normal"><?= $conversionCount ?></span>
                <p class="text-[#71819d] text-[11px] mt-0.5">Permohonan konversi mata kuliah</p>
            </div>
            <a href="<?= base_url('mahasiswa/konversi') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[11px] font-normal transition">
                Kelola permohonan konversi &rarr;
            </a>
        </div>
    </div>

    <!-- 4. Alur Layanan Magang (Pipeline Steps) -->
    <div class="bg-white p-5 sm:p-6 rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-[#172b4d] text-[17px] font-normal">Alur layanan magang</h3>
            <span class="px-2.5 py-1 rounded-[8px] bg-[#eff5ff] text-[#2563eb] text-[11px] font-semibold">
                Per periode
            </span>
        </div>

        <?php
        $pipelineSteps = [
            1 => ['title' => 'Pendaftaran', 'sub' => 'Ajukan magang baru'],
            2 => ['title' => 'Verifikasi TU', 'sub' => 'Persetujuan pengajuan'],
            3 => ['title' => 'Penentuan Pembimbing', 'sub' => 'Konfirmasi dosen'],
            4 => ['title' => 'Magang Aktif', 'sub' => 'Periode pelaksanaan'],
            5 => ['title' => 'Jurnal & Logbook', 'sub' => 'Catatan kegiatan'],
            6 => ['title' => 'Konversi MK', 'sub' => 'Permohonan konversi'],
            7 => ['title' => 'Seminar Magang', 'sub' => 'Layanan seminar'],
        ];
        ?>
        <!-- Mobile Vertical Stepper (Rapi tanpa scrollbar horizontal) -->
        <div class="md:hidden space-y-0">
            <?php foreach ($pipelineSteps as $sNum => $step): ?>
                <?php
                $isDone   = $sNum < $currentStep;
                $isActive = $sNum === $currentStep;
                ?>
                <div class="flex items-stretch gap-3">
                    <div class="flex flex-col items-center">
                        <?php if ($isDone): ?>
                            <div class="w-7 h-7 rounded-full bg-[#2563eb] text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        <?php elseif ($isActive): ?>
                            <div class="w-7 h-7 rounded-full bg-[#2563eb] text-white border-[3px] border-[#b8d8fc] flex items-center justify-center font-semibold text-[11px] flex-shrink-0 shadow-sm">
                                <?= $sNum ?>
                            </div>
                        <?php else: ?>
                            <div class="w-7 h-7 rounded-full bg-[#f7f9fc] border border-[#e4ebf6] text-[#90a4c3] flex items-center justify-center font-normal text-[11px] flex-shrink-0">
                                <?= $sNum ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($sNum < 7): ?>
                            <div class="w-[2px] flex-1 my-1 min-h-[14px] <?= $sNum < $currentStep ? 'bg-[#2563eb]' : 'bg-[#e4ebf6]' ?>"></div>
                        <?php endif; ?>
                    </div>
                    <div class="pb-3.5 pt-0.5 min-w-0 flex-1 flex items-center justify-between gap-2">
                        <div class="min-w-0">
                            <p class="text-xs leading-tight <?= $isActive ? 'text-[#2563eb] font-bold' : ($isDone ? 'text-[#172b4d] font-medium' : 'text-[#71819d] font-normal') ?>">
                                <?= esc($step['title']) ?>
                            </p>
                            <p class="text-[11px] mt-0.5 <?= $isActive ? 'text-[#2563eb]' : 'text-[#90a4c3]' ?>">
                                <?= esc($step['sub']) ?>
                            </p>
                        </div>
                        <?php if ($isActive): ?>
                            <span class="px-2 py-0.5 rounded-full bg-[#eff5ff] text-[#2563eb] text-[10px] font-semibold flex-shrink-0">Aktif</span>
                        <?php elseif ($isDone): ?>
                            <span class="text-[#2563eb] text-[10px] font-medium flex-shrink-0">Selesai</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Desktop & Tablet Horizontal Stepper -->
        <div class="hidden md:block overflow-x-auto no-scrollbar pb-1">
            <div class="min-w-[720px] flex items-start justify-between">
                <?php foreach ($pipelineSteps as $sNum => $step): ?>
                    <?php
                    $isDone   = $sNum < $currentStep;
                    $isActive = $sNum === $currentStep;
                    ?>
                    <div class="flex-1 flex flex-col items-center text-center relative group">
                        <!-- Step Connector & Badge Circle -->
                        <div class="w-full h-[30px] flex items-center">
                            <!-- Left Connector Line -->
                            <div class="flex-1 h-[2px] <?= $sNum === 1 ? 'invisible' : ($sNum <= $currentStep ? 'bg-[#2563eb]' : 'bg-[#e4ebf6]') ?>"></div>
                            
                            <!-- Circle Badge -->
                            <?php if ($isDone): ?>
                                <div class="w-[30px] h-[30px] rounded-full bg-[#2563eb] text-white flex items-center justify-center flex-shrink-0 z-10 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            <?php elseif ($isActive): ?>
                                <div class="w-[30px] h-[30px] rounded-full bg-[#2563eb] text-white border-[4px] border-[#b8d8fc] flex items-center justify-center font-normal text-[11px] flex-shrink-0 z-10 shadow-sm">
                                    <?= $sNum ?>
                                </div>
                            <?php else: ?>
                                <div class="w-[30px] h-[30px] rounded-full bg-[#f7f9fc] border border-[#e4ebf6] text-[#90a4c3] flex items-center justify-center font-normal text-[11px] flex-shrink-0 z-10">
                                    <?= $sNum ?>
                                </div>
                            <?php endif; ?>

                            <!-- Right Connector Line -->
                            <div class="flex-1 h-[2px] <?= $sNum === 7 ? 'invisible' : ($sNum < $currentStep ? 'bg-[#2563eb]' : 'bg-[#e4ebf6]') ?>"></div>
                        </div>

                        <!-- Labels -->
                        <div class="mt-2 space-y-0.5 px-1">
                            <p class="text-[11px] <?= $isActive ? 'text-[#2563eb] font-bold' : ($isDone ? 'text-[#172b4d] font-normal' : 'text-[#71819d] font-normal') ?>">
                                <?= esc($step['title']) ?>
                            </p>
                            <p class="text-[10px] <?= $isActive ? 'text-[#2563eb]' : 'text-[#90a4c3]' ?>">
                                <?= esc($step['sub']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- 5. Split Bottom Section (Two Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- ================= LEFT COLUMN (8 Cols) ================= -->
        <div class="lg:col-span-8 space-y-6">

            <!-- Card: Perlu ditindaklanjuti (Action Items) -->
            <div class="bg-white p-5 sm:p-6 rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <h3 class="text-[#172b4d] text-[18px] font-normal">Perlu ditindaklanjuti</h3>
                        <span class="px-2.5 py-1 rounded-[8px] bg-[#eff5ff] text-[#2563eb] text-[11px] font-semibold">
                            <?= count($actionItems) ?> hal
                        </span>
                    </div>
                    <span class="text-[#71819d] text-[11px] hidden sm:inline">
                        Sesuai status periode Anda
                    </span>
                </div>

                <?php if (!empty($actionItems)): ?>
                    <div class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($actionItems as $act): ?>
                            <div class="py-3.5 first:pt-0 last:pb-0 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
                                <div class="flex items-center gap-3.5 flex-1 min-w-0">
                                    <div class="w-[38px] h-[38px] rounded-[10px] <?= $act['icon_bg'] ?> flex items-center justify-center flex-shrink-0">
                                        <?= $act['icon'] ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[#172b4d] text-[13px] font-semibold truncate leading-normal">
                                            <?= esc($act['title']) ?>
                                        </p>
                                        <p class="text-[#71819d] text-[11px] truncate mt-0.5">
                                            <?= esc($act['desc']) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end gap-2 sm:gap-2.5 flex-shrink-0 pl-[52px] sm:pl-0">
                                    <span class="px-2.5 py-1 rounded-[8px] text-[11px] font-semibold <?= $act['badge_cls'] ?>">
                                        <?= esc($act['badge']) ?>
                                    </span>
                                    <a href="<?= $act['url'] ?>"
                                       class="px-3.5 py-2 rounded-[10px] text-[12px] font-semibold transition <?= $act['btn_cls'] ?>">
                                        <?= esc($act['btn_label']) ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="py-8 text-center text-slate-500 text-xs">
                        <svg class="w-8 h-8 text-emerald-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tidak ada tindakan mendesak saat ini. Semua pengajuan berjalan lancar.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card: Riwayat & Status Periode Magang (Timeline List View) -->
            <div class="bg-white p-5 sm:p-6 rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-[#172b4d] text-[18px] font-normal">Riwayat &amp; Status Periode Magang</h3>
                    <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[12px] font-semibold transition">
                        Lihat Semua Periode &rarr;
                    </a>
                </div>

                <?php if (!empty($internships)): ?>
                    <div class="space-y-4">
                        <?php foreach ($internships as $idx => $item): ?>
                            <?php
                            $isLast = ($idx === count($internships) - 1);
                            $badgeColor = 'bg-[#ecfdf5] text-[#047857]';
                            if ($item['status'] === 'ADMIN_APPROVED') {
                                $badgeColor = 'bg-[#eff6ff] text-[#1d4ed8]';
                            } elseif ($item['status'] === 'SUPERVISOR_ASSIGNED' || $item['assignment_status'] === 'PENDING') {
                                $badgeColor = 'bg-[#ecfeff] text-[#0e7490]';
                            } elseif (in_array($item['status'], ['REVISION_REQUIRED', 'REJECTED'])) {
                                $badgeColor = 'bg-[#fffbeb] text-[#b45309]';
                            }
                            ?>
                            <div class="flex items-start gap-3.5 group">
                                <!-- Timeline Column -->
                                <div class="flex flex-col items-center flex-shrink-0">
                                    <div class="w-7 h-7 rounded-full bg-[#ecf8f3] text-[#047857] flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <?php if (!$isLast): ?>
                                        <div class="w-px h-12 bg-[#e4ebf6] my-1"></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Detail Info Column -->
                                <div class="flex-1 min-w-0 space-y-1">
                                    <p class="text-[#172b4d] text-xs font-semibold truncate leading-normal">
                                        <?= esc($item['company_name']) ?> · <?= esc($item['position']) ?> · <?= esc($item['internship_type'] ?? 'Offline') ?>
                                    </p>
                                    <p class="text-[#71819d] text-[11px] leading-relaxed">
                                        <?php if (!empty($item['start_date']) && !empty($item['end_date'])): ?>
                                            <?= format_indo($item['start_date'], false, true) ?> – <?= format_indo($item['end_date'], false, true) ?> · 
                                        <?php endif; ?>
                                        TA <?= esc($item['academic_year'] ?? '-') ?> (<?= esc($item['semester'] ?? 'Ganjil') ?>)
                                    </p>
                                    <p class="text-[#71819d] text-[11px]">
                                        Dosen pembimbing: <?= !empty($item['supervisor_name']) ? esc($item['supervisor_name']) : ($item['assignment_status'] === 'PENDING' ? 'Menunggu Konfirmasi' : 'Belum ditentukan') ?>
                                    </p>
                                    <div class="pt-0.5">
                                        <span class="inline-block px-2 py-0.5 rounded-[8px] text-[11px] font-semibold <?= $badgeColor ?>">
                                            <?php
                                            if ($item['status'] === 'INTERNSHIP_ACTIVE') {
                                                echo 'Magang Aktif';
                                            } elseif ($item['status'] === 'ADMIN_APPROVED') {
                                                echo 'Disetujui TU';
                                            } elseif ($item['status'] === 'SUPERVISOR_ASSIGNED' || $item['assignment_status'] === 'PENDING') {
                                                echo 'Pembimbing Ditentukan: Menunggu Verifikasi Dosen Pembimbing';
                                            } elseif ($item['status'] === 'REVISION_REQUIRED') {
                                                echo 'Perlu Revisi';
                                            } elseif ($item['status'] === 'REJECTED') {
                                                echo 'Ditolak';
                                            } else {
                                                echo esc(str_replace('_', ' ', $item['status']));
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons Column -->
                                <div class="flex flex-col gap-1.5 flex-shrink-0">
                                    <?php if ($item['status'] === 'INTERNSHIP_ACTIVE'): ?>
                                        <a href="<?= base_url('mahasiswa/logbook?internship_id=' . $item['id']) ?>"
                                           class="px-3 py-1.5 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs font-semibold rounded-[10px] text-center transition">
                                            Isi Logbook
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('mahasiswa/pendaftaran/detail/' . $item['id']) ?>"
                                       class="px-3 py-1.5 bg-[#f1f5f9] hover:bg-[#e2e8f0] text-[#334155] text-xs font-semibold rounded-[10px] text-center transition">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-8 text-center space-y-2">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-semibold text-slate-800">Belum Ada Pengajuan Magang</h4>
                        <p class="text-xs text-slate-500">Ajukan magang pertama Anda untuk memulai verifikasi dan plotting dosen pembimbing.</p>
                        <div class="pt-2">
                            <a href="<?= base_url('mahasiswa/pendaftaran/baru') ?>" class="inline-flex items-center px-4 py-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                + Ajukan Magang Sekarang
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- ================= RIGHT COLUMN (4 Cols) ================= -->
        <div class="lg:col-span-4 space-y-6">

            <!-- Widget 1: Akhir periode aktif -->
            <div class="bg-white p-5 rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-[#172b4d] text-[18px] font-normal">Akhir periode aktif</h3>
                    <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[12px] font-semibold transition">
                        Detail &rarr;
                    </a>
                </div>

                <?php
                $activeUpcoming = !empty($activeInternships) ? $activeInternships : array_slice($internships, 0, 3);
                ?>
                <?php if (!empty($activeUpcoming)): ?>
                    <div class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($activeUpcoming as $uIdx => $uItem): ?>
                            <?php
                            $endTs = !empty($uItem['end_date']) ? strtotime($uItem['end_date']) : null;
                            $dayNum = $endTs ? date('d', $endTs) : '--';
                            $monthStr = $endTs ? ($bulanMap[(int)date('n', $endTs)] ?? 'BLN') : '---';
                            $isTop = ($uIdx === 0);
                            ?>
                            <div class="py-3.5 first:pt-0 last:pb-0 flex items-start gap-3.5">
                                <!-- Calendar Day Box -->
                                <div class="w-12 h-14 rounded-[10px] <?= $isTop ? 'bg-[#eff5ff] text-[#2563eb]' : 'bg-[#f7f9fc] text-[#172b4d]' ?> flex flex-col items-center justify-center flex-shrink-0">
                                    <span class="text-[21px] font-normal leading-none"><?= $dayNum ?></span>
                                    <span class="text-[9px] font-semibold text-[#71819d] mt-1"><?= $monthStr ?></span>
                                </div>

                                <!-- Details -->
                                <div class="flex-1 min-w-0 space-y-1">
                                    <p class="text-[#172b4d] text-xs font-normal truncate">
                                        <?= esc($uItem['company_name']) ?>
                                    </p>
                                    <p class="text-[#71819d] text-[11px] truncate">
                                        <?php if (!empty($uItem['start_date']) && !empty($uItem['end_date'])): ?>
                                            <?= date('d', strtotime($uItem['start_date'])) ?>–<?= format_indo($uItem['end_date'], false, true) ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                        · <?= esc($uItem['position']) ?> · <?= esc($uItem['internship_type'] ?? 'Offline') ?>
                                    </p>
                                    <p class="text-[#71819d] text-[10px] truncate">
                                        <?= !empty($uItem['supervisor_name']) ? esc($uItem['supervisor_name']) . ' · Dosen' : 'Belum ditentukan' ?>
                                    </p>
                                    <div>
                                        <span class="inline-block px-2 py-0.5 rounded-[8px] text-[11px] font-semibold <?= $isTop ? 'bg-[#eff5ff] text-[#2563eb]' : 'bg-[#fff7e8] text-[#a46a12]' ?>">
                                            <?= $uItem['status'] === 'INTERNSHIP_ACTIVE' ? 'Magang Aktif' : esc(str_replace('_', ' ', $uItem['status'])) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-xs text-slate-400 py-3">Tidak ada jadwal aktif.</p>
                <?php endif; ?>
            </div>

            <!-- Widget 2: Status pengajuan -->
            <div class="bg-white p-5 rounded-[16px] border border-[#e4ebf6] shadow-[0px_4px_16px_rgba(30,58,138,0.02)] space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-[#172b4d] text-[18px] font-normal">Status pengajuan</h3>
                    <a href="<?= base_url('mahasiswa/pendaftaran') ?>" class="text-[#2563eb] hover:text-[#1d4ed8] text-[12px] font-semibold transition">
                        Lihat detail &rarr;
                    </a>
                </div>

                <?php
                $feedItems = array_slice($internships, 0, 4);
                ?>
                <?php if (!empty($feedItems)): ?>
                    <div class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($feedItems as $fItem): ?>
                            <?php
                            $isApprovedTU = ($fItem['status'] === 'ADMIN_APPROVED');
                            $isPendingSpv = ($fItem['assignment_status'] === 'PENDING' || $fItem['status'] === 'SUPERVISOR_ASSIGNED');
                            ?>
                            <div class="py-3.5 first:pt-0 last:pb-0 flex items-start gap-3">
                                <div class="w-[30px] h-[30px] rounded-[8px] <?= $isApprovedTU ? 'bg-[#ecf8f3] text-[#047857]' : 'bg-[#eff5ff] text-[#2563eb]' ?> flex items-center justify-center flex-shrink-0">
                                    <?php if ($isApprovedTU): ?>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0 space-y-1">
                                    <p class="text-[#172b4d] text-xs font-semibold truncate">
                                        <?= esc($fItem['company_name']) ?> <?= $isApprovedTU ? 'disetujui TU' : ($isPendingSpv ? 'menunggu konfirmasi' : 'aktif') ?>
                                    </p>
                                    <p class="text-[#71819d] text-[11px] leading-relaxed">
                                        <?php if ($isApprovedTU): ?>
                                            Dosen pembimbing belum ditentukan.
                                        <?php elseif ($isPendingSpv): ?>
                                            Pembimbing ditentukan; menunggu verifikasi dosen pembimbing.
                                        <?php else: ?>
                                            Status saat ini: <?= esc(str_replace('_', ' ', $fItem['status'])) ?>
                                        <?php endif; ?>
                                    </p>
                                    <p class="text-[#90a4c3] text-[10px]">
                                        Status: <?= esc(str_replace('_', ' ', $fItem['status'])) ?>
                                    </p>
                                </div>
                                <div class="w-1.5 h-1.5 rounded-full bg-[#2563eb] flex-shrink-0 mt-1"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-xs text-slate-400 py-3">Belum ada riwayat aktivitas pengajuan.</p>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <!-- 6. Footer Notes -->
    <div class="pt-4 border-t border-[#e4ebf6] flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-[#71819d]">
        <p>© 2026 UMRAH · Sistem Informasi Magang</p>
        <p>Universitas Maritim Raja Ali Haji</p>
    </div>

</div>
<?= $this->endSection() ?>
