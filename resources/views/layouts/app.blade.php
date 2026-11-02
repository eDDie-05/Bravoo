<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Overview' }} · {{ config('app.name', 'Bravado') }}</title>
    <style>
        :root{font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:#172b3a;background:#f4f7f8;font-synthesis:none;text-rendering:optimizeLegibility}*{box-sizing:border-box}body{margin:0}.shell{min-height:100vh;display:grid;grid-template-columns:248px minmax(0,1fr)}.sidebar{background:#102e3a;color:#d8e6e8;padding:27px 16px;display:flex;flex-direction:column;gap:32px}.brand{padding:0 12px;display:flex;align-items:center;gap:11px}.brand-mark{background:#d8f171;color:#17313a;width:36px;height:36px;border-radius:11px;display:grid;place-items:center;font-weight:850}.brand strong{display:block;font-size:14px;letter-spacing:.02em;color:white}.brand small{display:block;color:#95b2b8;margin-top:3px;font-size:11px}.nav-label{color:#87a6ad;text-transform:uppercase;font-size:10px;letter-spacing:.15em;padding:0 12px;margin:4px 0 9px}.nav{display:grid;gap:4px}.nav a{color:#c0d2d4;text-decoration:none;padding:10px 12px;border-radius:9px;font-size:13px;display:flex;gap:11px;align-items:center}.nav a:hover,.nav a.active{background:#214652;color:#fff}.nav-icon{width:20px;color:#a9c4c6;font-size:10px;font-weight:750}.side-foot{margin-top:auto;border-top:1px solid #2c4d56;padding:16px 12px 0;color:#a8c0c4;font-size:11px;line-height:1.6}.main{min-width:0}.topbar{height:72px;border-bottom:1px solid #e4eaeb;background:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 38px}.crumb{font-size:12px;color:#789097}.userbox{display:flex;align-items:center;gap:12px;font-size:12px}.avatar{width:34px;height:34px;border-radius:50%;display:grid;place-items:center;background:#e5eddb;color:#355443;font-weight:700}.logout{border:0;background:transparent;color:#58727b;cursor:pointer;font:inherit;padding:8px}.content{padding:36px 40px 48px;max-width:1440px;margin:auto}.eyebrow{font-size:11px;color:#69838a;text-transform:uppercase;letter-spacing:.15em;font-weight:700}.heading{display:flex;justify-content:space-between;align-items:end;gap:20px;margin:8px 0 28px}.heading h1{font-size:30px;letter-spacing:-.04em;margin:0;color:#16323d}.heading p{margin:7px 0 0;color:#758a90;font-size:13px}.date{font-size:12px;color:#789097}.stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:28px}.stat,.panel,.module-card{background:white;border:1px solid #e5ebec;border-radius:14px}.stat{padding:20px 22px}.stat-top{display:flex;align-items:center;justify-content:space-between;color:#71888d;font-size:12px}.stat-mark{width:30px;height:30px;border-radius:9px;background:#f0f5e5;color:#55733e;display:grid;place-items:center;font-size:11px;font-weight:800}.stat-value{font-size:28px;font-weight:700;letter-spacing:-.04em;margin-top:13px;color:#183540}.stat-foot{font-size:11px;color:#8a9da1;margin-top:5px}.section-head{display:flex;align-items:end;justify-content:space-between;margin:30px 0 14px}.section-head h2{font-size:16px;margin:0;color:#1c3b45}.section-head p{font-size:12px;color:#829499;margin:5px 0 0}.module-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px}.module-card{padding:17px;text-decoration:none;color:inherit;transition:transform .15s,border-color .15s}.module-card:hover{transform:translateY(-2px);border-color:#bfd178}.module-head{display:flex;justify-content:space-between;align-items:center}.module-icon{width:34px;height:34px;border-radius:10px;background:#f0f5e5;color:#55733e;display:grid;place-items:center;font-size:10px;font-weight:800}.arrow{color:#9aabad}.module-card h3{font-size:13px;margin:13px 0 5px}.module-card p{font-size:11px;line-height:1.55;color:#829499;margin:0}.notice{padding:18px 20px;background:#f9fbf4;border:1px solid #e5ebd6;border-radius:12px;color:#61734c;font-size:12px;line-height:1.6}.module-detail{max-width:760px}.module-detail .panel{padding:24px}.login-wrap{min-height:100vh;display:grid;place-items:center;padding:24px;background:radial-gradient(ellipse at 25% 15%,#e7eed8,transparent 42%),#f4f7f8}.login-card{width:min(420px,100%);background:white;border:1px solid #e4eaeb;border-radius:18px;padding:32px;box-shadow:0 18px 60px #1a3e4a12}.login-card h1{font-size:24px;margin:26px 0 7px}.login-card p{font-size:13px;color:#758a90;margin:0 0 23px}.field{display:grid;gap:7px;margin:15px 0}.field label{font-size:12px;font-weight:650;color:#34505a}.field input,.field select{padding:12px;border:1px solid #d9e2e4;border-radius:8px;font:inherit;outline-color:#8ba64e;background:white}.check{font-size:12px;color:#637c83;display:flex;align-items:center;gap:8px;margin:16px 0}.button{width:100%;padding:12px;border:0;border-radius:8px;background:#173a46;color:#fff;font-weight:700;cursor:pointer}.error{font-size:12px;color:#a83232}.empty{padding:25px;text-align:center;color:#829499;font-size:12px}.action-link{display:inline-flex;align-items:center;justify-content:center;text-decoration:none;background:#173a46;color:#fff;border:0;border-radius:8px;padding:11px 15px;font:inherit;font-weight:600;font-size:12px;cursor:pointer}.form-panel{max-width:850px;background:white;border:1px solid #e5ebec;border-radius:14px;padding:24px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 20px}.form-actions{display:flex;justify-content:flex-end;align-items:center;gap:18px;border-top:1px solid #e8eeee;padding-top:18px;margin-top:12px}.form-actions a{font-size:12px;color:#71878d;text-decoration:none}.table-wrap{overflow-x:auto}.data-table{border-collapse:collapse;width:100%;font-size:12px;text-align:left}.data-table th{background:#fafcfc;color:#829499;text-transform:uppercase;font-size:10px;letter-spacing:.08em;font-weight:700}.data-table th,.data-table td{padding:14px 17px;border-bottom:1px solid #edf1f1;white-space:nowrap}.data-table td:first-child{white-space:normal}.data-table td strong,.data-table td small{display:block}.data-table td small{font-size:10px;color:#829499;margin-top:4px}.status-pill{display:inline-block;padding:5px 8px;border-radius:99px;background:#eff4e7;color:#58733d;font-size:10px;text-transform:capitalize}.status-on_leave{background:#fff4dd;color:#97712d}.status-inactive{background:#f3e9e8;color:#98615d}.pagination{padding:14px 18px;font-size:12px}
        @media(max-width:900px){.shell{grid-template-columns:72px minmax(0,1fr)}.sidebar{padding:24px 9px}.brand{padding:0 8px}.brand-copy,.nav-label,.nav-text,.side-foot{display:none}.nav a{justify-content:center;padding:12px}.nav-icon{width:auto}.content{padding:28px 24px}.module-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media(max-width:600px){.topbar{padding:0 18px}.content{padding:24px 16px}.heading{align-items:start;flex-direction:column}.stats{grid-template-columns:1fr}.module-grid{grid-template-columns:1fr}.date{display:none}}
    </style>
</head>
<body>
<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}" style="text-decoration:none">
            <span class="brand-mark">B</span><span class="brand-copy"><strong>BRAVADO</strong><small>Enterprise platform</small></span>
        </a>
        <div>
            <div class="nav-label">Workspace</div>
            <nav class="nav">
                <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="nav-icon">OV</span><span class="nav-text">Overview</span></a>
            </nav>
        </div>
        <div>
            <div class="nav-label">Operations</div>
            <nav class="nav">
                @foreach(config('bems.modules') as $key => $item)
                    @if($key !== 'settings' && $key !== 'reports')
                        @if(auth()->user()->hasPermissionTo($key.'.view'))<a class="{{ ($key === 'people' && request()->routeIs('people.*')) || (request()->routeIs('modules.show') && request()->route('module') === $key) ? 'active' : '' }}" href="{{ $key === 'people' ? route('people.index') : route('modules.show', $key) }}"><span class="nav-icon">{{ $item['icon'] }}</span><span class="nav-text">{{ $item['name'] }}</span></a>@endif
                    @endif
                @endforeach
            </nav>
        </div>
        <div>
            <div class="nav-label">Management</div>
            <nav class="nav">
                @foreach(['reports', 'settings'] as $key)
                    @if(auth()->user()->hasPermissionTo($key.'.view'))<a href="{{ route('modules.show', $key) }}"><span class="nav-icon">{{ config('bems.modules.'.$key.'.icon') }}</span><span class="nav-text">{{ config('bems.modules.'.$key.'.name') }}</span></a>@endif
                @endforeach
            </nav>
        </div>
        <div class="side-foot">Bravado Enterprise Management System<br>Modular operations · {{ now()->format('Y') }}</div>
    </aside>
    <main class="main">
        <header class="topbar">
            <div class="crumb">Bravado <span style="padding:0 7px;color:#c6d1d2">/</span> {{ $title ?? 'Overview' }}</div>
            <div class="userbox">
                <span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <span>{{ auth()->user()->name }}</span>
                <form method="post" action="{{ route('logout') }}">@csrf<button class="logout" type="submit">Sign out</button></form>
            </div>
        </header>
        <section class="content">@yield('content')</section>
    </main>
</div>
</body>
</html>
