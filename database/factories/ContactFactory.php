<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->firstName();
        $secondName = fake()->lastName();
        return [
            'firstName' => $firstName,
            'secondName' => $secondName,
            'fullName' => $firstName . " " . $secondName,
            'email' => fake()->safeEmail(),
            'color' => fake()->hexColor(),
            'phone' => '09'.fake()->numerify('##########')
        ];
    }
}
