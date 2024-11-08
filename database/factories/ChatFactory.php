<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::whereIn('role', ['user', 'hirafi'])->inRandomOrder()->first()->id,
            'receiver_id' => User::whereIn('role', ['user', 'hirafi'])->inRandomOrder()->first()->id,
            'message' => $this->faker->sentence,
            'timestamp' => now(),
        ];
    }
}
