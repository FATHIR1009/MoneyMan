<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
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
            'type' => 'income',
            'description' => fake()->sentence(3),
            'amount' => fake()->numberBetween(10000, 500000),
            'wallet_id' => Wallet::factory(),
            'destination_wallet_id' => null,
            'transaction_date' => now()->toDateString(),
        ];
    }

    /**
     * Indicate that the transaction is an expense.
     */
    public function expense(): static
    {
        return $this->state(fn () => [
            'type' => 'expense',
        ]);
    }

    /**
     * Indicate that the transaction is an income.
     */
    public function income(): static
    {
        return $this->state(fn () => [
            'type' => 'income',
        ]);
    }

    /**
     * Indicate that the transaction is a transfer.
     */
    public function transfer(): static
    {
        return $this->state(fn () => [
            'type' => 'transfer',
        ]);
    }
}
