<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Employee extends Model
{
    use HasFactory;

protected $fillable = [
        'employee_id',
        'name',
        'email',
        'phone',
        'department_id',
        'division_id',
        'position_id',
        'position_level',
        'basic_salary',
        'join_date',
    ];
    public function department() { return $this->belongsTo(Department::class); }
    public function division() { return $this->belongsTo(Division::class); }
    public function position() { return $this->belongsTo(Position::class); }



}
