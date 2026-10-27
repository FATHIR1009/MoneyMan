<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_dashboard_with_empty_database(): void
    {
        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Budi Santoso');
        $response->assertSee('Belum Ada Dompet');
        $response->assertSee('Belum ada transaksi');
        $response->assertSee('0 Dompet');
        $response->assertViewHas('totalBalance', 0.0);
        $response->assertViewHas('totalIncome', 0.0);
        $response->assertViewHas('totalExpense', 0.0);
        $response->assertViewHas('totalTransfer', 0.0);
    }

    public function test_dashboard_displays_correct_balances_and_summary_with_transactions(): void
    {
        $user = User::factory()->create();

        // Wallet 1: Saldo awal 100.000
        $wallet1 = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Dompet Utama',
            'type' => 'Fisik',
            'initial_balance' => 100000,
        ]);

        // Wallet 2: Saldo awal 50.000
        $wallet2 = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'E-Wallet',
            'type' => 'E-Wallet',
            'initial_balance' => 50000,
        ]);

        // Income to Wallet 1: 200.000
        Transaction::factory()->income()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet1->id,
            'amount' => 200000,
            'description' => 'Gaji Freelance',
            'transaction_date' => now()->toDateString(),
        ]);

        // Expense from Wallet 1: 50.000
        Transaction::factory()->expense()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet1->id,
            'amount' => 50000,
            'description' => 'Makan Siang',
            'transaction_date' => now()->toDateString(),
        ]);

        // Transfer from Wallet 1 to Wallet 2: 30.000
        Transaction::factory()->transfer()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet1->id,
            'destination_wallet_id' => $wallet2->id,
            'amount' => 30000,
            'description' => 'Top Up E-Wallet',
            'transaction_date' => now()->toDateString(),
        ]);

        // Wallet 1 balance: 100.000 + 200.000 - 50.000 - 30.000 = 220.000
        // Wallet 2 balance: 50.000 + 30.000 = 80.000
        // Total balance: 220.000 + 80.000 = 300.000

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewHas('totalBalance', 300000.0);
        $response->assertViewHas('totalIncome', 200000.0);
        $response->assertViewHas('totalExpense', 50000.0);
        $response->assertViewHas('totalTransfer', 30000.0);

        $response->assertSee('Dompet Utama');
        $response->assertSee('220.000');
        $response->assertSee('E-Wallet');
        $response->assertSee('80.000');
        $response->assertSee('300.000');
        $response->assertSee('Gaji Freelance');
        $response->assertSee('Makan Siang');
        $response->assertSee('Top Up E-Wallet');
    }

    public function test_transfer_does_not_affect_overall_total_balance(): void
    {
        $user = User::factory()->create();

        $walletA = Wallet::factory()->create([
            'user_id' => $user->id,
            'initial_balance' => 500000,
        ]);

        $walletB = Wallet::factory()->create([
            'user_id' => $user->id,
            'initial_balance' => 200000,
        ]);

        // Total initial = 700.000

        // Perform internal transfer of 150.000 from A to B
        Transaction::factory()->transfer()->create([
            'user_id' => $user->id,
            'wallet_id' => $walletA->id,
            'destination_wallet_id' => $walletB->id,
            'amount' => 150000,
            'description' => 'Transfer A ke B',
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        // Total balance must still be exactly 700.000
        $response->assertViewHas('totalBalance', 700000.0);
        // Transfer does NOT count as income or expense
        $response->assertViewHas('totalIncome', 0.0);
        $response->assertViewHas('totalExpense', 0.0);
        $response->assertViewHas('totalTransfer', 150000.0);

        // Wallet A is now 350.000
        // Wallet B is now 350.000
        $wallets = $response->viewData('wallets');
        $this->assertEquals(350000.0, $wallets->firstWhere('id', $walletA->id)->current_balance);
        $this->assertEquals(350000.0, $wallets->firstWhere('id', $walletB->id)->current_balance);
    }

    public function test_user_cannot_see_other_users_wallets_or_transactions(): void
    {
        $userA = User::factory()->create(['name' => 'User A']);
        $userB = User::factory()->create(['name' => 'User B']);

        $walletA = Wallet::factory()->create([
            'user_id' => $userA->id,
            'name' => 'Dompet Rahasia A',
            'initial_balance' => 1000000,
        ]);

        $walletB = Wallet::factory()->create([
            'user_id' => $userB->id,
            'name' => 'Dompet Publik B',
            'initial_balance' => 200000,
        ]);

        Transaction::factory()->income()->create([
            'user_id' => $userB->id,
            'wallet_id' => $walletB->id,
            'description' => 'Bonus Spesial B',
            'amount' => 500000,
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($userA)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Dompet Rahasia A');
        $response->assertDontSee('Dompet Publik B');
        $response->assertDontSee('Bonus Spesial B');
        $response->assertViewHas('totalBalance', 1000000.0);
        $response->assertViewHas('totalIncome', 0.0);
    }
}
