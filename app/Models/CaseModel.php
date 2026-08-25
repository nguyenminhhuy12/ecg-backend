<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    protected $table = 'cases'; 
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ecgImages()
    {
        return $this->hasMany(EcgImage::class, 'case_id');
    }

    public function prediction()
    {
        return $this->hasOne(Prediction::class, 'case_id');
    }
    protected $fillable = [
        'patient_id',
        'measured_at',
        'status',
        'note'
    ];
}
