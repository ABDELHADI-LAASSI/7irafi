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
            'user_id' => User::whereIn('role', ['user', 'hirafi'])->inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'date_posted' => now(),
        ];
    }
}
