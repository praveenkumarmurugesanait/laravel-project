<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Profile;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone_number' => $this->faker->unique()->numerify('##########'),
            'address' => $this->faker->address,
            'city_name' => $this->faker->city,
            'state' => $this->faker->state,
        ];
    }
}