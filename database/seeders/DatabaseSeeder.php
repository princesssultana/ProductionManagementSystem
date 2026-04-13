<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
    $this->call([
        UserTableSeeder::class,
    ]);
=======
        $this->call([
            UserSeeder::class,
            FactorySettingsSeeder::class,
        ]);
    }
>>>>>>> e3989e50dde883befeaef22580326c02260ff211
}
    }

