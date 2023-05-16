<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_config' => 1,
                'config_name' => 'address',
                'config_value' => 'Jl. Raya Cipadung No. 9, Bandung, Jawa Barat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_config' => 2,
                'config_name' => 'phone',
                'config_value' => '123456789',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_config' => 3,
                'config_name' => 'email',
                'config_value' => 'example@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('config')->insert($data);
    }
}
