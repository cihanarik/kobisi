<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'company_id',
        'start_date',
        'end_date',
        'cycle',
    ];
    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }


    protected $hidden = ['created_at', 'updated_at'];
}
