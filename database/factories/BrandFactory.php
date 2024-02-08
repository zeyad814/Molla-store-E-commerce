<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'brand_name' => $this->faker->company,
                'brand_image' => $this->faker->imageUrl(200, 200), // Adjust dimensions as needed
                'brand_logo' => $this->faker->imageUrl(100, 100), // Adjust dimensions as needed
                'brand_discount' => $this->faker->randomFloat(2, 0, 50), // Adjust range as desired
                'description' => $this->faker->paragraph,
                // 'meta_title' => $this->faker->sentence,
                // 'meta_description' => $this->faker->words(10, true),
                // 'meta_keywords' => $this->faker->company,
            ];
    }
}
