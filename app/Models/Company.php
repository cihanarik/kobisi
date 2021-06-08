<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_url',
        'name',
        'lastname',
        'company_name',
        'email',
        'password',
        'token',
        'status'
    ];

    public function company_package()
    {
        return $this->hasOne(CompanyPackage::class, 'company_id');
    }

    public function company_payments()
    {
        return $this->hasMany(CompanyPayment::class, 'company_id');
    }




    protected $hidden = [
        'token',
        'password',
        'created_at',
        'updated_at'
    ];
}
