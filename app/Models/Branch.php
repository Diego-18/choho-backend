<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['nit', 'phone', 'address', 'department_id', 'city_id', 'name'];

    public function department()
    {
        return $this->hasMany('App\Models\Department', 'id', 'department_id');
    }

    public function city()
    {
        return $this->hasMany('App\Models\City', 'id', 'city_id');
    }
}
