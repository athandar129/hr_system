<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkLocation extends Model
{
        protected $fillable = [
        'location_name',
        'lat',
        'long',
        'range',
        'address',
        'city',
        'country',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
