<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Employee::with(['department','division','position','grade','workLocation']);

    if ($q = $request->get('q')) {
        $query->where(function($q2) use ($q) {
            $q2->where('first_name','like', "%{$q}%")
               ->orWhere('last_name','like', "%{$q}%")
               ->orWhere('employee_code','like', "%{$q}%");
        });
    }
    if ($dept = $request->get('department_id')) {
        $query->where('department_id', $dept);
    }

    $employees = $query->orderBy('id','desc')->paginate($request->get('per_page', 10));

    return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
