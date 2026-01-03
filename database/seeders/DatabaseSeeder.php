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
        // Classic Models sample data
        $this->call(ClassicModelsSeeder::class);

        // Create users from employees
        $this->call(UserSeeder::class);
    }
}
