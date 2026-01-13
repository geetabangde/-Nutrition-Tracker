<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_name',
        'child_code',
        'age',
        'gender',
        'mother_name',
        'father_name',
        'address',
        'anganwadi_center',
        'monitoring_date',
        'weight',
        'height',
        'muac',
        'bilateral_pitting_edema',
        'nutrition_status',
        'image'
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function getImageAttribute($value)
    {
        return $value ? url($value) : null;
    }

}