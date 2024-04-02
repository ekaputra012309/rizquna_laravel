<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin PT Rizquna',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admindemo')
            ]
        ];

        // Looping and Inserting Array's Users into User Table
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
