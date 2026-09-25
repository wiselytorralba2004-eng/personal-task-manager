<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Task Manager')</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --text: #172033;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #3457d5;
            --primary-dark: #2744ad;
            --success: #16855b;
            --success-soft: #e8f7f0;
            --warning: #b66a09;
            --warning-soft: #fff5df;
            --danger: #c93a3a;
            --danger-soft: #fff0f0;
            --shadow: 0 12px 30px rgba(26, 39, 73, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .topbar {
            background: #111827;
            color: white;
            padding: 18px 0;
            box-shadow: 0 2px 12px rgba(0,0,0,.12);
        }

        .topbar-inner,
        .container {
            width: min(1080px, calc(100% - 32px));
            margin: 0 auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            background: var(--primary);
            border-radius: 10px;
        }

        .container { padding: 36px 0 60px; }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        h1, h2, h3, p { margin-top: 0; }
        h1 { margin-bottom: 6px; font-size: clamp(26px, 4vw, 36px); }
        .subtitle { color: var(--muted); margin-bottom: 0; }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .stat-value { font-size: 28px; font-weight: 800; margin-top: 6px; }
        .stat-label { color: var(--muted); font-size: 14px; }

        .task-grid { display: grid; gap: 16px; }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 22px;
            box-shadow: var(--shadow);
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
        }

        .task-title { margin-bottom: 8px; font-size: 20px; }
        .description { color: #4b5563; line-height: 1.6; white-space: pre-line; }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge.pending { color: var(--warning); background: var(--warning-soft); }
        .badge.completed { color: var(--success); background: var(--success-soft); }

        .meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 14px;
            color: var(--muted);
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 18px;
            margin-top: 18px;
            border-top: 1px solid var(--line);
        }

        .status-form {
            display: flex;
            gap: 8px;
            align-items: center;
            flex: 1 1 360px;
        }

        .status-form select { max-width: 180px; margin: 0; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 15px;
            border: 0;
            border-radius: 10px;
            text-decoration: none;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: .18s ease;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: #eef2ff; color: #3346a8; }
        .btn-danger { background: var(--danger-soft); color: var(--danger); }
        .btn-success { background: var(--success-soft); color: var(--success); }
        .btn-ghost { background: #eef1f5; color: #374151; }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 700;
        }

        input, textarea, select {
            width: 100%;
            border: 1px solid #d8dee8;
            background: white;
            border-radius: 10px;
            padding: 11px 12px;
            font: inherit;
            color: var(--text);
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #7d92e5;
            box-shadow: 0 0 0 3px rgba(52, 87, 213, .10);
        }

        textarea { min-height: 120px; resize: vertical; }
        .field { margin-bottom: 18px; }

        .form-card { max-width: 760px; margin: 0 auto; }
        .form-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 22px; }

        .alert {
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #bce7d3;
            background: #edfbf5;
            color: #0d6947;
            font-weight: 650;
        }

        .validation-summary {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            background: var(--danger-soft);
            color: #9c2828;
        }

        .validation-summary ul { margin: 8px 0 0; padding-left: 20px; }
        .field-error { color: #b72f2f; font-size: 13px; margin-top: 6px; }

        .empty-state {
            text-align: center;
            padding: 50px 24px;
            background: var(--surface);
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 10px;
        }

        @media (max-width: 720px) {
            .page-header, .task-top { flex-direction: column; align-items: stretch; }
            .stats { grid-template-columns: 1fr; }
            .status-form { flex-basis: 100%; }
            .status-form select { max-width: none; }
            .status-form { flex-direction: column; align-items: stretch; }
            .actions > form:not(.status-form), .actions > a { width: 100%; }
            .actions .btn { width: 100%; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <div class="brand">
            <div class="brand-icon">✓</div>
            <span>Personal Task Manager</span>
        </div>
    </div>
</header>

<main class="container">
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</main>
</body>
</html>
