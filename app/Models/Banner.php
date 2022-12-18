<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'sort_order',
        'active'
    ];

}
