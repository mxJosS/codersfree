<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices =[0, 10, 20, 30, 40, 50];
        foreach($prices as $price){
            Price::create([
                'value' => $price,
            ]); 
        }
    }
}
