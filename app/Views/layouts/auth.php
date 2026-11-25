<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIMAGANG UMRAH - Portal Magang Mahasiswa' ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo-umrah.png') ?>">

    <!-- Always ensure Login is in clean Light Mode -->
    <script>document.documentElement.classList.remove('dark');</script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        navy: { 800: '#0f2757', 900: '#0a1d3f', 950: '#06132b' }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-8px); }
        }
        @keyframes floatSlowReverse {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(8px); }
        }
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        @keyframes spinSlowReverse {
            from { transform: rotate(360deg); }
            to   { transform: rotate(0deg); }
        }
        @keyframes radarPulse {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50%       { opacity: 0.65; transform: scale(1.05); }
        }
        @keyframes cardFadeIn {
            0%   { opacity: 0; transform: translateY(16px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes heroSlideIn {
            0%   { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes driftXY {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33%       { transform: translate(14px, -10px) scale(1.04); }
            66%       { transform: translate(-10px, 10px) scale(0.97); }
        }
        @keyframes glowPulse {
            0%, 100% { opacity: 0.3; }
            50%       { opacity: 0.6; }
        }

        .anim-float      { animation: floatSlow 6s ease-in-out infinite; }
        .anim-float-rev  { animation: floatSlowReverse 7s ease-in-out infinite; }
        .anim-spin-slow  { animation: spinSlow 28s linear infinite; transform-origin: center; }
        .anim-spin-rev   { animation: spinSlowReverse 22s linear infinite; transform-origin: center; }
        .anim-radar-pulse{ animation: radarPulse 4s ease-in-out infinite; }
        .anim-card       { animation: cardFadeIn 0.5s cubic-bezier(0.16,1,0.3,1) forwards; }
        .anim-hero       { animation: heroSlideIn 0.65s cubic-bezier(0.16,1,0.3,1) forwards; }
        .anim-drift      { animation: driftXY 16s ease-in-out infinite; }
        .anim-glow       { animation: glowPulse 5s ease-in-out infinite; }

        /* Stat pill in right panel */
        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 600;
            white-space: nowrap;
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(203,213,225,0.7);
            color: #475569;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: box-shadow 0.2s, border-color 0.2s;
        }
        .stat-pill:hover { border-color: rgba(99,152,235,0.5); box-shadow: 0 2px 8px rgba(37,99,235,0.1); }
        .stat-pill .dot { width:7px; height:7px; border-radius:50%; flex-shrink:0; }
        .dot-green  { background: #22c55e; box-shadow: 0 0 6px rgba(34,197,94,0.5); }
        .dot-blue   { background: #3b82f6; box-shadow: 0 0 6px rgba(59,130,246,0.5); }
        .dot-amber  { background: #f59e0b; box-shadow: 0 0 6px rgba(245,158,11,0.5); }

        /* Feature badge */
        .feature-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(203,213,225,0.6);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .feature-badge:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(37,99,235,0.1); }

        /* Login card */
        .login-card {
            transition: box-shadow 0.3s;
        }
        .login-card:hover {
            box-shadow: 0 24px 64px rgba(23,43,77,0.12), 0 0 0 1px rgba(37,99,235,0.07) !important;
        }

        /* Subtle dot grid */
        .dot-grid {
            background-image: radial-gradient(circle, rgba(23,51,105,0.065) 1px, transparent 1px);
            background-size: 22px 22px;
        }
    </style>
</head>

<body class="text-[#172b4d] antialiased" style="background: linear-gradient(150deg, #edf1fb 0%, #f1f5fd 45%, #e9eef8 100%); min-height: 100vh;">
    <?= $this->renderSection('content') ?>
</body>

</html>
