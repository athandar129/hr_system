<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'name', 'department_id', 'division_id',
        'position_id', 'position_level', 'salary'
    ];

    public function department() { return $this->belongsTo(Department::class); }
    public function division() { return $this->belongsTo(Division::class); }
    public function position() { return $this->belongsTo(Position::class); }

}
