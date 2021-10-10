<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();


        $usersQuantity = 500;
        $categoryQuantity =300;
        $productQuantity = 100;
        $transactionsQuantity = 200;

        User::factory()->count($usersQuantity)->create();
        Category::factory()->count($categoryQuantity)->create();
        Product::factory()->count($productQuantity)->create()->each(
         function($product){
             $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
             $product->categories()->attach($categories);
         }
        );
        Transaction::factory()->count($transactionsQuantity)->create();

     }
}
