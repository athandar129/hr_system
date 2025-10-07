<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'title',
        'local_first_name',
        'local_last_name',
        'eng_first_name',
        'eng_last_name',
        'gender',
        'marital_status',
        'emp_type',
        'work_type',
        'employment_status',
        'uid',
        'email',
        'phone',
        'nationality',
        'race',
        'religion',
        'address',
        'city',
        'qualification',
        'division_id',
        'department_id',
        'position_id',
        'positionlvl_id',
        'work_location_id',
        'leave_rule_id',
        'dob',
        'hired_at',
        'joined_at',
        'approve_person',
        'salary',
        'photo',
        'role', // staff, manager, admin
    ];
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function positionLevel()
    {
        return $this->belongsTo(PositionLevel::class, 'positionlvl_id');
    }

    public function workLocation()
    {
        return $this->belongsTo(WorkLocation::class);
    }

    public function leaveRule()
    {
        return $this->belongsTo(LeaveRule::class);
    }

    /**
     * Helper methods
     */

    // Check if employee is a manager
    public function isManager()
    {
        // Option 1: Using role
        if (isset($this->role)) {
            return $this->role === 'manager';
        }

        // Option 2: Using position name
        if ($this->position) {
            return str_contains(strtolower($this->position->position_name), 'manager');
        }

        return false;
    }

    // Get full name
    public function fullName($lang = 'eng')
    {
        if ($lang === 'local') {
            return $this->local_first_name . ' ' . $this->local_last_name;
        }
        return $this->eng_first_name . ' ' . $this->eng_last_name;
    }
}
