<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = [User::CONTRIBUTOR,User::EDITOR];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$il4BjqqWj31JJCfNUX0L3..0HmN8iYe.gWoGy.euncviNFZ3MjknO', // secret
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber,
            'role' => $roles[mt_rand(0,1)]
        ];
    }
}
