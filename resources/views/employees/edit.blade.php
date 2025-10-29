@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Edit Employee</h4>

        @include('partials.errors')

        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Employee ID</label>
                <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $employee->employee_id) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $d)
                            <option value="{{ $d->id }}" {{ old('department_id', $employee->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Division</label>
                    <select name="division_id" class="form-select">
                        <option value="">-- Select Division --</option>
                        @foreach($divisions as $d)
                            <option value="{{ $d->id }}" {{ old('division_id', $employee->division_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Position</label>
                    <select name="position_id" class="form-select">
                        <option value="">-- Select Position --</option>
                        @foreach($positions as $p)
                            <option value="{{ $p->id }}" {{ old('position_id', $employee->position_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Position Level</label>
                <input type="text" name="position_level" class="form-control" value="{{ old('position_level', $employee->position_level) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary', $employee->salary) }}">
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
