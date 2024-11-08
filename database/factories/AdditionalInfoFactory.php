<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalInfo>
 */
class AdditionalInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define an array of 10 Arabic professions (7iraf)
        $hiraf = [
            'نجار', // Carpenter
            'حداد', // Blacksmith
            'كهربائي', // Electrician
            'سباك', // Plumber
            'مزارع', // Farmer
            'نجار', // Carpenter
            'ميكانيكي', // Mechanic
            'حلاق', // Barber
            'خياط', // Tailor
            'خباز'  // Baker
        ];

        return [
            'user_id' => User::all()->random()->id,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCevVbi_1eUp1UaHjKO0AYUSEViJvIvjkTWwSdjwBoc8YZUR3cOiJHa8OX-brtOQ5IBuY&usqp=CAU',
            'rating' => $this->faker->optional()->randomFloat(1, 0, 5), // Optional rating
            'hirfa' => $this->faker->randomElement($hiraf),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'city' => $this->faker->city,
            'availability' => $this->faker->boolean,
            'CIN' => $this->faker->word, // Change as per your requirements
            'biography' => $this->faker->paragraph,
        ];
    }
}
