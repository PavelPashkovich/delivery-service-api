<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => 'Notebook',
            'description' => 'Good, grey',
            'image' => fake()->imageUrl,
            'price' => fake()->randomNumber('3', true),
            'vendor_code' => fake()->imei,
        ];
    }
}
