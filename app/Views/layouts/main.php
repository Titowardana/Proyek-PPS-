<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIMAGANG' ?></title>

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

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        navy: {
                            50:  '#f0f4ff',
                            100: '#dce8ff',
                            500: '#2563eb',
                            700: '#173369',
                            800: '#112756',
                            900: '#0d1e3f',
                            950: '#081326',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', ui-sans-serif, system-ui; }

        /* Page entrance animation */
        @keyframes pageEnterAnim {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .page-enter {
            animation: pageEnterAnim 0.38s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Smooth transition when navigating */
        .page-navigating {
            opacity: 0 !important;
            transform: translateY(6px) !important;
            transition: opacity 0.22s cubic-bezier(0.4, 0, 0.2, 1), transform 0.22s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* Section highlight pulse */
        @keyframes sectionHighlightPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.45);
                border-color: #2563eb;
            }
            40% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0.15);
                border-color: #3b82f6;
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
                border-color: #e4ebf6;
            }
        }
        .section-highlight {
            animation: sectionHighlightPulse 1.8s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        }

        /* Sidebar custom scrollbar */
        #sidebar::-webkit-scrollbar { width: 4px; }
        #sidebar::-webkit-scrollbar-track { background: transparent; }
        #sidebar::-webkit-scrollbar-thumb { background: #c8d9f0; border-radius: 4px; }
        #sidebar::-webkit-scrollbar-thumb:hover { background: #90a4c3; }

        /* Smooth sidebar transition */
        #sidebar { transition: transform .25s cubic-bezier(.4,0,.2,1); }

        /* Active nav glow */
        .nav-active {
            background: #eff5ff;
            color: #2563eb;
            font-weight: 600;
        }
        .nav-active svg { color: #2563eb; }
        .nav-item:not(.nav-active):hover {
            background: #f7f9fc;
        }

        /* Tooltip for collapsed sidebar (future use) */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .dropdown-anim { animation: fadeInDown .18s ease both; }

        /* ============================================================
           DARK MODE ENGINE & INPUT CANVAS STYLES
           ============================================================ */
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
        html.dark body {
            background-color: #0b1329 !important;
            color: #e2e8f0 !important;
        }

        /* Dark Sidebar */
        html.dark #sidebar {
            background-color: #0d162a !important;
            border-color: #1a253c !important;
        }
        html.dark #sidebar .border-b,
        html.dark #sidebar .border-t {
            border-color: #1a253c !important;
        }
        html.dark #sidebar .nav-item:not(.nav-active) {
            color: #94a3b8 !important;
        }
        html.dark #sidebar .nav-item:not(.nav-active):hover {
            background-color: #152238 !important;
            color: #f1f5f9 !important;
        }
        html.dark #sidebar .nav-active {
            background-color: rgba(37, 99, 235, 0.18) !important;
            color: #60a5fa !important;
        }
        html.dark #sidebar .nav-active svg {
            color: #60a5fa !important;
        }
        html.dark #sidebar [class*="bg-[#eff5ff]"] {
            background-color: #142036 !important;
            border: 1px solid #1f3050 !important;
        }
        html.dark #sidebar [class*="text-[#173369]"] {
            color: #93c5fd !important;
        }
        html.dark #sidebar [class*="text-[#172b4d]"] {
            color: #f1f5f9 !important;
        }
        html.dark #sidebar [class*="text-[#71819d]"],
        html.dark #sidebar [class*="text-[#90a4c3]"] {
            color: #94a3b8 !important;
        }
        html.dark #sidebar::-webkit-scrollbar-thumb {
            background: #243552 !important;
        }

        /* Dark Header */
        html.dark header {
            background-color: #0d162a !important;
            border-color: #1a253c !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark header h2 {
            color: #f1f5f9 !important;
        }
        html.dark #toggleSidebar,
        html.dark #userMenuBtn,
        html.dark #themeToggleBtn {
            background-color: #131f37 !important;
            border-color: #243552 !important;
            color: #cbd5e1 !important;
        }
        html.dark #toggleSidebar:hover,
        html.dark #userMenuBtn:hover,
        html.dark #themeToggleBtn:hover {
            background-color: #1a2944 !important;
            border-color: #3b82f6 !important;
            color: #ffffff !important;
        }
        html.dark #userMenuDropdown {
            background-color: #131f37 !important;
            border-color: #243552 !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6) !important;
            color: #cbd5e1 !important;
        }
        html.dark #userMenuDropdown .border-b {
            border-color: #1e2c45 !important;
        }
        html.dark #userMenuDropdown [class*="bg-[#f7f9fc]"] {
            background-color: #0e172a !important;
        }
        html.dark #userMenuDropdown a,
        html.dark #userMenuDropdown button {
            color: #cbd5e1 !important;
        }
        html.dark #userMenuDropdown a:hover,
        html.dark #userMenuDropdown button:hover {
            background-color: #1a2944 !important;
            color: #ffffff !important;
        }
        html.dark header [class*="bg-[#f7f9fc]"] {
            background-color: #131f37 !important;
            border-color: #243552 !important;
        }
        html.dark header a.bg-white {
            background-color: #1e2c45 !important;
            color: #60a5fa !important;
            border-color: #2b3e60 !important;
        }

        /* Fix: Nama user & role di tombol header userMenuBtn — paksa terlihat di dark mode */
        html.dark #userMenuBtn span,
        html.dark #userMenuBtn div span,
        html.dark #userMenuBtn .text-left span,
        html.dark #userMenuBtn span[class*="font-semibold"],
        html.dark #userMenuBtn span[class*="text-[#172b4d]"],
        html.dark #userMenuBtn span[class*="text-[12px]"] {
            color: #f1f5f9 !important;
        }
        html.dark #userMenuBtn span[class*="text-[10px]"],
        html.dark #userMenuBtn span[class*="text-[#90a4c3]"] {
            color: #94a3b8 !important;
        }
        html.dark #userMenuBtn svg,
        html.dark #userMenuBtn svg path {
            color: #94a3b8 !important;
            stroke: #94a3b8 !important;
        }
        /* Fix: Nama & email user di dalam dropdown juga harus terlihat */
        html.dark #userMenuDropdown p {
            color: #f1f5f9 !important;
        }
        html.dark #userMenuDropdown p[class*="text-[#90a4c3]"],
        html.dark #userMenuDropdown p[class*="text-[11px]"] {
            color: #94a3b8 !important;
        }
        html.dark #userMenuDropdown .font-bold {
            color: #f1f5f9 !important;
        }
        /* Fix: Sidebar bottom user info area */
        html.dark #sidebar .text-xs.font-semibold,
        html.dark #sidebar p.font-semibold,
        html.dark #sidebar p[class*="font-semibold"],
        html.dark #sidebar p[class*="text-[#172b4d]"] {
            color: #f1f5f9 !important;
        }
        html.dark #sidebar p[class*="text-[10px]"],
        html.dark #sidebar p[class*="text-[9px]"],
        html.dark #sidebar p[class*="text-[#71819d]"] {
            color: #94a3b8 !important;
        }

        /* ============================================================
           INPUT CANVAS & FORM CONTROLS (CRITICAL FOR USER REQUIREMENT)
           Ensures NO input canvas remains white in Dark Mode
           ============================================================ */
        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="reset"]),
        html.dark textarea,
        html.dark select,
        html.dark input[type="text"],
        html.dark input[type="password"],
        html.dark input[type="email"],
        html.dark input[type="number"],
        html.dark input[type="date"],
        html.dark input[type="datetime-local"],
        html.dark input[type="url"],
        html.dark input[type="search"],
        html.dark input[type="tel"] {
            background-color: #152238 !important;
            background-image: none !important;
            color: #f8fafc !important;
            border: 1px solid #283c5d !important;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        }

        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="reset"]):focus,
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

        html.dark input[type="file"] {
            background-color: #152238 !important;
            border-color: #283c5d !important;
            color: #cbd5e1 !important;
        }

        html.dark input[type="file"]::file-selector-button {
            background-color: #1e3a6e !important;
            color: #93c5fd !important;
            border: 1px solid #2b4982 !important;
            border-radius: 6px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.2s ease;
        }

        html.dark input[type="file"]::file-selector-button:hover {
            background-color: #2563eb !important;
            color: #ffffff !important;
        }

        html.dark input[type="date"]::-webkit-calendar-picker-indicator,
        html.dark input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1) hue-rotate(180deg) brightness(1.2);
            cursor: pointer;
        }

        html.dark input:disabled,
        html.dark textarea:disabled,
        html.dark select:disabled,
        html.dark input[readonly],
        html.dark textarea[readonly] {
            background-color: #0c1424 !important;
            color: #64748b !important;
            border-color: #1a273e !important;
            cursor: not-allowed !important;
        }

        html.dark input[type="checkbox"],
        html.dark input[type="radio"] {
            background-color: #152238 !important;
            border-color: #283c5d !important;
            accent-color: #2563eb;
        }

        /* Transparent canvas tag safeguard */
        html.dark canvas {
            background-color: transparent !important;
        }

        /* ============================================================
           CARDS, CONTAINERS, STAT BOXES & SURFACES
           ============================================================ */
        html.dark .bg-white,
        html.dark div[class*="bg-white"],
        html.dark form[class*="bg-white"],
        html.dark section[class*="bg-white"],
        html.dark [class*="bg-[#ffffff]"] {
            background-color: #131f37 !important;
        }

        html.dark .bg-slate-50,
        html.dark .bg-gray-50,
        html.dark div[class*="bg-[#f7f9fc]"],
        html.dark [class*="bg-slate-50"],
        html.dark [class*="bg-gray-50"] {
            background-color: #17243c !important;
        }

        html.dark .bg-slate-100,
        html.dark .bg-gray-100 {
            background-color: #1c2b46 !important;
        }

        html.dark [class*="bg-[#eff5ff]"],
        html.dark .bg-blue-50 {
            background-color: rgba(37, 99, 235, 0.14) !important;
            border-color: rgba(37, 99, 235, 0.28) !important;
        }

        /* Borders */
        html.dark .border-slate-200,
        html.dark .border-slate-100,
        html.dark .border-slate-300,
        html.dark .border-gray-200,
        html.dark .border-gray-100,
        html.dark [class*="border-[#e4ebf6]"] {
            border-color: #1e2c45 !important;
        }

        html.dark [class*="[border-right:1px_solid_#e4ebf6]"],
        html.dark [class*="[border-bottom:1px_solid_#e4ebf6]"],
        html.dark [class*="[border-top:1px_solid_#e4ebf6]"],
        html.dark [class*="[border-left:1px_solid_#e4ebf6]"] {
            border-color: #1e2c45 !important;
        }

        /* Secondary Action Buttons (e.g. Unduh Laporan, Kembali, Detail) */
        html.dark button.bg-white,
        html.dark a.bg-white:not([class*="nav-"]) {
            background-color: #17243c !important;
            border-color: #2b3e60 !important;
            color: #93c5fd !important;
        }
        html.dark button.bg-white:hover,
        html.dark a.bg-white:not([class*="nav-"]):hover {
            background-color: #1e3050 !important;
            border-color: #3b82f6 !important;
            color: #ffffff !important;
        }

        /* Typography Colors in Dark Mode */
        html.dark h1, html.dark h2, html.dark h3, html.dark h4, html.dark h5, html.dark h6 {
            color: #f1f5f9 !important;
        }
        html.dark [class*="text-[#172b4d]"],
        html.dark .text-slate-900,
        html.dark .text-slate-800,
        html.dark .text-gray-900,
        html.dark .text-gray-800 {
            color: #f1f5f9 !important;
        }
        html.dark [class*="text-[#173369]"] {
            color: #93c5fd !important;
        }
        html.dark [class*="text-[#71819d]"],
        html.dark [class*="text-[#90a4c3]"],
        html.dark .text-slate-600,
        html.dark .text-slate-500,
        html.dark .text-gray-600,
        html.dark .text-gray-500 {
            color: #94a3b8 !important;
        }
        html.dark .text-slate-400,
        html.dark .text-gray-400 {
            color: #64748b !important;
        }
        html.dark label {
            color: #cbd5e1 !important;
        }

        /* Tables & Grids */
        html.dark table {
            border-color: #1e2c45 !important;
        }
        html.dark table thead th {
            background-color: #17243c !important;
            color: #94a3b8 !important;
            border-color: #1e2c45 !important;
        }
        html.dark table tbody tr {
            border-color: #1e2c45 !important;
        }
        html.dark table tbody tr:hover {
            background-color: #17253f !important;
        }
        html.dark table tbody td {
            border-color: #1e2c45 !important;
            color: #cbd5e1 !important;
        }
        html.dark table tbody tr.bg-slate-50 {
            background-color: #131e34 !important;
        }

        /* Modals & Dialogs */
        html.dark [role="dialog"] > div,
        html.dark [id*="modal"] > div.bg-white,
        html.dark [id*="Modal"] > div.bg-white,
        html.dark div[id*="Modal"] .bg-white,
        html.dark div[id*="modal"] .bg-white {
            background-color: #131f37 !important;
            border-color: #243552 !important;
            color: #e2e8f0 !important;
        }
        html.dark div[id*="Modal"] .bg-slate-50,
        html.dark div[id*="modal"] .bg-slate-50 {
            background-color: #17243c !important;
            border-color: #243552 !important;
        }

        /* Status Pills & Badges In Dark Mode */
        html.dark .bg-emerald-50,
        html.dark [class*="bg-[#f0fdf4]"] {
            background-color: rgba(16, 185, 129, 0.15) !important;
            border-color: rgba(16, 185, 129, 0.35) !important;
            color: #6ee7b7 !important;
        }
        html.dark .bg-amber-50,
        html.dark [class*="bg-[#fff7e8]"] {
            background-color: rgba(245, 158, 11, 0.15) !important;
            border-color: rgba(245, 158, 11, 0.35) !important;
            color: #fcd34d !important;
        }
        html.dark .bg-red-50,
        html.dark [class*="bg-[#fef2f2]"] {
            background-color: rgba(239, 68, 68, 0.15) !important;
            border-color: rgba(239, 68, 68, 0.35) !important;
            color: #fca5a5 !important;
        }

        /* Flash Messages & Alerts in Dark Mode */
        html.dark .bg-emerald-50.border-emerald-200 {
            background-color: rgba(16, 185, 129, 0.12) !important;
            border-color: rgba(16, 185, 129, 0.4) !important;
        }
        html.dark .text-emerald-800 {
            color: #6ee7b7 !important;
        }
        html.dark .text-emerald-500, html.dark .text-emerald-400 {
            color: #34d399 !important;
        }
        html.dark .bg-red-50.border-red-200 {
            background-color: rgba(239, 68, 68, 0.12) !important;
            border-color: rgba(239, 68, 68, 0.4) !important;
        }
        html.dark .text-red-800 {
            color: #fca5a5 !important;
        }
        html.dark .text-red-500, html.dark .text-red-400 {
            color: #f87171 !important;
        }
        html.dark .bg-blue-50, html.dark .bg-sky-50 {
            background-color: rgba(59, 130, 246, 0.12) !important;
            border-color: rgba(59, 130, 246, 0.35) !important;
        }
        html.dark .text-blue-800 {
            color: #93c5fd !important;
        }
        html.dark .bg-yellow-50, html.dark .bg-amber-50 {
            background-color: rgba(245, 158, 11, 0.12) !important;
            border-color: rgba(245, 158, 11, 0.35) !important;
        }
        html.dark .text-yellow-800, html.dark .text-amber-800 {
            color: #fcd34d !important;
        }

        /* Card borders & dividers */
        html.dark .border, html.dark .border-t, html.dark .border-b,
        html.dark .border-l, html.dark .border-r {
            border-color: #1e2c45 !important;
        }
        html.dark .border-\[#e4ebf6\], html.dark .border-\[#eaf0fb\] {
            border-color: #1e2c45 !important;
        }
        html.dark .divide-y > * + * {
            border-color: #1e2c45 !important;
        }

        /* Background utils in dark mode */
        html.dark .bg-white {
            background-color: #131f37 !important;
        }
        html.dark .bg-\[#f7f9fc\], html.dark .bg-\[#f8fafc\] {
            background-color: #0e1a2e !important;
        }
        html.dark .bg-\[#eff5ff\] {
            background-color: rgba(37, 99, 235, 0.15) !important;
        }
        html.dark .hover\:bg-\[#eff5ff\]:hover {
            background-color: rgba(37, 99, 235, 0.2) !important;
        }
        html.dark .shadow-sm, html.dark .shadow, html.dark .shadow-md {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4) !important;
        }

        /* ============================================================
           TARGETED FIX: Angka statistik, Badge Status, Sub-card,
           Tombol Sekunder, dan Teks Gelap di Seluruh Role
           ============================================================ */
        html.dark {
            color-scheme: dark;
        }

        /* Angka besar di kartu statistik (text-2xl, text-[27px], dst) */
        html.dark span[class*="text-2xl"],
        html.dark span[class*="text-3xl"],
        html.dark span[class*="text-4xl"],
        html.dark span[class*="text-[2"],
        html.dark h1[class*="text-[2"],
        html.dark h2[class*="text-[2"] {
            color: #f1f5f9 !important;
        }

        /* Kartu statistik: angka & sub-label */
        html.dark .bg-white span[class*="text-[#172b4d]"],
        html.dark .bg-white span[class*="text-2xl"] {
            color: #f1f5f9 !important;
        }

        /* Semua varian background netral terang & transparan (termasuk /50, /70, /80) */
        html.dark [class*="bg-white/"]:not([class*="text-white"]) {
            background-color: rgba(19, 31, 55, 0.92) !important;
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
        html.dark [class*="hover:bg-slate-50"]:hover,
        html.dark [class*="hover:bg-gray-50"]:hover {
            background-color: #1b2b47 !important;
        }
        html.dark [class*="hover:bg-slate-100"]:hover,
        html.dark [class*="hover:bg-slate-200"]:hover,
        html.dark [class*="hover:bg-gray-100"]:hover {
            background-color: #253a5e !important;
        }

        /* Semua varian background berwarna terang (-50, -100, -200, /30, /50, /80) */
        html.dark [class*="bg-emerald-50"],
        html.dark [class*="bg-emerald-100"] {
            background-color: rgba(16, 185, 129, 0.16) !important;
        }
        html.dark [class*="bg-amber-50"],
        html.dark [class*="bg-amber-100"],
        html.dark [class*="bg-yellow-50"],
        html.dark [class*="bg-yellow-100"] {
            background-color: rgba(245, 158, 11, 0.16) !important;
        }
        html.dark [class*="bg-red-50"],
        html.dark [class*="bg-red-100"],
        html.dark [class*="bg-red-200"],
        html.dark [class*="bg-rose-50"],
        html.dark [class*="bg-rose-100"] {
            background-color: rgba(239, 68, 68, 0.16) !important;
        }
        html.dark [class*="bg-blue-50"],
        html.dark [class*="bg-blue-100"],
        html.dark [class*="bg-sky-50"],
        html.dark [class*="bg-cyan-50"] {
            background-color: rgba(59, 130, 246, 0.16) !important;
        }
        html.dark [class*="bg-indigo-50"],
        html.dark [class*="bg-indigo-100"] {
            background-color: rgba(99, 102, 241, 0.18) !important;
        }
        html.dark [class*="bg-purple-50"],
        html.dark [class*="bg-purple-100"] {
            background-color: rgba(168, 85, 247, 0.18) !important;
        }

        /* Border berwarna terang agar selaras dengan dark mode */
        html.dark [class*="border-emerald-100"],
        html.dark [class*="border-emerald-200"],
        html.dark [class*="border-emerald-300"] {
            border-color: rgba(16, 185, 129, 0.35) !important;
        }
        html.dark [class*="border-amber-100"],
        html.dark [class*="border-amber-200"],
        html.dark [class*="border-amber-300"] {
            border-color: rgba(245, 158, 11, 0.35) !important;
        }
        html.dark [class*="border-red-100"],
        html.dark [class*="border-red-200"],
        html.dark [class*="border-red-300"],
        html.dark [class*="border-rose-200"] {
            border-color: rgba(239, 68, 68, 0.35) !important;
        }
        html.dark [class*="border-blue-100"],
        html.dark [class*="border-blue-200"],
        html.dark [class*="border-blue-300"],
        html.dark [class*="border-sky-200"],
        html.dark [class*="border-cyan-200"] {
            border-color: rgba(59, 130, 246, 0.35) !important;
        }
        html.dark [class*="border-indigo-200"],
        html.dark [class*="border-purple-200"] {
            border-color: rgba(139, 92, 246, 0.35) !important;
        }

        /* Teks netral gelap -> terang agar terbaca di seluruh halaman */
        html.dark .text-slate-700,
        html.dark .text-gray-700 {
            color: #e2e8f0 !important;
        }
        html.dark .text-slate-600,
        html.dark .text-gray-600 {
            color: #cbd5e1 !important;
        }
        html.dark .text-slate-500,
        html.dark .text-gray-500,
        html.dark .text-slate-400,
        html.dark .text-gray-400 {
            color: #94a3b8 !important;
        }

        /* Teks berwarna gelap di badge / alert / link -> terang & kontras */
        html.dark .text-emerald-900,
        html.dark .text-emerald-800,
        html.dark .text-emerald-700,
        html.dark .text-emerald-600 {
            color: #6ee7b7 !important;
        }
        html.dark .text-amber-900,
        html.dark .text-amber-800,
        html.dark .text-amber-700,
        html.dark .text-amber-600,
        html.dark .text-yellow-800 {
            color: #fcd34d !important;
        }
        html.dark .text-red-800,
        html.dark .text-red-700,
        html.dark .text-red-600,
        html.dark .text-rose-900,
        html.dark .text-rose-800,
        html.dark .text-rose-700,
        html.dark .text-rose-600 {
            color: #fca5a5 !important;
        }
        html.dark .text-blue-900,
        html.dark .text-blue-800,
        html.dark .text-blue-700,
        html.dark .text-blue-600 {
            color: #60a5fa !important;
        }
        html.dark .text-cyan-700,
        html.dark .text-sky-700 {
            color: #7dd3fc !important;
        }
        html.dark .text-indigo-900,
        html.dark .text-indigo-700,
        html.dark .text-indigo-600 {
            color: #a5b4fc !important;
        }
        html.dark .text-purple-900,
        html.dark .text-purple-800,
        html.dark .text-purple-700,
        html.dark .text-purple-600 {
            color: #d8b4fe !important;
        }

        /* Sidebar bottom info card: Teman perjalanan magang */
        html.dark #sidebar div[class*="bg-[#eff5ff]"] span,
        html.dark #sidebar div[class*="bg-[#eff5ff]"] p,
        html.dark #sidebar div[class*="rounded-2xl"] span,
        html.dark #sidebar div[class*="rounded-2xl"] p {
            color: #cbd5e1 !important;
        }
        html.dark #sidebar div[class*="bg-[#eff5ff]"] span[class*="text-[#173369]"],
        html.dark #sidebar div[class*="rounded-2xl"] span[class*="font-medium"] {
            color: #93c5fd !important;
        }
        html.dark #sidebar div[class*="bg-[#eff5ff]"] p[class*="text-[#71819d]"],
        html.dark #sidebar div[class*="rounded-2xl"] p[class*="leading-relaxed"] {
            color: #94a3b8 !important;
        }
        html.dark #sidebar div[class*="bg-[#eff5ff]"] a,
        html.dark #sidebar div[class*="rounded-2xl"] a {
            color: #60a5fa !important;
        }
        html.dark #sidebar div[class*="bg-[#eff5ff]"] svg,
        html.dark #sidebar div[class*="rounded-2xl"] svg {
            color: #60a5fa !important;
        }

        /* Step tracker alur layanan magang: nomor langkah belum aktif */
        html.dark div[class*="bg-[#f7f9fc]"][class*="rounded-full"],
        html.dark div[class*="bg-[#f7f9fc]"][class*="border"] {
            background-color: #17243c !important;
            border-color: #2b3e60 !important;
            color: #94a3b8 !important;
        }

        /* Kartu kalender / timeline */
        html.dark div[class*="bg-[#f7f9fc]"][class*="rounded-[10px]"],
        html.dark div[class*="bg-[#f7f9fc]"][class*="rounded-"] {
            background-color: #17243c !important;
            color: #94a3b8 !important;
        }

        /* Icon containers bg-[#eff5ff] di dalam kartu */
        html.dark span[class*="bg-[#eff5ff]"],
        html.dark div[class*="bg-[#eff5ff]"]:not(#sidebar *) {
            background-color: rgba(37, 99, 235, 0.18) !important;
        }

        /* Status badge bg-[#fff7e8] (amber / warning) */
        html.dark span[class*="bg-[#fff7e8]"],
        html.dark div[class*="bg-[#fff7e8]"] {
            background-color: rgba(245, 158, 11, 0.18) !important;
            color: #fcd34d !important;
        }
        html.dark span[class*="text-[#a46a12]"],
        html.dark p[class*="text-[#a46a12]"] {
            color: #fcd34d !important;
        }

        /* Status badge bg-[#ecf8f3] (green / success) */
        html.dark span[class*="bg-[#ecf8f3]"],
        html.dark div[class*="bg-[#ecf8f3]"] {
            background-color: rgba(16, 185, 129, 0.18) !important;
        }
        html.dark span[class*="text-[#047857]"],
        html.dark p[class*="text-[#047857]"] {
            color: #34d399 !important;
        }

        /* Tahun akademik label & badge kecil */
        html.dark span[class*="text-[#71819d]"],
        html.dark p[class*="text-[#71819d]"],
        html.dark div[class*="text-[#71819d]"] {
            color: #94a3b8 !important;
        }
        html.dark span[class*="text-[#90a4c3]"],
        html.dark p[class*="text-[#90a4c3]"],
        html.dark div[class*="text-[#90a4c3]"] {
            color: #94a3b8 !important;
        }

        /* Header page title "Dashboard SIMAGANG" */
        html.dark header span[class*="font-semibold"],
        html.dark header span[class*="font-medium"],
        html.dark header h2 {
            color: #f1f5f9 !important;
        }

        /* UMRAH label di sidebar bawah */
        html.dark #sidebar .text-\[#173369\] {
            color: #93c5fd !important;
        }
        html.dark #sidebar span[class*="text-[#173369]"],
        html.dark #sidebar p[class*="text-[#173369]"] {
            color: #93c5fd !important;
        }

        /* Tahun akademik text di header area konten */
        html.dark span[class*="text-[#71819d]"][class*="text-xs"],
        html.dark span[class*="text-[#71819d]"][class*="text-sm"] {
            color: #94a3b8 !important;
        }

        /* Mobile Responsive Polish */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .overflow-x-auto { -webkit-overflow-scrolling: touch; }
        @media (max-width: 639px) {
            table th, table td {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
        }

        /* Pastikan teks body global di dark mode */
        html.dark body,
        html.dark #app,
        html.dark main {
            color: #cbd5e1;
        }
    </style>
</head>
<body class="bg-[#f7f9fc] font-sans text-[#172b4d] antialiased">

<?= view('components/login_curtain') ?>

<div id="dashboardShell" class="min-h-screen flex">

    <!-- ============ SIDEBAR ============ -->
    <aside id="sidebar"
        class="w-[264px] flex-shrink-0 bg-white border-r border-[#e4ebf6] flex flex-col
               fixed inset-y-0 left-0 z-30 md:sticky md:top-0 md:h-screen md:overflow-y-auto
               -translate-x-full md:translate-x-0">

        <!-- Brand -->
        <div class="flex items-center gap-[12px] px-5 py-5 flex-shrink-0 border-b border-[#e4ebf6]">
            <div class="w-[48px] h-[48px] rounded-xl bg-white border border-[#e4ebf6] p-1 flex items-center justify-center flex-shrink-0 shadow-sm overflow-hidden">
                <img src="<?= base_url('assets/images/logo-simagang.png') ?>?v=2" alt="Logo SIMAGANG" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col gap-[2px]">
                <span class="text-[20px] font-bold text-[#173369] leading-tight tracking-tight">SIMAGANG</span>
                <span class="text-[9px] font-normal text-[#71819d] uppercase tracking-widest">Portal Magang Terpadu</span>
            </div>
        </div>

        <?php
        $role       = session()->get('role');
        $activeRole = session()->get('active_role') ?? ($role === 'dosen' ? 'dosen_pembimbing' : $role);
        $isWadek    = ($role === 'wadek1' || session()->get('is_wadek') === true);
        ?>

        <!-- Role badge -->
        <div class="px-5 pt-4 pb-1 flex-shrink-0">
            <span class="text-[10px] font-normal text-[#90a4c3] block mb-[6px]">
                Role: <?= ucfirst(str_replace('_', ' ', $role === 'dosen' ? $activeRole : $role)) ?>
            </span>
        </div>

        <!-- Navigation -->
        <?php
        $currentUri = uri_string();
        $isActive = function(string $pattern, bool $isDash = false) use ($currentUri): bool {
            if ($isDash) return in_array($currentUri, ['dashboard','','/',]);
            return url_is($pattern.'*') || str_starts_with($currentUri, $pattern);
        };
        $navCls = function(string $p, bool $d=false) use ($isActive): string {
            return $isActive($p,$d) ? 'nav-item nav-active' : 'nav-item';
        };
        $iconCls = function(string $p, bool $d=false) use ($isActive): string {
            return $isActive($p,$d) ? 'text-[#2563eb]' : 'text-[#71819d]';
        };
        ?>
        <nav class="px-5 py-2 space-y-[3px] flex-1 overflow-y-auto text-[12px] font-medium">

            <!-- Dashboard (all roles) -->
            <a href="<?= base_url('dashboard') ?>"
               class="<?= $navCls('dashboard', true) ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dashboard', true) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- MAHASISWA -->
            <?php if ($role === 'mahasiswa'): ?>
                <a href="<?= base_url('mahasiswa/pendaftaran') ?>"
                   class="<?= $navCls('mahasiswa/pendaftaran') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('mahasiswa/pendaftaran') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Pendaftaran Magang</span>
                </a>
                <a href="<?= base_url('mahasiswa/logbook') ?>"
                   class="<?= $navCls('mahasiswa/logbook') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('mahasiswa/logbook') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Jurnal &amp; Logbook</span>
                </a>
                <a href="<?= base_url('mahasiswa/konversi') ?>"
                   class="<?= $navCls('mahasiswa/konversi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('mahasiswa/konversi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                    </svg>
                    <span>Konversi MK Pilihan</span>
                </a>
                <a href="<?= base_url('mahasiswa/seminar') ?>"
                   class="<?= $navCls('mahasiswa/seminar') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('mahasiswa/seminar') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span>Seminar Magang</span>
                </a>
                <a href="<?= base_url('mahasiswa/penilaian') ?>"
                   class="<?= $navCls('mahasiswa/penilaian') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('mahasiswa/penilaian') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Pengumpulan &amp; Nilai</span>
                </a>
            <?php endif; ?>

            <!-- TU -->
            <?php if ($role === 'tu'): ?>
                <a href="<?= base_url('tu/verifikasi-dokumen') ?>"
                   class="<?= $navCls('tu/verifikasi-dokumen') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('tu/verifikasi-dokumen') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Verifikasi Dokumen TU</span>
                </a>
            <?php endif; ?>

            <!-- KAPRODI -->
            <?php if ($role === 'kaprodi'): ?>
                <a href="<?= base_url('kaprodi/penentuan-pembimbing') ?>"
                   class="<?= $navCls('kaprodi/penentuan-pembimbing') ?> flex items-center justify-between gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <span class="flex items-center gap-[10px]">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('kaprodi/penentuan-pembimbing') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Penentuan Pembimbing
                    </span>
                </a>
                <a href="<?= base_url('kaprodi/konversi') ?>"
                   class="<?= $navCls('kaprodi/konversi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('kaprodi/konversi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                    </svg>
                    <span>Pemantauan Konversi</span>
                </a>
                <a href="<?= base_url('kaprodi/dosen') ?>"
                   class="<?= $navCls('kaprodi/dosen') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('kaprodi/dosen') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Kelola Role Dosen</span>
                </a>
            <?php endif; ?>

            <!-- DOSEN -->
            <?php if (in_array($role, ['dosen','dosen_pembimbing','dosen_mk'])): ?>
                <?php if ($activeRole === 'dosen_pembimbing'): ?>
                    <div class="pt-3 pb-1">
                        <span class="px-2 text-[10px] font-bold uppercase tracking-widest text-[#90a4c3]">Menu Pembimbing</span>
                    </div>
                    <a href="<?= base_url('dosen-pembimbing/pemantauan-logbook') ?>"
                       class="<?= $navCls('dosen-pembimbing/pemantauan-logbook') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dosen-pembimbing/pemantauan-logbook') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Pemantauan Logbook</span>
                    </a>
                    <a href="<?= base_url('dosen-pembimbing/konversi') ?>"
                       class="<?= $navCls('dosen-pembimbing/konversi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dosen-pembimbing/konversi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Verifikasi Konversi</span>
                    </a>
                <?php elseif ($activeRole === 'dosen_mk'): ?>
                    <div class="pt-3 pb-1">
                        <span class="px-2 text-[10px] font-bold uppercase tracking-widest text-[#90a4c3]">Menu Pengampu MK</span>
                    </div>
                    <a href="<?= base_url('dosen-mk/konversi') ?>"
                       class="<?= $navCls('dosen-mk/konversi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dosen-mk/konversi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Verifikasi MK Pengampu</span>
                    </a>
                    <a href="<?= base_url('dosen-mk/seminar') ?>"
                       class="<?= $navCls('dosen-mk/seminar') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dosen-mk/seminar') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Seminar Magang</span>
                    </a>
                    <a href="<?= base_url('dosen-mk/penilaian') ?>"
                       class="<?= $navCls('dosen-mk/penilaian') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('dosen-mk/penilaian') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Penilaian &amp; Pengumpulan</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <!-- WADEK1 -->
            <?php if ($role === 'wadek1' || ($isWadek && $activeRole === 'wadek1')): ?>
                <a href="<?= base_url('wadek1/pemantauan-magang') ?>"
                   class="<?= $navCls('wadek1/pemantauan-magang') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('wadek1/pemantauan-magang') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <span>Pemantauan Magang</span>
                </a>
                <a href="<?= base_url('wadek1/konversi') ?>"
                   class="<?= $navCls('wadek1/konversi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('wadek1/konversi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Validasi Konversi MK</span>
                </a>
            <?php endif; ?>

            <!-- ADMIN -->
            <?php if ($role === 'admin'): ?>
                <?php foreach (['kaprodi' => 'Kelola Kaprodi', 'instansi' => 'Kelola Instansi Magang'] as $t => $lbl): ?>
                    <a href="<?= base_url("admin/users/$t") ?>"
                       class="<?= $navCls("admin/users/$t") ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls("admin/users/$t") ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span><?= $lbl ?></span>
                    </a>
                <?php endforeach; ?>
                <a href="<?= base_url('admin/kriteria-instansi') ?>"
                   class="<?= $navCls('admin/kriteria-instansi') ?> flex items-center gap-[10px] px-3 py-3 rounded-[10px] text-[#172b4d] transition-colors">
                    <svg class="w-[18px] h-[18px] flex-shrink-0 <?= $iconCls('admin/kriteria-instansi') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Kriteria Penilaian Instansi</span>
                </a>
            <?php endif; ?>
        </nav>

        <!-- Sidebar Bottom Info Card -->
        <div class="px-5 py-4 flex-shrink-0 border-t border-[#e4ebf6] space-y-3">
            <?php if ($role === 'mahasiswa'): ?>
                <div class="bg-[#eff5ff] rounded-2xl p-4 space-y-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="text-[13px] font-medium text-[#173369]">Teman perjalanan magang</span>
                    </div>
                    <p class="text-[11px] text-[#71819d] leading-relaxed">Alur, dokumen, dan ketentuan magang dalam satu panduan.</p>
                    <a href="<?= base_url('templates/Format_Proposal_Pengajuan_Konversi_Magang.docx') ?>" download class="inline-block text-[11px] font-medium text-[#2563eb] hover:underline">
                        Buka panduan &rarr;
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-[#eff5ff] rounded-2xl p-4 space-y-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="text-[13px] font-medium text-[#173369]">Keputusan yang terarah</span>
                    </div>
                    <p class="text-[11px] text-[#71819d] leading-relaxed">Panduan persetujuan, pembimbing, dan konversi akademik.</p>
                </div>
            <?php endif; ?>

            <!-- UMRAH Branding & User Mini Profile -->
            <div class="pt-1 space-y-2">
                <div>
                    <div class="text-[18px] font-bold text-[#173369] leading-none">UMRAH</div>
                    <div class="text-[9px] font-semibold text-[#71819d] tracking-wider uppercase mt-0.5">Universitas Maritim Raja Ali Haji</div>
                </div>
                <div class="w-full h-px bg-[#e4ebf6]"></div>
                <div class="flex items-center justify-between gap-2 pt-0.5">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-[#173369] text-white flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                            <?= strtoupper(substr(session()->get('userName') ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-[#172b4d] truncate leading-tight"><?= session()->get('userName') ?></p>
                            <p class="text-[10px] text-[#71819d] capitalize leading-tight"><?= str_replace('_', ' ', $role === 'dosen' ? $activeRole : $role) ?></p>
                        </div>
                    </div>
                    <a href="<?= base_url('logout') ?>" title="Keluar (Logout)" class="p-1.5 text-slate-400 hover:text-red-600 transition flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- ============ MAIN CONTENT ============ -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Header -->
        <header class="bg-white border-b border-[#e4ebf6] px-3.5 sm:px-6 py-3 sm:py-3.5 flex items-center justify-between gap-2 sticky top-0 z-20 shadow-[0_1px_3px_rgba(23,43,77,0.06)]">
            <div class="flex items-center gap-2.5 sm:gap-3 min-w-0 flex-1">
                <!-- Mobile hamburger -->
                <button id="toggleSidebar" class="md:hidden text-[#71819d] hover:text-[#172b4d] p-2 rounded-xl border border-[#e4ebf6] hover:bg-[#f7f9fc] transition flex-shrink-0" aria-label="Buka Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h2 class="text-[13px] sm:text-[14px] font-semibold text-[#172b4d] truncate"><?= $title ?? 'SIMAGANG' ?></h2>
            </div>

            <div class="flex items-center gap-2.5 sm:gap-3">
                <!-- Theme Toggle Button (Dark / Light Mode) -->
                <button type="button" id="themeToggleBtn" onclick="toggleThemeMode()"
                        class="p-2 rounded-xl bg-[#f7f9fc] hover:bg-[#eff5ff] border border-[#e4ebf6] text-[#71819d] hover:text-[#173369] transition duration-150 flex items-center justify-center focus:outline-none"
                        title="Beralih Mode Gelap/Terang" aria-label="Beralih Mode Gelap/Terang">
                    <!-- Sun Icon (Active when dark) -->
                    <svg id="themeSunIcon" class="w-4 h-4 text-amber-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon Icon (Active when light) -->
                    <svg id="themeMoonIcon" class="w-4 h-4 text-slate-600 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- Dosen Role Switcher (header) -->
                <?php if ($role === 'dosen' || $isWadek): ?>
                    <div class="hidden sm:inline-flex items-center bg-[#f7f9fc] border border-[#e4ebf6] p-1 rounded-lg text-xs">
                        <span class="text-[#90a4c3] font-medium px-2 text-[11px] uppercase tracking-wider">Peran:</span>
                        <a href="<?= base_url('switch-role/dosen_pembimbing') ?>"
                           class="px-2.5 py-1 rounded font-semibold transition <?= $activeRole === 'dosen_pembimbing' ? 'bg-white text-[#2563eb] shadow-sm border border-[#e4ebf6]' : 'text-[#71819d] hover:text-[#172b4d]' ?>">
                            👨‍🏫 Pembimbing
                        </a>
                        <a href="<?= base_url('switch-role/dosen_mk') ?>"
                           class="px-2.5 py-1 rounded font-semibold transition <?= $activeRole === 'dosen_mk' ? 'bg-white text-[#2563eb] shadow-sm border border-[#e4ebf6]' : 'text-[#71819d] hover:text-[#172b4d]' ?>">
                            📚 Pengampu MK
                        </a>
                        <?php if ($isWadek): ?>
                        <a href="<?= base_url('switch-role/wadek1') ?>"
                           class="px-2.5 py-1 rounded font-semibold transition <?= $activeRole === 'wadek1' ? 'bg-white text-[#2563eb] shadow-sm border border-[#e4ebf6]' : 'text-[#71819d] hover:text-[#172b4d]' ?>">
                            Wadek 1
                        </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <button id="userMenuBtn"
                        class="flex items-center gap-2.5 bg-[#f7f9fc] hover:bg-[#eff5ff] border border-[#e4ebf6] p-1.5 pr-3 rounded-xl transition focus:outline-none">
                        <div class="w-7 h-7 rounded-lg bg-[#173369] text-white font-bold text-xs flex items-center justify-center uppercase flex-shrink-0">
                            <?= strtoupper(substr(session()->get('userName') ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="text-left hidden sm:block">
                            <span class="text-[12px] font-semibold text-[#172b4d] block leading-tight"><?= session()->get('userName') ?></span>
                            <span class="text-[10px] text-[#90a4c3] capitalize block leading-tight"><?= str_replace('_', ' ', $role === 'dosen' ? $activeRole : $role) ?></span>
                        </div>
                        <svg class="w-3.5 h-3.5 text-[#90a4c3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="userMenuDropdown"
                        class="hidden dropdown-anim absolute right-0 mt-2 w-56 bg-white border border-[#e4ebf6] rounded-xl shadow-lg shadow-blue-900/5 py-1.5 text-sm text-[#172b4d] z-50">
                        <div class="px-4 py-2.5 border-b border-[#e4ebf6]">
                            <p class="font-bold text-[#172b4d] truncate text-[13px]"><?= session()->get('userName') ?></p>
                            <p class="text-[11px] text-[#90a4c3] truncate"><?= session()->get('userEmail') ?></p>
                        </div>

                        <?php if ($role === 'dosen' || $isWadek): ?>
                            <div class="py-1.5 border-b border-[#e4ebf6] bg-[#f7f9fc]">
                                <span class="block px-4 py-1 text-[10px] font-bold text-[#90a4c3] uppercase tracking-wider">Ganti Mode Peran</span>
                                <a href="<?= base_url('switch-role/dosen_pembimbing') ?>"
                                   class="flex items-center justify-between px-4 py-1.5 text-xs hover:bg-[#eff5ff] transition <?= $activeRole === 'dosen_pembimbing' ? 'font-bold text-[#2563eb] bg-blue-50/50' : 'text-[#172b4d]' ?>">
                                    <span>👨‍🏫 Dosen Pembimbing</span>
                                    <?php if ($activeRole === 'dosen_pembimbing'): ?><span class="text-[#2563eb] font-bold">✓</span><?php endif; ?>
                                </a>
                                <a href="<?= base_url('switch-role/dosen_mk') ?>"
                                   class="flex items-center justify-between px-4 py-1.5 text-xs hover:bg-[#eff5ff] transition <?= $activeRole === 'dosen_mk' ? 'font-bold text-[#2563eb] bg-blue-50/50' : 'text-[#172b4d]' ?>">
                                    <span>📚 Dosen Pengampu MK</span>
                                    <?php if ($activeRole === 'dosen_mk'): ?><span class="text-[#2563eb] font-bold">✓</span><?php endif; ?>
                                </a>
                                <?php if ($isWadek): ?>
                                <a href="<?= base_url('switch-role/wadek1') ?>"
                                   class="flex items-center justify-between px-4 py-1.5 text-xs hover:bg-[#eff5ff] transition <?= $activeRole === 'wadek1' ? 'font-bold text-[#2563eb] bg-blue-50/50' : 'text-[#172b4d]' ?>">
                                    <span>Wadek 1</span>
                                    <?php if ($activeRole === 'wadek1'): ?><span class="text-[#2563eb] font-bold">✓</span><?php endif; ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Theme Toggle inside User Menu -->
                        <button type="button" onclick="toggleThemeMode()"
                                class="w-full flex items-center justify-between px-4 py-2 text-xs text-[#172b4d] hover:bg-[#eff5ff] transition border-b border-[#e4ebf6] focus:outline-none">
                            <span class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                                <span>Mode Tema</span>
                            </span>
                            <span id="themeMenuLabel" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-200">Terang</span>
                        </button>

                        <a href="<?= base_url('logout') ?>"
                           class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar (Logout)
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-3.5 sm:px-6 pt-3 sm:pt-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-3 sm:mb-4 p-3 sm:p-3.5 bg-emerald-50 border border-emerald-200 border-l-4 border-l-emerald-500 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-3 sm:mb-4 p-3 sm:p-3.5 bg-red-50 border border-red-200 border-l-4 border-l-red-500 text-red-800 text-xs sm:text-sm rounded-xl flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Page Content -->
        <main class="px-3.5 sm:px-6 pb-8 sm:pb-10 pt-1.5 sm:pt-2 flex-1 page-enter">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<!-- Mobile sidebar overlay -->
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/40 z-20 md:hidden backdrop-blur-sm"></div>

<script>
    // Smooth page exit transition when navigating
    document.addEventListener('DOMContentLoaded', () => {
        const mainEl = document.querySelector('main');
        document.querySelectorAll('a[href]:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"]):not([download])').forEach(link => {
            link.addEventListener('click', function(e) {
                // Check same origin and no modifier keys
                if (this.hostname === window.location.hostname && !e.ctrlKey && !e.metaKey && !e.shiftKey) {
                    if (mainEl && !this.getAttribute('onclick')) {
                        mainEl.classList.add('page-navigating');
                    }
                }
            });
        });
    });

    // Mobile sidebar toggle
    const toggleBtn     = document.getElementById('toggleSidebar');
    const sidebar       = document.getElementById('sidebar');
    const overlay       = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (overlay)   overlay.addEventListener('click', closeSidebar);

    // User menu dropdown
    const userMenuBtn      = document.getElementById('userMenuBtn');
    const userMenuDropdown = document.getElementById('userMenuDropdown');
    if (userMenuBtn && userMenuDropdown) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenuDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', () => userMenuDropdown.classList.add('hidden'));
    }

    // Theme Switcher Engine (Dark / Light Mode)
    function syncThemeUI() {
        const isDark = document.documentElement.classList.contains('dark');
        const sunIcon = document.getElementById('themeSunIcon');
        const moonIcon = document.getElementById('themeMoonIcon');
        const menuLabel = document.getElementById('themeMenuLabel');

        if (sunIcon && moonIcon) {
            if (isDark) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }

        if (menuLabel) {
            menuLabel.textContent = isDark ? 'Gelap' : 'Terang';
            if (isDark) {
                menuLabel.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-800 text-amber-300 border border-slate-700';
            } else {
                menuLabel.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-200';
            }
        }
    }

    function toggleThemeMode() {
        document.documentElement.classList.add('theme-transition');
        const isDark = document.documentElement.classList.contains('dark');

        if (isDark) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('simagang_theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('simagang_theme', 'dark');
        }

        syncThemeUI();

        setTimeout(() => {
            document.documentElement.classList.remove('theme-transition');
        }, 300);
    }

    // Run theme sync on initial load
    syncThemeUI();
</script>

<?= $this->renderSection('modals') ?>
<?= $this->renderSection('scripts') ?>

</body>
</html>
