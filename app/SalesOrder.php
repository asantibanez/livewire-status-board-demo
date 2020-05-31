<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'client',
        'status',
        'total',
        'order',
    ];

    protected $attributes = [
        'order' => 0,
    ];
}
