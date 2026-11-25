<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 pb-10">

    <!-- 1. Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-[26px] font-bold text-[#172b4d] tracking-tight">
                Dashboard Staf TU
            </h1>
            <p class="text-xs sm:text-[13px] text-[#71819d] mt-1">
                Kelola dan verifikasi berkas administrasi magang mahasiswa.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= base_url('tu/verifikasi-dokumen') ?>"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#173369] hover:bg-[#1d4188] text-white text-xs font-semibold rounded-xl shadow-sm transition active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Verifikasi Dokumen
            </a>
        </div>
    </div>

    <!-- 2. Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Menunggu Verifikasi -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">Menunggu Verifikasi</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-[#172b4d]"><?= esc($pendingApprovals) ?></div>
            <p class="text-xs text-[#71819d] mt-1">Berkas permohonan perlu ditinjau</p>
            <?php if ($pendingApprovals > 0): ?>
                <a href="<?= base_url('tu/verifikasi-dokumen') ?>" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-700 mt-3">
                    Tinjau sekarang →
                </a>
            <?php endif; ?>
        </div>

        <!-- Magang Aktif -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">Magang Aktif</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-50 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-[#172b4d]"><?= esc($totalActive) ?></div>
            <p class="text-xs text-[#71819d] mt-1">Mahasiswa aktif melaksanakan magang</p>
        </div>

        <!-- Surat Diterbitkan -->
        <div class="bg-white rounded-2xl border border-[#e4ebf6] p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-semibold text-[#71819d] uppercase tracking-wider">Surat Diterbitkan</span>
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 text-[#2563eb]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-[#172b4d]">0</div>
            <p class="text-xs text-[#71819d] mt-1">Dokumen fisik administrasi</p>
        </div>
    </div>

    <!-- 3. Quick Action Banner -->
    <div class="relative bg-gradient-to-r from-[#173369] via-[#1d3f7e] to-[#2563eb] rounded-2xl p-6 text-white overflow-hidden shadow-xl shadow-blue-900/10">
        <div class="absolute -right-8 -bottom-8 w-56 h-56 rounded-full bg-white/[0.04] blur-2xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-blue-200 mb-1">Administrasi TU</p>
                <h3 class="text-lg font-bold text-white">Verifikasi Berkas Mahasiswa</h3>
                <p class="text-sm text-blue-200/80 mt-1">Periksa dan setujui permohonan dokumen magang yang masuk.</p>
            </div>
            <a href="<?= base_url('tu/verifikasi-dokumen') ?>"
               class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2.5 bg-white text-[#173369] text-xs font-bold rounded-xl hover:bg-blue-50 transition active:scale-95 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8l2 2 4-4"/>
                </svg>
                Buka Antrian Verifikasi
            </a>
        </div>
    </div>

    <!-- 4. Panduan / Info -->
    <div class="bg-[#eff5ff] rounded-2xl p-5 border border-[#dce8ff]">
        <div class="flex items-start gap-3">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#2563eb]/10 text-[#2563eb] flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <div>
                <h4 class="text-[13px] font-semibold text-[#173369]">Alur Kerja Verifikasi TU</h4>
                <p class="text-[12px] text-[#71819d] mt-1 leading-relaxed">
                    Mahasiswa mengajukan permohonan magang → <strong>TU memverifikasi</strong> kelengkapan berkas dan dokumen → Kaprodi menentukan dosen pembimbing → Magang dilaksanakan.
                </p>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
