<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
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
        $employees = Employee::with(['department', 'division', 'position'])->get();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $divisions = Division::all();
        $positions = Position::all();
        return view('employee.create', compact('departments', 'divisions', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required',
            'department_id' => 'required',
            'division_id' => 'required',
            'position_id' => 'required',
            'salary' => 'required|numeric',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
