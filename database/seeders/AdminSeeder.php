<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nayla.test'],
            [
                'name' => 'Admin N.A.Y.L.A',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
