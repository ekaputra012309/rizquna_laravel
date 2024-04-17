<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Privilage;

class PrivilagesTableSeeder extends Seeder
{
    public function run()
    {
        // Create a privilage with role_id = 1 and user_id = 1
        Privilage::create([
            'role_id' => 1,
            'user_id' => 1,
            // Add other fields if needed
        ]);
    }
}
