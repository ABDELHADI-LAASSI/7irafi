<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestWork>
 */
class RequestWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id ,
            'hirafi_id' => User::where('role', 'hirafi')->inRandomOrder()->first()->id ,
            'description' => $this->faker->sentence,
            'status' => 'pending', // Default status
        ];
    }
}
