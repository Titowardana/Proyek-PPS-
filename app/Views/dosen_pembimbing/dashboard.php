<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 pb-10">

    <!-- 1. Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-[26px] font-bold text-[#172b4d] tracking-tight">
                Dashboard Dosen Pembimbing
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-1">
                Pemantauan &amp; verifikasi logbook mingguan mahasiswa bimbingan.
            </p>
        </div>
    </div>

    <!-- 2. Stats Cards -->
    <?php
    $totalBimbingan  = count($supervisedStudents ?? []);
    $activeStudents  = array_filter($supervisedStudents ?? [], fn($s) => ($s['internship_status'] ?? '') === 'INTERNSHIP_ACTIVE');
    $pendingLogbooks = array_filter($supervisedStudents ?? [], fn($s) => ($s['unverified_logs'] ?? 0) > 0);
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Total Bimbingan -->
        <div class="bg-white p-5 rounded-2xl border border-[#e4ebf6] shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">Total Bimbingan</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 text-[#2563eb]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-[#172b4d]"><?= $totalBimbingan ?></div>
            <p class="text-xs text-[#71819d] mt-1">Mahasiswa dalam bimbingan</p>
        </div>

        <!-- Magang Aktif -->
        <div class="bg-white p-5 rounded-2xl border border-[#e4ebf6] shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">Aktif Magang</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-50 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-[#172b4d]"><?= count($activeStudents) ?></div>
            <p class="text-xs text-[#71819d] mt-1">Sedang melaksanakan magang</p>
        </div>

        <!-- Logbook Belum Diverifikasi -->
        <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
           class="bg-white p-5 rounded-2xl border border-[#e4ebf6] shadow-sm hover:shadow-md hover:border-[#b8d0ff] transition-all block group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] group-hover:text-[#2563eb] uppercase tracking-wider transition">Logbook Pending</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-bold text-[#172b4d]"><?= count($pendingLogbooks) ?></div>
            <p class="text-xs text-[#2563eb] font-semibold mt-1">Periksa logbook →</p>
        </a>
    </div>

    <!-- 3. Daftar Mahasiswa Bimbingan -->
    <div class="bg-white rounded-2xl border border-[#e4ebf6] shadow-sm overflow-hidden">
        <div class="p-5 border-b border-[#e4ebf6] flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-[15px] font-bold text-[#172b4d]">Daftar Mahasiswa Bimbingan</h2>
                <p class="text-xs text-[#71819d] mt-0.5">Mahasiswa yang sedang berada di bawah bimbingan Anda.</p>
            </div>
            <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
               class="text-xs font-semibold text-[#2563eb] hover:text-[#1d4188] flex items-center gap-1 flex-shrink-0">
                Pantau Logbook →
            </a>
        </div>

        <?php if (!empty($supervisedStudents)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-[#f7f9fc] border-b border-[#e4ebf6] text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">
                            <th class="px-6 py-3.5">Mahasiswa</th>
                            <th class="px-6 py-3.5">Perusahaan</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5 text-center">Logbook Belum Diperiksa</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf6]">
                        <?php foreach ($supervisedStudents as $student): ?>
                            <tr class="hover:bg-[#f7f9fc]/70 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-[#172b4d]"><?= esc($student['student_name'] ?? '-') ?></div>
                                    <div class="text-xs text-[#90a4c3]"><?= esc($student['nim'] ?? '') ?></div>
                                </td>
                                <td class="px-6 py-4 text-xs text-[#71819d]"><?= esc($student['company_name'] ?? '-') ?></td>
                                <td class="px-6 py-4">
                                    <?= view('components/status_badge', ['status' => $student['internship_status'] ?? '-']) ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php $unverified = $student['unverified_logs'] ?? 0; ?>
                                    <?php if ($unverified > 0): ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            <?= $unverified ?> pending
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-[#90a4c3] italic">Sudah diperiksa</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook/' . ($student['internship_id'] ?? '')) ?>"
                                       class="inline-flex items-center px-3 py-1.5 bg-[#eff5ff] hover:bg-blue-100 text-[#2563eb] text-xs font-semibold rounded-lg border border-[#b8d0ff] transition">
                                        Pantau Logbook
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-14 text-center">
                <div class="w-14 h-14 rounded-2xl bg-[#f7f9fc] border border-[#e4ebf6] text-[#90a4c3] mx-auto flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-[#172b4d]">Belum Ada Mahasiswa Bimbingan</h3>
                <p class="text-xs text-[#71819d] mt-1 max-w-sm mx-auto leading-relaxed">
                    Anda belum memiliki mahasiswa bimbingan magang yang aktif saat ini.
                </p>
            </div>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>
