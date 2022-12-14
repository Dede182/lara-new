<?php

namespace Database\Factories;

use App\Models\User;
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
            'folder'=>$firstName,
            'email' => fake()->safeEmail(),
            'color' => fake()->hexColor(),
            'phone' => '09'.fake()->numerify('##########'),
            'user_id' => User::inRandomOrder()->first()
        ];
    }
}
