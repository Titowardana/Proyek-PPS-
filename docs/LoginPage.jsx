import React, { useState } from 'react';
import { 
  GraduationCap, 
  MapPin, 
  Calendar, 
  HelpCircle, 
  User, 
  Lock, 
  Eye, 
  EyeOff, 
  ArrowRight, 
  BookOpen, 
  ShieldCheck,
  Building2,
  FolderOpen,
  UserCheck,
  CheckCircle2,
  Briefcase
} from 'lucide-react';

export default function LoginPage() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [demoFeedback, setDemoFeedback] = useState(null);

  const demoAccounts = [
    { label: 'Mahasiswa', email: 'mahasiswa@simagang.ac.id', icon: GraduationCap },
    { label: 'Staf TU', email: 'tu@simagang.ac.id', icon: FolderOpen },
    { label: 'Kaprodi', email: 'kaprodi@simagang.ac.id', icon: Building2 },
    { label: 'Dosbem', email: 'dosbem@simagang.ac.id', icon: UserCheck },
    { label: 'Dosen MK', email: 'dosenmk@simagang.ac.id', icon: BookOpen },
    { label: 'Wadek 1', email: 'wadek1@simagang.ac.id', icon: Briefcase },
  ];

  const handleQuickDemo = (role, demoEmail) => {
    setEmail(demoEmail);
    setPassword('password123');
    setDemoFeedback(role);
    setTimeout(() => setDemoFeedback(null), 3000);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Login submitted:', { email, password, rememberMe });
  };

  const handleSSO = () => {
    alert('Mengarahkan ke Single Sign-On (SSO) Google Workspace Akun Mahasiswa/Dosen UMRAH...');
  };

  return (
    // 1. Global Responsive Layout: min-h-screen w-full flex flex-col lg:flex-row bg-slate-50
    <div className="min-h-screen w-full flex flex-col lg:flex-row bg-slate-50 font-sans antialiased text-slate-800 select-none">
      
      {/* ======================================================== */}
      {/* 2. LEFT COLUMN (Blue Branding)                           */}
      {/* Mobile/Tablet: h-auto pt-8 px-5 pb-12 (CLEAN BOTTOM PAD)  */}
      {/* Desktop: lg:w-1/2 lg:h-screen lg:relative lg:p-0         */}
      {/* ======================================================== */}
      <div className="relative w-full h-auto pt-8 px-5 pb-12 sm:px-8 lg:w-1/2 lg:h-screen lg:relative lg:p-0 bg-[#091f46] text-white flex flex-col justify-between overflow-hidden shrink-0 z-0">
        
        {/* Deep Navy Gradient & Nautical Backdrops */}
        <div className="absolute inset-0 z-0 pointer-events-none">
          <img 
            src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1600&auto=format&fit=crop" 
            alt="Kampus Maritim UMRAH" 
            className="w-full h-full object-cover object-center filter saturate-75 contrast-125 opacity-20 mix-blend-luminosity scale-105"
          />
          <div className="absolute inset-0 bg-gradient-to-br from-[#061533] via-[#0c2452] via-[#102f6b] to-[#07193d]" />
          
          {/* Subtle Ambient Radial Glows */}
          <div className="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-blue-500/20 blur-3xl" />
          <div className="absolute bottom-0 right-10 w-80 h-80 rounded-full bg-cyan-400/15 blur-3xl" />

          {/* Faint Compass / Nautical Motif (Desktop Only) */}
          <div className="absolute top-1/2 right-28 -translate-y-1/2 w-56 h-56 rounded-full border border-blue-300/15 hidden xl:flex items-center justify-center">
            <div className="w-44 h-44 rounded-full border border-dashed border-blue-200/20 flex items-center justify-center animate-[spin_60s_linear_infinite]">
              <div className="w-24 h-24 rounded-full bg-blue-500/10 backdrop-blur-sm flex items-center justify-center">
                <img 
                  src="/assets/images/logo-umrah.png" 
                  alt="UMRAH Watermark" 
                  className="w-14 h-14 object-contain opacity-30 brightness-150"
                  onError={(e) => { e.target.style.display = 'none'; }}
                />
              </div>
            </div>
            <span className="absolute top-2 text-[10px] font-bold text-blue-200/50 tracking-widest">N</span>
            <span className="absolute bottom-2 text-[10px] font-bold text-blue-200/50 tracking-widest">S</span>
          </div>
        </div>

        {/* Top Header: Logo Area with Official UMRAH Logo */}
        <div className="relative z-20 flex items-center space-x-3 mb-6 lg:mb-0 lg:absolute lg:top-8 lg:left-8">
          <div className="w-11 h-11 rounded-xl border border-white/25 bg-white/10 backdrop-blur-md flex items-center justify-center shadow-md p-1.5 shrink-0">
            <img 
              src="/assets/images/logo-umrah.png" 
              alt="Logo Resmi UMRAH" 
              className="w-full h-full object-contain filter drop-shadow"
            />
          </div>
          <div>
            <div className="flex items-center space-x-2">
              <span className="text-xl xl:text-2xl font-bold tracking-tight text-white">SIMAGANG</span>
              <span className="text-[10px] xl:text-xs font-semibold px-2 py-0.5 rounded-full bg-blue-500/30 text-blue-200 border border-blue-400/30">
                UMRAH
              </span>
            </div>
            <p className="text-[10px] font-semibold text-blue-200/80 tracking-wider uppercase">
              PORTAL MAGANG MAHASISWA
            </p>
          </div>
        </div>

        {/* Main Content: Vertically Centered on Desktop */}
        <div className="relative z-10 my-auto py-2 lg:py-6 px-1 sm:px-2 lg:px-14 xl:px-16 max-w-xl space-y-3.5 xl:space-y-4">
          <div className="flex items-center space-x-2">
            <span className="w-6 h-0.5 bg-[#b8d8fc] rounded-full" />
            <span className="text-[11px] font-bold tracking-[1.6px] uppercase text-[#b8d8fc]">
              — ILMU • PENGALAMAN • MASA DEPAN
            </span>
          </div>

          <h1 className="text-2xl sm:text-3xl xl:text-4xl font-extrabold tracking-tight leading-[1.2] text-white">
            Dari kampus maritim,<br />
            <span className="text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-[#b8deff]">
              menuju masa depan.
            </span>
          </h1>

          <p className="text-xs sm:text-sm text-[#ecf3ff] opacity-80 leading-relaxed font-normal max-w-md">
            Mulai perjalanan magang Anda. Hubungkan ilmu, pengalaman, dan peluang dalam satu portal terpadu.
          </p>

          <div className="rounded-xl border border-white/20 bg-white/10 backdrop-blur-md p-3.5 flex items-start space-x-3 shadow-lg shadow-black/10 transition hover:bg-white/15 max-w-md">
            <div className="w-9 h-9 rounded-lg border border-white/25 bg-white/15 flex-shrink-0 flex items-center justify-center text-white shadow-sm mt-0.5">
              <GraduationCap className="w-5 h-5 text-blue-200" />
            </div>
            <div className="space-y-0.5">
              <h3 className="text-xs xl:text-sm font-bold text-white tracking-tight">
                Satu portal. Seluas peluang Anda.
              </h3>
              <p className="text-[11px] text-[#e1edff] leading-normal opacity-90">
                Kelola pengajuan, aktivitas, dan laporan magang dalam ekosistem akademik yang terintegrasi.
              </p>
            </div>
          </div>
        </div>

        {/* Footer on Blue Side: Decluttered on Mobile */}
        <div className="relative z-20 mt-6 pt-3 flex items-center justify-between text-[11px] text-[#b8d4f7] opacity-80 font-medium lg:mt-0 lg:pt-0">
          {/* Left: Tanjungpinang, Kepri */}
          <div className="flex items-center space-x-1.5 lg:absolute lg:bottom-8 lg:left-8">
            <MapPin className="w-3.5 h-3.5 text-blue-300" />
            <span>Tanjungpinang, Kepri</span>
          </div>

          {/* Right: MARITIM • UNGGUL • BERBUDAYA (Hidden on mobile to save space) */}
          <div className="hidden lg:block absolute bottom-8 right-12 lg:right-24 font-semibold tracking-wider text-[10px] uppercase">
            MARITIM • UNGGUL • BERBUDAYA
          </div>
        </div>

        {/* ======================================================== */}
        {/* THE CURVE (Desktop Only - Symmetrical Convex Arc)        */}
        {/* ======================================================== */}
        <div className="hidden lg:block absolute top-0 -right-1 w-24 h-full pointer-events-none z-20 overflow-hidden">
          <svg 
            viewBox="0 0 100 1000" 
            preserveAspectRatio="none" 
            className="h-full w-full"
          >
            <defs>
              <linearGradient id="curveGlowLine" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stopColor="#60a5fa" stopOpacity="0.3" />
                <stop offset="50%" stopColor="#38bdf8" stopOpacity="0.85" />
                <stop offset="100%" stopColor="#60a5fa" stopOpacity="0.3" />
              </linearGradient>
              <filter id="curveShadow" x="-30%" y="0%" width="150%" height="100%">
                <feDropShadow dx="-4" dy="0" stdDeviation="6" floodColor="#061533" floodOpacity="0.25" />
              </filter>
            </defs>

            <path 
              d="M 0,0 Q 100,500 0,1000 L 100,1000 L 100,0 Z" 
              fill="#f8fafc" 
              filter="url(#curveShadow)"
            />

            <path 
              d="M 0,0 Q 100,500 0,1000" 
              fill="none" 
              stroke="url(#curveGlowLine)" 
              strokeWidth="2.5" 
            />
          </svg>
        </div>

      </div>

      {/* ======================================================== */}
      {/* 3. RIGHT COLUMN (White Form Area - Clean Stacking Mobile) */}
      {/* Mobile/Tablet: w-full py-8 px-4 (NO OVERLAPPING, NO -MT)   */}
      {/* Desktop: lg:w-1/2 lg:py-0 lg:px-12 lg:h-screen            */}
      {/* ======================================================== */}
      <div className="w-full py-8 px-4 sm:px-6 flex flex-col items-center justify-center lg:w-1/2 lg:py-0 lg:px-12 lg:h-screen lg:overflow-y-auto relative z-0">

        {/* 2. Top Navigation: Hidden on Mobile, Shown only on Desktop */}
        <div className="hidden lg:flex absolute top-8 right-8 items-center space-x-4 text-xs text-slate-500 font-medium z-30">
          <div className="flex items-center space-x-1.5">
            <Calendar className="w-3.5 h-3.5 text-slate-400" />
            <span className="font-semibold text-slate-600 text-[11px] sm:text-xs">TA 2026 / 2027</span>
          </div>
          <button 
            type="button" 
            className="flex items-center space-x-1 hover:text-blue-600 transition text-[11px] sm:text-xs focus:outline-none"
            onClick={() => alert('Pusat Bantuan: Hubungi helpdesk UPT TIK via email tik@umrah.ac.id')}
          >
            <HelpCircle className="w-3.5 h-3.5 text-slate-400 hover:text-blue-600" />
            <span>Pusat bantuan</span>
          </button>
        </div>

        {/* 3. Card Sizing on Mobile: Full width on mobile (w-full lg:max-w-md) */}
        <div className="w-full lg:max-w-md bg-white rounded-2xl sm:rounded-xl border border-slate-200/80 shadow-lg sm:shadow-xl p-5 sm:p-6 transition-all relative z-10">
          
          {/* Card Header with Official University Logo */}
          <div className="pb-2.5 border-b border-slate-100">
            <div className="flex items-center space-x-3">
              {/* Official University Logo */}
              <div className="w-10 h-10 rounded-lg bg-blue-50/80 border border-blue-100 flex items-center justify-center p-1 shrink-0 shadow-sm">
                <img 
                  src="/assets/images/logo-umrah.png" 
                  alt="Logo UMRAH" 
                  className="w-full h-full object-contain"
                />
              </div>
              <div>
                <span className="text-base font-bold tracking-tight text-[#17387d]">UMRAH</span>
                <span className="text-[10px] font-semibold text-slate-500 block -mt-0.5 uppercase tracking-wider">
                  UNIVERSITAS MARITIM RAJA ALI HAJI
                </span>
              </div>
            </div>

            <div className="mt-2.5">
              <span className="text-[10px] font-bold tracking-[1.2px] uppercase text-blue-600 block mb-0.5">
                PORTAL MAGANG TERPADU
              </span>
              <h2 className="text-lg sm:text-xl font-bold tracking-tight text-slate-900">
                Selamat Datang di SIMAGANG
              </h2>
              <p className="text-[11px] text-slate-500 mt-0.5">
                Sistem Informasi Magang Universitas Maritim Raja Ali Haji
              </p>
            </div>
          </div>

          {/* Single Sign-On (SSO) Button */}
          <div className="mt-3">
            <button
              type="button"
              onClick={handleSSO}
              className="w-full py-2.5 px-3 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-xs rounded-lg transition flex items-center justify-center space-x-2 shadow-sm hover:border-slate-300 active:scale-[0.99]"
            >
              <svg className="w-4 h-4" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" />
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" />
              </svg>
              <span>Login dengan Email UMRAH (SSO)</span>
            </button>

            {/* "ATAU" (OR) Divider */}
            <div className="relative flex items-center justify-center my-2.5">
              <div className="border-t border-slate-200 w-full" />
              <span className="bg-white px-2.5 text-[9px] font-bold text-slate-400 uppercase tracking-widest absolute">
                ATAU
              </span>
            </div>
          </div>

          {/* Form */}
          <form onSubmit={handleSubmit} className="space-y-2.5">
            {/* Input 1: NIM / NIP / Email */}
            <div className="space-y-1">
              <label className="block text-[11px] font-semibold text-slate-700 uppercase tracking-wider">
                NIM / NIP / EMAIL
              </label>
              <div className="relative rounded-lg border border-slate-300 bg-white transition-all focus-within:border-blue-600 focus-within:ring-2 focus-within:ring-blue-600/10">
                <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                  <User className="w-4 h-4" />
                </div>
                <input 
                  type="text" 
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required 
                  placeholder="Masukkan NIM, NIP, atau email Anda" 
                  className="w-full pl-9 pr-3 py-2 text-xs sm:text-sm text-slate-800 placeholder:text-gray-500 bg-transparent rounded-lg focus:outline-none"
                />
              </div>
            </div>

            {/* Input 2: Password */}
            <div className="space-y-1">
              <label className="block text-[11px] font-semibold text-slate-700 uppercase tracking-wider">
                PASSWORD
              </label>
              <div className="relative rounded-lg border border-slate-300 bg-white transition-all focus-within:border-blue-600 focus-within:ring-2 focus-within:ring-blue-600/10">
                <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                  <Lock className="w-4 h-4" />
                </div>
                <input 
                  type={showPassword ? 'text' : 'password'} 
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required 
                  placeholder="Masukkan password Anda" 
                  className="w-full pl-9 pr-9 py-2 text-xs sm:text-sm text-slate-800 placeholder:text-gray-500 bg-transparent rounded-lg focus:outline-none"
                />
                <button 
                  type="button" 
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                  title="Lihat Kata Sandi"
                >
                  {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
                </button>
              </div>
            </div>

            {/* Form Options */}
            <div className="flex items-center justify-between text-[11px] pt-0.5">
              <label className="flex items-center space-x-1.5 cursor-pointer text-slate-600 select-none">
                <input 
                  type="checkbox" 
                  checked={rememberMe}
                  onChange={(e) => setRememberMe(e.target.checked)}
                  className="w-3.5 h-3.5 rounded border-slate-300 text-blue-600 focus:ring-blue-500" 
                />
                <span>Remember Me</span>
              </label>
              <a 
                href="#forgot" 
                onClick={(e) => { e.preventDefault(); alert('Hubungi operator akademik fakultas Anda untuk reset password.'); }}
                className="text-blue-600 hover:text-blue-700 font-semibold transition"
              >
                Forgot Password
              </a>
            </div>

            {/* Primary Button */}
            <button 
              type="submit" 
              className="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-lg shadow-sm transition-all flex items-center justify-center space-x-1.5 focus:ring-2 focus:ring-blue-500/20 active:scale-[0.99]"
            >
              <span>Login</span>
              <ArrowRight className="w-4 h-4" />
            </button>

            {/* Secondary Button */}
            <button 
              type="button" 
              onClick={() => alert('Membuka Panduan Magang Mahasiswa UMRAH.')}
              className="w-full py-2 px-4 bg-white hover:bg-slate-50 text-slate-700 font-medium text-xs rounded-lg border border-slate-300 transition-all flex items-center justify-center space-x-1.5 shadow-sm"
            >
              <BookOpen className="w-3.5 h-3.5 text-slate-600" />
              <span>Panduan Magang</span>
            </button>
          </form>

          {/* Quick Demo Section */}
          <div className="mt-3 pt-2.5 border-t border-dotted border-slate-300">
            <div className="flex items-center justify-between mb-1.5">
              <span className="text-[10px] font-bold tracking-wider text-slate-500 uppercase flex items-center space-x-1">
                <span className="w-1.5 h-1.5 rounded-full bg-blue-600" />
                <span>• AKUN UJI COBA (QUICK DEMO)</span>
              </span>
              <span className="text-[9px] text-slate-400">1-Klik isi form</span>
            </div>

            <div className="grid grid-cols-2 gap-2 text-[11px]">
              {demoAccounts.map((account) => {
                const IconComponent = account.icon;
                return (
                  <button 
                    key={account.label}
                    type="button" 
                    onClick={() => handleQuickDemo(account.label, account.email)}
                    className="px-2.5 py-1.5 bg-white hover:bg-blue-50 hover:text-blue-700 hover:border-blue-300 border border-slate-200 text-slate-700 rounded-full text-left transition flex items-center space-x-2 font-medium truncate shadow-sm"
                  >
                    <IconComponent className="w-3.5 h-3.5 text-blue-600 shrink-0" />
                    <span className="truncate">{account.label}</span>
                  </button>
                );
              })}
            </div>

            {demoFeedback && (
              <div className="mt-1.5 p-1 px-2 bg-blue-50 border border-blue-200 text-blue-700 text-[10px] rounded-md flex items-center justify-between animate-in fade-in">
                <span className="flex items-center space-x-1">
                  <CheckCircle2 className="w-3 h-3 text-blue-600" />
                  <span>Mengisi: <b>{demoFeedback}</b></span>
                </span>
                <span className="text-[9px] text-blue-500 font-mono">password123</span>
              </div>
            )}
          </div>

          {/* Trust Badge */}
          <div className="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-center space-x-1.5 text-[11px] text-slate-500">
            <ShieldCheck className="w-3.5 h-3.5 text-emerald-500" />
            <span className="text-emerald-700 font-medium">Login aman • Akun akademik UMRAH</span>
          </div>

        </div>

        {/* Right Column Footer: Outside the card */}
        <div className="w-full lg:max-w-md text-center space-y-0.5 text-[10px] text-slate-400 mt-4 px-4">
          <p>Kendala akses? Hubungi pengelola magang fakultas Anda.</p>
          <p className="text-[9px] text-slate-400">
            © 2026 UMRAH. Hak cipta dilindungi — Kebijakan Privasi
          </p>
        </div>

      </div>

    </div>
  );
}
