<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        // 1. Wallets and Total Balance
        $wallets = $user->wallets()
            ->withCurrentBalance()
            ->orderBy('id')
            ->get();

        $totalBalance = (float) $wallets->sum('current_balance');

        // 2. Monthly Summary Period (Current Month)
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $periodName = now()->locale('id')->translatedFormat('F Y');

        $monthlyStats = $user->transactions()
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->selectRaw('
                type,
                COUNT(*) as total_count,
                SUM(amount) as total_amount
            ')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        $totalIncome = (float) ($monthlyStats->get('income')?->total_amount ?? 0);
        $incomeCount = (int) ($monthlyStats->get('income')?->total_count ?? 0);

        $totalExpense = (float) ($monthlyStats->get('expense')?->total_amount ?? 0);
        $expenseCount = (int) ($monthlyStats->get('expense')?->total_count ?? 0);

        $totalTransfer = (float) ($monthlyStats->get('transfer')?->total_amount ?? 0);
        $transferCount = (int) ($monthlyStats->get('transfer')?->total_count ?? 0);

        $expenseRatio = $totalIncome > 0 ? round(($totalExpense / $totalIncome) * 100, 1) : 0;

        // Net cash flow
        $netCashflow = $totalIncome - $totalExpense;
        $netCashflowPercentage = $totalIncome > 0 ? round(($netCashflow / $totalIncome) * 100) : 0;

        // 3. Largest Expense this month
        $largestExpense = $user->transactions()
            ->with('wallet')
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->orderByDesc('amount')
            ->first();

        $largestExpensePercentage = ($totalExpense > 0 && $largestExpense)
            ? round(($largestExpense->amount / $totalExpense) * 100, 1)
            : 0;

        // 4. Expense Breakdown by Wallet (Composition)
        $expenseByWallet = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->selectRaw('wallet_id, SUM(amount) as total_amount')
            ->groupBy('wallet_id')
            ->with('wallet')
            ->get()
            ->map(function ($item) use ($totalExpense) {
                $percentage = $totalExpense > 0 ? round(($item->total_amount / $totalExpense) * 100, 1) : 0;

                return (object) [
                    'wallet' => $item->wallet,
                    'wallet_name' => $item->wallet ? $item->wallet->name : 'Dompet Lain',
                    'amount' => (float) $item->total_amount,
                    'percentage' => $percentage,
                ];
            });

        // 5. Recent Transactions
        $recentTransactions = $user->transactions()
            ->with(['wallet', 'destinationWallet'])
            ->latest('transaction_date')
            ->latest('id')
            ->take(10)
            ->get();

        // 6. Time-based Greeting & Formatting
        $hour = now()->hour;
        $greeting = match (true) {
            $hour >= 5 && $hour < 11 => 'Selamat Pagi',
            $hour >= 11 && $hour < 15 => 'Selamat Siang',
            $hour >= 15 && $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };
        $currentDateFormatted = now()->locale('id')->translatedFormat('l, d F Y');

        return view('dashboard', compact(
            'wallets',
            'totalBalance',
            'periodName',
            'totalIncome',
            'incomeCount',
            'totalExpense',
            'expenseCount',
            'totalTransfer',
            'transferCount',
            'expenseRatio',
            'netCashflowPercentage',
            'largestExpense',
            'largestExpensePercentage',
            'expenseByWallet',
            'recentTransactions',
            'greeting',
            'currentDateFormatted'
        ));
    }
}
