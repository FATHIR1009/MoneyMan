<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $wallets = $user->wallets()
            ->withCurrentBalance()
            ->orderBy('id')
            ->get();

        $totalBalance = (float) $wallets->sum('current_balance');
        $activeWalletsCount = $wallets->count();

        // Retrieve recent transactions across user's wallets to attach the last transaction to each wallet
        $walletIds = $wallets->pluck('id')->all();
        $recentTransactions = $user->transactions()
            ->where(function ($query) use ($walletIds) {
                $query->whereIn('wallet_id', $walletIds)
                    ->orWhereIn('destination_wallet_id', $walletIds);
            })
            ->latest('transaction_date')
            ->latest('id')
            ->get();

        foreach ($wallets as $wallet) {
            $wallet->last_transaction = $recentTransactions->first(function ($tx) use ($wallet) {
                return (int) $tx->wallet_id === (int) $wallet->id || (int) $tx->destination_wallet_id === (int) $wallet->id;
            });
        }

        // Composition calculation
        $fisikCount = $wallets->filter(fn ($w) => in_array(strtolower($w->type), ['cash', 'tunai', 'fisik']))->count();
        $digitalCount = $wallets->filter(fn ($w) => in_array(strtolower($w->type), ['gopay', 'ovo', 'dana', 'shopeepay', 'e-wallet', 'digital', 'ewallet']))->count();
        $bankCount = $wallets->filter(fn ($w) => in_array(strtolower($w->type), ['bank', 'rekening']))->count();
        $otherCount = $activeWalletsCount - $fisikCount - $digitalCount - $bankCount;

        $compositionParts = [];
        if ($fisikCount > 0) {
            $compositionParts[] = "{$fisikCount} Fisik (Cash)";
        }
        if ($digitalCount > 0) {
            $compositionParts[] = "{$digitalCount} Digital (E-Wallet)";
        }
        if ($bankCount > 0) {
            $compositionParts[] = "{$bankCount} Bank";
        }
        if ($otherCount > 0) {
            $compositionParts[] = "{$otherCount} Lainnya";
        }

        $compositionText = ! empty($compositionParts)
            ? implode(' · ', $compositionParts)
            : 'Belum ada dompet aktif';

        return view('wallets.index', compact(
            'wallets',
            'totalBalance',
            'activeWalletsCount',
            'fisikCount',
            'digitalCount',
            'bankCount',
            'otherCount',
            'compositionText'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request): RedirectResponse
    {
        $request->user()->wallets()->create($request->validated());

        return redirect()->route('wallets.index')->with('success', 'Dompet baru berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet): RedirectResponse
    {
        $wallet->update($request->validated());

        return redirect()->route('wallets.index')->with('success', 'Dompet berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Wallet $wallet): RedirectResponse
    {
        abort_if((int) $wallet->user_id !== (int) $request->user()->id, 403);

        if ($wallet->transactions()->exists() || $wallet->incomingTransfers()->exists()) {
            return redirect()->route('wallets.index')->with('error', 'Dompet tidak dapat dihapus karena masih memiliki riwayat transaksi terkait.');
        }

        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Dompet berhasil dihapus!');
    }
}
