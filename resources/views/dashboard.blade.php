@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-space-lg w-full max-w-[1280px] mx-auto py-space-md">
<!-- Top Greeting & Header Controls -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
<div class="flex flex-col">
<div class="flex items-center gap-space-xs">
<span class="font-headline-lg text-headline-lg text-on-surface">Selamat Pagi, Ahmad</span>
<span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-secondary-container text-on-secondary-fixed">
<span class="material-symbols-outlined text-[18px]">waving_hand</span>
</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-0.5">
          Sabtu, 24 Mei 2025 <span class="mx-1.5 opacity-40">•</span> Ringkasan Finansial Anda
        </p>
</div>
<!-- Action Buttons Header -->
<div class="flex flex-wrap items-center gap-space-xs">
<button class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md shadow-sm hover:brightness-95 active:scale-95 transition-all" id="btn-add-income" type="button">
<span class="material-symbols-outlined text-[18px]">add_circle</span>
<span>+ Income</span>
</button>
<button class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-error-container text-on-error-container font-label-md text-label-md shadow-sm hover:brightness-95 active:scale-95 transition-all" id="btn-add-expense" type="button">
<span class="material-symbols-outlined text-[18px]">remove_circle</span>
<span>− Expense</span>
</button>
<button class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-surface-container-highest text-on-surface font-label-md text-label-md shadow-sm hover:bg-surface-container-high active:scale-95 transition-all" id="btn-add-transfer" type="button">
<span class="material-symbols-outlined text-[18px]">swap_horiz</span>
<span>↔ Transfer</span>
</button>
<button class="flex items-center gap-1.5 px-space-md py-2.5 rounded-xl bg-surface-container-lowest text-on-surface-variant font-label-md text-label-md shadow-sm hover:bg-surface-container hover:text-on-surface active:scale-95 transition-all" id="btn-new-wallet" type="button">
<span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
<span>+ Dompet</span>
</button>
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
<span>Sinkronisasi Lokal Aktif</span>
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
<span class="font-display-lg text-display-lg text-on-primary font-bold tracking-tight" id="balance-value">500.000</span>
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
<span class="font-headline-sm text-headline-sm text-on-primary leading-tight">3 Dompet</span>
</div>
</div>
<div class="hidden sm:block w-px h-8 bg-surface-container-lowest/15"></div>
<div class="flex items-center gap-space-sm px-space-sm py-1.5">
<div class="w-9 h-9 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center text-primary-fixed">
<span class="material-symbols-outlined text-[20px]">auto_graph</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-primary-fixed-dim">Arus Kas Masuk</span>
<span class="font-headline-sm text-headline-sm text-secondary-fixed leading-tight">+65% Net</span>
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
<span class="font-label-sm text-label-sm text-on-surface-variant">Terakhir diperbarui: Hari ini 08:30 WIB</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
<!-- 1. Cash Card -->
<div class="group relative flex flex-col justify-between p-space-md bg-surface-container-lowest rounded-2xl shadow-sm hover:shadow-md transition-all">
<div class="flex items-start justify-between">
<div class="flex items-center gap-space-sm">
<div class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed shadow-sm">
<span class="material-symbols-outlined text-[24px]">payments</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface font-semibold">Cash</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Uang Tunai Dompet Fisik</span>
</div>
</div>
<span class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Fisik</span>
</div>
<div class="my-space-md">
<span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Saldo Tersedia</span>
<div class="flex items-baseline gap-1">
<span class="font-body-md text-body-md text-on-surface-variant font-semibold">Rp</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight">100.000</span>
</div>
</div>
<div class="flex items-center justify-between pt-space-xs">
<button class="flex items-center gap-1 font-label-md text-label-md text-secondary hover:text-on-secondary-container transition-colors" type="button">
<span>Lihat Rincian</span>
<span class="material-symbols-outlined text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
</button>
<div class="flex items-center gap-1 text-on-surface-variant">
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Catat Setoran" type="button">
<span class="material-symbols-outlined text-[16px]">add</span>
</button>
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Transfer Kas" type="button">
<span class="material-symbols-outlined text-[16px]">swap_horiz</span>
</button>
</div>
</div>
</div>
<!-- 2. GoPay Card -->
<div class="group relative flex flex-col justify-between p-space-md bg-surface-container-lowest rounded-2xl shadow-sm hover:shadow-md transition-all">
<div class="flex items-start justify-between">
<div class="flex items-center gap-space-sm">
<div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center text-on-surface shadow-sm">
<span class="material-symbols-outlined text-[24px]">qr_code_scanner</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface font-semibold">GoPay</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">E-Wallet Akun Utama</span>
</div>
</div>
<span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">E-Wallet</span>
</div>
<div class="my-space-md">
<span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Saldo Tersedia</span>
<div class="flex items-baseline gap-1">
<span class="font-body-md text-body-md text-on-surface-variant font-semibold">Rp</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight">150.000</span>
</div>
</div>
<div class="flex items-center justify-between pt-space-xs">
<button class="flex items-center gap-1 font-label-md text-label-md text-secondary hover:text-on-secondary-container transition-colors" type="button">
<span>Lihat Rincian</span>
<span class="material-symbols-outlined text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
</button>
<div class="flex items-center gap-1 text-on-surface-variant">
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Isi Saldo" type="button">
<span class="material-symbols-outlined text-[16px]">add</span>
</button>
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Kirim Saldo" type="button">
<span class="material-symbols-outlined text-[16px]">swap_horiz</span>
</button>
</div>
</div>
</div>
<!-- 3. DANA Card -->
<div class="group relative flex flex-col justify-between p-space-md bg-surface-container-lowest rounded-2xl shadow-sm hover:shadow-md transition-all">
<div class="flex items-start justify-between">
<div class="flex items-center gap-space-sm">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface shadow-sm">
<span class="material-symbols-outlined text-[24px]">account_balance</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface font-semibold">DANA</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">E-Wallet Operasional</span>
</div>
</div>
<span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">E-Wallet</span>
</div>
<div class="my-space-md">
<span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Saldo Tersedia</span>
<div class="flex items-baseline gap-1">
<span class="font-body-md text-body-md text-on-surface-variant font-semibold">Rp</span>
<span class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight">250.000</span>
</div>
</div>
<div class="flex items-center justify-between pt-space-xs">
<button class="flex items-center gap-1 font-label-md text-label-md text-secondary hover:text-on-secondary-container transition-colors" type="button">
<span>Lihat Rincian</span>
<span class="material-symbols-outlined text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
</button>
<div class="flex items-center gap-1 text-on-surface-variant">
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Isi Saldo" type="button">
<span class="material-symbols-outlined text-[16px]">add</span>
</button>
<button class="w-7 h-7 rounded-lg bg-surface-container-low hover:bg-surface-container flex items-center justify-center transition-colors" title="Kirim Saldo" type="button">
<span class="material-symbols-outlined text-[16px]">swap_horiz</span>
</button>
</div>
</div>
</div>
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
            +Rp1.000.000
          </div>
<div class="flex items-center gap-1.5 mt-1">
<span class="material-symbols-outlined text-secondary text-[16px]">trending_up</span>
<span class="font-label-sm text-label-sm text-on-secondary-fixed font-semibold">2 Mutasi Penerimaan</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">• Mei 2025</span>
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
            -Rp350.000
          </div>
<div class="flex items-center gap-1.5 mt-1">
<span class="material-symbols-outlined text-error text-[16px]">pie_chart</span>
<span class="font-label-sm text-label-sm text-on-error-container font-semibold">3 Transaksi Tercatat</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">• Rasio 35%</span>
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
            Rp200.000
          </div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
            Netral • Tidak mempengaruhi total saldo akun.
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
<span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">Bulan Mei</span>
</div>
<div class="flex items-center gap-space-md my-space-sm p-space-sm rounded-xl bg-surface-container-low">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center shrink-0 text-on-surface">
<span class="material-symbols-outlined text-[28px]">menu_book</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-lg text-label-lg text-on-surface font-bold truncate">Buku Pemrograman Laravel</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Pendidikan &amp; Karir • GoPay</span>
<div class="flex items-center gap-2 mt-1">
<span class="font-headline-sm text-headline-sm text-error font-bold">-Rp75.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">20 Mei 2025</span>
</div>
</div>
</div>
<div class="p-space-sm rounded-xl bg-surface-container-lowest shadow-sm flex items-center justify-between">
<div class="flex items-center gap-space-xs text-on-surface-variant">
<span class="material-symbols-outlined text-[18px]">verified</span>
<span class="font-body-sm text-body-sm">Porsi terhadap total beban:</span>
</div>
<span class="font-label-lg text-label-lg text-on-surface font-bold">21.4%</span>
</div>
</div>
<!-- Spending Breakdown Visual (7 Cols) -->
<div class="lg:col-span-7 flex flex-col justify-between p-space-lg bg-surface-container-lowest rounded-2xl shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px]">donut_small</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Komposisi Pengeluaran Dompet</h3>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">Total: Rp350.000</span>
</div>
<!-- Multi-segment visual bar -->
<div class="w-full flex flex-col gap-space-sm my-space-xs">
<div class="w-full h-4 rounded-full bg-surface-container-low flex overflow-hidden">
<div class="h-full bg-surface-container-highest transition-all" style="width: 57%;" title="GoPay 57%"></div>
<div class="h-full bg-secondary-fixed transition-all" style="width: 29%;" title="Cash 29%"></div>
<div class="h-full bg-surface-container-high transition-all" style="width: 14%;" title="DANA 14%"></div>
</div>
<!-- Progress Legend Rows -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-space-sm pt-space-xs">
<div class="flex flex-col p-space-xs rounded-xl bg-surface-container-low">
<div class="flex items-center justify-between">
<div class="flex items-center gap-1.5">
<span class="w-2.5 h-2.5 rounded-full bg-surface-container-highest"></span>
<span class="font-label-md text-label-md text-on-surface font-semibold">GoPay</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant font-bold">57.1%</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-semibold mt-1">Rp200.000</span>
</div>
<div class="flex flex-col p-space-xs rounded-xl bg-surface-container-low">
<div class="flex items-center justify-between">
<div class="flex items-center gap-1.5">
<span class="w-2.5 h-2.5 rounded-full bg-secondary-fixed"></span>
<span class="font-label-md text-label-md text-on-surface font-semibold">Cash</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant font-bold">28.6%</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-semibold mt-1">Rp100.000</span>
</div>
<div class="flex flex-col p-space-xs rounded-xl bg-surface-container-low">
<div class="flex items-center justify-between">
<div class="flex items-center gap-1.5">
<span class="w-2.5 h-2.5 rounded-full bg-surface-container-high"></span>
<span class="font-label-md text-label-md text-on-surface font-semibold">DANA</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant font-bold">14.3%</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-semibold mt-1">Rp50.000</span>
</div>
</div>
</div>
<div class="flex items-center justify-between text-on-surface-variant pt-space-xs">
<span class="font-body-sm text-body-sm">Pola pengeluaran didominasi e-wallet untuk kebutuhan edukasi &amp; konsumsi harian.</span>
</div>
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
            Semua (5)
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
<!-- Row 1: Uang Saku (Income) -->
<div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="income">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-11 h-11 rounded-full bg-secondary-fixed/50 text-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">payments</span>
</div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">Uang Saku</span>
<span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">Income</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span>Dompet: <strong class="font-semibold text-on-surface">Cash</strong></span>
<span>•</span>
<span>24 Mei 2025</span>
</div>
</div>
</div>
<div class="flex flex-col items-end shrink-0 pl-space-sm">
<span class="font-numerical-ledger text-numerical-ledger text-secondary font-bold">+Rp500.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Kas Fisik Masuk</span>
</div>
</div>
<!-- Row 2: Makan Siang Padang (Expense) -->
<div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="expense">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-11 h-11 rounded-full bg-error-container/60 text-error flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">restaurant</span>
</div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">Makan Siang Padang</span>
<span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">Expense</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span>Dompet: <strong class="font-semibold text-on-surface">GoPay</strong></span>
<span>•</span>
<span>23 Mei 2025</span>
</div>
</div>
</div>
<div class="flex flex-col items-end shrink-0 pl-space-sm">
<span class="font-numerical-ledger text-numerical-ledger text-error font-bold">-Rp25.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Makanan &amp; Minuman</span>
</div>
</div>
<!-- Row 3: Top Up GoPay (Transfer) -->
<div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="transfer">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-11 h-11 rounded-full bg-surface-container-highest text-on-surface flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">swap_horiz</span>
</div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">Top Up GoPay</span>
<span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm font-semibold">Transfer</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span>Alur: <strong class="font-semibold text-on-surface">DANA → GoPay</strong></span>
<span>•</span>
<span>22 Mei 2025</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">DANA berkurang, GoPay bertambah</span>
</div>
</div>
<div class="flex flex-col items-end shrink-0 pl-space-sm">
<span class="font-numerical-ledger text-numerical-ledger text-on-surface font-bold">Rp50.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Netral Antar Dompet</span>
</div>
</div>
<!-- Row 4: Buku Referensi (Expense) -->
<div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="expense">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-11 h-11 rounded-full bg-error-container/60 text-error flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">menu_book</span>
</div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">Buku Referensi</span>
<span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">Expense</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span>Dompet: <strong class="font-semibold text-on-surface">GoPay</strong></span>
<span>•</span>
<span>20 Mei 2025</span>
</div>
</div>
</div>
<div class="flex flex-col items-end shrink-0 pl-space-sm">
<span class="font-numerical-ledger text-numerical-ledger text-error font-bold">-Rp75.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Pendidikan</span>
</div>
</div>
<!-- Row 5: Gaji Freelance Web (Income) -->
<div class="tx-item flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container-low transition-colors" data-type="income">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-11 h-11 rounded-full bg-secondary-fixed/50 text-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">work</span>
</div>
<div class="flex flex-col min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">Gaji Freelance Web</span>
<span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">Income</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span>Dompet: <strong class="font-semibold text-on-surface">DANA</strong></span>
<span>•</span>
<span>18 Mei 2025</span>
</div>
</div>
</div>
<div class="flex flex-col items-end shrink-0 pl-space-sm">
<span class="font-numerical-ledger text-numerical-ledger text-secondary font-bold">+Rp500.000</span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Pendapatan Proyek</span>
</div>
</div>
</div>
<div class="pt-space-md flex items-center justify-center">
<button class="flex items-center gap-1.5 px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md text-label-md transition-colors" type="button">
<span>Lihat Riwayat Selengkapnya</span>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Subtle Toast Notification (Floating in Bottom Corner) -->
<div class="fixed bottom-20 lg:bottom-6 right-6 z-50 flex items-center gap-space-sm px-space-md py-3 rounded-xl bg-primary-container text-on-primary shadow-xl transition-all duration-300" id="toast-notification">
<div class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-on-secondary text-[16px]">check</span>
</div>
<div class="flex flex-col text-left">
<span class="font-label-md text-label-md font-semibold text-on-primary">Transfer Berhasil</span>
<span class="font-body-sm text-body-sm text-primary-fixed-dim">Rp50.000 dipindahkan dari DANA ke GoPay</span>
</div>
<button class="ml-2 text-primary-fixed-dim hover:text-on-primary" id="close-toast" type="button">
<span class="material-symbols-outlined text-[18px]">close</span>
</button>
</div>
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