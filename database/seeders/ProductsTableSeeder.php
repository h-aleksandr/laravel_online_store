<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	for($i=1; $i<=10; $i++)
     	DB::table('products')->insert([
            'title' => 'Product '.$i,
            'price' => rand(100,1500),
            'new_price' => rand(90, 1000),
            'in_stock' => 1,
            'description' => 'ome seeding operations may cause you to alter or lose data. In order to protect you from running seeding commands against your production database, you will be prompted for confirmation before the seeders are executed in the production environment. To force the seeders to run without a prompt, use the',
        ]);
    }
}
