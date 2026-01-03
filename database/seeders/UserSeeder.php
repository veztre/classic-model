<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employees and create users from them
        $employees = Employee::all();

        foreach ($employees as $employee) {
            User::firstOrCreate(
                ['email' => $employee->email],
                [
                    'email' => $employee->email,
                    'password' => Hash::make('password'), // Default password
                ]
            );
        }
    }
}
