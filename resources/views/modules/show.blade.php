@extends('layouts.app', ['title' => $module['name']])

@section('content')
<div class="eyebrow">Business module</div>
<div class="heading"><div><h1>{{ $module['name'] }}</h1><p>{{ $module['description'] }}</p></div></div>
<div class="module-detail">
    <div class="panel">
        <div class="module-head"><span class="module-icon">{{ $module['icon'] }}</span><span class="eyebrow">Planned workspace</span></div>
        <h2 style="font-size:18px;margin:19px 0 8px">{{ $module['name'] }} foundation</h2>
        <p style="font-size:13px;line-height:1.7;color:#71878d;margin:0">This workspace is part of the Bravado modular platform. Its screens, data workflows and permissions will be added in the delivery phases documented in the project roadmap. Shared identity and department records will be reused throughout.</p>
        <div class="notice" style="margin-top:20px">The module is currently a navigation and scope placeholder. No sample business records are shown as real company data.</div>
    </div>
</div>
@endsection
