@extends('layouts.app')
@section('title', 'Employees')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Employees</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $employee->employee_code }}</td>
            <td>{{ $employee->fullName() }}</td>
            <td>{{ $employee->department?->name }}</td>
            <td>{{ $employee->position?->position_name }}</td>
            <td>{{ $employee->role }}</td>
            <td>{{ $employee->employment_status }}</td>
            <td>
                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
