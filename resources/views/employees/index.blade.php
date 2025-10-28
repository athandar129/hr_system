@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Employee List</h3>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Department</th><th>Division</th><th>Position</th><th>Salary</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->employee_id }}</td>
            <td>{{ $emp->name }}</td>
            <td>{{ $emp->department->name ?? '' }}</td>
            <td>{{ $emp->division->name ?? '' }}</td>
            <td>{{ $emp->position->name ?? '' }}</td>
            <td>{{ $emp->salary }}</td>
            <td>
                <form action="{{ route('employees.destroy', $emp->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
