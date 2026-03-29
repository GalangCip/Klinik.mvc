<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Klinik</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        :root {
            --emerald:#0d7c5f; --emerald-lt:#10a97f; --emerald-dk:#085240;
            --cream:#f6f1e9; --gold:#c9a84c; --dark:#111714;
            --sidebar:#0a2e22; --muted:#6b7a72; --border:#e5e0d8;
        }
        body { font-family:'DM Sans',sans-serif; background:#f0ece4; color:var(--dark); display:flex; min-height:100vh; }

        /* SIDEBAR */
        .sidebar { width:260px; background:var(--sidebar); display:flex; flex-direction:column; position:fixed; top:0; left:0; bottom:0; z-index:100; }
        .sidebar::after { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 80% 50% at 50% 100%,rgba(16,169,127,.12),transparent 60%); pointer-events:none; }
        .sb-logo { padding:28px 24px 24px; border-bottom:1px solid rgba(255,255,255,.07); }
        .sb-logo h1 { font-family:'Playfair Display',serif; font-size:20px; color:var(--cream); }
        .sb-logo span { font-size:11px; font-weight:500; letter-spacing:2px; text-transform:uppercase; color:rgba(201,168,76,.8); }
        .sb-user { padding:20px 24px; border-bottom:1px solid rgba(255,255,255,.07); display:flex; align-items:center; gap:12px; }
        .avatar { width:42px; height:42px; border-radius:12px; background:linear-gradient(135deg,var(--emerald),var(--emerald-lt)); display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; color:#fff; flex-shrink:0; }
        .u-name { font-size:14px; font-weight:600; color:var(--cream); }
        .u-role { font-size:11px; color:rgba(201,168,76,.8); text-transform:uppercase; letter-spacing:1px; }
        .sb-nav { flex:1; padding:20px 16px; display:flex; flex-direction:column; gap:4px; }
        .nav-lbl { font-size:10px; font-weight:600; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.3); padding:8px 8px 4px; margin-top:8px; }
        .nav-item { display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:10px; color:rgba(246,241,233,.65); font-size:14px; font-weight:500; text-decoration:none; transition:all .2s; }
        .nav-item:hover { background:rgba(255,255,255,.07); color:var(--cream); }
        .nav-item.active { background:rgba(13,124,95,.35); color:#fff; border:1px solid rgba(16,169,127,.3); }
        .sb-foot { padding:16px; border-top:1px solid rgba(255,255,255,.07); }
        .btn-logout { display:flex; align-items:center; gap:10px; width:100%; padding:11px 12px; background:rgba(220,53,69,.15); border:1px solid rgba(220,53,69,.25); border-radius:10px; color:#ff8a8a; font-family:'DM Sans',sans-serif; font-size:14px; font-weight:500; cursor:pointer; text-decoration:none; transition:all .2s; }
        .btn-logout:hover { background:rgba(220,53,69,.25); }

        /* MAIN */
        .main { margin-left:260px; flex:1; display:flex; flex-direction:column; }
        .topbar { background:#fff; border-bottom:1px solid var(--border); padding:0 32px; height:68px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:50; }
        .topbar-title { font-size:18px; font-weight:600; }
        .badge { padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; }
        .badge-admin  { background:rgba(201,168,76,.15); color:#8a6d1a; border:1px solid rgba(201,168,76,.35); }
        .badge-dokter { background:rgba(13,124,95,.12); color:var(--emerald-dk); border:1px solid rgba(13,124,95,.25); }
        .content { padding:32px; }

        /* STAT CARDS */
        .stats { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:32px; }
        .stat { background:#fff; border-radius:16px; padding:24px; border:1px solid var(--border); position:relative; overflow:hidden; transition:transform .2s,box-shadow .2s; }
        .stat:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,.08); }
        .stat::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; }
        .stat:nth-child(1)::before { background:linear-gradient(90deg,var(--emerald),var(--emerald-lt)); }
        .stat:nth-child(2)::before { background:linear-gradient(90deg,#3b82f6,#60a5fa); }
        .stat:nth-child(3)::before { background:linear-gradient(90deg,var(--gold),#f0c36d); }
        .stat:nth-child(4)::before { background:linear-gradient(90deg,#8b5cf6,#a78bfa); }
        .stat-ico { font-size:28px; margin-bottom:14px; }
        .stat-num { font-family:'Playfair Display',serif; font-size:32px; font-weight:700; color:var(--dark); line-height:1; margin-bottom:6px; }
        .stat-lbl { font-size:13px; color:var(--muted); font-weight:500; }

        /* TABLE */
        .sec-hd { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
        .sec-title { font-family:'Playfair Display',serif; font-size:22px; font-weight:700; }
        .sec-sub { font-size:13px; color:var(--muted); margin-top:2px; }
        .search { position:relative; }
        .search input { padding:9px 16px 9px 38px; border:1.5px solid var(--border); border-radius:10px; font-family:'DM Sans',sans-serif; font-size:13px; background:#fff; color:var(--dark); outline:none; transition:border-color .2s; width:240px; }
        .search input:focus { border-color:var(--emerald); }
        .search::before { content:'🔍'; position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:14px; }
        .tbl-card { background:#fff; border-radius:16px; border:1px solid var(--border); overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.05); }
        table { width:100%; border-collapse:collapse; }
        thead { background:linear-gradient(135deg,var(--sidebar),#0d4d38); }
        thead th { padding:14px 16px; text-align:left; font-size:11px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:rgba(246,241,233,.75); }
        tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:rgba(13,124,95,.04); }
        tbody td { padding:13px 16px; font-size:14px; }
        .badge-jk { display:inline-block; padding:3px 10px; border-radius:6px; font-size:12px; font-weight:600; }
        .badge-p  { background:rgba(59,130,246,.1); color:#1d4ed8; }
        .badge-w  { background:rgba(236,72,153,.1); color:#be185d; }
        .email-cell { font-family:monospace; font-size:12px; color:var(--emerald-dk); background:rgba(13,124,95,.06); padding:3px 8px; border-radius:6px; }
        .nomed { font-family:monospace; font-size:13px; font-weight:600; color:var(--gold); background:rgba(201,168,76,.08); padding:3px 8px; border-radius:6px; }
        .tbl-foot { padding:14px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; background:rgba(246,241,233,.4); font-size:13px; color:var(--muted); }

        /* AES CARD */
        .aes-card { margin-top:24px; background:linear-gradient(135deg,#0a2e22,#0d4d38); border-radius:16px; padding:28px 32px; color:var(--cream); position:relative; overflow:hidden; }
        .aes-card::before { content:'🔐'; position:absolute; right:32px; top:50%; transform:translateY(-50%); font-size:72px; opacity:.1; }
        .aes-card h3 { font-family:'Playfair Display',serif; font-size:18px; margin-bottom:10px; color:var(--gold); }
        .aes-card p { font-size:14px; opacity:.8; line-height:1.7; }
        .code { margin-top:14px; background:rgba(0,0,0,.3); border-radius:8px; padding:14px 16px; font-family:monospace; font-size:13px; color:#a8e6cf; border-left:3px solid var(--emerald-lt); line-height:1.8; }

        @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        .stat { animation:fadeUp .4s ease both; }
        .stat:nth-child(1){animation-delay:.05s} .stat:nth-child(2){animation-delay:.1s}
        .stat:nth-child(3){animation-delay:.15s} .stat:nth-child(4){animation-delay:.2s}
        .tbl-card{animation:fadeUp .4s .25s ease both}
        .aes-card{animation:fadeUp .4s .3s ease both}
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sb-logo">
        <h1>🏥 Klinik</h1>
        <span>Sistem Manajemen Klinik</span>
    </div>
    <div class="sb-user">
        <div class="avatar">{{ strtoupper(substr(session('user','U'),0,1)) }}</div>
        <div>
            <div class="u-name">{{ session('user') }}</div>
            <div class="u-role">{{ session('level') }}</div>
        </div>
    </div>
    <nav class="sb-nav">
        <span class="nav-lbl">Menu Utama</span>
        <a href="{{ route('dashboard') }}" class="nav-item active"><span>📊</span> Dashboard</a>
        <span class="nav-lbl">Data</span>
        <a href="#" class="nav-item"><span>👥</span> Data Pasien</a>
        <a href="#" class="nav-item"><span>👨‍⚕️</span> Data Dokter</a>
        <a href="#" class="nav-item"><span>📋</span> Kwitansi</a>
        <a href="#" class="nav-item"><span>💊</span> Tindakan Medis</a>
        <span class="nav-lbl">Sistem</span>
        <a href="#" class="nav-item"><span>⚙️</span> Pengaturan</a>
        <a href="#" class="nav-item"><span>🔒</span> Keamanan Data</a>
    </nav>
    <div class="sb-foot">
        <a href="{{ route('logout') }}" class="btn-logout"><span>🚪</span> Keluar dari Sistem</a>
    </div>
</aside>

<main class="main">
    <div class="topbar">
        <div class="topbar-title">Dashboard Klinik</div>
        <div style="display:flex;align-items:center;gap:12px;">
            <span class="badge {{ session('level')==='admin' ? 'badge-admin' : 'badge-dokter' }}">
                {{ session('level') }}
            </span>
            <span style="font-size:13px;color:var(--muted);">{{ now()->format('d M Y') }}</span>
        </div>
    </div>

    <div class="content">
        <div class="stats">
            <div class="stat">
                <div class="stat-ico">👥</div>
                <div class="stat-num">{{ count($pasien) }}</div>
                <div class="stat-lbl">Total Pasien</div>
            </div>
            <div class="stat">
                <div class="stat-ico">👨‍⚕️</div>
                <div class="stat-num">10</div>
                <div class="stat-lbl">Dokter Aktif</div>
            </div>
            <div class="stat">
                <div class="stat-ico">📋</div>
                <div class="stat-num">10</div>
                <div class="stat-lbl">Total Kwitansi</div>
            </div>
            <div class="stat">
                <div class="stat-ico">🔐</div>
                <div class="stat-num">AES</div>
                <div class="stat-lbl">Enkripsi Email Aktif</div>
            </div>
        </div>

        <div class="sec-hd">
            <div>
                <div class="sec-title">Data Pasien</div>
                <div class="sec-sub">Email ditampilkan setelah didekripsi dengan AES_DECRYPT()</div>
            </div>
            <div class="search">
                <input type="text" id="cari" placeholder="Cari nama pasien..." onkeyup="filterTable()">
            </div>
        </div>

        <div class="tbl-card">
            <table id="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Med. Rec</th>
                        <th>Nama Pasien</th>
                        <th>JK</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl. Lahir</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th>Email (Dekripsi AES)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasien as $i => $p)
                    <tr>
                        <td style="color:var(--muted);font-size:13px;">{{ $i+1 }}</td>
                        <td><span class="nomed">{{ $p->nomedrec }}</span></td>
                        <td style="font-weight:600;">{{ $p->nama_pasien }}</td>
                        <td>
                            <span class="badge-jk {{ $p->jenkel==='P' ? 'badge-p' : 'badge-w' }}">
                                {{ $p->jenkel==='P' ? '♂ P' : '♀ W' }}
                            </span>
                        </td>
                        <td style="font-size:13px;">{{ $p->tempat_lahir }}</td>
                        <td style="font-size:13px;">{{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d M Y') }}</td>
                        <td style="font-size:13px;">{{ $p->kota }}</td>
                        <td style="font-size:13px;">{{ $p->telepon }}</td>
                        <td><span class="email-cell">{{ $p->email_asli ?? '-' }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="tbl-foot">
                <span>Menampilkan <strong>{{ count($pasien) }}</strong> data pasien</span>
                <span>🔒 Email dienkripsi AES-128 | key: <code>key_rahasia</code></span>
            </div>
        </div>

        <div class="aes-card">
            <h3>🔐 Keamanan Data — Enkripsi AES MySQL</h3>
            <p>Email pasien disimpan terenkripsi menggunakan <strong>AES_ENCRYPT()</strong> sehingga tidak terbaca langsung di phpMyAdmin. Dashboard ini mendekripsinya menggunakan <strong>AES_DECRYPT()</strong> dengan kunci yang sama.</p>
            <div class="code">
                -- Lihat email TERENKRIPSI (di phpMyAdmin):<br>
                SELECT nomedrec, nama_pasien, email FROM pasien WHERE nomedrec = 'P00001';<br><br>
                -- Lihat email TERDEKRIPSI (yang dipakai aplikasi ini):<br>
                SELECT nama_pasien, CAST(AES_DECRYPT(email, 'key_rahasia') AS CHAR) AS email_asli FROM pasien;
            </div>
        </div>
    </div>
</main>

<script>
function filterTable() {
    const q = document.getElementById('cari').value.toLowerCase();
    document.querySelectorAll('#tbl tbody tr').forEach(r => {
        r.style.display = r.cells[2].textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
</body>
</html>
