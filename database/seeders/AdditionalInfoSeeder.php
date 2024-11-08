<?php

namespace Database\Seeders;

use App\Models\AdditionalInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalInfo::factory()->count(50)->create();
    }
}
