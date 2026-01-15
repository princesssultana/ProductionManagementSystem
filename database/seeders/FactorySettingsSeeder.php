<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FactorySetting;

class FactorySettingsSeeder extends Seeder
{
    public function run(): void
    {
        FactorySetting::create([
            'factory_name' => 'Main Factory',
            'max_capacity' => 10000,
            'min_stock_threshold' => 500,
            'status' => 'active',
        ]);

        FactorySetting::create([
            'factory_name' => 'Secondary Factory',
            'max_capacity' => 5000,
            'min_stock_threshold' => 200,
            'status' => 'active',
        ]);
    }
}
