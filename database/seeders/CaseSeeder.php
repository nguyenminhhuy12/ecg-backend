<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CaseModel;
use App\Models\Patient;
use App\Models\User;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseModel::create([
            'patient_id' => 1, // PHẢI tồn tại trong patients
            'measured_at' => now(),
            'status' => 'uploaded'
        ]);
    }
}
