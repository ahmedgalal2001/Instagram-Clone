<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'image_url' => $this->faker->imageUrl(), // Assuming you store the image URL
            'caption' => $this->faker->sentence,
        ];
    }
}
