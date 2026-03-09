<?php

namespace Database\Seeders;

use App\Models\ProductUnit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Piece',
                'abbreviation' => 'pc',
            ],
            [
                'name' => 'Kilogram',
                'abbreviation' => 'kg',
            ],
            [
                'name' => 'Gram',
                'abbreviation' => 'g',
            ],
            [
                'name' => 'Liter',
                'abbreviation' => 'L',
            ],
            [
                'name' => 'Pack',
                'abbreviation' => 'pk',
            ],
        ];

        foreach ($data as $unit) {
            ProductUnit::create($unit);
        }
    }
}
