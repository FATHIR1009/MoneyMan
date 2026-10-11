@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-6 pt-4">
<!-- Top Section: Metric Highlights & Action Header -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
<div>
<div class="flex items-center gap-2 mb-1">
<span class="inline-flex items-center px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm">
            Buku Kas Utama
          </span>
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Sinkronisasi Realtime</span>
</div>
<h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Riwayat Transaksi</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-0.5">
          Semua catatan pemasukan, pengeluaran, dan transfer antar dompet
        </p>
</div>
<div class="flex items-center gap-3">
<button class="h-11 px-4 rounded-xl bg-surface-container-lowest text-on-surface hover:bg-surface-container-low shadow-sm flex items-center gap-2 font-label-lg text-label-lg transition-all active:scale-[0.98]" id="btn-export" type="button">
<span class="material-symbols-outlined text-[18px]">download</span>
<span>Unduh CSV</span>
</button>
<button class="h-11 px-5 rounded-xl bg-primary text-on-primary hover:opacity-90 shadow-md flex items-center gap-2 font-label-lg text-label-lg transition-all active:scale-[0.98]" id="btn-open-modal" type="button">
<span class="material-symbols-outlined text-[20px]">add</span>
<span>+ Catat Transaksi Baru</span>
</button>
</div>
</div>
<!-- Quick Financial Summary Strip (Context Awareness) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
<span class="material-symbols-outlined text-[20px]">arrow_downward</span>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Total Masuk (Bulan Ini)</p>
<p class="font-headline-sm text-headline-sm text-secondary font-bold">+Rp1.000.000</p>
</div>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed">2 Mutasi</span>
</div>
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined text-[20px]">arrow_upward</span>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Total Keluar (Bulan Ini)</p>
<p class="font-headline-sm text-headline-sm text-error font-bold">-Rp118.000</p>
</div>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-error-container text-on-error-container">3 Mutasi</span>
</div>
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface">
<span class="material-symbols-outlined text-[20px]">swap_horiz</span>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Transfer Antar Dompet</p>
<p class="font-headline-sm text-headline-sm text-on-surface font-bold">Rp50.000</p>
</div>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container text-on-surface">1 Rotasi</span>
</div>
</div>
<!-- Controls & Filter Bar -->
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm space-y-3">
<div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3">
<!-- Search Input -->
<div class="relative flex-1 min-w-[240px]">
<span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant">search</span>
<input class="w-full h-11 pl-10 pr-4 rounded-xl bg-surface-container-low text-on-surface placeholder:text-on-surface-variant font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary transition-all" id="search-input" placeholder="Cari deskripsi transaksi..." type="text"/>
</div>
<!-- Filter: Jenis -->
<div class="relative min-w-[170px]">
<select class="w-full h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary transition-all" id="filter-type">
<option value="all">Semua Jenis</option>
<option value="income">Pemasukan (+)</option>
<option value="expense">Pengeluaran (-)</option>
<option value="transfer">Transfer (⇄)</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">unfold_more</span>
</div>
<!-- Filter: Dompet -->
<div class="relative min-w-[170px]">
<select class="w-full h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary transition-all" id="filter-wallet">
<option value="all">Semua Dompet</option>
<option value="Cash">Cash (Tunai Fisik)</option>
<option value="GoPay">GoPay</option>
<option value="DANA">DANA</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">unfold_more</span>
</div>
<!-- Filter: Tanggal / Range Picker -->
<div class="flex items-center gap-2 h-11 px-3.5 rounded-xl bg-surface-container-low text-on-surface min-w-[160px] cursor-pointer hover:bg-surface-container transition-all">
<span class="material-symbols-outlined text-[18px] text-on-surface-variant">calendar_month</span>
<span class="font-label-lg text-label-lg flex-1">Mei 2025</span>
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">keyboard_arrow_down</span>
</div>
<!-- Reset Button -->
<button class="h-11 px-3.5 rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-1 font-label-md text-label-md transition-all active:scale-95" id="btn-reset-filter" title="Atur Ulang Filter" type="button">
<span class="material-symbols-outlined text-[18px]">restart_alt</span>
<span class="hidden xl:inline">Reset</span>
</button>
</div>
<!-- Active Filters Tag Bar -->
<div class="flex flex-wrap items-center gap-2 pt-1" id="active-tags-container">
<span class="font-label-sm text-label-sm text-on-surface-variant">Filter aktif:</span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm">
<span>Periode: 1 - 31 Mei 2025</span>
</span>
<span class="font-label-sm text-label-sm text-on-surface-variant ml-auto" id="active-count-indicator">
          6 item terfilter
        </span>
</div>
</div>
<!-- Main Table Container (Desktop Data Table & Mobile Stack Cards) -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<!-- Desktop Header Row (Hidden on mobile) -->
<div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-3.5 bg-surface-container-low font-label-md text-label-md text-on-surface-variant uppercase tracking-wider items-center select-none">
<div class="col-span-4">Deskripsi &amp; Kategori</div>
<div class="col-span-2">Jenis Transaksi</div>
<div class="col-span-2">Dompet Terlibat</div>
<div class="col-span-2 text-right">Jumlah Uang (Rp)</div>
<div class="col-span-2 text-right">Tanggal &amp; Aksi</div>
</div>
<!-- Transaction List (Rows) -->
<div class="divide-y-0" id="transaction-rows">
<!-- Row 1: Uang Saku (Income) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="500000" data-category="Pemasukan Bulanan" data-desc="Uang Saku" data-type="income" data-wallet="Cash">
<!-- Col 1: Deskripsi & Kategori -->
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0 text-on-secondary-fixed">
<span class="material-symbols-outlined text-[20px]">payments</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Uang Saku</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Pemasukan Rutin</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Auto Reconciled</span>
</div>
</div>
</div>
<!-- Col 2: Jenis Transaksi Badge -->
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_downward</span>
<span>Pemasukan</span>
</span>
</div>
<!-- Col 3: Dompet -->
<div class="lg:col-span-2 flex items-center gap-2">
<div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">wallet</span>
<span class="font-label-md text-label-md font-medium">Cash</span>
</div>
</div>
<!-- Col 4: Jumlah Uang -->
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<p class="font-numerical-ledger text-numerical-ledger text-secondary font-bold tracking-tight">
                +Rp500.000
              </p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Saldo bertambah</p>
</div>
</div>
<!-- Col 5: Tanggal & Aksi -->
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">24 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">08:30 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
<!-- Row 2: Makan Siang (Expense) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="25000" data-category="Makanan &amp; Minuman" data-desc="Makan Siang" data-type="expense" data-wallet="GoPay">
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center shrink-0 text-on-error-container">
<span class="material-symbols-outlined text-[20px]">restaurant</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Makan Siang</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Kuliner Warteg</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Merchant QRIS</span>
</div>
</div>
</div>
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
<span>Pengeluaran</span>
</span>
</div>
<div class="lg:col-span-2 flex items-center gap-2">
<div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">qr_code_2</span>
<span class="font-label-md text-label-md font-medium">GoPay</span>
</div>
</div>
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<p class="font-numerical-ledger text-numerical-ledger text-error font-bold tracking-tight">
                -Rp25.000
              </p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Biaya konsumsi</p>
</div>
</div>
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">23 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">12:15 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
<!-- Row 3: Top Up Saldo GoPay (Transfer) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="50000" data-category="Transfer Internal" data-desc="Top Up Saldo GoPay" data-type="transfer" data-wallet="DANA">
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0 text-on-surface">
<span class="material-symbols-outlined text-[20px]">swap_horiz</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Top Up Saldo GoPay</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Transfer Antar Dompet</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Bebas Admin</span>
</div>
</div>
</div>
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container-highest text-on-surface font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">sync_alt</span>
<span>Transfer</span>
</span>
</div>
<!-- Transfer explicit routing -->
<div class="lg:col-span-2 flex items-center gap-1.5">
<div class="px-2 py-1 rounded-md bg-surface-container text-on-surface font-label-sm text-label-sm font-semibold">
              DANA
            </div>
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">arrow_forward</span>
<div class="px-2 py-1 rounded-md bg-surface-container text-on-surface font-label-sm text-label-sm font-semibold">
              GoPay
            </div>
</div>
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<div class="flex items-center lg:justify-end gap-1">
<span class="material-symbols-outlined text-[14px] text-on-surface-variant">swap_horiz</span>
<span class="font-numerical-ledger text-numerical-ledger text-on-surface font-bold tracking-tight">
                  Rp50.000
                </span>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">DANA berkurang, GoPay bertambah</p>
</div>
</div>
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">22 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">14:00 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
<!-- Row 4: Buku Pemrograman (Expense) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="75000" data-category="Pendidikan &amp; Buku" data-desc="Buku Pemrograman" data-type="expense" data-wallet="GoPay">
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center shrink-0 text-on-error-container">
<span class="material-symbols-outlined text-[20px]">menu_book</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Buku Pemrograman</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Buku Belajar Go &amp; Cloud</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Toko Buku Gramedia</span>
</div>
</div>
</div>
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
<span>Pengeluaran</span>
</span>
</div>
<div class="lg:col-span-2 flex items-center gap-2">
<div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">credit_card</span>
<span class="font-label-md text-label-md font-medium">GoPay</span>
</div>
</div>
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<p class="font-numerical-ledger text-numerical-ledger text-error font-bold tracking-tight">
                -Rp75.000
              </p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Self-development</p>
</div>
</div>
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">20 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">19:40 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
<!-- Row 5: Freelance Web Design (Income) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="500000" data-category="Pendapatan Freelance" data-desc="Freelance Web Design" data-type="income" data-wallet="DANA">
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0 text-on-secondary-fixed">
<span class="material-symbols-outlined text-[20px]">laptop_mac</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Freelance Web Design</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Proyek Landing Page</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-secondary font-medium">Klien Lokal</span>
</div>
</div>
</div>
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_downward</span>
<span>Pemasukan</span>
</span>
</div>
<div class="lg:col-span-2 flex items-center gap-2">
<div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">account_balance_wallet</span>
<span class="font-label-md text-label-md font-medium">DANA</span>
</div>
</div>
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<p class="font-numerical-ledger text-numerical-ledger text-secondary font-bold tracking-tight">
                +Rp500.000
              </p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Saldo bertambah</p>
</div>
</div>
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">18 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">10:00 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
<!-- Row 6: Beli Kopi Susu (Expense) -->
<div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" data-amount="18000" data-category="Makanan &amp; Minuman" data-desc="Beli Kopi Susu" data-type="expense" data-wallet="Cash">
<div class="lg:col-span-4 flex items-center gap-3.5">
<div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center shrink-0 text-on-error-container">
<span class="material-symbols-outlined text-[20px]">coffee</span>
</div>
<div class="min-w-0">
<p class="font-body-md text-body-md font-semibold text-on-surface truncate">Beli Kopi Susu</p>
<div class="flex items-center gap-2 mt-0.5">
<span class="font-label-sm text-label-sm text-on-surface-variant">Coffee Shop Sore</span>
<span class="w-1 h-1 rounded-full bg-outline-variant"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant">Cash Fisik</span>
</div>
</div>
</div>
<div class="lg:col-span-2 flex items-center">
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[14px]">arrow_upward</span>
<span>Pengeluaran</span>
</span>
</div>
<div class="lg:col-span-2 flex items-center gap-2">
<div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
<span class="material-symbols-outlined text-[16px] text-on-surface-variant">wallet</span>
<span class="font-label-md text-label-md font-medium">Cash</span>
</div>
</div>
<div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
<span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
<div class="text-right">
<p class="font-numerical-ledger text-numerical-ledger text-error font-bold tracking-tight">
                -Rp18.000
              </p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Konsumsi santai</p>
</div>
</div>
<div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
<div class="text-left lg:text-right">
<p class="font-label-md text-label-md text-on-surface font-medium">16 Mei 2025</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">15:20 WIB</p>
</div>
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Lihat Rincian" type="button">
<span class="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Transaksi" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus Data" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
</div>
</div>
<!-- Empty State Drawer (Toggled dynamically or previewed) -->
<div class="hidden flex-col items-center justify-center py-16 px-4 text-center" id="empty-state-drawer">
<div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant mb-4">
<span class="material-symbols-outlined text-[32px]">manage_search</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">
          Tidak ada transaksi yang cocok dengan filter
        </h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">
          Silakan periksa kata kunci pencarian, ubah opsi filter dompet, atau atur ulang periode tanggal yang Anda pilih.
        </p>
<button class="h-10 px-5 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:opacity-90 transition-all flex items-center gap-2" id="btn-empty-reset" type="button">
<span class="material-symbols-outlined text-[18px]">filter_alt_off</span>
<span>Bersihkan Filter &amp; Tampilkan Semua</span>
</button>
</div>
<!-- Pagination Bar Footer -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-4 bg-surface-container-low select-none">
<div class="flex items-center gap-2">
<span class="font-label-md text-label-md text-on-surface-variant">
            Menampilkan <strong class="text-on-surface">1 - 6</strong> dari <strong class="text-on-surface">24</strong> transaksi
          </span>
<span class="w-1 h-1 rounded-full bg-outline-variant hidden sm:inline-block"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant hidden sm:inline-block">Halaman 1 dari 4</span>
</div>
<div class="flex items-center gap-1.5">
<!-- Prev Button -->
<button class="h-9 px-3 rounded-lg bg-surface-container-lowest text-outline-variant font-label-md text-label-md flex items-center gap-1 cursor-not-allowed" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
<span class="hidden md:inline">Sebelumnya</span>
</button>
<!-- Pages -->
<button class="w-9 h-9 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold" type="button">
            1
          </button>
<button class="w-9 h-9 rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container font-label-md text-label-md transition-colors" type="button">
            2
          </button>
<button class="w-9 h-9 rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container font-label-md text-label-md transition-colors" type="button">
            3
          </button>
<span class="px-1 text-on-surface-variant font-label-sm text-label-sm">...</span>
<button class="w-9 h-9 rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container font-label-md text-label-md transition-colors" type="button">
            4
          </button>
<!-- Next Button -->
<button class="h-9 px-3 rounded-lg bg-surface-container-lowest hover:bg-surface-container text-on-surface font-label-md text-label-md flex items-center gap-1 transition-colors" type="button">
<span class="hidden md:inline">Selanjutnya</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Quick Analysis Card & Reconcile Tip -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-secondary text-[26px]">account_balance</span>
</div>
<div>
<h4 class="font-headline-sm text-headline-sm text-on-surface">Tips Rekonsiliasi Kas Mandiri</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
            Pastikan seluruh transaksi tunai fisik dicatat sebelum tutup buku harian jam 21:00 WIB untuk menjaga validitas saldo kas nyata.
          </p>
</div>
</div>
<button class="h-10 px-4 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center gap-2 whitespace-nowrap transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">fact_check</span>
<span>Mulai Cek Saldo</span>
</button>
</div>
</div>
<!-- Interactive Slide-over / Modal for '+ Catat Transaksi Baru' -->
<div class="fixed inset-0 bg-on-surface/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200" id="modal-backdrop">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl shadow-xl overflow-hidden transform scale-95 transition-transform duration-200" id="modal-card">
<!-- Modal Header -->
<div class="p-6 bg-surface-container-low flex items-center justify-between">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface font-bold">Catat Transaksi Baru</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Tambahkan catatan keuangan secara teliti</p>
</div>
<button class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors" id="btn-close-modal" type="button">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<!-- Modal Body -->
<form class="p-6 space-y-4" id="add-tx-form">
<!-- Segmented Type Selector -->
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-2">Jenis Mutasi</label>
<div class="grid grid-cols-3 gap-2 bg-surface-container-low p-1.5 rounded-xl">
<button class="tx-type-toggle py-2 rounded-lg bg-surface-container-lowest text-secondary font-label-md text-label-md font-bold shadow-sm text-center flex items-center justify-center gap-1" type="button">
<span class="material-symbols-outlined text-[16px]">add_circle</span> Pemasukan
            </button>
<button class="tx-type-toggle py-2 rounded-lg text-on-surface-variant hover:text-on-surface font-label-md text-label-md text-center flex items-center justify-center gap-1" type="button">
<span class="material-symbols-outlined text-[16px]">remove_circle</span> Pengeluaran
            </button>
<button class="tx-type-toggle py-2 rounded-lg text-on-surface-variant hover:text-on-surface font-label-md text-label-md text-center flex items-center justify-center gap-1" type="button">
<span class="material-symbols-outlined text-[16px]">swap_horiz</span> Transfer
            </button>
</div>
</div>
<!-- Nominal Input with big numbers -->
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Nominal (Rupiah)</label>
<div class="relative flex items-center">
<span class="absolute left-4 font-headline-md text-headline-md text-on-surface-variant font-bold">Rp</span>
<input class="w-full h-14 pl-14 pr-4 rounded-xl bg-surface-container-low text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0" type="number"/>
</div>
</div>
<!-- Description -->
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Deskripsi Singkat</label>
<input class="w-full h-11 px-4 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Contoh: Honor Proyek, Makan Siang, dll." type="text"/>
</div>
<!-- Wallet and Category -->
<div class="grid grid-cols-2 gap-3">
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Dompet Sumber</label>
<select class="w-full h-11 px-3 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg focus:outline-none focus:ring-2 focus:ring-primary">
<option>Cash (Tunai)</option>
<option>GoPay</option>
<option>DANA</option>
</select>
</div>
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Kategori</label>
<select class="w-full h-11 px-3 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg focus:outline-none focus:ring-2 focus:ring-primary">
<option>Gaji &amp; Pendapatan</option>
<option>Makanan &amp; Minum</option>
<option>Transportasi</option>
<option>Edukasi</option>
<option>Lain-lain</option>
</select>
</div>
</div>
<!-- Date & Time -->
<div>
<label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Waktu Transaksi</label>
<input class="w-full h-11 px-4 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md focus:outline-none focus:ring-2 focus:ring-primary" type="datetime-local" value="2025-05-24T08:30"/>
</div>
<!-- Actions -->
<div class="pt-3 flex items-center justify-end gap-3">
<button class="h-11 px-5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" id="btn-cancel-modal" type="button">
            Batal
          </button>
<button class="h-11 px-6 rounded-xl bg-primary text-on-primary hover:opacity-90 font-label-lg text-label-lg font-bold shadow-md transition-opacity" type="submit">
            Simpan Transaksi
          </button>
</div>
</form>
</div>
</div>
<!-- Client-side Interactive Filter & Modal Management Script -->
<script>
    (function initTransactionDashboard() {
      const searchInput = document.getElementById('search-input');
      const filterType = document.getElementById('filter-type');
      const filterWallet = document.getElementById('filter-wallet');
      const btnReset = document.getElementById('btn-reset-filter');
      const btnEmptyReset = document.getElementById('btn-empty-reset');
      const rows = document.querySelectorAll('.transaction-item');
      const emptyState = document.getElementById('empty-state-drawer');
      const countIndicator = document.getElementById('active-count-indicator');

      function applyFilters() {
        const query = (searchInput.value || '').toLowerCase().trim();
        const selectedType = filterType.value;
        const selectedWallet = filterWallet.value;

        let visibleCount = 0;

        rows.forEach(row => {
          const desc = (row.dataset.desc || '').toLowerCase();
          const category = (row.dataset.category || '').toLowerCase();
          const type = row.dataset.type;
          const wallet = row.dataset.wallet;

          const matchesQuery = !query || desc.includes(query) || category.includes(query);
          const matchesType = selectedType === 'all' || type === selectedType;
          const matchesWallet = selectedWallet === 'all' || wallet === selectedWallet;

          if (matchesQuery && matchesType && matchesWallet) {
            row.classList.remove('hidden');
            visibleCount++;
          } else {
            row.classList.add('hidden');
          }
        });

        if (visibleCount === 0) {
          emptyState.classList.remove('hidden');
          emptyState.classList.add('flex');
        } else {
          emptyState.classList.add('hidden');
          emptyState.classList.remove('flex');
        }

        if (countIndicator) {
          countIndicator.textContent = `${visibleCount} item terfilter`;
        }
      }

      function resetAll() {
        if (searchInput) searchInput.value = '';
        if (filterType) filterType.value = 'all';
        if (filterWallet) filterWallet.value = 'all';
        applyFilters();
      }

      if (searchInput) searchInput.addEventListener('input', applyFilters);
      if (filterType) filterType.addEventListener('change', applyFilters);
      if (filterWallet) filterWallet.addEventListener('change', applyFilters);
      if (btnReset) btnReset.addEventListener('click', resetAll);
      if (btnEmptyReset) btnEmptyReset.addEventListener('click', resetAll);

      // Modal Dialog Logic
      const modalBackdrop = document.getElementById('modal-backdrop');
      const modalCard = document.getElementById('modal-card');
      const btnOpenModal = document.getElementById('btn-open-modal');
      const btnCloseModal = document.getElementById('btn-close-modal');
      const btnCancelModal = document.getElementById('btn-cancel-modal');
      const form = document.getElementById('add-tx-form');

      function openModal() {
        if (!modalBackdrop || !modalCard) return;
        modalBackdrop.classList.remove('opacity-0', 'pointer-events-none');
        modalBackdrop.classList.add('opacity-100', 'pointer-events-auto');
        modalCard.classList.remove('scale-95');
        modalCard.classList.add('scale-100');
      }

      function closeModal() {
        if (!modalBackdrop || !modalCard) return;
        modalBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
        modalBackdrop.classList.add('opacity-0', 'pointer-events-none');
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
      }

      if (btnOpenModal) btnOpenModal.addEventListener('click', openModal);
      if (btnCloseModal) btnCloseModal.addEventListener('click', closeModal);
      if (btnCancelModal) btnCancelModal.addEventListener('click', closeModal);

      if (modalBackdrop) {
        modalBackdrop.addEventListener('click', (e) => {
          if (e.target === modalBackdrop) closeModal();
        });
      }

      if (form) {
        form.addEventListener('submit', (e) => {
          e.preventDefault();
          closeModal();
          alert('Transaksi berhasil ditambahkan ke riwayat!');
        });
      }

      // Segmented toggle styling interaction
      const typeToggles = document.querySelectorAll('.tx-type-toggle');
      typeToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
          typeToggles.forEach(t => {
            t.classList.remove('bg-surface-container-lowest', 'text-secondary', 'font-bold', 'shadow-sm');
            t.classList.add('text-on-surface-variant');
          });
          toggle.classList.add('bg-surface-container-lowest', 'text-secondary', 'font-bold', 'shadow-sm');
          toggle.classList.remove('text-on-surface-variant');
        });
      });
    })();
  </script>
@endsection