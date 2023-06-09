<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capital'];

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'id', 'city_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id', 'order_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'id', 'department_id');
    }
}
