<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'child_id',
    'monitoring_date',
    'weight',
    'height',
    'muac',
    'bilateral_pitting_edema',
    
];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }


}
