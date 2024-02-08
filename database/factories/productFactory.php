<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10), // Assuming you have 10 categories
            'brand_id' => $this->faker->numberBetween(1, 5), // Assuming you have 5 brands
            'product_name' => $this->faker->name,
            'product_code' => $this->faker->unique()->numerify('##-####'),
            'product_color' => $this->faker->randomElement(['Red', 'Blue', 'Black', 'Green', 'Yellow']),
            'product_price' => $this->faker->randomFloat(2, 10, 100),
            'product_discount' => $this->faker->randomFloat(2, 0, 50),
            'final_price' => $this->faker->randomFloat(2, 100, 1000),
            // 'product_video' => null, // Consider using Faker's youtube link generator if this is a video field
            'main_image'=>$this->faker->imageUrl(100, 100),
            'description' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(10, 50),
            'sku' => $this->faker->unique()->isbn13(),
            // 'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->words(10, true),
            // 'meta_keywords' => $this->faker->words(10, true),
            'is_featured' => $this->faker->randomElement(['yes', 'no']),
            'status' => 1,
        ];
    }
}
