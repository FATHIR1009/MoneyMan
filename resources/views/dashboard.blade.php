@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-space-lg w-full max-w-[1280px] mx-auto py-space-md">
<!-- Top Greeting & Header Controls -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
<div class="flex flex-col">
<div class="flex items-center gap-space-xs">
<span class="font-headline-lg text-headline-lg text-on-surface">{{ $greeting }}, {{ auth()->user()->name }}</span>
<span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-secondary-container text-on-secondary-fixed">
<span class="material-symbols-outlined text-[18px]">waving_hand</span>
</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-0.5">
          {{ $currentDateFormatted }} <span class="mx-1.5 opacity-40">•</span> Ringkasan Finansial Anda
        </p>
</div>
<!-- Action Buttons Header -->
<div class="flex flex-wrap items-center gap-space-xs">
<a href="{{ route('transactions.create') }}" class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md shadow-sm hover:brightness-95 active:scale-95 transition-all" id="btn-add-income">
<span class="material-symbols-outlined text-[18px]">add_circle</span>
<span>+ Income</span>
</a>
<a href="{{ route('transactions.create') }}" class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-error-container text-on-error-container font-label-md text-label-md shadow-sm hover:brightness-95 active:scale-95 transition-all" id="btn-add-expense">
<span class="material-symbols-outlined text-[18px]">remove_circle</span>
<span>− Expense</span>
</a>
<a href="{{ route('transactions.create') }}" class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-surface-container-highest text-on-surface font-label-md text-label-md shadow-sm hover:bg-surface-container-high active:scale-95 transition-all" id="btn-add-transfer">
<span class="material-symbols-outlined text-[18px]">swap_horiz</span>
<span>↔ Transfer</span>
</a>
<a href="{{ route('wallets.index') }}" class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-surface-container-lowest text-on-surface-variant font-label-md text-label-md shadow-sm hover:bg-surface-container hover:text-on-surface active:scale-95 transition-all" id="btn-new-wallet">
<span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
<span>+ Dompet</span>
</a>
</div>
</div>
<!-- Main Total Balance Vault Hero -->
<div class="relative overflow-hidden rounded-2xl bg-primary-container text-on-primary shadow-xl p-space-lg lg:p-space-xl">
<!-- Ambient Background Graphic Pattern -->
<div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-secondary/15 blur-3xl pointer-events-none"></div>
<div class="absolute right-32 -bottom-20 w-64 h-64 rounded-full bg-tertiary-container/30 blur-2xl pointer-events-none"></div>
<div class="relative z-10 flex flex-col lg:flex-row lg:items-end justify-between gap-space-lg">
<div class="flex flex-col gap-space-sm max-w-xl">
<div class="flex items-center gap-space-sm">
<span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-lowest/10 backdrop-blur-md text-primary-fixed text-label-sm font-label-sm">
<span class="material-symbols-outlined text-[14px]">shield</span>
<span>Vault Personal Terenkripsi</span>
</span>
<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-secondary text-on-secondary font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[12px]">done_all</span>
<span>Sinkronisasi Database Aktif</span>
</span>
</div>
<div class="flex items-center gap-space-xs mt-1">
<span class="font-label-lg text-label-lg text-primary-fixed-dim uppercase tracking-wider">Total Saldo Terkonsolidasi</span>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-primary-fixed hover:bg-surface-container-lowest/10 transition-colors" id="toggle-balance" title="Toggle Tampilan Saldo" type="button">
<span class="material-symbols-outlined text-[18px]" id="eye-icon">visibility</span>
</button>
</div>
<div class="flex items-baseline gap-space-xs">
<span class="font-headline-md text-headline-md text-primary-fixed-dim font-bold">Rp</span>
<span class="font-display-lg text-display-lg text-on-primary font-bold tracking-tight" id="balance-value">{{ number_format($totalBalance, 0, ',', '.') }}</span>
<span class="hidden font-display-lg text-display-lg text-on-primary font-bold tracking-widest leading-none" id="balance-masked">••••••••</span>
</div>
<p class="font-body-sm text-body-sm text-on-primary-container">
            Akumulasi bersih dari seluruh dompet fisik &amp; e-wallet aktif tanpa selisih rekonsiliasi.
          </p>
</div>
<!-- Metric Badges & Snapshot Stats -->
<div class="flex flex-wrap lg:flex-nowrap items-center gap-space-sm bg-surface-container-lowest/5 backdrop-blur-md p-space-sm rounded-xl">
<div class="flex items-center gap-space-sm px-space-sm py-1.5">
<div class="w-9 h-9 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center text-secondary-fixed">
<span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-primary-fixed-dim">Status Vault</span>
<span class="font-headline-sm text-headline-sm text-on-primary leading-tight">{{ $wallets->count() }} Dompet</span>
</div>
</div>
<div class="hidden sm:block w-px h-8 bg-surface-container-lowest/15"></div>
<div class="flex items-center gap-space-sm px-space-sm py-1.5">
<div class="w-9 h-9 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center text-primary-fixed">
<span class="material-symbols-outlined text-[20px]">auto_graph</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-primary-fixed-dim">Arus Kas Bersih</span>
<span class="font-headline-sm text-headline-sm {{ $netCashflowPercentage >= 0 ? 'text-secondary-fixed' : 'text-error-container' }} leading-tight">{{ $netCashflowPercentage >= 0 ? '+' : '' }}{{ $netCashflowPercentage }}% Net</span>
</div>
</div>
</div>
</div>
</div>
<!-- WALLET OVERVIEW (Horizontal Grid) -->
<div class="flex flex-col gap-space-sm">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px]">wallet</span>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Portofolio Dompet</h2>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Terakhir diperbarui: Hari ini {{ now()->format('H:i') }} WIB</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
@forelse($wallets as $wallet)
  @php
    $typeLower = strtolower($wallet->type);
    $isCash = in_array($typeLower, ['cash', 'tunai', 'fisik']);
    $isEwallet = in_array($typeLower, ['gopay', 'ovo', 'dana', 'shopeepay', 'e-wallet', 'digital']);
    $icon = $isCash ? 'payments' : ($isEwallet ? 'qr_code_scanner' : 'account_balance');
    $iconBg = $isCash ? 'bg-secondary-fixed text-on-secondary-fixed' : ($isEwallet ? 'bg-surface-container-highest text-on-surface' : 'bg-surface-container-high text-on-surface');
    $badgeBg = $isCash ? 'bg-surface-container text-on-surface-variant' : 'bg-secondary-fixed text-on-secondary-fixed';
  @endphp
  <div class="group relative flex flex-col justify-between p-space-md bg-surface-container-lowest rounded-2xl shadow-sm hover:shadow-md transition-all">
  <div class="flex items-start justify-between">
  <div class="flex items-center gap-space-sm">
  <div class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center shadow-sm">
  <span class="material-symbols-outlined text-[24px]">{{ $icon }}</span>
  </div>
  <div class="flex flex-col">
  <span class="font-label-lg text-label-lg text-on-surface font-semibold">{{ $wallet->name }}</span>
  <span class="font-label-sm text-label-sm text-on-surface-variant">Saldo Awal: Rp{{ number_format($wallet->initial_balance, 0, ',', '.') }}</span>
  </div>
  </div>
  <span class="px-2 py-0.5 rounded-full {{ $badgeBg }} font-label-sm text-label-sm">{{ ucfirst($wallet->type) }}</span>
  </div>
  <div class="my-space-md">
  <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Saldo Tersedia</span>
  <div class="flex items-baseline gap-1">
  <span class="font-body-md text-body-md text-on-surface-variant font-semibold">Rp</span>
  <span class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight">{{ number_format($wallet->current_balance, 0, ',', '.') }}</span>
  </div>
  </div>
  <div class="flex items-center justify-between pt-space-xs">
  <a href="{{ route('wallets.index') }}" class="flex items-center gap-1 font-label-md text-label-md text-secondary hover:text-on-secondary-container transition-colors">
  <span>Lihat Rincian</span>
  <span class="material-symbols-outlined text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
  </a>
  <div class="flex items-center gap-1 text-on-surface-variant">
  <a href="{{ route('transactions.create') }}" class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Catat Transaksi">
  <span class="material-symbols-outlined text-[16px]">add</span>
  </a>
  <a href="{{ route('transactions.create') }}" class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Transfer Kas">
  <span class="material-symbols-outlined text-[16px]">swap_horiz</span>
  </a>
  </div>
  </div>
  </div>
@empty
  <div class="col-span-full py-12 px-4 text-center bg-surface-container-lowest rounded-2xl border border-dashed border-outline-variant/40">
    <div class="w-12 h-12 rounded-full bg-surface-container-high flex items-center justify-center mx-auto mb-3 text-on-surface-variant">
      <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
    </div>
    <h4 class="font-label-lg text-label-lg font-semibold text-on-surface">Belum Ada Dompet</h4>
    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 max-w-sm mx-auto">
      Tambahkan dompet pertama Anda untuk mulai mengelola keuangan secara mandiri.
    </p>
    <a href="{{ route('wallets.index') }}" class="inline-flex items-center gap-1.5 mt-4 px-4 py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md shadow-sm hover:opacity-90 transition-opacity">
      <span class="material-symbols-outlined text-[16px]">add</span>
      <span>+ Buat Dompet Baru</span>
    </a>
  </div>
@endforelse
</div>
</div>
<!-- FINANCIAL SUMMARY (3 Logic Metric Cards) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
<!-- Income Card -->
<div class="flex flex-col justify-between p-space-md bg-secondary-fixed/30 rounded-2xl shadow-sm">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-secondary-fixed font-semibold uppercase tracking-wider">Pemasukan Bulan Ini</span>
<div class="w-9 h-9 rounded-xl bg-secondary text-on-secondary flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">south_west</span>
</div>
</div>
<div class="mt-space-md">
<div class="font-numerical-balance text-numerical-balance text-secondary font-bold tracking-tight">
            +Rp{{ number_format($totalIncome, 0, ',', '.') }}
          </div>
<div class="flex items-center gap-1.5 mt-1">
<span class="material-symbols-outlined text-secondary text-[16px]">trending_up</span>
<span class="font-label-sm text-label-sm text-on-secondary-fixed font-semibold">{{ $incomeCount }} Mutasi Penerimaan</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">• {{ $periodName }}</span>
</div>
</div>
</div>
<!-- Expense Card -->
<div class="flex flex-col justify-between p-space-md bg-error-container/30 rounded-2xl shadow-sm">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-error-container font-semibold uppercase tracking-wider">Pengeluaran Bulan Ini</span>
<div class="w-9 h-9 rounded-xl bg-error text-on-error flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">north_east</span>
</div>
</div>
<div class="mt-space-md">
<div class="font-numerical-balance text-numerical-balance text-error font-bold tracking-tight">
            -Rp{{ number_format($totalExpense, 0, ',', '.') }}
          </div>
<div class="flex items-center gap-1.5 mt-1">
<span class="material-symbols-outlined text-error text-[16px]">pie_chart</span>
<span class="font-label-sm text-label-sm text-on-error-container font-semibold">{{ $expenseCount }} Transaksi Tercatat</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">• Rasio {{ $expenseRatio }}%</span>
</div>
</div>
</div>
<!-- Transfer Card (Neutral financial movement) -->
<div class="flex flex-col justify-between p-space-md bg-surface-container rounded-2xl shadow-sm">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant font-semibold uppercase tracking-wider">Pemindahan Antar Dompet</span>
<div class="w-9 h-9 rounded-xl bg-surface-container-highest text-on-surface flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">swap_horiz</span>
</div>
</div>
<div class="mt-space-md">
<div class="font-numerical-balance text-numerical-balance text-on-surface font-bold tracking-tight">
            Rp{{ number_format($totalTransfer, 0, ',', '.') }}
          </div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
            Netral • {{ $transferCount }} rotasi • Tidak mempengaruhi total saldo akun.
          </p>
</div>
</div>
</div>
<!-- BENTO SPLIT: LARGEST EXPENSE & INSIGHT + SPENDING COMPOSITION -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-md">
<!-- Highlight: Pengeluaran Terbesar (5 Cols) -->
<div class="lg:col-span-5 flex flex-col justify-between p-space-lg bg-surface-container-lowest rounded-2xl shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-error text-[20px]">priority_high</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Pengeluaran Terbesar</h3>
</div>
<span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">{{ $periodName }}</span>
</div>
@if($largestExpense)
  <div class="flex items-center gap-space-md my-space-sm p-space-sm rounded-xl bg-surface-container-low">
  <div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center shrink-0 text-on-surface">
  <span class="material-symbols-outlined text-[28px]">payments</span>
  </div>
  <div class="flex flex-col min-w-0">
  <span class="font-label-lg text-label-lg text-on-surface font-bold truncate">{{ $largestExpense->description }}</span>
  <span class="font-body-sm text-body-sm text-on-surface-variant">Dompet • {{ $largestExpense->wallet?->name ?? 'Dompet' }}</span>
  <div class="flex items-center gap-2 mt-1">
  <span class="font-headline-sm text-headline-sm text-error font-bold">-Rp{{ number_format($largestExpense->amount, 0, ',', '.') }}</span>
  <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $largestExpense->transaction_date->locale('id')->translatedFormat('d M Y') }}</span>
  </div>
  </div>
  </div>
  <div class="p-space-sm rounded-xl bg-surface-container-lowest shadow-sm flex items-center justify-between">
  <div class="flex items-center gap-space-xs text-on-surface-variant">
  <span class="material-symbols-outlined text-[18px]">verified</span>
  <span class="font-body-sm text-body-sm">Porsi terhadap total beban:</span>
  </div>
  <span class="font-label-lg text-label-lg text-on-surface font-bold">{{ $largestExpensePercentage }}%</span>
  </div>
@else
  <div class="flex flex-col items-center justify-center py-8 text-center bg-surface-container-low/50 rounded-xl my-auto">
    <span class="material-symbols-outlined text-on-surface-variant text-[28px] mb-2">savings</span>
    <p class="font-label-md text-label-md text-on-surface font-medium">Tidak ada pengeluaran</p>
    <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Belum ada pengeluaran tercatat pada bulan ini.</p>
  </div>
@endif
</div>
<!-- Spending Breakdown Visual (7 Cols) -->
<div class="lg:col-span-7 flex flex-col justify-between p-space-lg bg-surface-container-lowest rounded-2xl shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px]">donut_small</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Komposisi Pengeluaran Dompet</h3>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Total: Rp{{ number_format($totalExpense, 0, ',', '.') }}</span>
</div>
@if($totalExpense > 0 && $expenseByWallet->isNotEmpty())
  @php
    $barColors = [
      'bg-surface-container-highest',
      'bg-secondary-fixed',
      'bg-surface-container-high',
      'bg-tertiary-fixed',
      'bg-primary-fixed',
    ];
    $dotColors = [
      'bg-surface-container-highest',
      'bg-secondary-fixed',
      'bg-surface-container-high',
      'bg-tertiary-fixed',
      'bg-primary-fixed',
    ];
  @endphp
  <!-- Multi-segment visual bar -->
  <div class="w-full flex flex-col gap-space-sm my-space-xs">
  <div class="w-full h-4 rounded-full bg-surface-container-low flex overflow-hidden">
    @foreach($expenseByWallet as $index => $item)
      <div class="h-full {{ $barColors[$index % count($barColors)] }} transition-all" style="width: {{ $item->percentage }}%;" title="{{ $item->wallet_name }} {{ $item->percentage }}%"></div>
    @endforeach
  </div>
  <!-- Progress Legend Rows -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-sm pt-space-xs">
    @foreach($expenseByWallet as $index => $item)
      <div class="flex flex-col p-space-xs rounded-xl bg-surface-container-low">
      <div class="flex items-center justify-between">
      <div class="flex items-center gap-1.5">
      <span class="w-2.5 h-2.5 rounded-full {{ $dotColors[$index % count($dotColors)] }}"></span>
      <span class="font-label-md text-label-md text-on-surface font-semibold truncate">{{ $item->wallet_name }}</span>
      </div>
      <span class="font-label-sm text-label-sm text-on-surface-variant font-bold">{{ $item->percentage }}%</span>
      </div>
      <span class="font-body-md text-body-md text-on-surface font-semibold mt-1">Rp{{ number_format($item->amount, 0, ',', '.') }}</span>
      </div>
    @endforeach
  </div>
  </div>
  <div class="flex items-center justify-between text-on-surface-variant pt-space-xs">
  <span class="font-body-sm text-body-sm">Pola pengeluaran berdasarkan beban dompet pada periode {{ $periodName }}.</span>
  </div>
@else
  <div class="flex flex-col items-center justify-center py-8 text-center bg-surface-container-low/50 rounded-xl my-auto">
    <span class="material-symbols-outlined text-on-surface-variant text-[28px] mb-2">pie_chart</span>
    <p class="font-label-md text-label-md text-on-surface font-medium">Belum ada komposisi</p>
    <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Catatan pengeluaran akan ditampilkan dalam grafik komposisi dompet.</p>
  </div>
@endif
</div>
</div>
<!-- RECENT TRANSACTIONS TABLE / LIST -->
<div class="flex flex-col p-space-lg bg-surface-container-lowest rounded-2xl shadow-sm">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-space-sm pb-space-md">
<div class="flex flex-col">
<h3 class="font-headline-md text-headline-md text-on-surface">Transaksi Terkini</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Seluruh aliran dana masuk, keluar, dan mutasi saldo antar dompet</p>
</div>
<!-- Filter Segmented Tabs -->
<div class="flex items-center p-1 bg-surface-container-low rounded-xl" id="transaction-filters">
<button class="filter-tab px-3 py-1.5 rounded-lg font-label-md text-label-md font-semibold bg-surface-container-lowest text-on-surface shadow-sm transition-all" data-filter="all" type="button">
            Semua ({{ $recentTransactions->count() }})
          </button>
<button class="filter-tab px-3 py-1.5 rounded-lg font-label-md text-label-md font-semibold text-on-surface-variant hover:text-on-surface transition-all" data-filter="income" type="button">
            Pemasukan
          </button>
<button class="filter-tab px-3 py-1.5 rounded-lg font-label-md text-label-md font-semibold text-on-surface-variant hover:text-on-surface transition-all" data-filter="expense" type="button">
            Pengeluaran
          </button>
<button class="filter-tab px-3 py-1.5 rounded-lg font-label-md text-label-md font-semibold text-on-surface-variant hover:text-on-surface transition-all" data-filter="transfer" type="button">
            Transfer
          </button>
</div>
</div>
<!-- Transaction Items Feed -->
<div class="flex flex-col gap-space-xs" id="transaction-list">
@forelse($recentTransactions as $tx)
  @php
    $isIncome = $tx->type === 'income';
    $isExpense = $tx->type === 'expense';
    $isTransfer = $tx->type === 'transfer';

    $icon = $isIncome ? 'payments' : ($isExpense ? 'restaurant' : 'swap_horiz');
    $iconBg = $isIncome
      ? 'bg-secondary-fixed/50 text-secondary'
      : ($isExpense ? 'bg-error-container/60 text-error' : 'bg-surface-container-highest text-on-surface');
    $badgeBg = $isIncome
      ? 'bg-secondary-fixed text-on-secondary-fixed'
      : ($isExpense ? 'bg-error-container text-on-error-container' : 'bg-surface-container-high text-on-surface');
    $amountColor = $isIncome
      ? 'text-secondary'
      : ($isExpense ? 'text-error' : 'text-on-surface');
    $amountPrefix = $isIncome ? '+Rp' : ($isExpense ? '-Rp' : 'Rp');
  @endphp
  <div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="{{ $tx->type }}">
  <div class="flex items-center gap-space-sm min-w-0">
  <div class="w-11 h-11 rounded-full {{ $iconBg }} flex items-center justify-center shrink-0">
  <span class="material-symbols-outlined text-[22px]">{{ $icon }}</span>
  </div>
  <div class="flex flex-col min-w-0">
  <div class="flex items-center gap-2">
  <span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">{{ $tx->description }}</span>
  <span class="px-2 py-0.5 rounded-full {{ $badgeBg }} font-label-sm text-label-sm font-semibold">{{ ucfirst($tx->type) }}</span>
  </div>
  <div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm mt-0.5">
  @if($isTransfer)
    <span>Alur: <strong class="font-semibold text-on-surface">{{ $tx->wallet?->name ?? '-' }} → {{ $tx->destinationWallet?->name ?? '-' }}</strong></span>
  @else
    <span>Dompet: <strong class="font-semibold text-on-surface">{{ $tx->wallet?->name ?? '-' }}</strong></span>
  @endif
  <span>•</span>
  <span>{{ $tx->transaction_date->locale('id')->translatedFormat('d M Y') }}</span>
  </div>
  @if($isTransfer)
    <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $tx->wallet?->name ?? '-' }} berkurang, {{ $tx->destinationWallet?->name ?? '-' }} bertambah</span>
  @endif
  </div>
  </div>
  <div class="flex flex-col items-end shrink-0 pl-space-sm">
  <span class="font-numerical-ledger text-numerical-ledger {{ $amountColor }} font-bold">{{ $amountPrefix }}{{ number_format($tx->amount, 0, ',', '.') }}</span>
  <span class="font-label-sm text-label-sm text-on-surface-variant">
    {{ $isIncome ? 'Saldo bertambah' : ($isExpense ? 'Saldo berkurang' : 'Netral Antar Dompet') }}
  </span>
  </div>
  </div>
@empty
  <div class="py-12 text-center text-on-surface-variant">
    <span class="material-symbols-outlined text-[32px] opacity-60 mb-2">receipt_long</span>
    <p class="font-label-md text-label-md font-semibold text-on-surface">Belum ada transaksi</p>
    <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Catatan mutasi pemasukan, pengeluaran, dan transfer akan tampil di sini.</p>
  </div>
@endforelse
</div>
<div class="pt-space-md flex items-center justify-center">
<a href="{{ route('transactions.index') }}" class="flex items-center gap-1.5 px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md text-label-md transition-colors">
<span>Lihat Riwayat Selengkapnya</span>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</a>
</div>
</div>
</div>
@if(session('success'))
<!-- Subtle Toast Notification (Floating in Bottom Corner) -->
<div class="fixed bottom-20 lg:bottom-6 right-6 z-50 flex items-center gap-space-sm px-space-md py-3 rounded-xl bg-primary-container text-on-primary shadow-xl transition-all duration-300" id="toast-notification">
<div class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-on-secondary text-[16px]">check</span>
</div>
<div class="flex flex-col text-left">
<span class="font-label-md text-label-md font-semibold text-on-primary">Sukses</span>
<span class="font-body-sm text-body-sm text-primary-fixed-dim">{{ session('success') }}</span>
</div>
<button class="ml-2 text-primary-fixed-dim hover:text-on-primary" id="close-toast" type="button">
<span class="material-symbols-outlined text-[18px]">close</span>
</button>
</div>
@endif
</div>
<script>
  (function () {
    // 1. Balance visibility toggle
    var toggleBtn = document.getElementById('toggle-balance');
    var balanceVal = document.getElementById('balance-value');
    var balanceMask = document.getElementById('balance-masked');
    var eyeIcon = document.getElementById('eye-icon');
    var isHidden = false;

    if (toggleBtn && balanceVal && balanceMask && eyeIcon) {
      toggleBtn.addEventListener('click', function () {
        isHidden = !isHidden;
        if (isHidden) {
          balanceVal.classList.add('hidden');
          balanceMask.classList.remove('hidden');
          eyeIcon.textContent = 'visibility_off';
        } else {
          balanceVal.classList.remove('hidden');
          balanceMask.classList.add('hidden');
          eyeIcon.textContent = 'visibility';
        }
      });
    }

    // 2. Transaction Filter tabs
    var filterContainer = document.getElementById('transaction-filters');
    if (filterContainer) {
      var tabs = filterContainer.querySelectorAll('.filter-tab');
      var items = document.querySelectorAll('.tx-item');

      tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          var targetFilter = tab.getAttribute('data-filter');

          // Style active tab
          tabs.forEach(function (t) {
            t.classList.remove('bg-surface-container-lowest', 'text-on-surface', 'shadow-sm');
            t.classList.add('text-on-surface-variant');
          });
          tab.classList.add('bg-surface-container-lowest', 'text-on-surface', 'shadow-sm');
          tab.classList.remove('text-on-surface-variant');

          // Filter rows
          items.forEach(function (item) {
            var itemType = item.getAttribute('data-type');
            if (targetFilter === 'all' || itemType === targetFilter) {
              item.classList.remove('hidden');
              item.classList.add('flex');
            } else {
              item.classList.add('hidden');
              item.classList.remove('flex');
            }
          });
        });
      });
    }

    // 3. Toast dismiss handler
    var toast = document.getElementById('toast-notification');
    var closeToast = document.getElementById('close-toast');
    if (closeToast && toast) {
      closeToast.addEventListener('click', function () {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(12px)';
        setTimeout(function () {
          toast.remove();
        }, 300);
      });
    }
  })();
</script>
@endsection