<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_date', 'prefix', 'order_number', 'seller', 'provider_id', 'department_id', 'city_id', 'user_id'];

    public function provider()
    {
        return $this->hasMany('App\Models\Provider', 'id', 'provider_id');
    }

    public function department()
    {
        return $this->hasMany('App\Models\Department', 'id', 'department_id');
    }

    public function city()
    {
        return $this->hasMany('App\Models\City', 'id', 'city_id');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\Models\OrderDetail', 'id', 'order_id');
    }

}
