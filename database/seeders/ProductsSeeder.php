<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'company_id'=> '1',
        'product_name' => 'おーいお茶',
        'price' => '100',
        'stock' => '40',
        'comment' => '人気のお茶です。',
        'img_path' => null,
        ],
        [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'company_id'=> '2',
        'product_name' => 'カルピス',
        'price' => '140',
        'stock' => '30',
        'comment' => null,
        'img_path' => null,
        ],
        ]);

    }
}
