<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['nit', 'razon_social', 'type', 'active'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id', 'order_id');
    }
}
