<?php

namespace Database\Factories;

use App\Models\User;
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
                'title' => fake()->unique()->realTextBetween(20,50),
                'content' => fake()->text(1000),
                'is_published' => fake()->boolean(),
                'author_id' => User::get()->random()->id,
                'published_at' => fake()->date(),
                'created_at' => fake()->date(),
                'updated_at' => fake()->date()
            ];
    }
}
