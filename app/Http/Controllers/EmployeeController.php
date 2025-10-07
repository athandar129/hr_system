<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'positionLevel', 'workLocation', 'leaveRule'])->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 $departments = Department::all();
        $positions = Position::all();
        $positionLevels = PositionLevel::all();
        $workLocations = WorkLocation::all();
        $leaveRules = LeaveRule::all();

        return view('employees.create', compact('departments','positions','positionLevels','workLocations','leaveRules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'employee_code' => 'required|unique:employees',
            'eng_first_name' => 'required',
            'eng_last_name' => 'nullable',
            'email' => 'required|email|unique:employees',
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'positionlvl_id' => 'nullable|exists:position_levels,id',
            'work_location_id' => 'nullable|exists:work_locations,id',
            'leave_rule_id' => 'nullable|exists:leave_rules,id',
            'role' => 'nullable|in:staff,manager,admin',
             ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
         $departments = Department::all();
        $positions = Position::all();
        $positionLevels = PositionLevel::all();
        $workLocations = WorkLocation::all();
        $leaveRules = LeaveRule::all();

        return view('employees.edit', compact('employee','departments','positions','positionLevels','workLocations','leaveRules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
         $validated = $request->validate([
            'employee_code' => 'required|unique:employees,employee_code,'.$employee->id,
            'eng_first_name' => 'required',
            'eng_last_name' => 'nullable',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'positionlvl_id' => 'nullable|exists:position_levels,id',
            'work_location_id' => 'nullable|exists:work_locations,id',
            'leave_rule_id' => 'nullable|exists:leave_rules,id',
            'role' => 'nullable|in:staff,manager,admin',
            ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
         $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
