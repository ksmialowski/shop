<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use JsonException;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run()
    {
        $productName = 'Product Name';
        DB::table('products')->insert([
            'id_product' => 1,
            'id_category' => 1,
            'product_name' => $productName,
            'product_slug' => Str::slug($productName),
            'product_type' => 'product',
            'product_description' => 'Product Description',
            'product_price' => 100.00,
            'product_quantity' => 10,
            'product_specification' => json_encode([
                'product_specification_1'  => 'Product Specification 1',
                'product_specification_2'  => 'Product Specification 2',
                'product_specification_3'  => 'Product Specification 3',
                'product_specification_4'  => 'Product Specification 4',
                'product_specification_5'  => 'Product Specification 5',
                'product_specification_6'  => 'Product Specification 6',
                'product_specification_7'  => 'Product Specification 7',
                'product_specification_8'  => 'Product Specification 8',
                'product_specification_9'  => 'Product Specification 9',
                'product_specification_10' => 'Product Specification 10',
            ], JSON_THROW_ON_ERROR),
            'product_status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
