<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'code',
        'name',
        'birth_year',
        'gender',
        'note',
    ];
    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
