@extends('layouts.app')
@section('title', 'Employee Details')
@section('content')
<div class="card">
    <div class="card-header">{{ $employee->fullName() }}</div>
    <div class="card-body">
        <p><strong>Employee Code:</strong> {{ $employee->employee_code }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Department:</strong> {{ $employee->department?->name }}</p>
        <p><strong>Position:</strong> {{ $employee->position?->position_name }}</p>
        <p><strong>Role:</strong> {{ $employee->role }}</p>
        <p><strong>Status:</strong> {{ $employee->employment_status }}</p>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection
