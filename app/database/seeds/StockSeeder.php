<?php

use Illuminate\Database\Seeder;
use App\Stock;

class StockSeeder extends Seeder
{
    public function run()
    {
        // サンプルデータの挿入
        Stock::create([
            'store_id' => 1,
            'product_id' => 1,
            'quantity' => 10,
            'weight' => 5.2,
            // 他のカラムについても同様にデータを挿入する
        ]);

        Stock::create([
            'store_id' => 2,
            'product_id' => 2,
            'quantity' => 15,
            'weight' => 6.5,
            // 他のカラムについても同様にデータを挿入する
        ]);

        // 他のサンプルデータの挿入
    }
}
