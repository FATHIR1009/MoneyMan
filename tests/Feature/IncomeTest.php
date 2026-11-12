<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_transactions_and_is_redirected_to_login(): void
    {
        $wallet = Wallet::factory()->create();

        $this->get(route('transactions.index'))->assertRedirect(route('login'));
        $this->get(route('transactions.create'))->assertRedirect(route('login'));
        $this->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => 100000,
            'transaction_date' => now()->toDateString(),
            'description' => 'Pendapatan Guest',
            'type' => 'income',
        ])->assertRedirect(route('login'));
    }

    public function test_authenticated_user_sees_empty_state_when_there_are_no_transactions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('transactions.index'));

        $response->assertOk();
        $response->assertSee('Belum Ada Transaksi Pemasukan');
        $response->assertSee('+ Catat Pemasukan Pertama');
        $response->assertViewHas('incomeThisMonth', 0.0);
        $response->assertViewHas('incomeCountThisMonth', 0);
    }

    public function test_authenticated_user_can_view_transaction_create_page(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'BCA Utama',
            'initial_balance' => 500000,
        ]);

        $response = $this->actingAs($user)->get(route('transactions.create'));

        $response->assertOk();
        $response->assertSee('Catat Pemasukan Baru');
        $response->assertSee('BCA Utama');
        $response->assertSee('500.000');
    }

    public function test_user_can_create_income_transaction_successfully(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'GoPay Tabungan',
            'initial_balance' => 100000,
        ]);

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => 350000,
            'transaction_date' => now()->toDateString(),
            'description' => 'Gaji Freelance Desain',
            'type' => 'income',
        ]);

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'type' => 'income',
            'amount' => 350000,
            'description' => 'Gaji Freelance Desain',
            'destination_wallet_id' => null,
        ]);
    }

    public function test_income_transaction_correctly_increases_wallet_balance_and_dashboard_balance(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Dompet Kas',
            'initial_balance' => 200000,
        ]);

        $this->assertEquals(200000.0, $wallet->fresh()->current_balance);

        // Record income of 150.000
        $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => 150000,
            'transaction_date' => now()->toDateString(),
            'description' => 'Pendapatan Tambahan',
            'type' => 'income',
        ]);

        // 1. Wallet balance should now be 200.000 + 150.000 = 350.000
        $this->assertEquals(350000.0, $wallet->fresh()->current_balance);

        // 2. Wallets page should display 350.000 and totalBalance = 350.000
        $walletPageResponse = $this->actingAs($user)->get(route('wallets.index'));
        $walletPageResponse->assertOk();
        $walletPageResponse->assertSee('350.000');
        $walletPageResponse->assertViewHas('totalBalance', 350000.0);

        // 3. Dashboard page should display totalBalance = 350.000 and totalIncome = 150.000
        $dashboardResponse = $this->actingAs($user)->get(route('dashboard'));
        $dashboardResponse->assertOk();
        $dashboardResponse->assertSee('350.000');
        $dashboardResponse->assertViewHas('totalBalance', 350000.0);
        $dashboardResponse->assertViewHas('totalIncome', 150000.0);

        // 4. Transactions page should display the transaction and summary
        $transactionsResponse = $this->actingAs($user)->get(route('transactions.index'));
        $transactionsResponse->assertOk();
        $transactionsResponse->assertSee('Pendapatan Tambahan');
        $transactionsResponse->assertSee('150.000');
        $transactionsResponse->assertViewHas('incomeThisMonth', 150000.0);
        $transactionsResponse->assertViewHas('incomeCountThisMonth', 1);
    }

    public function test_income_validation_fails_when_required_fields_are_missing(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => '',
            'amount' => '',
            'transaction_date' => '',
            'description' => '',
        ]);

        $response->assertSessionHasErrors(['wallet_id', 'amount', 'transaction_date', 'description']);
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_income_validation_fails_when_amount_is_zero_or_negative(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);

        $responseZero = $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => 0,
            'transaction_date' => now()->toDateString(),
            'description' => 'Test Nominal Nol',
        ]);
        $responseZero->assertSessionHasErrors(['amount']);

        $responseNegative = $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => -25000,
            'transaction_date' => now()->toDateString(),
            'description' => 'Test Nominal Negatif',
        ]);
        $responseNegative->assertSessionHasErrors(['amount']);

        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_income_validation_fails_for_invalid_date(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'wallet_id' => $wallet->id,
            'amount' => 50000,
            'transaction_date' => 'tanggal-ngasal',
            'description' => 'Test Tanggal Invalid',
        ]);

        $response->assertSessionHasErrors(['transaction_date']);
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_user_cannot_create_income_for_another_users_wallet(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $walletA = Wallet::factory()->create(['user_id' => $userA->id, 'name' => 'Dompet Korban A']);

        // User B tries to record income to User A's wallet
        $response = $this->actingAs($userB)->post(route('transactions.store'), [
            'wallet_id' => $walletA->id,
            'amount' => 500000,
            'transaction_date' => now()->toDateString(),
            'description' => 'Pemasukan Ilegal User B',
        ]);

        $response->assertSessionHasErrors(['wallet_id']);
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_user_cannot_view_another_users_transactions(): void
    {
        $userA = User::factory()->create(['name' => 'User A']);
        $userB = User::factory()->create(['name' => 'User B']);

        $walletA = Wallet::factory()->create(['user_id' => $userA->id, 'name' => 'Dompet A']);
        $walletB = Wallet::factory()->create(['user_id' => $userB->id, 'name' => 'Dompet B']);

        Transaction::factory()->income()->create([
            'user_id' => $userA->id,
            'wallet_id' => $walletA->id,
            'description' => 'Bonus Rahasia User A',
            'amount' => 999000,
        ]);

        Transaction::factory()->income()->create([
            'user_id' => $userB->id,
            'wallet_id' => $walletB->id,
            'description' => 'Penjualan Buku User B',
            'amount' => 125000,
        ]);

        $response = $this->actingAs($userB)->get(route('transactions.index'));

        $response->assertOk();
        $response->assertSee('Penjualan Buku User B');
        $response->assertSee('125.000');
        $response->assertDontSee('Bonus Rahasia User A');
        $response->assertDontSee('999.000');
    }

    public function test_transactions_index_displays_saved_income_with_correct_details(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Bank Mandiri',
        ]);

        $tx = Transaction::factory()->income()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'amount' => 1250000,
            'description' => 'Honor Pembuatan Website',
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('transactions.index'));

        $response->assertOk();
        $response->assertSee('Honor Pembuatan Website');
        $response->assertSee('1.250.000');
        $response->assertSee('Pemasukan');
        $response->assertSee('Bank Mandiri');
    }

    public function test_transactions_index_correctly_parses_title_subnote_and_custom_tag(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Bank Mandiri',
        ]);

        Transaction::factory()->income()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'amount' => 500000,
            'description' => 'Gaji bulanan - Gaji pertama | tranfer bank',
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('transactions.index'));

        $response->assertOk();
        $response->assertSee('Gaji bulanan');
        $response->assertSee('Gaji pertama');
        $response->assertSee('tranfer bank');
        $response->assertDontSee('Auto Reconciled');
    }
}
