<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department_id'];

    public function department()
    {
        return $this->hasMany('App\Models\Department', 'id', 'department_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id', 'order_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Branch', 'id', 'city_id');
    }
}
