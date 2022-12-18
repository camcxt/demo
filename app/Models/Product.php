<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'image',
        'price',
        'old_price',
        'description',
        'tags',
        'is_best_sell',
        'is_new',
        'sort_order',
        'active',
        'amount'
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Products');
    }
}