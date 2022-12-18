<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'product_name',
        'product_price',
        'product_image'
    ];

}
