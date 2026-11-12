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
      <button class="h-11 px-5 rounded-xl bg-primary text-on-primary hover:opacity-90 shadow-md flex items-center gap-2 font-label-lg text-label-lg transition-all active:scale-[0.98] cursor-pointer" id="btn-open-modal" onclick="openModal()" type="button">
        <span class="material-symbols-outlined text-[20px]">add</span>
        <span>+ Catat Pemasukan Baru</span>
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
          <p class="font-headline-sm text-headline-sm text-secondary font-bold">+Rp{{ number_format($incomeThisMonth, 0, ',', '.') }}</p>
        </div>
      </div>
      <span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed">{{ $incomeCountThisMonth }} Mutasi</span>
    </div>

    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
          <span class="material-symbols-outlined text-[20px]">arrow_upward</span>
        </div>
        <div>
          <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Total Keluar (Bulan Ini)</p>
          <p class="font-headline-sm text-headline-sm text-error font-bold">-Rp{{ number_format($expenseThisMonth, 0, ',', '.') }}</p>
        </div>
      </div>
      <span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-error-container text-on-error-container">{{ $expenseCountThisMonth }} Mutasi</span>
    </div>

    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface">
          <span class="material-symbols-outlined text-[20px]">swap_horiz</span>
        </div>
        <div>
          <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Transfer Antar Dompet</p>
          <p class="font-headline-sm text-headline-sm text-on-surface font-bold">Rp{{ number_format($transferThisMonth, 0, ',', '.') }}</p>
        </div>
      </div>
      <span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container text-on-surface">{{ $transferCountThisMonth }} Rotasi</span>
    </div>
  </div>

  <!-- Controls & Filter Bar -->
  <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm space-y-3">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3">
      <!-- Search Input -->
      <div class="relative flex-1 min-w-[240px]">
        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant">search</span>
        <input class="w-full h-11 pl-10 pr-4 rounded-xl bg-surface-container-low text-on-surface placeholder:text-on-surface-variant font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary transition-all border border-surface-container" id="search-input" placeholder="Cari deskripsi transaksi..." type="text"/>
      </div>
      <!-- Filter: Jenis -->
      <div class="relative min-w-[170px]">
        <select class="w-full h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary transition-all border border-surface-container" id="filter-type">
          <option value="all">Semua Jenis</option>
          <option value="income">Pemasukan (+)</option>
          <option value="expense">Pengeluaran (-)</option>
          <option value="transfer">Transfer (⇄)</option>
        </select>
        <span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">unfold_more</span>
      </div>
      <!-- Filter: Dompet -->
      <div class="relative min-w-[170px]">
        <select class="w-full h-11 pl-3.5 pr-9 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary transition-all border border-surface-container" id="filter-wallet">
          <option value="all">Semua Dompet</option>
          @foreach($wallets as $wallet)
            <option value="{{ $wallet->name }}">{{ $wallet->name }}</option>
          @endforeach
        </select>
        <span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">unfold_more</span>
      </div>
      <!-- Reset Button -->
      <button class="h-11 px-3.5 rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-1 font-label-md text-label-md transition-all active:scale-95 cursor-pointer" id="btn-reset-filter" title="Atur Ulang Filter" type="button">
        <span class="material-symbols-outlined text-[18px]">restart_alt</span>
        <span class="hidden xl:inline">Reset</span>
      </button>
    </div>

    <!-- Active Filters Tag Bar -->
    <div class="flex flex-wrap items-center gap-2 pt-1" id="active-tags-container">
      <span class="font-label-sm text-label-sm text-on-surface-variant">Status:</span>
      <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface font-label-sm text-label-sm">
        <span>Buku Kas Mandiri</span>
      </span>
      <span class="font-label-sm text-label-sm text-on-surface-variant ml-auto" id="active-count-indicator">
        {{ $transactions->count() }} item terdaftar
      </span>
    </div>
  </div>

  <!-- Main Table Container (Desktop Data Table & Mobile Stack Cards) -->
  <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
    @if($transactions->isEmpty())
      <!-- Database-level Empty State Component -->
      <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
        <div class="w-16 h-16 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed mb-4">
          <span class="material-symbols-outlined text-[32px]">payments</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-1">
          Belum Ada Transaksi Pemasukan
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">
          Anda belum memiliki catatan transaksi pemasukan. Mulai catat pemasukan pertama Anda untuk memantau aliran dana dan saldo dompet secara real-time.
        </p>
        <button class="h-11 px-5 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:opacity-90 transition-all flex items-center gap-2 shadow-sm cursor-pointer" onclick="openModal()" type="button">
          <span class="material-symbols-outlined text-[18px]">add_circle</span>
          <span>+ Catat Pemasukan Pertama</span>
        </button>
      </div>
    @else
      <!-- Desktop Header Row (Hidden on mobile) -->
      <div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-3.5 bg-surface-container-low font-label-md text-label-md text-on-surface-variant uppercase tracking-wider items-center select-none">
        <div class="col-span-4">Deskripsi Transaksi</div>
        <div class="col-span-2">Jenis Transaksi</div>
        <div class="col-span-2">Dompet Terlibat</div>
        <div class="col-span-2 text-right">Jumlah Uang (Rp)</div>
        <div class="col-span-2 text-right">Tanggal Transaksi</div>
      </div>

      <!-- Transaction List (Rows) -->
      <div class="divide-y divide-surface-container" id="transaction-rows">
        @foreach($transactions as $tx)
          @php
            $isIncome = $tx->type === 'income';
            $isExpense = $tx->type === 'expense';
            $isTransfer = $tx->type === 'transfer';

            $sign = $isIncome ? '+' : ($isExpense ? '-' : '');
            $amountColor = $isIncome ? 'text-secondary font-bold' : ($isExpense ? 'text-error font-bold' : 'text-on-surface font-bold');
            $badgeBg = $isIncome ? 'bg-secondary-fixed text-on-secondary-fixed' : ($isExpense ? 'bg-error-container text-on-error-container' : 'bg-surface-container-highest text-on-surface');
            $badgeIcon = $isIncome ? 'arrow_downward' : ($isExpense ? 'arrow_upward' : 'swap_horiz');
            $badgeLabel = $isIncome ? 'Pemasukan' : ($isExpense ? 'Pengeluaran' : 'Transfer');
            $iconBg = $isIncome ? 'bg-secondary-fixed text-on-secondary-fixed' : ($isExpense ? 'bg-error-container text-on-error-container' : 'bg-surface-container-high text-on-surface');
            $iconSymbol = $isIncome ? 'payments' : ($isExpense ? 'shopping_bag' : 'sync_alt');
          @endphp

          <div class="transaction-item group grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 p-4 lg:px-6 lg:py-4 hover:bg-surface-container-low transition-colors items-center" 
               data-amount="{{ (float) $tx->amount }}" 
               data-desc="{{ strtolower($tx->description) }}" 
               data-type="{{ $tx->type }}" 
               data-wallet="{{ $tx->wallet?->name }}">
            <!-- Col 1: Deskripsi & Kategori -->
            <div class="lg:col-span-4 flex items-center gap-3.5">
              <div class="w-10 h-10 rounded-full {{ $iconBg }} flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">{{ $iconSymbol }}</span>
              </div>
              <div class="min-w-0">
                @php
                  $rawDesc = trim($tx->description);
                  $customTag = null;
                  $customSub = null;

                  if (str_contains($rawDesc, '|')) {
                      $splitPipe = explode('|', $rawDesc, 2);
                      $rawDesc = trim($splitPipe[0]);
                      $customTag = trim($splitPipe[1]);
                  }

                  $subParts = preg_split('/\s*[-–—·•]\s*/u', $rawDesc, 3);
                  $mainTitle = trim($subParts[0] ?? $rawDesc);

                  if (isset($subParts[1]) && trim($subParts[1]) !== '') {
                      $customSub = trim($subParts[1]);
                  }

                  if ($customTag === null && isset($subParts[2]) && trim($subParts[2]) !== '') {
                      $customTag = trim($subParts[2]);
                  }

                  $defaultSub = $isIncome ? 'Pemasukan Rutin' : ($isExpense ? 'Pengeluaran Kas' : 'Transfer Antar Dompet');
                  $defaultTag = $isIncome ? 'Auto Reconciled' : ($isExpense ? 'Merchant QRIS' : 'Bebas Admin');

                  $subNote = ($customSub !== null && $customSub !== '') ? $customSub : $defaultSub;
                  $tag = ($customTag !== null && $customTag !== '') ? $customTag : $defaultTag;
                @endphp
                <p class="font-body-md text-body-md font-semibold text-on-surface truncate">{{ $mainTitle }}</p>
                <div class="flex items-center gap-2 mt-0.5">
                  <span class="font-label-sm text-label-sm text-on-surface-variant truncate">{{ $subNote }}</span>
                  <span class="w-1 h-1 rounded-full bg-outline-variant shrink-0"></span>
                  <span class="font-label-sm text-label-sm text-secondary font-medium shrink-0">{{ $tag }}</span>
                </div>
              </div>
            </div>

            <!-- Col 2: Jenis Transaksi Badge -->
            <div class="lg:col-span-2 flex items-center">
              <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full {{ $badgeBg }} font-label-sm text-label-sm font-semibold">
                <span class="material-symbols-outlined text-[14px]">{{ $badgeIcon }}</span>
                <span>{{ $badgeLabel }}</span>
              </span>
            </div>

            <!-- Col 3: Dompet -->
            <div class="lg:col-span-2 flex items-center gap-2">
              <div class="px-2.5 py-1 rounded-lg bg-surface-container flex items-center gap-1.5 text-on-surface">
                <span class="material-symbols-outlined text-[16px] text-on-surface-variant">wallet</span>
                <span class="font-label-md text-label-md font-medium">{{ $tx->wallet?->name ?? '-' }}</span>
              </div>
            </div>

            <!-- Col 4: Jumlah Uang -->
            <div class="lg:col-span-2 lg:text-right flex lg:block justify-between items-center">
              <span class="lg:hidden font-label-sm text-label-sm text-on-surface-variant">Nominal:</span>
              <div class="text-right">
                <p class="font-numerical-ledger text-numerical-ledger {{ $amountColor }} tracking-tight">
                  {{ $sign }}Rp{{ number_format($tx->amount, 0, ',', '.') }}
                </p>
                <p class="font-label-sm text-label-sm text-on-surface-variant">
                  {{ $isIncome ? 'Saldo bertambah' : ($isExpense ? 'Saldo berkurang' : 'Mutasi internal') }}
                </p>
              </div>
            </div>

            <!-- Col 5: Tanggal -->
            <div class="lg:col-span-2 flex items-center justify-between lg:justify-end gap-3 pt-2 lg:pt-0">
              <div class="text-left lg:text-right">
                <p class="font-label-md text-label-md text-on-surface font-medium">
                  {{ $tx->transaction_date ? $tx->transaction_date->locale('id')->translatedFormat('d M Y') : '-' }}
                </p>
                <p class="font-label-sm text-label-sm text-on-surface-variant">
                  {{ $tx->created_at ? $tx->created_at->format('H:i') . ' WIB' : '' }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Empty State Drawer (Toggled dynamically by JS filters) -->
      <div class="hidden flex-col items-center justify-center py-16 px-4 text-center" id="empty-state-drawer">
        <div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant mb-4">
          <span class="material-symbols-outlined text-[32px]">manage_search</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">
          Tidak ada transaksi yang cocok dengan filter
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">
          Silakan periksa kata kunci pencarian, ubah opsi filter dompet, atau atur ulang opsi filter Anda.
        </p>
        <button class="h-10 px-5 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:opacity-90 transition-all flex items-center gap-2 cursor-pointer" id="btn-empty-reset" type="button">
          <span class="material-symbols-outlined text-[18px]">filter_alt_off</span>
          <span>Bersihkan Filter &amp; Tampilkan Semua</span>
        </button>
      </div>

      <!-- Table Footer Summary -->
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-4 bg-surface-container-low select-none">
        <div class="flex items-center gap-2">
          <span class="font-label-md text-label-md text-on-surface-variant">
            Total tercatat: <strong class="text-on-surface">{{ $transactions->count() }}</strong> transaksi
          </span>
        </div>
      </div>
    @endif
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
          Pastikan seluruh pendapatan dan penerimaan uang dicatat secara berkala ke dompet yang bersangkutan agar saldo buku kas tetap akurat dan seimbang.
        </p>
      </div>
    </div>
    <a href="{{ route('wallets.index') }}" class="h-10 px-4 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center gap-2 whitespace-nowrap transition-colors">
      <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
      <span>Cek Saldo Dompet</span>
    </a>
  </div>
</div>

<!-- Interactive Modal for '+ Catat Pemasukan Baru' -->
<div class="fixed inset-0 bg-on-surface/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200" id="modal-backdrop">
  <div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl shadow-xl overflow-hidden transform scale-95 transition-transform duration-200" id="modal-card">
    <!-- Modal Header -->
    <div class="p-6 bg-surface-container-low flex items-center justify-between border-b border-surface-container">
      <div>
        <h3 class="font-headline-md text-headline-md text-on-surface font-bold">Catat Pemasukan Baru</h3>
        <p class="font-body-sm text-body-sm text-on-surface-variant">Tambahkan saldo kas masuk ke salah satu dompet Anda</p>
      </div>
      <button class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors cursor-pointer" onclick="closeModal()" type="button">
        <span class="material-symbols-outlined text-[20px]">close</span>
      </button>
    </div>

    <!-- Modal Body -->
    <form class="p-6 space-y-4" id="add-tx-form" method="POST" action="{{ route('transactions.store') }}">
      @csrf
      <input type="hidden" name="type" value="income" id="tx-type-input">

      @if($errors->any())
        <div class="p-3 rounded-xl bg-error-container text-on-error-container text-body-sm space-y-1">
          @foreach($errors->all() as $error)
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px] text-error">error</span>
              <span>{{ $error }}</span>
            </div>
          @endforeach
        </div>
      @endif

      <!-- Segmented Type Selector -->
      <div>
        <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-2">Jenis Mutasi</label>
        <div class="grid grid-cols-3 gap-2 bg-surface-container-low p-1.5 rounded-xl">
          <button class="tx-type-toggle py-2 rounded-lg bg-surface-container-lowest text-secondary font-label-md text-label-md font-bold shadow-sm text-center flex items-center justify-center gap-1 cursor-default" type="button">
            <span class="material-symbols-outlined text-[16px]">add_circle</span> Pemasukan
          </button>
          <button class="tx-type-toggle py-2 rounded-lg text-on-surface-variant font-label-md text-label-md text-center flex items-center justify-center gap-1 opacity-50 cursor-not-allowed" type="button" disabled title="Pengeluaran belum aktif">
            <span class="material-symbols-outlined text-[16px]">remove_circle</span> Pengeluaran
          </button>
          <button class="tx-type-toggle py-2 rounded-lg text-on-surface-variant font-label-md text-label-md text-center flex items-center justify-center gap-1 opacity-50 cursor-not-allowed" type="button" disabled title="Transfer belum aktif">
            <span class="material-symbols-outlined text-[16px]">swap_horiz</span> Transfer
          </button>
        </div>
      </div>

      <!-- Nominal Input -->
      <div>
        <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Nominal Pemasukan (Rupiah) <span class="text-error">*</span></label>
        <div class="relative flex items-center">
          <span class="absolute left-4 font-headline-md text-headline-md text-on-surface-variant font-bold pointer-events-none">Rp</span>
          <input class="w-full h-14 pl-14 pr-4 rounded-xl bg-surface-container-low text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary border border-surface-container" 
                 id="modal-amount-input" name="amount" value="{{ old('amount') }}" placeholder="0" min="1" step="any" required type="number"/>
        </div>
        <!-- Quick Denomination Preset Chips -->
        <div class="mt-2">
          <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Pecahan Cepat:</span>
          <div class="flex flex-wrap gap-1.5">
            <button type="button" onclick="addAmountToInput('modal-amount-input', 1000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+1.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 2000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+2.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 5000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+5.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 10000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+10.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 20000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+20.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 50000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+50.000</button>
            <button type="button" onclick="addAmountToInput('modal-amount-input', 100000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+100.000</button>
            <button type="button" onclick="resetInputAmount('modal-amount-input')" class="px-2.5 py-1 rounded-lg bg-error-container hover:bg-error-container/80 text-error font-label-sm text-label-sm transition-colors cursor-pointer">Reset</button>
          </div>
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Deskripsi / Sumber Pemasukan <span class="text-error">*</span></label>
        <input class="w-full h-11 px-4 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary border border-surface-container" 
               name="description" value="{{ old('description') }}" placeholder="Contoh: Gaji Bulanan - Gaji Pertama | Transfer Bank" required type="text"/>
        <p class="font-label-sm text-label-sm text-on-surface-variant mt-1.5">Format: <span class="text-on-surface font-medium">Judul - Keterangan | Tag Label</span> (Contoh: <span class="text-secondary font-medium">Gaji Bulanan - Gaji Pertama | Transfer Bank</span>)</p>
      </div>

      <!-- Wallet Selection -->
      <div>
        <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Dompet Tujuan Pemasukan <span class="text-error">*</span></label>
        @if($wallets->isEmpty())
          <div class="p-3 rounded-xl bg-error-container text-on-error-container text-body-sm flex items-center justify-between">
            <span>Anda belum memiliki dompet. Buat dompet terlebih dahulu!</span>
            <a href="{{ route('wallets.index') }}" class="font-bold underline ml-2">Buka Wallets</a>
          </div>
        @else
          <select name="wallet_id" required class="w-full h-11 px-3 rounded-xl bg-surface-container-low text-on-surface font-label-lg text-label-lg focus:outline-none focus:ring-2 focus:ring-primary border border-surface-container cursor-pointer">
            <option value="" disabled {{ old('wallet_id') ? '' : 'selected' }}>Pilih Dompet Penerima</option>
            @foreach($wallets as $wallet)
              <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>
                {{ $wallet->name }} (Saldo: Rp{{ number_format($wallet->current_balance ?? $wallet->initial_balance, 0, ',', '.') }})
              </option>
            @endforeach
          </select>
        @endif
      </div>

      <!-- Date -->
      <div>
        <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Tanggal Transaksi <span class="text-error">*</span></label>
        <input class="w-full h-11 px-4 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md focus:outline-none focus:ring-2 focus:ring-primary border border-surface-container" 
               name="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" required type="date"/>
      </div>

      <!-- Actions -->
      <div class="pt-3 flex items-center justify-end gap-3 border-t border-surface-container">
        <button class="h-11 px-5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors cursor-pointer" onclick="closeModal()" type="button">
          Batal
        </button>
        <button class="h-11 px-6 rounded-xl bg-primary text-on-primary hover:opacity-90 font-label-lg text-label-lg font-bold shadow-md transition-opacity cursor-pointer" type="submit" {{ $wallets->isEmpty() ? 'disabled' : '' }}>
          Simpan Pemasukan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Toast Notifications -->
@if(session('success'))
  <div class="fixed bottom-20 lg:bottom-6 right-6 z-50 flex items-center gap-space-sm px-space-md py-3 rounded-xl bg-primary-container text-on-primary shadow-xl transition-all duration-300" id="toast-notification">
    <div class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center shrink-0">
      <span class="material-symbols-outlined text-on-secondary text-[16px]">check</span>
    </div>
    <div class="flex flex-col text-left">
      <span class="font-label-md text-label-md font-semibold text-on-primary">Sukses</span>
      <span class="font-body-sm text-body-sm text-primary-fixed-dim">{{ session('success') }}</span>
    </div>
    <button class="ml-2 text-primary-fixed-dim hover:text-on-primary cursor-pointer" onclick="document.getElementById('toast-notification').remove()" type="button">
      <span class="material-symbols-outlined text-[18px]">close</span>
    </button>
  </div>
@endif

@if(session('error'))
  <div class="fixed bottom-20 lg:bottom-6 right-6 z-50 flex items-center gap-space-sm px-space-md py-3 rounded-xl bg-error-container text-on-error-container shadow-xl transition-all duration-300" id="toast-notification-error">
    <div class="w-6 h-6 rounded-full bg-error flex items-center justify-center shrink-0">
      <span class="material-symbols-outlined text-on-error text-[16px]">priority_high</span>
    </div>
    <div class="flex flex-col text-left">
      <span class="font-label-md text-label-md font-semibold text-error">Gagal</span>
      <span class="font-body-sm text-body-sm text-on-error-container">{{ session('error') }}</span>
    </div>
    <button class="ml-2 text-on-error-container hover:text-error cursor-pointer" onclick="document.getElementById('toast-notification-error').remove()" type="button">
      <span class="material-symbols-outlined text-[18px]">close</span>
    </button>
  </div>
@endif

<!-- Client-side Interactive Filter & Modal Management Script -->
<script>
  function addAmountToInput(inputId, val) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const current = parseFloat(input.value) || 0;
    input.value = current + val;
  }

  function resetInputAmount(inputId) {
    const input = document.getElementById(inputId);
    if (input) input.value = '';
  }

  const modalBackdrop = document.getElementById('modal-backdrop');
  const modalCard = document.getElementById('modal-card');

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

  if (modalBackdrop) {
    modalBackdrop.addEventListener('click', (e) => {
      if (e.target === modalBackdrop) closeModal();
    });
  }

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
      const selectedType = filterType ? filterType.value : 'all';
      const selectedWallet = filterWallet ? filterWallet.value : 'all';

      let visibleCount = 0;

      rows.forEach(row => {
        const desc = (row.dataset.desc || '').toLowerCase();
        const type = row.dataset.type;
        const wallet = row.dataset.wallet;

        const matchesQuery = !query || desc.includes(query);
        const matchesType = selectedType === 'all' || type === selectedType;
        const matchesWallet = selectedWallet === 'all' || wallet === selectedWallet;

        if (matchesQuery && matchesType && matchesWallet) {
          row.classList.remove('hidden');
          visibleCount++;
        } else {
          row.classList.add('hidden');
        }
      });

      if (emptyState) {
        if (visibleCount === 0 && rows.length > 0) {
          emptyState.classList.remove('hidden');
          emptyState.classList.add('flex');
        } else {
          emptyState.classList.add('hidden');
          emptyState.classList.remove('flex');
        }
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
  })();

  @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
      openModal();
    });
  @endif
</script>
@endsection
