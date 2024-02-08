<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'type' => $this->faker->randomElement(['banner', 'product', 'team', 'other']),  // Adjust as needed
            'link' => $this->faker->url(),
            'alt' => $this->faker->optional()->sentence(),
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => 1, // Default to active
            'title'=>$this->faker->words(10,true),
        ];
    }
}
