<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_wallets_and_is_redirected_to_login(): void
    {
        $wallet = Wallet::factory()->create();

        $this->get(route('wallets.index'))->assertRedirect(route('login'));
        $this->post(route('wallets.store'), [
            'name' => 'Dompet Baru',
            'type' => 'Fisik',
            'initial_balance' => 100000,
        ])->assertRedirect(route('login'));
        $this->put(route('wallets.update', $wallet), [
            'name' => 'Dompet Ubah',
            'type' => 'Fisik',
            'initial_balance' => 200000,
        ])->assertRedirect(route('login'));
        $this->delete(route('wallets.destroy', $wallet))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_sees_empty_state_when_they_have_no_wallets(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('wallets.index'));

        $response->assertOk();
        $response->assertSee('Belum Ada Dompet Terdaftar');
        $response->assertSee('+ Tambah Dompet Pertama');
        $response->assertSee('0 Dompet');
        $response->assertViewHas('totalBalance', 0.0);
        $response->assertViewHas('activeWalletsCount', 0);
    }

    public function test_authenticated_user_can_view_their_wallets_with_correct_balances(): void
    {
        $user = User::factory()->create();

        $wallet1 = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Dompet Tunai',
            'type' => 'Fisik',
            'initial_balance' => 100000,
        ]);

        $wallet2 = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'BCA Digital',
            'type' => 'Bank',
            'initial_balance' => 500000,
        ]);

        // Income to wallet 1: 50.000 -> wallet 1 balance = 150.000
        Transaction::factory()->income()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet1->id,
            'amount' => 50000,
            'description' => 'Bonus Penjualan',
            'transaction_date' => now()->toDateString(),
        ]);

        // Transfer from wallet 2 to wallet 1: 100.000
        // wallet 1 balance = 150.000 + 100.000 = 250.000
        // wallet 2 balance = 500.000 - 100.000 = 400.000
        // Total balance = 650.000
        Transaction::factory()->transfer()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet2->id,
            'destination_wallet_id' => $wallet1->id,
            'amount' => 100000,
            'description' => 'Tarik Tunai dari Bank',
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('wallets.index'));

        $response->assertOk();
        $response->assertSee('Dompet Tunai');
        $response->assertSee('BCA Digital');
        $response->assertSee('Fisik');
        $response->assertSee('Bank');
        $response->assertSee('100.000'); // Saldo awal wallet 1
        $response->assertSee('500.000'); // Saldo awal wallet 2
        $response->assertSee('250.000'); // Saldo terkini wallet 1
        $response->assertSee('400.000'); // Saldo terkini wallet 2
        $response->assertSee('650.000'); // Total saldo
        $response->assertViewHas('totalBalance', 650000.0);
        $response->assertViewHas('activeWalletsCount', 2);
    }

    public function test_user_can_create_a_new_wallet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('wallets.store'), [
            'name' => 'GoPay Tabungan',
            'type' => 'E-Wallet',
            'initial_balance' => 250000,
        ]);

        $response->assertRedirect(route('wallets.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('wallets', [
            'user_id' => $user->id,
            'name' => 'GoPay Tabungan',
            'type' => 'E-Wallet',
            'initial_balance' => 250000,
        ]);
    }

    public function test_wallet_creation_validates_required_and_valid_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('wallets.store'), [
            'name' => '',
            'type' => 'JenisTidakValid',
            'initial_balance' => -5000,
        ]);

        $response->assertSessionHasErrors(['name', 'type', 'initial_balance']);
        $this->assertDatabaseCount('wallets', 0);
    }

    public function test_user_can_update_their_own_wallet(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Dompet Lama',
            'type' => 'Fisik',
            'initial_balance' => 50000,
        ]);

        $response = $this->actingAs($user)->put(route('wallets.update', $wallet), [
            'name' => 'Dompet Baru Terupdate',
            'type' => 'E-Wallet',
            'initial_balance' => 150000,
        ]);

        $response->assertRedirect(route('wallets.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'user_id' => $user->id,
            'name' => 'Dompet Baru Terupdate',
            'type' => 'E-Wallet',
            'initial_balance' => 150000,
        ]);
    }

    public function test_updating_wallet_initial_balance_does_not_modify_or_delete_existing_transactions(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'initial_balance' => 100000,
        ]);

        $txIncome = Transaction::factory()->income()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'amount' => 75000,
            'description' => 'Pendapatan Tetap',
            'transaction_date' => now()->toDateString(),
        ]);

        $txExpense = Transaction::factory()->expense()->create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'amount' => 25000,
            'description' => 'Makan Siang',
            'transaction_date' => now()->toDateString(),
        ]);

        // Initial current balance = 100.000 + 75.000 - 25.000 = 150.000
        $this->assertEquals(150000.0, $wallet->fresh()->current_balance);

        // Update initial balance to 300.000
        $response = $this->actingAs($user)->put(route('wallets.update', $wallet), [
            'name' => $wallet->name,
            'type' => $wallet->type,
            'initial_balance' => 300000,
        ]);

        $response->assertRedirect(route('wallets.index'));

        // Verify transactions are untouched
        $this->assertDatabaseHas('transactions', [
            'id' => $txIncome->id,
            'amount' => 75000,
            'description' => 'Pendapatan Tetap',
        ]);
        $this->assertDatabaseHas('transactions', [
            'id' => $txExpense->id,
            'amount' => 25000,
            'description' => 'Makan Siang',
        ]);
        $this->assertDatabaseCount('transactions', 2);

        // Current balance dynamically adjusts with the new initial balance:
        // 300.000 + 75.000 - 25.000 = 350.000
        $this->assertEquals(350000.0, $wallet->fresh()->current_balance);
    }

    public function test_user_cannot_view_update_or_delete_another_users_wallet(): void
    {
        $userA = User::factory()->create(['name' => 'User A']);
        $userB = User::factory()->create(['name' => 'User B']);

        $walletA = Wallet::factory()->create([
            'user_id' => $userA->id,
            'name' => 'Dompet Eksklusif User A',
            'type' => 'Bank',
            'initial_balance' => 1000000,
        ]);

        // User B cannot see User A's wallet on index
        $response = $this->actingAs($userB)->get(route('wallets.index'));
        $response->assertOk();
        $response->assertDontSee('Dompet Eksklusif User A');

        // User B cannot update User A's wallet -> 403 Forbidden
        $updateResponse = $this->actingAs($userB)->put(route('wallets.update', $walletA), [
            'name' => 'Diretas oleh B',
            'type' => 'Fisik',
            'initial_balance' => 0,
        ]);
        $updateResponse->assertForbidden();

        // User B cannot delete User A's wallet -> 403 Forbidden
        $deleteResponse = $this->actingAs($userB)->delete(route('wallets.destroy', $walletA));
        $deleteResponse->assertForbidden();

        // Assert database record was not altered
        $this->assertDatabaseHas('wallets', [
            'id' => $walletA->id,
            'name' => 'Dompet Eksklusif User A',
            'initial_balance' => 1000000,
        ]);
    }

    public function test_wallet_without_associated_transactions_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Dompet Kosong',
        ]);

        $response = $this->actingAs($user)->delete(route('wallets.destroy', $wallet));

        $response->assertRedirect(route('wallets.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('wallets', [
            'id' => $wallet->id,
        ]);
    }

    public function test_wallet_with_associated_transactions_cannot_be_deleted(): void
    {
        $user = User::factory()->create();

        // 1. As source wallet
        $walletSource = Wallet::factory()->create(['user_id' => $user->id]);
        Transaction::factory()->expense()->create([
            'user_id' => $user->id,
            'wallet_id' => $walletSource->id,
            'amount' => 10000,
        ]);

        $response1 = $this->actingAs($user)->delete(route('wallets.destroy', $walletSource));
        $response1->assertRedirect(route('wallets.index'));
        $response1->assertSessionHas('error');
        $this->assertDatabaseHas('wallets', ['id' => $walletSource->id]);

        // 2. As destination wallet in transfer
        $walletAnother = Wallet::factory()->create(['user_id' => $user->id]);
        $walletDest = Wallet::factory()->create(['user_id' => $user->id]);
        Transaction::factory()->transfer()->create([
            'user_id' => $user->id,
            'wallet_id' => $walletAnother->id,
            'destination_wallet_id' => $walletDest->id,
            'amount' => 20000,
        ]);

        $response2 = $this->actingAs($user)->delete(route('wallets.destroy', $walletDest));
        $response2->assertRedirect(route('wallets.index'));
        $response2->assertSessionHas('error');
        $this->assertDatabaseHas('wallets', ['id' => $walletDest->id]);
    }
}
