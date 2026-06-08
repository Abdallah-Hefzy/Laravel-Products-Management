<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
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
            'name'=>$name,
            'slug'=>Str::slug($name),
            'category_id'=>Category::inRandomOrder()->first()?->id,
            'image' =>'https://picsum.photos/600/600?random='.rand(1,1000),
        ];
    }
}
