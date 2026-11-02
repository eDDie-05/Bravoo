@extends('layouts.app', ['title' => 'Overview'])

@section('content')
<div class="eyebrow">Company operations</div>
<div class="heading">
    <div><h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }}.</h1><p>Your central workspace for Bravado operations.</p></div>
    <div class="date">{{ now()->format('l, d F Y') }}</div>
</div>
<div class="stats">
    <article class="stat"><div class="stat-top"><span>Active employees</span><span class="stat-mark">HR</span></div><div class="stat-value">{{ auth()->user()->hasPermissionTo('people.view') ? \App\Models\Employee::where('employment_status', 'active')->count() : '—' }}</div><div class="stat-foot">{{ auth()->user()->hasPermissionTo('people.view') ? 'Across all departments' : 'People access required' }}</div></article>
    <article class="stat"><div class="stat-top"><span>Departments</span><span class="stat-mark">OR</span></div><div class="stat-value">{{ auth()->user()->hasPermissionTo('people.view') ? \Illuminate\Support\Facades\DB::table('departments')->where('is_active', true)->count() : '—' }}</div><div class="stat-foot">{{ auth()->user()->hasPermissionTo('people.view') ? 'Active company teams' : 'People access required' }}</div></article>
    <article class="stat"><div class="stat-top"><span>Business modules</span><span class="stat-mark">BM</span></div><div class="stat-value">{{ count(config('bems.modules')) }}</div><div class="stat-foot">Connected in one platform</div></article>
</div>
<div class="section-head"><div><h2>Business modules</h2><p>Open a workspace to see its scope and delivery status.</p></div></div>
<div class="module-grid">
    @foreach(config('bems.modules') as $key => $module)
        @if(auth()->user()->hasPermissionTo($key.'.view'))
        <a href="{{ $key === 'people' ? route('people.index') : route('modules.show', $key) }}" class="module-card"><div class="module-head"><span class="module-icon">{{ $module['icon'] }}</span><span class="arrow">↗</span></div><h3>{{ $module['name'] }}</h3><p>{{ $module['description'] }}</p></a>
        @endif
    @endforeach
</div>
<div class="section-head"><div><h2>Platform foundation</h2><p>Shared controls used by every department.</p></div></div>
<div class="notice">Central sign-in, employee and department records, role and permission tables, and a minimized audit trail are in place as the first foundation. Module workflows will be delivered in phases; no operational records are seeded by default.</div>
@endsection
