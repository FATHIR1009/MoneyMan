<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $transactions = $user->transactions()
            ->with(['wallet', 'destinationWallet'])
            ->latest('transaction_date')
            ->latest('id')
            ->get();

        $wallets = $user->wallets()
            ->withCurrentBalance()
            ->orderBy('name')
            ->get();

        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $monthlyStats = $user->transactions()
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->selectRaw('type, COUNT(*) as total_count, SUM(amount) as total_amount')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        $incomeThisMonth = (float) ($monthlyStats->get('income')?->total_amount ?? 0);
        $incomeCountThisMonth = (int) ($monthlyStats->get('income')?->total_count ?? 0);

        $expenseThisMonth = (float) ($monthlyStats->get('expense')?->total_amount ?? 0);
        $expenseCountThisMonth = (int) ($monthlyStats->get('expense')?->total_count ?? 0);

        $transferThisMonth = (float) ($monthlyStats->get('transfer')?->total_amount ?? 0);
        $transferCountThisMonth = (int) ($monthlyStats->get('transfer')?->total_count ?? 0);

        return view('transactions.index', compact(
            'transactions',
            'wallets',
            'incomeThisMonth',
            'incomeCountThisMonth',
            'expenseThisMonth',
            'expenseCountThisMonth',
            'transferThisMonth',
            'transferCountThisMonth'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $wallets = $request->user()
            ->wallets()
            ->withCurrentBalance()
            ->orderBy('name')
            ->get();

        return view('transactions.create', compact('wallets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->transactions()->create([
            'wallet_id' => $validated['wallet_id'],
            'amount' => $validated['amount'],
            'transaction_date' => Carbon::parse($validated['transaction_date'])->toDateString(),
            'description' => $validated['description'],
            'type' => 'income',
            'destination_wallet_id' => null,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi pemasukan berhasil dicatat!');
    }
}
