<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'image_url',
        'sort_order',
        'active'
    ];
}
