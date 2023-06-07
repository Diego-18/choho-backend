<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['prefix', 'profile', 'family', 'group', 'subgroup', 'description', 'subtotal', 'iva', 'total', 'order_id', 'product_id'];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order', 'id', 'order_id');
    }
}
