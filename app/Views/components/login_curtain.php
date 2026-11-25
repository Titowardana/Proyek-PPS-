<?php if (session()->getFlashdata('login_transition')): ?>
<!-- Split Curtain Reveal Transition (Hanya aktif tepat setelah login berhasil) -->
<style>
    #simagang-curtain-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        pointer-events: auto;
        overflow: hidden;
        user-select: none;
    }

    .simagang-curtain-panel {
        position: fixed;
        left: 0;
        right: 0;
        height: 50vh;
        height: 50dvh;
        will-change: transform;
        transition: transform 950ms cubic-bezier(0.77, 0, 0.175, 1);
    }

    #simagang-curtain-top {
        top: 0;
        background:
            radial-gradient(ellipse 75% 80% at 50% 100%, rgba(20, 184, 166, 0.20) 0%, rgba(37, 99, 235, 0.16) 42%, transparent 75%),
            linear-gradient(175deg, #06132b 0%, #0b224d 55%, #11336e 100%);
        border-bottom: 1px solid rgba(94, 234, 212, 0.25);
        box-shadow: 0 12px 40px rgba(6, 19, 43, 0.45);
    }

    #simagang-curtain-bottom {
        bottom: 0;
        background:
            radial-gradient(ellipse 75% 80% at 50% 0%, rgba(37, 99, 235, 0.20) 0%, rgba(20, 184, 166, 0.14) 42%, transparent 75%),
            linear-gradient(5deg, #06132b 0%, #0b224d 55%, #11336e 100%);
        border-top: 1px solid rgba(96, 165, 250, 0.25);
        box-shadow: 0 -12px 40px rgba(6, 19, 43, 0.45);
    }

    #simagang-curtain-seam {
        position: fixed;
        left: 0;
        right: 0;
        top: 50%;
        height: 2px;
        transform: translateY(-50%) scaleX(1);
        background: linear-gradient(90deg, transparent 5%, rgba(59, 130, 246, 0.55) 28%, rgba(45, 212, 191, 0.85) 50%, rgba(59, 130, 246, 0.55) 72%, transparent 95%);
        box-shadow: 0 0 18px rgba(45, 212, 191, 0.45);
        transition: opacity 420ms ease, transform 520ms cubic-bezier(0.22, 1, 0.36, 1);
        pointer-events: none;
    }

    #simagang-curtain-emblem {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale(1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        z-index: 10000;
        pointer-events: none;
        transition: opacity 420ms ease, transform 520ms cubic-bezier(0.22, 1, 0.36, 1);
    }

    #simagang-curtain-emblem .emblem-badge {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.96);
        padding: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow:
            0 12px 32px rgba(6, 19, 43, 0.45),
            0 0 0 1px rgba(94, 234, 212, 0.35),
            0 0 28px rgba(20, 184, 166, 0.25);
    }

    #simagang-curtain-emblem .emblem-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.26em;
        color: #cbd5e1;
        text-transform: uppercase;
        text-shadow: 0 1px 8px rgba(6, 19, 43, 0.7);
    }

    /* State terbuka */
    #simagang-curtain-overlay.is-opening {
        pointer-events: none;
    }
    #simagang-curtain-overlay.is-opening #simagang-curtain-top {
        transform: translateY(-102%);
    }
    #simagang-curtain-overlay.is-opening #simagang-curtain-bottom {
        transform: translateY(102%);
    }
    #simagang-curtain-overlay.is-opening #simagang-curtain-seam {
        opacity: 0;
        transform: translateY(-50%) scaleX(1.15);
    }
    #simagang-curtain-overlay.is-opening #simagang-curtain-emblem {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.86);
    }

    /* Efek kemunculan halus pada dashboard di balik tirai */
    .curtain-dashboard-ready {
        opacity: 0.65;
        transform: scale(0.975);
        transform-origin: center top;
        transition: opacity 900ms cubic-bezier(0.22, 1, 0.36, 1), transform 950ms cubic-bezier(0.22, 1, 0.36, 1);
    }
    .curtain-dashboard-ready.is-revealed {
        opacity: 1;
        transform: scale(1);
    }

    /* Aksesibilitas: kurangi animasi bila pengguna mengaktifkan prefers-reduced-motion */
    @media (prefers-reduced-motion: reduce) {
        .simagang-curtain-panel,
        #simagang-curtain-seam,
        #simagang-curtain-emblem,
        .curtain-dashboard-ready {
            transition: opacity 150ms ease !important;
            transform: none !important;
        }
        #simagang-curtain-overlay.is-opening {
            opacity: 0;
        }
    }
</style>

<div id="simagang-curtain-overlay" aria-hidden="true">
    <div id="simagang-curtain-top" class="simagang-curtain-panel"></div>
    <div id="simagang-curtain-bottom" class="simagang-curtain-panel"></div>
    <div id="simagang-curtain-seam"></div>
    <div id="simagang-curtain-emblem">
        <div class="emblem-badge">
            <img src="<?= base_url('assets/images/logo-simagang.png') ?>?v=2" alt="SIMAGANG" style="width:100%;height:100%;object-fit:contain;">
        </div>
        <span class="emblem-label">SIMAGANG</span>
    </div>
</div>

<script>
    (function () {
        const overlay = document.getElementById('simagang-curtain-overlay');
        if (!overlay) return;

        const shell = document.getElementById('dashboardShell');
        const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (shell && !prefersReduced) {
            shell.classList.add('curtain-dashboard-ready');
        }

        function startReveal() {
            if (prefersReduced) {
                overlay.classList.add('is-opening');
                setTimeout(() => overlay.remove(), 180);
                return;
            }

            // Pastikan frame awal sudah ter-paint sebelum animasi tirai dibuka
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    overlay.classList.add('is-opening');
                    if (shell) {
                        shell.classList.add('is-revealed');
                    }
                });
            });

            // Bersihkan overlay & class transform setelah animasi selesai (950ms + buffer)
            setTimeout(() => {
                if (shell) {
                    shell.classList.remove('curtain-dashboard-ready', 'is-revealed');
                }
                overlay.remove();
            }, 1000);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', startReveal, { once: true });
        } else {
            startReveal();
        }
    })();
</script>
<?php endif; ?>
