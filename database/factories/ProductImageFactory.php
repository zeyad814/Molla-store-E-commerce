<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),  // Associate with a valid product
            'image' => $this->faker->imageUrl(640, 480),   // Generate a random image URL
            'image_sort' => $this->faker->numberBetween(1, 5),
            'status' => 1,
        ];
    }
}
