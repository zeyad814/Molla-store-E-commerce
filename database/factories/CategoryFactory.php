<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => 0, // You can modify this based on your category hierarchy
            'category_name' => $this->faker->word,
            'category_image' => $this->faker->imageUrl(),
            'url'=>$this->faker->url(),
            'category_discount' => $this->faker->randomFloat(2, 0, 50),
            'description' => $this->faker->paragraph,
            // 'meta_title' => $this->faker->sentence,
            // 'meta_description' => $this->faker->paragraph,
            // 'meta_keywords' => $this->faker->words(5, true),
        ];
    }
}
