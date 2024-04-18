<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Privilage;

class PrivilagesTableSeeder extends Seeder
{
    public function run()
    {
        $privilages = [
            [
                'role_id' => 1,
                'user_id' => 1,
            ],
            [
                'role_id' => 2,
                'user_id' => 2,
            ],
        ];
        foreach ($privilages as $privilage) {
            Privilage::create($privilage);
        }
    }
}
