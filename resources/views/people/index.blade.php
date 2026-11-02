@extends('layouts.app', ['title' => 'People & HR'])

@section('content')
<div class="eyebrow">People operations</div>
<div class="heading">
    <div><h1>Employee directory</h1><p>Manage the shared employee records used across Bravado.</p></div>
    @if(auth()->user()->hasPermissionTo('employees.manage'))<a class="action-link" href="{{ route('people.employees.create') }}">+ Add employee</a>@endif
</div>
@if(session('status'))<div class="notice" style="margin-bottom:18px">{{ session('status') }}</div>@endif
<div class="stats">
    <article class="stat"><div class="stat-top"><span>Active employees</span><span class="stat-mark">HR</span></div><div class="stat-value">{{ $activeCount }}</div><div class="stat-foot">Current employee records</div></article>
    <article class="stat"><div class="stat-top"><span>Departments</span><span class="stat-mark">OR</span></div><div class="stat-value">{{ $departmentCount }}</div><div class="stat-foot">Active company teams</div></article>
    <article class="stat"><div class="stat-top"><span>Directory</span><span class="stat-mark">ID</span></div><div class="stat-value">{{ $employees->total() }}</div><div class="stat-foot">Employee records</div></article>
</div>
<div class="panel" style="overflow:hidden">
    <div class="table-wrap"><table class="data-table"><thead><tr><th>Employee</th><th>Employee number</th><th>Department</th><th>Job title</th><th>Status</th></tr></thead><tbody>
        @forelse($employees as $employee)
            <tr><td><strong>{{ $employee->first_name }} {{ $employee->last_name }}</strong><small>{{ $employee->work_email ?: 'No work email' }}</small></td><td>{{ $employee->employee_number }}</td><td>{{ $employee->department?->name ?: 'Unassigned' }}</td><td>{{ $employee->job_title ?: '—' }}</td><td><span class="status-pill status-{{ $employee->employment_status }}">{{ str_replace('_', ' ', ucfirst($employee->employment_status)) }}</span></td></tr>
        @empty
            <tr><td colspan="5" class="empty">No employee records yet. Add the first record when you're ready.</td></tr>
        @endforelse
    </tbody></table></div>
    @if($employees->hasPages())<div class="pagination">{{ $employees->links() }}</div>@endif
</div>
@endsection
