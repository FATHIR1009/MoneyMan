@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-space-lg">
  <!-- Top Action & Title Header (Distinct Contextual Page Header) -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md pt-space-xs">
    <div>
      <div class="flex items-center gap-2 mb-1">
        <span class="inline-flex items-center px-2 py-0.5 rounded-full font-label-sm text-label-sm bg-surface-container text-on-surface-variant">
          Brankas Portofolio
        </span>
        <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">· Likuiditas Riil</span>
      </div>
      <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Daftar Dompet Mandiri</h1>
      <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Kelola alokasi saldo dan jenis penyimpanan uang Anda secara terpusat</p>
    </div>
    <div class="flex items-center gap-space-sm self-start md:self-auto">
      <button class="group flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-primary-container hover:bg-inverse-surface text-on-primary font-label-lg text-label-lg shadow-sm transition-all duration-200 cursor-pointer" id="openModalBtn" onclick="openAddWalletModal()" type="button">
        <span class="material-symbols-outlined text-[18px] text-secondary-container transition-transform group-hover:rotate-90">add_circle</span>
        <span>+ Tambah Dompet Baru</span>
      </button>
    </div>
  </div>

  <!-- Top Metrics Overview Bar -->
  <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md">
    <!-- Total Saldo Metric -->
    <div class="md:col-span-7 bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
      <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-secondary/5 rounded-full pointer-events-none"></div>
      <div class="flex items-start justify-between">
        <div class="flex flex-col">
          <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Total Saldo Semua Dompet</span>
          <div class="flex items-baseline gap-2 mt-1">
            <span class="font-numerical-balance text-numerical-balance text-on-surface tracking-tight">Rp{{ number_format($totalBalance, 0, ',', '.') }}</span>
            <span class="font-label-sm text-label-sm text-secondary font-semibold bg-secondary-fixed/40 px-2 py-0.5 rounded-full">100% Likuid</span>
          </div>
        </div>
        <div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-primary-container">
          <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
        </div>
      </div>
      <div class="mt-space-md pt-space-sm flex items-center justify-between">
        <div class="flex items-center gap-2 text-on-surface-variant">
          <span class="material-symbols-outlined text-[16px] text-secondary">verified</span>
          <span class="font-body-sm text-body-sm">Terakhir sinkronisasi: Terkini</span>
        </div>
        <div class="flex items-center gap-1.5">
          <div class="w-2 h-2 rounded-full bg-secondary animate-pulse"></div>
          <span class="font-label-sm text-label-sm font-semibold text-secondary">Ledger Seimbang</span>
        </div>
      </div>
    </div>

    <!-- Dompet Aktif Breakdown Card -->
    <div class="md:col-span-5 bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm flex flex-col justify-between">
      <div class="flex items-start justify-between">
        <div class="flex flex-col">
          <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Total Dompet Aktif</span>
          <span class="font-numerical-balance text-numerical-balance text-on-surface mt-1">{{ $activeWalletsCount }} Dompet</span>
        </div>
        <div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-on-surface-variant">
          <span class="material-symbols-outlined text-[24px]">category</span>
        </div>
      </div>
      <!-- Composition bars -->
      <div class="mt-space-md space-y-2">
        <div class="flex justify-between font-label-sm text-label-sm">
          <span class="text-on-surface font-medium truncate">{{ $compositionText }}</span>
          <span class="text-on-surface-variant shrink-0">{{ $activeWalletsCount }} Akun</span>
        </div>
        <div class="w-full h-2 rounded-full bg-surface-container flex overflow-hidden">
          @if($activeWalletsCount > 0)
            @if($fisikCount > 0)
              <div class="bg-primary-container h-full" style="width: {{ ($fisikCount / $activeWalletsCount) * 100 }}%;"></div>
            @endif
            @if($digitalCount > 0)
              <div class="bg-secondary h-full" style="width: {{ ($digitalCount / $activeWalletsCount) * 100 }}%;"></div>
            @endif
            @if($bankCount > 0)
              <div class="bg-surface-container-highest h-full" style="width: {{ ($bankCount / $activeWalletsCount) * 100 }}%;"></div>
            @endif
            @if($otherCount > 0)
              <div class="bg-outline-variant h-full" style="width: {{ ($otherCount / $activeWalletsCount) * 100 }}%;"></div>
            @endif
          @else
            <div class="bg-surface-container-high h-full w-full"></div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Active Wallets Grid Section -->
  <div class="space-y-space-md">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2">
        <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Dompet Terdaftar</h2>
        <span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-semibold">{{ $activeWalletsCount }} Sumber Kas</span>
      </div>
    </div>

    @if($wallets->isEmpty())
      <!-- Empty State Component -->
      <div class="bg-surface-container-lowest rounded-2xl p-space-xl text-center flex flex-col items-center justify-center space-y-space-sm border border-dashed border-outline-variant/50 py-16">
        <div class="w-16 h-16 rounded-2xl bg-surface-container flex items-center justify-center text-primary-container mb-2">
          <span class="material-symbols-outlined text-[36px]">account_balance_wallet</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Belum Ada Dompet Terdaftar</h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
          Anda belum memiliki dompet yang terdaftar. Tambahkan dompet pertama Anda seperti Uang Tunai, E-Wallet, atau Rekening Bank untuk mulai mengelola keuangan secara terpusat.
        </p>
        <button class="mt-4 flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-primary-container hover:bg-inverse-surface text-on-primary font-label-lg text-label-lg shadow-sm transition-all duration-200 cursor-pointer" onclick="openAddWalletModal()" type="button">
          <span class="material-symbols-outlined text-[18px]">add_circle</span>
          <span>+ Tambah Dompet Pertama</span>
        </button>
      </div>
    @else
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-md">
        @foreach($wallets as $wallet)
          @php
            $typeLower = strtolower($wallet->type);
            $isCash = in_array($typeLower, ['cash', 'tunai', 'fisik']);
            $isEwallet = in_array($typeLower, ['gopay', 'ovo', 'dana', 'shopeepay', 'e-wallet', 'digital', 'ewallet']);
            $isBank = in_array($typeLower, ['bank', 'rekening']);

            $accentBarColor = $isCash ? 'bg-primary-container' : ($isEwallet ? 'bg-secondary' : ($isBank ? 'bg-surface-container-highest' : 'bg-outline-variant'));
            $icon = $isCash ? 'payments' : ($isEwallet ? 'qr_code_scanner' : ($isBank ? 'account_balance' : 'account_balance_wallet'));
            $iconBg = $isCash ? 'bg-surface-container text-primary-container' : ($isEwallet ? 'bg-secondary-fixed/50 text-secondary' : ($isBank ? 'bg-surface-container-high text-on-surface' : 'bg-surface-container text-on-surface'));
            $badgeBg = $isCash ? 'bg-surface-container text-on-surface-variant' : ($isEwallet ? 'bg-secondary-fixed text-on-secondary-fixed' : 'bg-surface-container-high text-on-surface');
          @endphp

          <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 {{ $accentBarColor }}"></div>
            <div>
              <div class="flex items-start justify-between gap-space-sm mb-space-md">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[26px]">{{ $icon }}</span>
                  </div>
                  <div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">{{ $wallet->name }}</h3>
                    <div class="flex items-center gap-1.5 mt-0.5">
                      <span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full {{ $badgeBg }} font-medium">{{ $wallet->type }}</span>
                    </div>
                  </div>
                </div>
                <!-- Action Menu: Edit & Trash with Confirmation -->
                <div class="flex items-center gap-1">
                  <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors cursor-pointer" 
                          onclick="editWallet({{ $wallet->id }}, '{{ addslashes($wallet->name) }}', '{{ addslashes($wallet->type) }}', {{ (float) $wallet->initial_balance }})" 
                          title="Edit Dompet" type="button">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                  </button>
                  <button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container hover:text-on-error-container transition-colors cursor-pointer" 
                          onclick="confirmDeleteWallet({{ $wallet->id }}, '{{ addslashes($wallet->name) }}')" 
                          title="Hapus Dompet" type="button">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                  </button>
                </div>
              </div>

              <!-- Wallet Balance Breakdown -->
              <div class="py-space-xs space-y-1">
                <span class="font-label-sm text-label-sm text-on-surface-variant block">Saldo Saat Ini</span>
                <p class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">
                  Rp{{ number_format($wallet->current_balance, 0, ',', '.') }}
                </p>
                <div class="flex items-center gap-1 text-on-surface-variant pt-0.5">
                  <span class="font-label-sm text-label-sm">Saldo Awal:</span>
                  <span class="font-label-sm text-label-sm font-semibold text-on-surface">Rp{{ number_format($wallet->initial_balance, 0, ',', '.') }}</span>
                </div>
              </div>
            </div>

            <!-- Last Transaction Block -->
            <div class="mt-space-md pt-space-sm bg-surface-container-low rounded-xl p-space-sm">
              <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Transaksi Terakhir</span>
              @if($wallet->last_transaction)
                @php
                  $tx = $wallet->last_transaction;
                  $isIncomingTransfer = ($tx->type === 'transfer' && (int) $tx->destination_wallet_id === (int) $wallet->id);
                  $isOutgoing = ($tx->type === 'expense' || ($tx->type === 'transfer' && (int) $tx->wallet_id === (int) $wallet->id));
                  $txSign = $isOutgoing ? '-' : '+';
                  $txColor = ($tx->type === 'income' || $isIncomingTransfer) ? 'text-secondary' : ($tx->type === 'expense' ? 'text-error' : 'text-on-surface');
                  $iconName = ($tx->type === 'income' || $isIncomingTransfer) ? 'arrow_downward' : ($tx->type === 'expense' ? 'arrow_upward' : 'swap_horiz');
                  $circleBg = ($tx->type === 'income' || $isIncomingTransfer) ? 'bg-secondary-fixed' : ($tx->type === 'expense' ? 'bg-error-container' : 'bg-surface-container-highest');
                  $circleIconColor = ($tx->type === 'income' || $isIncomingTransfer) ? 'text-on-secondary-fixed' : ($tx->type === 'expense' ? 'text-on-error-container' : 'text-on-surface');
                @endphp
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2 truncate pr-2">
                    <div class="w-6 h-6 rounded-full {{ $circleBg }} flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[14px] {{ $circleIconColor }}">{{ $iconName }}</span>
                    </div>
                    <span class="font-body-md text-body-md text-on-surface font-medium truncate">{{ $tx->description }}</span>
                  </div>
                  <span class="font-numerical-ledger text-numerical-ledger {{ $txColor }} shrink-0 font-bold">
                    {{ $txSign }}Rp{{ number_format($tx->amount, 0, ',', '.') }}
                  </span>
                </div>
              @else
                <div class="flex items-center gap-2 text-on-surface-variant py-0.5">
                  <span class="material-symbols-outlined text-[16px]">info</span>
                  <span class="font-body-sm text-body-sm">Belum ada transaksi terkait</span>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <!-- Expansion Recommendation Card -->
      <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm flex flex-col md:flex-row items-center justify-between gap-space-md">
        <div class="flex items-center gap-space-md">
          <div class="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-on-surface-variant shrink-0">
            <span class="material-symbols-outlined text-[32px]">add_card</span>
          </div>
          <div>
            <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Ingin menambah wadah dana baru?</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Tambahkan rekening bank atau e-wallet kedua Anda untuk memperluas pencatatan keuangan harian secara terorganisasi.</p>
          </div>
        </div>
        <button class="shrink-0 flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors cursor-pointer" onclick="openAddWalletModal()" type="button">
          <span class="material-symbols-outlined text-[18px]">add</span>
          <span>Buat Akun Tambahan</span>
        </button>
      </div>
    @endif
  </div>
</div>

<!-- MODAL CONTAINER: Tambah / Edit Dompet -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-space-md backdrop-blur-sm bg-on-surface/40 hidden opacity-0 transition-opacity duration-300" id="addWalletModal">
  <div class="w-full max-w-lg bg-surface-container-lowest rounded-2xl shadow-xl p-space-lg flex flex-col transform scale-95 transition-transform duration-300" id="modalCard">
    <!-- Modal Header -->
    <div class="flex items-center justify-between pb-space-sm border-b border-surface-container">
      <div class="flex items-center gap-2.5">
        <div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary-container">
          <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
        </div>
        <div>
          <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold" id="modalTitle">Tambah Dompet Baru</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant">Konfigurasikan wadah dana mandiri Anda</p>
        </div>
      </div>
      <button class="w-9 h-9 rounded-full flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors cursor-pointer" onclick="closeAddWalletModal()" type="button">
        <span class="material-symbols-outlined text-[20px]">close</span>
      </button>
    </div>

    <!-- Modal Form Body -->
    <form class="space-y-space-md mt-space-md" id="walletForm" method="POST" action="{{ route('wallets.store') }}">
      @csrf
      <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">

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

      <!-- Field 1: Nama Dompet -->
      <div>
        <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletName">
          Nama Dompet <span class="text-error">*</span>
        </label>
        <input class="w-full h-11 px-3.5 rounded-xl bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline-variant focus:outline-none focus:ring-2 focus:ring-primary-container transition-all border border-surface-container-high" 
               id="walletName" name="name" value="{{ old('name') }}" placeholder="Contoh: Bank Mandiri, GoPay, Tunai Dompet" required type="text"/>
        <p class="font-label-sm text-label-sm text-on-surface-variant mt-1">Gunakan nama yang mudah dikenali saat mencatat mutasi transaksi.</p>
      </div>

      <!-- Field 2: Jenis Dompet (Select dropdown) -->
      <div>
        <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletType">
          Jenis Dompet <span class="text-error">*</span>
        </label>
        <div class="relative">
          <select class="w-full h-11 px-3.5 rounded-xl bg-surface text-on-surface font-body-md text-body-md appearance-none focus:outline-none focus:ring-2 focus:ring-primary-container transition-all cursor-pointer pr-10 border border-surface-container-high" 
                  id="walletType" name="type" required>
            <option disabled {{ old('type') ? '' : 'selected' }} value="">Pilih jenis penyimpanan uang</option>
            <option value="Fisik" {{ old('type') === 'Fisik' || old('type') === 'cash' ? 'selected' : '' }}>Uang Tunai (Cash / Fisik)</option>
            <option value="E-Wallet" {{ old('type') === 'E-Wallet' || old('type') === 'ewallet' ? 'selected' : '' }}>E-Wallet (GoPay, DANA, OVO, dll)</option>
            <option value="Bank" {{ old('type') === 'Bank' || old('type') === 'bank' ? 'selected' : '' }}>Bank (Rekening Tabungan / Giro)</option>
            <option value="Lainnya" {{ old('type') === 'Lainnya' || old('type') === 'other' ? 'selected' : '' }}>Lainnya (Other / Logam Mulia / Celengan)</option>
          </select>
          <span class="material-symbols-outlined text-[20px] text-on-surface-variant absolute right-3 top-3 pointer-events-none">
            expand_more
          </span>
        </div>
      </div>

      <!-- Field 3: Saldo Awal -->
      <div>
        <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletBalance">
          Saldo Awal (Initial Balance) <span class="text-error">*</span>
        </label>
        <div class="relative flex items-center">
          <div class="absolute left-3.5 pointer-events-none font-headline-sm text-headline-sm text-on-surface-variant font-bold">
            Rp
          </div>
          <input class="w-full h-12 pl-12 pr-4 rounded-xl bg-surface text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary-container transition-all border border-surface-container-high" 
                 id="walletBalance" name="initial_balance" min="0" step="any" value="{{ old('initial_balance', 0) }}" placeholder="0" required type="number"/>
        </div>
        <div class="flex items-center gap-1.5 mt-1.5 text-on-secondary-container">
          <span class="material-symbols-outlined text-[14px]">info</span>
          <span class="font-label-sm text-label-sm">Saldo awal akan langsung dicatat sebagai alokasi dasar dompet.</span>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-space-sm pt-space-xs mt-space-md">
        <button class="px-5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors cursor-pointer" onclick="closeAddWalletModal()" type="button">
          Batal
        </button>
        <button class="px-6 py-2.5 rounded-xl bg-secondary text-on-secondary hover:bg-on-secondary-fixed-variant font-label-lg text-label-lg shadow-sm transition-colors flex items-center gap-2 cursor-pointer" type="submit">
          <span class="material-symbols-outlined text-[18px]">save</span>
          <span id="submitBtnText">Simpan Dompet</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- DIALOG CONFIRMATION: Hapus Dompet -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-space-md backdrop-blur-sm bg-on-surface/40 hidden opacity-0 transition-opacity duration-200" id="deleteConfirmDialog">
  <div class="w-full max-w-sm bg-surface-container-lowest rounded-2xl shadow-xl p-space-lg flex flex-col items-center text-center">
    <div class="w-12 h-12 rounded-full bg-error-container text-error flex items-center justify-center mb-space-sm">
      <span class="material-symbols-outlined text-[28px]">warning</span>
    </div>
    <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Hapus Dompet Ini?</h3>
    <p class="font-body-md text-body-md text-on-surface-variant mt-1.5" id="deleteWarningText">
      Apakah Anda yakin ingin menghapus dompet ini? Tindakan ini hanya dapat diproses jika dompet belum memiliki riwayat transaksi.
    </p>

    <form id="deleteWalletForm" method="POST" action="" class="w-full mt-space-lg">
      @csrf
      @method('DELETE')
      <div class="grid grid-cols-2 gap-space-sm w-full">
        <button class="py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors cursor-pointer" onclick="closeDeleteDialog()" type="button">
          Batal
        </button>
        <button class="py-2.5 rounded-xl bg-error text-on-error hover:bg-on-error-container font-label-lg text-label-lg transition-colors cursor-pointer" type="submit">
          Ya, Hapus
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

<!-- Client-Side Interactive Handling -->
<script>
  function openAddWalletModal() {
    const modal = document.getElementById('addWalletModal');
    const card = document.getElementById('modalCard');
    const form = document.getElementById('walletForm');

    form.reset();
    form.action = "{{ route('wallets.store') }}";
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('modalTitle').textContent = 'Tambah Dompet Baru';
    document.getElementById('submitBtnText').textContent = 'Simpan Dompet';
    document.getElementById('walletBalance').value = 0;

    modal.classList.remove('hidden');
    setTimeout(() => {
      modal.classList.remove('opacity-0');
      card.classList.remove('scale-95');
    }, 10);
  }

  function closeAddWalletModal() {
    const modal = document.getElementById('addWalletModal');
    const card = document.getElementById('modalCard');
    modal.classList.add('opacity-0');
    card.classList.add('scale-95');
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 300);
  }

  function editWallet(id, name, type, balance) {
    const modal = document.getElementById('addWalletModal');
    const card = document.getElementById('modalCard');
    const form = document.getElementById('walletForm');

    form.action = '/wallets/' + id;
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('modalTitle').textContent = 'Edit Dompet: ' + name;
    document.getElementById('submitBtnText').textContent = 'Simpan Perubahan';
    document.getElementById('walletName').value = name;
    
    // Select type in dropdown
    const typeSelect = document.getElementById('walletType');
    typeSelect.value = type;
    if (!typeSelect.value) {
      for (let i = 0; i < typeSelect.options.length; i++) {
        if (typeSelect.options[i].value.toLowerCase() === type.toLowerCase()) {
          typeSelect.selectedIndex = i;
          break;
        }
      }
    }

    document.getElementById('walletBalance').value = balance;

    modal.classList.remove('hidden');
    setTimeout(() => {
      modal.classList.remove('opacity-0');
      card.classList.remove('scale-95');
    }, 10);
  }

  function confirmDeleteWallet(walletId, walletName) {
    const dialog = document.getElementById('deleteConfirmDialog');
    const form = document.getElementById('deleteWalletForm');
    form.action = '/wallets/' + walletId;
    document.getElementById('deleteWarningText').textContent = 
      'Seluruh riwayat dan saldo dari dompet "' + walletName + '" akan dihapus secara permanen. Tindakan ini hanya diperbolehkan jika belum ada transaksi terkait.';
    dialog.classList.remove('hidden');
    setTimeout(() => {
      dialog.classList.remove('opacity-0');
    }, 10);
  }

  function closeDeleteDialog() {
    const dialog = document.getElementById('deleteConfirmDialog');
    dialog.classList.add('opacity-0');
    setTimeout(() => {
      dialog.classList.add('hidden');
    }, 200);
  }

  @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('addWalletModal');
      const card = document.getElementById('modalCard');
      modal.classList.remove('hidden');
      modal.classList.remove('opacity-0');
      card.classList.remove('scale-95');
    });
  @endif
</script>
@endsection
