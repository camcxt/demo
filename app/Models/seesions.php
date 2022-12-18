<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seesions extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    public $timestamps = false;
    protected $fillable = [
        // 'product_id',
        // 'product_name',
        // 'image',
        // 'price',
        // 'old_price'
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];
}
