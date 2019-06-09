<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::truncate();
//        Category::truncate();
//        Product::truncate();
//        Transaction::truncate();
//        DB::table('category_product')->trucante();

        $userQuantity = 200;
        $categoryQuantity = 30;
        $productQuantity = 1000;
        $transactionQuantity = 1000;

        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoryQuantity)->create();
        factory(Transaction::class, $transactionQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function ($product){
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
    }
}
