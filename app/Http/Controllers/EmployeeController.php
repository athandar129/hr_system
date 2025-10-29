<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $employees = Employee::with(['department', 'division', 'position'])->paginate(15);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $divisions = Division::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('employees.create', compact('departments', 'divisions', 'positions'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'employee_id' => 'required|string|unique:employees,employee_id',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'department_id' => 'nullable|exists:departments,id',
        'division_id' => 'nullable|exists:divisions,id',
        'position_id' => 'nullable|exists:positions,id',
        'position_level' => 'nullable|string|max:100',
        'basic_salary' => 'nullable|numeric|min:0', // ✅ same name as migration
        'join_date' => 'nullable|date',
    ]);

    Employee::create($data);

    return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
}

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        $divisions = Division::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'departments', 'divisions', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'employee_id' => 'required|string|unique:employees,employee_id,' . $employee->id,
            'name' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'division_id' => 'nullable|exists:divisions,id',
            'position_id' => 'nullable|exists:positions,id',
            'position_level' => 'nullable|string|max:100',
            'salary' => 'nullable|numeric|min:0'
        ]);

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
