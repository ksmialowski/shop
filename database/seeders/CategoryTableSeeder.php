<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = 'Category One';
        DB::table('category')->insert([
            'id_category' => 1,
            'category_name' => $title,
            'category_slug' => Str::slug($title),
            'category_description' => Factory::create()->text(100),
            'category_order' => 1,
            'category_color' => '#000000',
            'category_status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
