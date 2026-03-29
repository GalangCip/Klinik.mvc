<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Klinik</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --emerald:    #0d7c5f;
            --emerald-lt: #10a97f;
            --emerald-dk: #085240;
            --cream:      #f6f1e9;
            --gold:       #c9a84c;
            --dark:       #111714;
            --muted:      #6b7a72;
        }
        body { min-height: 100vh; display: flex; font-family: 'DM Sans', sans-serif; background: var(--dark); overflow: hidden; }

        /* LEFT */
        .left { width: 55%; position: relative; background: linear-gradient(145deg, #0a2e22, #0d4d38 50%, #1a6b50); display: flex; flex-direction: column; justify-content: center; padding: 60px; overflow: hidden; }
        .left::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 80% 60% at 20% 80%, rgba(201,168,76,.15), transparent 60%), radial-gradient(ellipse 60% 80% at 80% 20%, rgba(16,169,127,.2), transparent 60%); }
        .deco { position: absolute; border-radius: 50%; border: 1px solid rgba(201,168,76,.2); }
        .deco:nth-child(1) { width:400px; height:400px; top:-120px; right:-80px; }
        .deco:nth-child(2) { width:250px; height:250px; bottom:40px; left:-80px; border-color:rgba(16,169,127,.25); }
        .deco:nth-child(3) { width:120px; height:120px; top:40%; right:60px; border-color:rgba(255,255,255,.1); }
        .panel { position: relative; z-index: 2; }
        .tag { display:inline-block; background:rgba(201,168,76,.15); border:1px solid rgba(201,168,76,.4); color:var(--gold); font-size:11px; font-weight:600; letter-spacing:3px; text-transform:uppercase; padding:6px 16px; border-radius:20px; margin-bottom:32px; }
        .panel h1 { font-family:'Playfair Display',serif; font-size:clamp(36px,4vw,54px); font-weight:800; color:var(--cream); line-height:1.15; margin-bottom:20px; }
        .panel h1 span { color:var(--emerald-lt); }
        .panel p { color:rgba(246,241,233,.6); font-size:15px; line-height:1.8; max-width:400px; margin-bottom:48px; }
        .features { display:flex; flex-direction:column; gap:16px; }
        .feat { display:flex; align-items:center; gap:14px; color:rgba(246,241,233,.75); font-size:14px; }
        .feat-icon { width:36px; height:36px; border-radius:10px; background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }

        /* RIGHT */
        .right { width:45%; background:var(--cream); display:flex; flex-direction:column; justify-content:center; padding:60px 50px; position:relative; }
        .right::before { content:''; position:absolute; top:0; right:0; width:100%; height:4px; background:linear-gradient(90deg,var(--emerald),var(--gold)); }
        .login-hd { margin-bottom:36px; }
        .login-hd h2 { font-family:'Playfair Display',serif; font-size:30px; font-weight:700; color:var(--dark); margin-bottom:8px; }
        .login-hd p { color:var(--muted); font-size:14px; }
        .form-group { margin-bottom:22px; }
        .form-label { display:block; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; color:var(--dark); margin-bottom:8px; }
        .input-wrap { position:relative; }
        .input-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); font-size:18px; color:var(--muted); pointer-events:none; }
        .form-input { width:100%; padding:14px 16px 14px 48px; border:1.5px solid #d8d4cc; border-radius:12px; font-family:'DM Sans',sans-serif; font-size:15px; color:var(--dark); background:#fff; transition:all .25s; outline:none; }
        .form-input:focus { border-color:var(--emerald); box-shadow:0 0 0 3px rgba(13,124,95,.1); }
        .alert-err { background:#fff0f0; border:1.5px solid #f5c6c6; border-radius:10px; padding:12px 16px; margin-bottom:24px; display:flex; align-items:center; gap:10px; color:#c0392b; font-size:14px; font-weight:500; }
        .alert-ok  { background:#f0fff8; border:1.5px solid #a8e6cf; border-radius:10px; padding:12px 16px; margin-bottom:24px; color:#0d7c5f; font-size:14px; font-weight:500; }
        .btn { width:100%; padding:15px; background:linear-gradient(135deg,var(--emerald),var(--emerald-lt)); color:#fff; border:none; border-radius:12px; font-family:'DM Sans',sans-serif; font-size:15px; font-weight:600; cursor:pointer; transition:all .3s; }
        .btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(13,124,95,.35); }
        .demo { margin-top:28px; padding:16px; background:rgba(13,124,95,.06); border:1px dashed rgba(13,124,95,.3); border-radius:10px; font-size:13px; color:var(--muted); }
        .demo strong { color:var(--emerald-dk); }
        .foot { position:absolute; bottom:24px; left:50%; transform:translateX(-50%); font-size:12px; color:var(--muted); white-space:nowrap; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .right > * { animation: fadeUp .5s ease both; }
        .login-hd{animation-delay:.1s} .form-group{animation-delay:.2s} .btn{animation-delay:.3s} .demo{animation-delay:.35s}
    </style>
</head>
<body>
<div class="left">
    <div class="deco"></div><div class="deco"></div><div class="deco"></div>
    <div class="panel">
        <span class="tag">🏥 Sistem Klinik</span>
        <h1>Manajemen<br>Klinik <span>Digital</span><br>Terpadu</h1>
        <p>Platform terintegrasi untuk pengelolaan data pasien, dokter, dan administrasi klinik dengan keamanan data tingkat tinggi.</p>
        <div class="features">
            <div class="feat"><div class="feat-icon">🔒</div><span>Password di-hash dengan <strong>password_hash()</strong></span></div>
            <div class="feat"><div class="feat-icon">🔐</div><span>Email pasien dienkripsi dengan <strong>AES_ENCRYPT</strong></span></div>
            <div class="feat"><div class="feat-icon">📁</div><span>Arsitektur <strong>MVC</strong> yang bersih dan terstruktur</span></div>
        </div>
    </div>
</div>

<div class="right">
    @if($errors->has('login'))
        <div class="alert-err">⚠️ {{ $errors->first('login') }}</div>
    @endif
    @if(session('success'))
        <div class="alert-ok">✅ {{ session('success') }}</div>
    @endif

    <div class="login-hd">
        <h2>Selamat Datang 👋</h2>
        <p>Masukkan kredensial Anda untuk mengakses sistem</p>
    </div>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Username</label>
            <div class="input-wrap">
                <span class="input-icon">👤</span>
                <input class="form-input" type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrap">
                <span class="input-icon">🔑</span>
                <input class="form-input" type="password" name="password" placeholder="Masukkan password" required>
            </div>
        </div>
        <button type="submit" class="btn">Masuk ke Sistem →</button>
    </form>

    <div class="demo">
        <strong>🧪 Demo Login:</strong><br>
        Username: <strong>admin_klinik</strong> &nbsp;|&nbsp; Password: <strong>admin123</strong><br>
        Username: <strong>dr_budi</strong> &nbsp;|&nbsp; Password: <strong>dokter123</strong>
    </div>
    <p class="foot">© 2025 Klinik — Sistem Manajemen Klinik</p>
</div>
</body>
</html>