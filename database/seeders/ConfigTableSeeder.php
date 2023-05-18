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
            ],
            [
                'id_config' => 4,
                'config_name' => 'facebook',
                'config_value' => 'https://www.facebook.com/',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_config' => 5,
                'config_name' => 'instagram',
                'config_value' => 'https://www.instagram.com/',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_config' => 6,
                'config_name' => 'twitter',
                'config_value' => 'https://twitter.com/',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_config' => 7,
                'config_name' => 'linkedin',
                'config_value' => 'https://www.linkedin.com/',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('config')->insert($data);
    }
}
