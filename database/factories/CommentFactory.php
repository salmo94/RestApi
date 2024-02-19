<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => fake()->text(255),
            'parent_id' => Comment::inRandomOrder()->first() ? Comment::inRandomOrder()->first()->id : null,
            'author_id' => User::get()->random()->id,
            'post_id' => Post::get()->random()->id,
            'created_at' => fake()->date(),
            'updated_at' => fake()->date()
        ];
    }
}
