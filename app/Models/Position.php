<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'position_code',
        'position_name',
        'positionlevel_id',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
