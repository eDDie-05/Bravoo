@extends('layouts.app', ['title' => 'Add employee'])

@section('content')
<div class="eyebrow">People operations</div>
<div class="heading"><div><h1>Add employee</h1><p>Create a shared employee record. Sign-in accounts are managed separately.</p></div></div>
<div class="form-panel">
    <form method="post" action="{{ route('people.employees.store') }}">@csrf
        <div class="form-grid">
            <div class="field"><label for="employee_number">Employee number *</label><input id="employee_number" name="employee_number" value="{{ old('employee_number') }}" required maxlength="40">@error('employee_number')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="department_id">Department</label><select id="department_id" name="department_id"><option value="">Unassigned</option>@foreach($departments as $department)<option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>@endforeach</select>@error('department_id')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="first_name">First name *</label><input id="first_name" name="first_name" value="{{ old('first_name') }}" required maxlength="100">@error('first_name')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="last_name">Last name *</label><input id="last_name" name="last_name" value="{{ old('last_name') }}" required maxlength="100">@error('last_name')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="work_email">Work email</label><input id="work_email" name="work_email" type="email" value="{{ old('work_email') }}" maxlength="255">@error('work_email')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="job_title">Job title</label><input id="job_title" name="job_title" value="{{ old('job_title') }}" maxlength="120">@error('job_title')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="started_on">Start date</label><input id="started_on" name="started_on" type="date" value="{{ old('started_on') }}" max="{{ now()->toDateString() }}">@error('started_on')<span class="error">{{ $message }}</span>@enderror</div>
            <div class="field"><label for="employment_status">Employment status *</label><select id="employment_status" name="employment_status" required>@foreach(['active' => 'Active', 'on_leave' => 'On leave', 'inactive' => 'Inactive'] as $value => $label)<option value="{{ $value }}" @selected(old('employment_status', 'active') === $value)>{{ $label }}</option>@endforeach</select>@error('employment_status')<span class="error">{{ $message }}</span>@enderror</div>
        </div>
        <div class="form-actions"><a href="{{ route('people.index') }}">Cancel</a><button class="action-link" type="submit">Save employee</button></div>
    </form>
</div>
@endsection
