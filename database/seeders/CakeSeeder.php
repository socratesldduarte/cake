<?php

namespace Database\Seeders;

use App\Models\Cake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CREATE 10 CAKE EXAMPLES
        Cake::create([
            'name' => 'Bolo Cenoura e Chocolate 500g',
            'weight' => 500,
            'price' => 20.5,
            'available' => 10,
            'orders' => [
                [
                    'email' => 'socrates@swge.com.br',
                    'situation' => 'new',
                ],
                [
                    'email' => 'fulano@swge.com.br',
                    'situation' => 'new',
                ],
                [
                    'email' => 'beltrano@swge.com.br',
                    'situation' => 'new',
                ],
                [
                    'email' => 'siclano@swge.com.br',
                    'situation' => 'new',
                ],
            ],
        ]);
    }
}
