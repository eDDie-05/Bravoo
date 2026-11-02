<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()->hasPermissionTo('people.view'), 403);

        return view('people.index', [
            'employees' => Employee::with('department')->orderBy('last_name')->orderBy('first_name')->paginate(20),
            'activeCount' => Employee::where('employment_status', 'active')->count(),
            'departmentCount' => Department::where('is_active', true)->count(),
        ]);
    }

    public function create(): View
    {
        abort_unless(auth()->user()->hasPermissionTo('employees.manage'), 403);

        return view('people.create', ['departments' => Department::where('is_active', true)->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()->hasPermissionTo('employees.manage'), 403);

        $data = $request->validate([
            'employee_number' => ['required', 'string', 'max:40', 'unique:employees,employee_number'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'work_email' => ['nullable', 'email', 'max:255', 'unique:employees,work_email'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'job_title' => ['nullable', 'string', 'max:120'],
            'started_on' => ['nullable', 'date', 'before_or_equal:today'],
            'employment_status' => ['required', 'in:active,on_leave,inactive'],
        ]);

        Employee::create($data);

        return redirect()->route('people.index')->with('status', 'Employee record created.');
    }
}
