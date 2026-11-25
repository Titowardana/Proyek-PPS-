<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIMAGANG - Portal Penilaian Instansi' ?></title>

    <!-- Theme State Initializer (Prevents White Flash) -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('simagang_theme');
                if (savedTheme === 'dark' || (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#f0f4f8',
                            100: '#d9e2ec',
                            500: '#334e68',
                            600: '#243b53',
                            700: '#102a43',
                            800: '#091e36',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        html.dark {
            color-scheme: dark;
        }

        /* Smooth Theme Transition */
        html.theme-transition,
        html.theme-transition *,
        html.theme-transition *:before,
        html.theme-transition *:after {
            transition: background-color 0.22s ease, border-color 0.22s ease, color 0.18s ease !important;
            transition-delay: 0 !important;
        }

        /* Dark Body Canvas */
        html.dark {
            color-scheme: dark;
        }
        html.dark body {
            background-color: #0b1329 !important;
            color: #e2e8f0 !important;
        }

        /* Dark Header & Footer */
        html.dark header,
        html.dark footer {
            background-color: #0d162a !important;
            border-color: #1a253c !important;
        }

        /* Dark Cards & Surfaces */
        html.dark .bg-white,
        html.dark [class*="bg-white/"] {
            background-color: #131f37 !important;
        }
        html.dark [class*="bg-slate-50"],
        html.dark [class*="bg-gray-50"] {
            background-color: #16233b !important;
        }
        html.dark [class*="bg-slate-100"],
        html.dark [class*="bg-gray-100"] {
            background-color: #1c2c48 !important;
        }
        html.dark [class*="bg-slate-200"],
        html.dark [class*="bg-gray-200"] {
            background-color: #233657 !important;
        }
        html.dark [class*="bg-emerald-50"],
        html.dark [class*="bg-emerald-100"] {
            background-color: rgba(16, 185, 129, 0.16) !important;
        }
        html.dark [class*="bg-amber-50"],
        html.dark [class*="bg-amber-100"],
        html.dark [class*="bg-yellow-50"] {
            background-color: rgba(245, 158, 11, 0.16) !important;
        }
        html.dark [class*="bg-red-50"],
        html.dark [class*="bg-red-100"] {
            background-color: rgba(239, 68, 68, 0.16) !important;
        }
        html.dark [class*="bg-blue-50"],
        html.dark [class*="bg-blue-100"] {
            background-color: rgba(59, 130, 246, 0.16) !important;
        }
        html.dark .border-slate-200,
        html.dark .border-slate-300,
        html.dark .border-slate-100 {
            border-color: #1e2c45 !important;
        }

        /* Typography */
        html.dark h1, html.dark h2, html.dark h3, html.dark h4 {
            color: #f1f5f9 !important;
        }
        html.dark .text-slate-900,
        html.dark .text-slate-800 {
            color: #f1f5f9 !important;
        }
        html.dark .text-slate-700,
        html.dark .text-gray-700 {
            color: #e2e8f0 !important;
        }
        html.dark .text-slate-600,
        html.dark .text-slate-500,
        html.dark .text-slate-400 {
            color: #94a3b8 !important;
        }
        html.dark .text-emerald-800,
        html.dark .text-emerald-700,
        html.dark .text-emerald-600 {
            color: #6ee7b7 !important;
        }
        html.dark .text-amber-800,
        html.dark .text-amber-700,
        html.dark .text-amber-600 {
            color: #fcd34d !important;
        }
        html.dark .text-red-800,
        html.dark .text-red-700,
        html.dark .text-red-600 {
            color: #fca5a5 !important;
        }
        html.dark .text-blue-800,
        html.dark .text-blue-700,
        html.dark .text-blue-600 {
            color: #60a5fa !important;
        }
        html.dark label {
            color: #cbd5e1 !important;
        }
        html.dark table thead th {
            background-color: #17243c !important;
            color: #94a3b8 !important;
            border-color: #1e2c45 !important;
        }
        html.dark table tbody td,
        html.dark table tbody tr {
            border-color: #1e2c45 !important;
        }

        /* Input Canvas & Form Controls */
        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="reset"]),
        html.dark textarea,
        html.dark select {
            background-color: #152238 !important;
            background-image: none !important;
            color: #f8fafc !important;
            border: 1px solid #283c5d !important;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        }

        html.dark input:focus,
        html.dark textarea:focus,
        html.dark select:focus {
            background-color: #192a47 !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25), inset 0 1px 2px rgba(0, 0, 0, 0.3) !important;
            color: #ffffff !important;
            outline: none !important;
        }

        html.dark input::placeholder,
        html.dark textarea::placeholder {
            color: #64748b !important;
        }

        html.dark select option {
            background-color: #0f172a !important;
            color: #f8fafc !important;
        }

        html.dark input:disabled,
        html.dark textarea:disabled,
        html.dark select:disabled {
            background-color: #0c1424 !important;
            color: #64748b !important;
            border-color: #1a273e !important;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col">
    <?= view('components/login_curtain') ?>
    <!-- Top Navigation Bar (Tanpa Sidebar) -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
            <!-- Brand / Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center font-black text-white shadow-sm text-base">
                    S
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="font-extrabold text-slate-900 tracking-tight text-base">SIMAGANG</span>
                        <span class="hidden sm:inline-block px-2 py-0.5 rounded-full bg-blue-50 border border-blue-200 text-[10px] font-bold text-blue-700">
                            Mitra Instansi
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-500 hidden sm:block">Portal Penilaian Praktikan Magang</p>
                </div>
            </div>

            <!-- User Info, Theme Toggle & Logout -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Theme Toggle Button -->
                <button type="button" onclick="toggleInstansiTheme()"
                        class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-amber-400 transition"
                        title="Beralih Mode Gelap/Terang" aria-label="Beralih Mode Gelap/Terang">
                    <svg id="instansiThemeSunIcon" class="w-4 h-4 text-amber-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg id="instansiThemeMoonIcon" class="w-4 h-4 text-slate-600 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <div class="text-right hidden sm:block">
                    <span class="text-xs font-bold text-slate-800 block leading-tight"><?= esc(session()->get('userName') ?? '') ?></span>
                    <span class="text-[11px] text-slate-400 block leading-tight"><?= esc(session()->get('userEmail') ?? '') ?></span>
                </div>

                <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                <a href="<?= base_url('logout') ?>" 
                   onclick="return confirm('Keluar dari portal penilaian instansi?')"
                   class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 border border-red-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main id="dashboardShell" class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-5 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 text-xs sm:text-sm rounded-r-xl shadow-xs flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 text-xs sm:text-sm rounded-r-xl shadow-xs flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto py-4">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center text-xs text-slate-400">
            &copy; <?= date('Y') ?> SIMAGANG &bull; Portal Penilaian Praktikan Magang oleh Instansi Mitra.
        </div>
    </footer>

    <script>
        function syncInstansiThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const sunIcon = document.getElementById('instansiThemeSunIcon');
            const moonIcon = document.getElementById('instansiThemeMoonIcon');
            if (sunIcon && moonIcon) {
                if (isDark) {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                } else {
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                }
            }
        }

        function toggleInstansiTheme() {
            document.documentElement.classList.add('theme-transition');
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('simagang_theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('simagang_theme', 'dark');
            }
            syncInstansiThemeUI();
            setTimeout(() => {
                document.documentElement.classList.remove('theme-transition');
            }, 300);
        }

        syncInstansiThemeUI();
    </script>
</body>
</html>

