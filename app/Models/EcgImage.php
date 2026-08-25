<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EcgImage extends Model
{
    use HasFactory;

    protected $table = 'ecg_images';

    protected $fillable = [
        'case_id',
        'file_path',
        'file_name',
    ];

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
}
