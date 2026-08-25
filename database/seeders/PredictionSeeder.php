<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prediction;
use App\Models\CaseModel;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prediction::create([
            'case_id' => 2,
            'user_id' => 2,
            'label' => 'MI',
            'confidence' => 0.92
        ]);
    }
}
