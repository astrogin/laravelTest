<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'plan_id',
        'user_id',
        'status',
        'price'
    ];
}
