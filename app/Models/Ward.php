<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'prefix',
        'province_id',
        'district_id'
    ];
}
