<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionLevel extends Model
{
     protected $fillable = [
        'level_name', // e.g., Junior, Senior, Lead
        'description',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'positionlvl_id');
    }
}
