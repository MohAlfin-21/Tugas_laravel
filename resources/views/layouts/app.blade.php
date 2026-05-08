<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Data Siswa Jurusan RPL - SMKN 1 Dlanggu">
    <title>@yield('title', 'Data Siswa') — SMKN 1 Dlanggu RPL</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            color: #333;
            min-height: 100vh;
        }

        /* ── HEADER ── */
        header {
            background: #1a56a0;
            color: white;
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            height: 60px;
            box-shadow: 0 2px 6px rgba(0,0,0,.25);
        }
        header .logo {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: .5px;
        }
        header .subtitle {
            font-size: 13px;
            opacity: .85;
        }
        header nav {
            margin-left: auto;
        }
        header nav a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 4px;
            background: rgba(255,255,255,.15);
        }
        header nav a:hover { background: rgba(255,255,255,.3); }

        /* ── MAIN ── */
        main {
            max-width: 1100px;
            margin: 28px auto;
            padding: 0 16px;
        }

        /* ── CARD ── */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,.1);
            padding: 24px;
        }

        /* ── FLASH MESSAGES ── */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 500;
        }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #059669; }
        .alert-error   { background: #fee2e2; color: #991b1b; border-left: 4px solid #dc2626; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-block;
            padding: 7px 16px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity .15s;
        }
        .btn:hover { opacity: .85; }
        .btn-primary  { background: #1a56a0; color: white; }
        .btn-warning  { background: #d97706; color: white; }
        .btn-danger   { background: #dc2626; color: white; }
        .btn-secondary{ background: #6b7280; color: white; }
        .btn-sm       { padding: 5px 11px; font-size: 12px; }

        /* ── TABLE ── */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 16px;
        }
        th {
            background: #1a56a0;
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        tr:hover td { background: #f9fafb; }
        .actions { display: flex; gap: 6px; }

        /* ── FORM ── */
        .form-group { margin-bottom: 18px; }
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #374151;
        }
        label .required { color: #dc2626; margin-left: 2px; }
        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color .2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #1a56a0;
            box-shadow: 0 0 0 2px rgba(26,86,160,.15);
        }
        textarea { resize: vertical; min-height: 80px; }
        .error-msg { color: #dc2626; font-size: 12px; margin-top: 4px; }

        /* ── SEARCH ── */
        .search-bar {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }
        .search-bar input {
            flex: 1;
            max-width: 320px;
        }

        /* ── PAGINATION ── */
        .pagination { margin-top: 16px; display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
        .pagination a, .pagination span {
            padding: 5px 11px;
            border-radius: 4px;
            font-size: 13px;
            border: 1px solid #d1d5db;
            color: #374151;
            text-decoration: none;
        }
        .pagination a:hover { background: #1a56a0; color: white; border-color: #1a56a0; }
        .pagination .active span { background: #1a56a0; color: white; border-color: #1a56a0; }
        .pagination .disabled span { color: #9ca3af; }

        /* ── PAGE TITLE ── */
        .page-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a56a0;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        /* ── BADGE ── */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-laki  { background: #dbeafe; color: #1d4ed8; }
        .badge-perempuan { background: #fce7f3; color: #9d174d; }

        /* ── FOOTER ── */
        footer {
            text-align: center;
            padding: 16px;
            color: #9ca3af;
            font-size: 12px;
            margin-top: 32px;
        }

        /* ── FORM LAYOUT ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 20px;
        }
        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            header .subtitle { display: none; }
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }
        .empty-state p { font-size: 15px; margin-top: 8px; }
    </style>
</head>
<body>

<header>
    <div>
        <div class="logo">🏫 SMKN 1 Dlanggu</div>
        <div class="subtitle">Jurusan Rekayasa Perangkat Lunak (RPL)</div>
    </div>
    <nav>
        <a href="{{ route('siswa.index') }}">📋 Data Siswa</a>
    </nav>
</header>

<main>
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} SMKN 1 Dlanggu — Jurusan Rekayasa Perangkat Lunak
</footer>

</body>
</html>
