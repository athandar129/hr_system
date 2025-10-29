@extends('layouts.admin')

@section('title', 'Employee Detail')

@section('content')
<h3>Employee Detail</h3>
<table class="table table-bordered">
    <tr><th>Employee ID</th><td>{{ $employee->employee_id }}</td></tr>
    <tr><th>Name</th><td>{{ $employee->name }}</td></tr>
    <tr><th>Department</th><td>{{ $employee->department->name ?? '-' }}</td></tr>
    <tr><th>Division</th><td>{{ $employee->division->name ?? '-' }}</td></tr>
    <tr><th>Position</th><td>{{ $employee->position->name ?? '-' }}</td></tr>
    <tr><th>Position Level</th><td>{{ $employee->position_level ?? '-' }}</td></tr>
    <tr><th>Salary</th><td>{{ $employee->salary ? number_format($employee->salary,2) : '-' }}</td></tr>
</table>
<a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
@endsection
