<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Standard Product Shipping',
                'shipping_by' => 'product',
                'category_id' => null,
                'subcategory_id' => null,
                'cost' => 60.00,
                'is_multiple_by_quantity' => false,
                'estimated_delivery_time' => 3,
                'description' => 'Standard delivery for individual products within 3 working days.',
            ],
            [
                'name' => 'Express Product Shipping',
                'shipping_by' => 'product',
                'category_id' => null,
                'subcategory_id' => null,
                'cost' => 120.00,
                'is_multiple_by_quantity' => true,
                'estimated_delivery_time' => 1,
                'description' => 'Fast delivery service within 24 hours. Shipping cost increases per quantity.',
            ],
            [
                'name' => 'Electronics Category Shipping',
                'shipping_by' => 'category',
                'category_id' => 1,
                'subcategory_id' => null,
                'cost' => 150.00,
                'is_multiple_by_quantity' => false,
                'estimated_delivery_time' => 2,
                'description' => 'Special handling shipping for electronics category products.',
            ],
            [
                'name' => 'Clothing Subcategory Shipping',
                'shipping_by' => 'category',
                'category_id' => 2,
                'subcategory_id' => 5,
                'cost' => 80.00,
                'is_multiple_by_quantity' => true,
                'estimated_delivery_time' => 4,
                'description' => 'Shipping for specific clothing subcategory items. Cost applies per quantity.',
            ],
            [
                'name' => 'Free Promotional Shipping',
                'shipping_by' => 'product',
                'category_id' => null,
                'subcategory_id' => null,
                'cost' => 0.00,
                'is_multiple_by_quantity' => false,
                'estimated_delivery_time' => 5,
                'description' => 'Free shipping offer for selected promotional products.',
            ],
        ];

        foreach ($data as $unit) {
            Shipping::create($unit);
        }
    }
}
