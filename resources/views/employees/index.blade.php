@extends('layouts.admin')

@section('title', 'Employees')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Employees</h3>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
</div>

@include('partials.alerts')

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Division</th>
            <th>Position</th>
            <th>Level</th>
            <th>Salary</th>
            <th style="width:130px">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employees as $emp)
            <tr>
                <td>{{ $loop->iteration + ($employees->currentPage()-1)*$employees->perPage() }}</td>
                <td>{{ $emp->employee_id }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->department->name ?? '-' }}</td>
                <td>{{ $emp->division->name ?? '-' }}</td>
                <td>{{ $emp->position->name ?? '-' }}</td>
                <td>{{ $emp->position_level ?? '-' }}</td>
                <td>{{ $emp->salary ? number_format($emp->salary, 2) : '-' }}</td>
                <td>
                    <a href="{{ route('employees.edit', $emp) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $emp) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this employee?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">No employees found.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $employees->links() }}
@endsection
