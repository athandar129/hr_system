@extends('layouts.app')
@section('title', isset($employee) ? 'Edit Employee' : 'Add Employee')
@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
            @csrf
            @if(isset($employee)) @method('PUT') @endif

            <div class="mb-3">
                <label>Employee Code</label>
                <input type="text" name="employee_code" class="form-control" value="{{ old('employee_code', $employee->employee_code ?? '') }}">
            </div>

            <div class="mb-3">
                <label>First Name (English)</label>
                <input type="text" name="eng_first_name" class="form-control" value="{{ old('eng_first_name', $employee->eng_first_name ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Last Name (English)</label>
                <input type="text" name="eng_last_name" class="form-control" value="{{ old('eng_last_name', $employee->eng_last_name ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Department</label>
                <select name="department_id" class="form-select">
                    <option value="">Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ (isset($employee) && $employee->department_id == $dept->id) ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select">
                    <option value="staff" {{ (isset($employee) && $employee->role=='staff') ? 'selected' : '' }}>Staff</option>
                    <option value="manager" {{ (isset($employee) && $employee->role=='manager') ? 'selected' : '' }}>Manager</option>
                    <option value="admin" {{ (isset($employee) && $employee->role=='admin') ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button class="btn btn-success">{{ isset($employee) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</div>
@endsection

