<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price_month',
        'price_year',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
