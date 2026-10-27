<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement(['Cash', 'GoPay', 'DANA', 'Bank Mandiri', 'BCA']),
            'type' => fake()->randomElement(['Fisik', 'E-Wallet', 'Bank']),
            'initial_balance' => fake()->numberBetween(50000, 1000000),
        ];
    }
}
