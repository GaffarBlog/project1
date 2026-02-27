<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Men',
                'slug' => 'men',
                'description' => 'Men fashion and accessories',
                'subcategories' => [
                    [
                        'name' => 'Shirts',
                        'slug' => 'shirts',
                        'description' => 'Men shirts category',
                    ],
                    [
                        'name' => 'Pants',
                        'slug' => 'pants',
                        'description' => 'Men pants category',
                    ],
                    [
                        'name' => 'Shoes',
                        'slug' => 'shoes',
                        'description' => 'Men shoes category',
                    ],
                    [
                        'name' => 'Watches',
                        'slug' => 'watches',
                        'description' => 'Men watches category',
                    ],
                ],
            ],
            [
                'name' => 'Women',
                'slug' => 'women',
                'description' => 'Women fashion and accessories',
                'subcategories' => [
                    [
                        'name' => 'Dresses',
                        'slug' => 'dresses',
                        'description' => 'Women dresses category',
                    ],
                    [
                        'name' => 'Handbags',
                        'slug' => 'handbags',
                        'description' => 'Women handbags category',
                    ],
                ],
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets',
                'subcategories' => [
                    [
                        'name' => 'Mobile Phones',
                        'slug' => 'mobile-phones',
                        'description' => 'Smartphones and mobile phones',
                    ],
                    [
                        'name' => 'Laptops',
                        'slug' => 'laptops',
                        'description' => 'Laptops and notebooks',
                    ],
                    [
                        'name' => 'Tablets',
                        'slug' => 'tablets',
                        'description' => 'Tablet devices category',
                    ],
                    [
                        'name' => 'Accessories',
                        'slug' => 'electronics-accessories',
                        'description' => 'Electronic accessories',
                    ],
                    [
                        'name' => 'Smart Watches',
                        'slug' => 'smart-watches',
                        'description' => 'Smart wearable devices',
                    ],
                ],
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'description' => 'Home and kitchen products',
                'subcategories' => [
                    [
                        'name' => 'Furniture',
                        'slug' => 'furniture',
                        'description' => 'Home furniture category',
                    ],
                ],
            ],
            [
                'name' => 'Beauty & Health',
                'slug' => 'beauty-health',
                'description' => 'Beauty and health products',
                'subcategories' => [
                    [
                        'name' => 'Skincare',
                        'slug' => 'skincare',
                        'description' => 'Skin care products',
                    ],
                    [
                        'name' => 'Haircare',
                        'slug' => 'haircare',
                        'description' => 'Hair care products',
                    ],
                    [
                        'name' => 'Makeup',
                        'slug' => 'makeup',
                        'description' => 'Makeup and cosmetics',
                    ],
                ],
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'description' => 'Sports and outdoor equipment',
                'subcategories' => [
                    [
                        'name' => 'Fitness Equipment',
                        'slug' => 'fitness-equipment',
                        'description' => 'Gym and fitness equipment',
                    ],
                    [
                        'name' => 'Outdoor Gear',
                        'slug' => 'outdoor-gear',
                        'description' => 'Outdoor adventure gear',
                    ],
                ],
            ],
        ];

        foreach ($data as $item) {
            $parent = Category::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'description' => $item['description'],
            ]);

            if (isset($item['subcategories'])) {
                foreach ($item['subcategories'] as $subcategory) {
                    Category::create([
                        'name' => $subcategory['name'],
                        'slug' => $subcategory['slug'],
                        'description' => $subcategory['description'],
                        'parent_id' => $parent->id,
                    ]);
                }
            }
        }

    }
}
