<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'dept_code',
        'dept_name',
        'weeklyassign_id',
        'work_location_id',
        'leave_rule_id',
    ];

    /**
     * Relationships
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function workLocation()
    {
        return $this->belongsTo(WorkLocation::class);
    }

    public function leaveRule()
    {
        return $this->belongsTo(LeaveRule::class);
    }

    public function manager()
    {
        // If you add a manager_id field in departments table
        return $this->belongsTo(Employee::class, 'manager_id');
    }
}
