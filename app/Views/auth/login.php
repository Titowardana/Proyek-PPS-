<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="w-full min-h-screen lg:h-screen lg:overflow-hidden flex flex-col lg:flex-row relative overflow-x-hidden">

    <!-- ==================== LEFT HERO SECTION ==================== -->
    <div class="hidden lg:flex lg:w-[48%] xl:w-[46%] lg:h-full relative flex-col justify-between p-7 xl:p-10 pb-5 xl:pb-6 text-white overflow-hidden flex-shrink-0"
         style="clip-path: url(#heroCurve);">

        <!-- Background Image & Maritime Dark Overlay -->
        <div class="absolute inset-0 bg-cover bg-center pointer-events-none scale-105 transition-transform duration-1000"
             style="background-image: url('<?= base_url('assets/images/gedung-umrah.jpg') ?>');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#071d43]/95 via-[#0b2759]/90 to-[#103371]/88 pointer-events-none"></div>

        <!-- Nautical Compass / Radar Watermark Graphic in Background with Animations -->
        <div class="absolute top-1/2 -translate-y-1/2 right-2 xl:right-6 w-72 h-72 xl:w-84 xl:h-84 pointer-events-none anim-radar-pulse">
            <svg viewBox="0 0 300 300" fill="none" class="w-full h-full">
                <!-- Outer rotating ring -->
                <g class="anim-spin-slow origin-center">
                    <circle cx="150" cy="150" r="140" stroke="#93c5fd" stroke-width="1.2" stroke-dasharray="4 4" opacity="0.6"/>
                    <circle cx="150" cy="150" r="110" stroke="#93c5fd" stroke-width="1" opacity="0.4"/>
                    <!-- Cardinal direction markers -->
                    <text x="150" y="24" text-anchor="middle" fill="#93c5fd" font-size="11" font-weight="700" letter-spacing="1">N</text>
                    <text x="150" y="286" text-anchor="middle" fill="#93c5fd" font-size="11" font-weight="700" letter-spacing="1">S</text>
                    <text x="20" y="154" text-anchor="middle" fill="#93c5fd" font-size="11" font-weight="700" letter-spacing="1">W</text>
                    <text x="280" y="154" text-anchor="middle" fill="#93c5fd" font-size="11" font-weight="700" letter-spacing="1">E</text>
                </g>

                <!-- Inner counter-rotating dashes -->
                <g class="anim-spin-rev origin-center">
                    <circle cx="150" cy="150" r="75" stroke="#93c5fd" stroke-width="1" stroke-dasharray="3 4" opacity="0.5"/>
                    <circle cx="150" cy="150" r="45" stroke="#93c5fd" stroke-width="1.2" opacity="0.7"/>
                </g>

                <!-- Crosshairs -->
                <line x1="150" y1="5" x2="150" y2="295" stroke="#93c5fd" stroke-width="1" stroke-dasharray="3 3" opacity="0.45"/>
                <line x1="5" y1="150" x2="295" y2="150" stroke="#93c5fd" stroke-width="1" stroke-dasharray="3 3" opacity="0.45"/>

                <!-- Center glowing badge with logo silhouette -->
                <circle cx="150" cy="150" r="28" fill="#173369" stroke="#93c5fd" stroke-width="2" opacity="0.95"/>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <img src="<?= base_url('assets/images/logo-umrah.png') ?>" alt="UMRAH" class="w-10 h-10 object-contain opacity-90 drop-shadow-lg">
            </div>
        </div>

        <!-- 1. Top Brand Header with Coordinates Pill -->
        <div class="relative z-10 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3.5">
                <div class="w-14 h-14 rounded-2xl bg-white p-1.5 flex items-center justify-center border border-white/30 shadow-xl flex-shrink-0 transition-transform hover:scale-105">
                    <img src="<?= base_url('assets/images/logo-simagang.png') ?>?v=2" alt="Logo SIMAGANG" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-white font-extrabold text-[19px] tracking-tight">SIMAGANG</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#1d428a]/80 text-blue-200 border border-blue-400/30">UMRAH</span>
                    </div>
                    <p class="text-[9px] font-semibold text-blue-200/80 tracking-[0.16em] uppercase">PORTAL MAGANG MAHASISWA</p>
                </div>
            </div>
        </div>

        <!-- 2. Hero Center Content -->
        <div class="relative z-10 my-auto py-4 anim-hero">
            <div class="flex items-center gap-2 text-xs font-bold tracking-[0.2em] text-blue-300 uppercase mb-4">
                <span class="tracking-tighter font-mono">— —</span>
                <span>ILMU • PENGALAMAN • MASA DEPAN</span>
            </div>

            <h1 class="text-3xl xl:text-4xl font-extrabold text-white leading-[1.25] tracking-tight">
                Dari kampus maritim,<br>
                menuju masa depan.
            </h1>

            <p class="text-xs xl:text-sm text-blue-100/85 mt-4 leading-relaxed max-w-md font-normal">
                Mulai perjalanan magang Anda. Hubungkan ilmu, pengalaman, dan peluang dalam satu portal terpadu.
            </p>

            <!-- Translucent Feature Card -->
            <div class="mt-7 bg-[#0a234e]/60 backdrop-blur-md border border-white/15 hover:border-white/25 transition rounded-2xl p-4 max-w-md shadow-2xl flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center flex-shrink-0 text-white shadow-inner">
                    <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-xs">Satu portal. Seluas peluang Anda.</h4>
                    <p class="text-[11px] text-blue-200/85 mt-0.5 leading-relaxed">
                        Kelola pengajuan, aktivitas, dan laporan magang dalam ekosistem akademik yang terintegrasi.
                    </p>
                </div>
            </div>

            <!-- Aesthetic Pills (Terintegrasi SIAKAD & MBKM) -->
            <div class="mt-4 flex flex-wrap items-center gap-2 max-w-md">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/[0.06] backdrop-blur-sm border border-white/10 text-[10px] text-blue-200 font-medium shadow-sm">
                    <span class="text-xs">⚡</span>
                    <span>Terintegrasi SIAKAD & MBKM</span>
                </div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/[0.06] backdrop-blur-sm border border-white/10 text-[10px] text-blue-200 font-medium shadow-sm">
                    <span class="text-xs">🛡️</span>
                    <span>Single Sign-On Akun UMRAH</span>
                </div>
            </div>
        </div>

        <!-- 3. Bottom Footer of Left Hero (Diturunkan dan Dirapikan) -->
        <div class="relative z-10 flex items-center justify-between text-xs text-blue-200/80 pt-5 mt-auto border-t border-white/15 pb-1">
            <div class="flex items-center gap-2 bg-white/[0.06] backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 shadow-sm transition hover:bg-white/[0.1]">
                <svg class="w-3.5 h-3.5 text-blue-300 animate-pulse flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-[11px] font-medium tracking-wide text-blue-100">Tanjungpinang, Kepri</span>
            </div>
            <div class="flex items-center gap-2 text-[10px] font-bold tracking-[0.22em] text-blue-200 uppercase bg-white/[0.05] backdrop-blur-md px-4 py-1.5 rounded-full border border-white/10 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                <span>MARITIM • UNGGUL • BERBUDAYA</span>
            </div>
        </div>
    </div>

    <!-- ==================== RIGHT LOGIN SECTION ==================== -->
    <div class="flex-1 flex flex-col min-h-screen lg:min-h-0 lg:h-full relative overflow-hidden"
         style="background: linear-gradient(150deg, #edf1fb 0%, #f1f5fd 45%, #e9eef8 100%);">

        <!-- Decorative: Dot grid overlay -->
        <div class="absolute inset-0 pointer-events-none dot-grid" style="opacity:0.55;"></div>

        <!-- Decorative: Large ambient glow blobs -->
        <div class="absolute -top-32 -right-32 w-[520px] h-[520px] rounded-full pointer-events-none anim-float anim-glow"
             style="background: radial-gradient(circle, rgba(96,165,250,0.18) 0%, rgba(99,102,241,0.08) 60%, transparent 80%);"></div>
        <div class="absolute -bottom-40 -left-24 w-[480px] h-[480px] rounded-full pointer-events-none anim-float-rev anim-glow"
             style="background: radial-gradient(circle, rgba(79,70,229,0.14) 0%, rgba(37,99,235,0.07) 60%, transparent 80%); animation-delay: 2s;"></div>
        <div class="absolute top-1/3 right-16 w-72 h-72 rounded-full pointer-events-none anim-drift"
             style="background: radial-gradient(circle, rgba(147,197,253,0.12) 0%, transparent 70%); animation-delay: 1s;"></div>

        <!-- Decorative: Geometric lines (top right corner) -->
        <div class="absolute top-0 right-0 w-64 h-64 pointer-events-none opacity-[0.07]">
            <svg viewBox="0 0 256 256" fill="none" class="w-full h-full">
                <path d="M256 0 L256 256 L0 0 Z" fill="url(#cornerGrad)"/>
                <defs>
                    <linearGradient id="cornerGrad" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#2563eb"/>
                        <stop offset="100%" stop-color="#173369"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decorative: Small floating ring (bottom left) -->
        <div class="absolute bottom-24 left-12 w-20 h-20 rounded-full border-2 border-blue-300/25 pointer-events-none anim-spin-slow"></div>
        <div class="absolute bottom-32 left-20 w-10 h-10 rounded-full border border-indigo-300/20 pointer-events-none anim-spin-rev"></div>

        <!-- Top Utility Bar (Mobile Brand + Glassmorphic Badges) -->
        <div class="flex items-center justify-between lg:justify-end gap-2.5 text-xs text-slate-500 font-medium pt-3 px-4 sm:px-7 relative z-10 flex-shrink-0">
            <!-- Brand khusus Mobile/Tablet -->
            <div class="flex lg:hidden items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-white p-1 border border-slate-200/80 shadow-sm flex items-center justify-center flex-shrink-0">
                    <img src="<?= base_url('assets/images/logo-simagang.png') ?>?v=2" alt="SIMAGANG" class="w-full h-full object-contain">
                </div>
                <div class="leading-tight">
                    <span class="text-xs font-extrabold text-[#173369] tracking-tight block">SIMAGANG</span>
                    <span class="text-[8.5px] font-semibold text-slate-500 uppercase tracking-wider block">UMRAH</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="stat-pill">
                    <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-[11px] text-slate-600 font-semibold">TA 2026 / 2027</span>
                </div>
                <a href="#" onclick="alert('Pusat Bantuan Magang UMRAH\nEmail: magang@umrah.ac.id\nWhatsApp Helpdesk: +62 812-3456-7890'); return false;"
                   class="stat-pill hover:border-blue-300">
                    <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="text-[11px] font-semibold hidden sm:inline">Pusat bantuan</span>
                    <span class="text-[11px] font-semibold sm:hidden">Bantuan</span>
                </a>
            </div>
        </div>

        <!-- Centered Login Card with Card Entrance Animation -->
        <div class="flex-1 flex items-center justify-center overflow-y-auto px-4 sm:px-0 py-2 relative z-10">
        <div class="w-full max-w-[420px] mx-auto py-2 anim-card">
            <div class="bg-white rounded-[22px] p-5 sm:p-6 login-card shadow-[0_16px_48px_rgba(23,43,77,0.08)] border border-slate-200/80">

                <!-- Card Header -->
                <div class="flex items-center gap-2.5 mb-3.5">
                    <div class="w-9 h-9 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center p-1 flex-shrink-0 shadow-sm">
                        <img src="<?= base_url('assets/images/logo-umrah.png') ?>" alt="UMRAH" class="w-6 h-6 object-contain">
                    </div>
                    <div>
                        <div class="font-extrabold text-[13px] text-slate-900 tracking-tight leading-none">UMRAH</div>
                        <div class="text-[9px] font-semibold text-slate-500 tracking-wider uppercase mt-0.5">UNIVERSITAS MARITIM RAJA ALI HAJI</div>
                    </div>
                </div>

                <!-- Title -->
                <div class="mb-4">
                    <div class="text-[10px] font-bold text-blue-600 tracking-wider uppercase">PORTAL MAGANG TERPADU</div>
                    <h2 class="text-xl sm:text-[22px] font-extrabold text-slate-900 tracking-tight mt-0.5">
                        Selamat Datang di SIMAGANG
                    </h2>
                    <p class="text-[11px] text-slate-500 mt-0.5">
                        Sistem Informasi Magang Universitas Maritim Raja Ali Haji
                    </p>
                </div>

                <!-- Google SSO Button -->
                <button type="button"
                        onclick="fillDemo('mahasiswa@simagang.ac.id')"
                        class="w-full flex items-center justify-center gap-2.5 py-2.5 px-4 bg-white hover:bg-slate-50 border border-slate-200/90 hover:border-blue-300 rounded-xl text-xs font-semibold text-slate-700 shadow-sm transition active:scale-[0.99] mb-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Login dengan Email UMRAH (SSO)</span>
                </button>

                <!-- Divider -->
                <div class="relative flex items-center justify-center my-2.5">
                    <div class="border-t border-slate-200 w-full"></div>
                    <span class="bg-white px-2.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest absolute">ATAU</span>
                </div>

                <!-- Alert Messages -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-3.5 p-3 bg-red-50 border border-red-200 border-l-4 border-l-red-500 text-red-700 text-xs rounded-lg flex items-start gap-2">
                        <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-3.5 p-3 bg-emerald-50 border border-emerald-200 border-l-4 border-l-emerald-500 text-emerald-700 text-xs rounded-lg flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>

                <!-- Form Login -->
                <form id="loginForm" action="<?= base_url('login') ?>" method="POST" class="space-y-2.5">
                    <?= csrf_field() ?>

                    <!-- Input Email / NIM -->
                    <div>
                        <label for="loginEmail" class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-1">
                            NIM / NIP / EMAIL
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <input type="text"
                                   id="loginEmail"
                                   name="email"
                                   value="<?= old('email') ?>"
                                   required
                                   placeholder="Masukkan NIM, NIP, atau email Anda"
                                   class="w-full pl-9 pr-3.5 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none text-slate-800 placeholder-slate-400 transition-all duration-200">
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="loginPassword" class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-1">
                            PASSWORD
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password"
                                   id="loginPassword"
                                   name="password"
                                   required
                                   placeholder="Masukkan password Anda"
                                   class="w-full pl-9 pr-9 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none text-slate-800 placeholder-slate-400 transition-all duration-200">
                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                                <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-xs pt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer select-none text-slate-600 text-xs">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded text-blue-600 border-slate-300 focus:ring-blue-500">
                            <span>Remember Me</span>
                        </label>
                        <a href="#" onclick="alert('Silakan hubungi administrator program studi atau Helpdesk TIK UMRAH untuk reset password akun Anda.'); return false;"
                           class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
                            Forgot Password
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button id="loginSubmitBtn" type="submit"
                            class="w-full py-2.5 px-4 bg-[#2563eb] hover:bg-[#1d4ed8] active:scale-[0.99] text-white text-xs font-bold rounded-xl shadow-md shadow-blue-500/25 hover:shadow-lg hover:shadow-blue-500/35 transition-all duration-200 flex items-center justify-center gap-1.5 mt-1">
                        <span>Login</span>
                        <span>&rarr;</span>
                    </button>

                    <!-- Panduan Magang Button (Modal Trigger) -->
                    <button type="button" onclick="openPanduanModal()"
                            class="w-full py-2 px-4 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 shadow-sm hover:border-blue-300 group">
                        <svg class="w-4 h-4 text-blue-600 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Panduan & Alur Magang</span>
                    </button>
                </form>

                <!-- Quick Demo Section -->
                <div class="mt-3 pt-3 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-1.5">
                        <div class="flex items-center gap-1.5 text-[10px] font-bold text-blue-600 tracking-wider">
                            <span>••</span>
                            <span>AKUN UJI COBA (QUICK DEMO)</span>
                        </div>
                        <span class="text-[10px] text-slate-400">1-Klik isi form</span>
                    </div>

                    <div class="grid grid-cols-2 gap-1.5">
                        <button type="button" onclick="fillDemo('mahasiswa@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">🎓</span>
                            <span class="truncate">Mahasiswa</span>
                        </button>
                        <button type="button" onclick="fillDemo('tu@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">📁</span>
                            <span class="truncate">Staf TU</span>
                        </button>
                        <button type="button" onclick="fillDemo('kaprodi@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">🏛️</span>
                            <span class="truncate">Kaprodi</span>
                        </button>
                        <button type="button" onclick="fillDemo('dosbem@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">👨‍🏫</span>
                            <span class="truncate">Dosbem</span>
                        </button>
                        <button type="button" onclick="fillDemo('dosenmk@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">📖</span>
                            <span class="truncate">Dosen MK</span>
                        </button>
                        <button type="button" onclick="fillDemo('wadek1@simagang.ac.id')"
                                class="px-2.5 py-1.5 bg-white hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 rounded-lg text-left text-[11px] font-medium text-slate-700 flex items-center gap-1.5 transition-all duration-150 hover:-translate-y-0.5 shadow-sm active:scale-95">
                            <span class="text-xs">🏛️</span>
                            <span class="truncate">Wadek 1</span>
                        </button>
                    </div>
                </div>

                <!-- Safe Login Badge -->
                <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-center gap-1.5 text-[11px] text-emerald-600 font-medium">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Login aman • Akun akademik UMRAH</span>
                </div>
            </div>

            <!-- Page Footer below Card -->
            <div class="mt-3 text-center space-y-0.5">
                <p class="text-[11px] text-slate-400">
                    Kendala akses? Hubungi pengelola magang fakultas Anda.
                </p>
                <p class="text-[11px] text-slate-400">
                    &copy; 2026 UMRAH. Hak cipta dilindungi &mdash; Kebijakan Privasi
                </p>
            </div>
        </div>
        </div><!-- end flex-1 center wrapper -->

        <!-- Bottom decorative strip: stat pills row -->
        <div class="relative z-10 flex-shrink-0 py-3 px-5 sm:px-8">
            <!-- Thin gradient divider -->
            <div class="w-full h-px mb-3" style="background: linear-gradient(90deg, transparent, rgba(99,152,235,0.25) 30%, rgba(99,152,235,0.25) 70%, transparent);"></div>

            <!-- Stat pills row -->
            <div class="flex flex-wrap items-center justify-center gap-2">
                <span class="stat-pill">
                    <span class="dot dot-green"></span>
                    <span>Sistem Online</span>
                </span>
                <span class="stat-pill">
                    <svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                    </svg>
                    <span>Terintegrasi SIAKAD</span>
                </span>
                <span class="stat-pill">
                    <svg class="w-3 h-3 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>SSO Aman & Terenkripsi</span>
                </span>
                <span class="stat-pill">
                    <span class="dot dot-amber"></span>
                    <span>MBKM 2025/2026</span>
                </span>
            </div>
        </div>
    </div>

</div>

<!-- Modal Panduan & Alur Magang (Compact Layout) -->
<div id="modalPanduan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true">
    <!-- Backdrop with blur -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closePanduanModal()"></div>

    <!-- Modal Box -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 z-10 transition-all transform animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-[#173369] to-[#2563eb] text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center text-white border border-white/20">
                    <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white tracking-tight">Panduan & Prosedur Magang</h3>
                    <p class="text-[11px] text-blue-200">Alur & Ketentuan Program Magang Mahasiswa UMRAH</p>
                </div>
            </div>
            <button type="button" onclick="closePanduanModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body: Step by Step Flow -->
        <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Step 1 -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        1
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800">Pengajuan Rekomendasi</h4>
                        <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                            Mahasiswa mengajukan permohonan surat pengantar & rekomendasi magang melalui staf TU fakultas.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        2
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800">Persetujuan & Dosbem</h4>
                        <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                            Kaprodi meninjau kelayakan mitra dan menetapkan Dosen Pembimbing (Dosbem).
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        3
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800">Pelaksanaan & Logbook</h4>
                        <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                            Pelaksanaan magang di instansi mitra, bimbingan berkala, serta pengisian logbook mingguan.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        4
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800">Ujian & Konversi MK</h4>
                        <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                            Penyusunan laporan akhir, pelaksanaan seminar/ujian, serta validasi konversi nilai oleh Dosen MK.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Notice Box -->
            <div class="p-3.5 rounded-xl bg-blue-50/70 border border-blue-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-[11px] text-blue-900 leading-relaxed">
                    Template berkas proposal, laporan, serta formulir pengajuan lengkap tersedia dan dapat diakses langsung di dalam <strong>Dashboard Mahasiswa</strong> setelah Anda login.
                </p>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
            <a href="<?= base_url('templates/Format_Proposal_Pengajuan_Konversi_Magang.docx') ?>" download
               class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-blue-600 hover:text-blue-800 transition py-1.5 px-3 rounded-lg hover:bg-blue-50">
                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Unduh Format Proposal (.docx)</span>
            </a>
            <button type="button" onclick="closePanduanModal()"
                    class="py-1.5 px-4 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- SVG ClipPath Definition for the curved hero wave -->
<svg width="0" height="0" class="absolute">
    <defs>
        <clipPath id="heroCurve" clipPathUnits="objectBoundingBox">
            <path d="M 0,0 L 0.93,0 Q 1.05,0.5 0.93,1 L 0,1 Z" />
        </clipPath>
    </defs>
</svg>

<script>
    function openPanduanModal() {
        const modal = document.getElementById('modalPanduan');
        modal.classList.remove('hidden');
    }

    function closePanduanModal() {
        const modal = document.getElementById('modalPanduan');
        modal.classList.add('hidden');
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePanduanModal();
        }
    });

    function fillDemo(email) {
        const emailInput = document.getElementById('loginEmail');
        const passInput = document.getElementById('loginPassword');
        emailInput.value = email;
        passInput.value = 'password123';
        
        // Visual feedback highlight
        emailInput.classList.add('ring-2', 'ring-blue-500');
        passInput.classList.add('ring-2', 'ring-blue-500');
        setTimeout(() => {
            emailInput.classList.remove('ring-2', 'ring-blue-500');
            passInput.classList.remove('ring-2', 'ring-blue-500');
        }, 600);
    }

    function togglePassword() {
        const passInput = document.getElementById('loginPassword');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passInput.type === 'password') {
            passInput.type = 'text';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
            `;
        } else {
            passInput.type = 'password';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
        }
    }

    // Mencegah klik berulang saat proses submit autentikasi berlangsung
    const loginForm = document.getElementById('loginForm');
    const loginSubmitBtn = document.getElementById('loginSubmitBtn');
    if (loginForm && loginSubmitBtn) {
        loginForm.addEventListener('submit', function () {
            if (loginSubmitBtn.disabled) return false;
            loginSubmitBtn.disabled = true;
            loginSubmitBtn.classList.add('opacity-80', 'cursor-not-allowed');
        });
    }
</script>
<?= $this->endSection() ?>
