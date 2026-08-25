<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EcgImage;
use App\Models\CaseModel;

class EcgImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EcgImage::create([
            'case_id' => 2, // PHẢI tồn tại trong cases
            'file_path' => 'storage/ecg/demo1.png',
            'file_name' => 'demo1.png'
        ]);
    }
}
