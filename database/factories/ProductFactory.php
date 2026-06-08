<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => Category::inRandomOrder()->first()?->id,
            'subcategory_id' => Subcategory::inRandomOrder()->first()?->id,
            'brand_id' => Brand::inRandomOrder()->first()?->id,
            'image' => 'https://picsum.photos/600/600?random=' . rand(1, 1000),
            'price' => rand(3000, 100000),
            'quantity' => rand(1, 20),
            'status' => rand(0, 1),
            'description' => $this->faker->sentence(15),
        ];
    }
}
