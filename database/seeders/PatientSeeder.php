<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'code' => 'BN001',
            'name' => 'Nguyen Van A',
            'birth_year' => 1998,
            'gender' => 'male',
            'note' => 'Demo patient from seeder'
        ]);

        Patient::create([
            'code' => 'BN002',
            'name' => 'Tran Thi B',
            'birth_year' => 2000,
            'gender' => 'female',
            'note' => 'Demo patient from seeder'
        ]);

    }
}
