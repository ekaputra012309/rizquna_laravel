<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['kode_role' => 'superadmin', 'nama_role' => 'Super Admin'],
            ['kode_role' => 'admin', 'nama_role' => 'Administrator'],
            ['kode_role' => 'marketing', 'nama_role' => 'Marketing'],
            ['kode_role' => 'finance', 'nama_role' => 'Finance'],
            // Add more roles as needed
        ];

        // Insert roles into the database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
