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
<button class="group flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-primary-container hover:bg-inverse-surface text-on-primary font-label-lg text-label-lg shadow-sm transition-all duration-200" id="openModalBtn" type="button">
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
<span class="font-numerical-balance text-numerical-balance text-on-surface tracking-tight">Rp500.000</span>
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
<span class="font-body-sm text-body-sm">Terakhir sinkronisasi: 2 menit yang lalu</span>
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
<span class="font-numerical-balance text-numerical-balance text-on-surface mt-1">3 Dompet</span>
</div>
<div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-on-surface-variant">
<span class="material-symbols-outlined text-[24px]">category</span>
</div>
</div>
<!-- Composition bars -->
<div class="mt-space-md space-y-2">
<div class="flex justify-between font-label-sm text-label-sm">
<span class="text-on-surface font-medium">1 Fisik (Cash) · 2 Digital (E-Wallet)</span>
<span class="text-on-surface-variant">Kapasitas 3/10</span>
</div>
<div class="w-full h-2 rounded-full bg-surface-container flex overflow-hidden">
<div class="bg-primary-container h-full" style="width: 33.3%;"></div>
<div class="bg-secondary h-full" style="width: 66.7%;"></div>
</div>
</div>
</div>
</div>
<!-- Active Wallets Grid Section -->
<div class="space-y-space-md">
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Dompet Terdaftar</h2>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-semibold">3 Sumber Kas</span>
</div>
<div class="flex items-center gap-2">
<button class="p-1.5 rounded-lg bg-surface-container-lowest hover:bg-surface-container text-on-surface-variant transition-colors shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px]">filter_list</span>
</button>
<button class="p-1.5 rounded-lg bg-surface-container-lowest hover:bg-surface-container text-on-surface-variant transition-colors shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px]">sort_by_alpha</span>
</button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-md">
<!-- CARD 1: Cash (Uang Tunai) -->
<div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
<div class="absolute top-0 left-0 right-0 h-1 bg-primary-container"></div>
<div>
<div class="flex items-start justify-between gap-space-sm mb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center text-primary-container shadow-xs">
<span class="material-symbols-outlined text-[26px]">payments</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Cash</h3>
<div class="flex items-center gap-1.5 mt-0.5">
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-medium">Uang Tunai (Cash)</span>
</div>
</div>
</div>
<!-- Action Menu: Edit & Trash with Confirmation -->
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors" onclick="editWallet('Cash', 'cash', 100000)" title="Edit Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container hover:text-on-error-container transition-colors" onclick="confirmDeleteWallet('Cash')" title="Hapus Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Current Wallet Balance -->
<div class="py-space-xs">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Saldo Saat Ini</span>
<p class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Rp100.000</p>
</div>
</div>
<!-- Last Transaction Block -->
<div class="mt-space-md pt-space-sm bg-surface-container-low rounded-xl p-space-sm">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Transaksi Terakhir</span>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2 truncate pr-2">
<div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[14px] text-on-secondary-fixed">arrow_downward</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-medium truncate">Uang Saku</span>
</div>
<span class="font-numerical-ledger text-numerical-ledger text-secondary shrink-0 font-bold">+Rp500.000</span>
</div>
</div>
</div>
<!-- CARD 2: GoPay (E-Wallet) -->
<div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
<div class="absolute top-0 left-0 right-0 h-1 bg-secondary"></div>
<div>
<div class="flex items-start justify-between gap-space-sm mb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-secondary-fixed/50 flex items-center justify-center text-secondary shadow-xs">
<span class="material-symbols-outlined text-[26px]">account_balance</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">GoPay</h3>
<div class="flex items-center gap-1.5 mt-0.5">
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-medium">E-Wallet</span>
</div>
</div>
</div>
<!-- Action Menu: Edit & Trash with Confirmation -->
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors" onclick="editWallet('GoPay', 'ewallet', 150000)" title="Edit Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container hover:text-on-error-container transition-colors" onclick="confirmDeleteWallet('GoPay')" title="Hapus Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Current Wallet Balance -->
<div class="py-space-xs">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Saldo Saat Ini</span>
<p class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Rp150.000</p>
</div>
</div>
<!-- Last Transaction Block -->
<div class="mt-space-md pt-space-sm bg-surface-container-low rounded-xl p-space-sm">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Transaksi Terakhir</span>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2 truncate pr-2">
<div class="w-6 h-6 rounded-full bg-error-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[14px] text-on-error-container">arrow_upward</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-medium truncate">Makan</span>
</div>
<span class="font-numerical-ledger text-numerical-ledger text-error shrink-0 font-bold">-Rp25.000</span>
</div>
</div>
</div>
<!-- CARD 3: DANA (E-Wallet) -->
<div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
<div class="absolute top-0 left-0 right-0 h-1 bg-surface-container-highest"></div>
<div>
<div class="flex items-start justify-between gap-space-sm mb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface shadow-xs">
<span class="material-symbols-outlined text-[26px]">account_balance_wallet</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">DANA</h3>
<div class="flex items-center gap-1.5 mt-0.5">
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-medium">E-Wallet</span>
</div>
</div>
</div>
<!-- Action Menu: Edit & Trash with Confirmation -->
<div class="flex items-center gap-1">
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors" onclick="editWallet('DANA', 'ewallet', 250000)" title="Edit Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">edit</span>
</button>
<button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container hover:text-on-error-container transition-colors" onclick="confirmDeleteWallet('DANA')" title="Hapus Dompet" type="button">
<span class="material-symbols-outlined text-[18px]">delete</span>
</button>
</div>
</div>
<!-- Current Wallet Balance -->
<div class="py-space-xs">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Saldo Saat Ini</span>
<p class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Rp250.000</p>
</div>
</div>
<!-- Last Transaction Block -->
<div class="mt-space-md pt-space-sm bg-surface-container-low rounded-xl p-space-sm">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Transaksi Terakhir</span>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2 truncate pr-2">
<div class="w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[14px] text-on-surface">swap_horiz</span>
</div>
<span class="font-body-md text-body-md text-on-surface font-medium truncate">Top Up GoPay</span>
</div>
<span class="font-numerical-ledger text-numerical-ledger text-on-surface shrink-0 font-bold">-Rp50.000</span>
</div>
</div>
</div>
</div>
</div>
<!-- Empty State / Expansion Recommendation Card -->
<div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm flex flex-col md:flex-row items-center justify-between gap-space-md">
<div class="flex items-center gap-space-md">
<div class="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-on-surface-variant shrink-0">
<span class="material-symbols-outlined text-[32px]">add_card</span>
</div>
<div>
<h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Belum ada dompet lain?</h4>
<p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Tambahkan rekening bank atau e-wallet kedua Anda untuk memperluas jangkauan pencatatan keuangan harian.</p>
</div>
</div>
<button class="shrink-0 flex items-center gap-2 px-space-md py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" onclick="openAddWalletModal()" type="button">
<span class="material-symbols-outlined text-[18px]">add</span>
<span>Buat Akun Tambahan</span>
</button>
</div>
</div>
<!-- MODAL CONTAINER: Tambah Dompet Baru -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-space-md backdrop-blur-sm bg-on-surface/40 hidden opacity-0 transition-opacity duration-300" id="addWalletModal">
<div class="w-full max-w-lg bg-surface-container-lowest rounded-2xl shadow-xl p-space-lg flex flex-col transform scale-95 transition-transform duration-300" id="modalCard">
<!-- Modal Header -->
<div class="flex items-center justify-between pb-space-sm">
<div class="flex items-center gap-2.5">
<div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary-container">
<span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold" id="modalTitle">Tambah Dompet Baru</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Konfigurasikan wadah dana mandiri baru</p>
</div>
</div>
<button class="w-9 h-9 rounded-full flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors" id="closeModalBtn" type="button">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<!-- Modal Form Body -->
<form class="space-y-space-md mt-space-md" id="walletForm" onsubmit="handleFormSubmit(event)">
<!-- Field 1: Nama Dompet -->
<div>
<label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletName">
            Nama Dompet <span class="text-error">*</span>
</label>
<input class="w-full h-11 px-3.5 rounded-xl bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline-variant focus:outline-none focus:ring-2 focus:ring-primary-container transition-all" id="walletName" placeholder="Contoh: Bank Mandiri, OVO, ShopeePay, Celengan" required="" type="text"/>
<p class="font-label-sm text-label-sm text-on-surface-variant mt-1">Gunakan nama yang mudah dikenali saat mencatat transaksi.</p>
</div>
<!-- Field 2: Jenis Dompet (Select dropdown) -->
<div>
<label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletType">
            Jenis Dompet <span class="text-error">*</span>
</label>
<div class="relative">
<select class="w-full h-11 px-3.5 rounded-xl bg-surface text-on-surface font-body-md text-body-md appearance-none focus:outline-none focus:ring-2 focus:ring-primary-container transition-all cursor-pointer pr-10" id="walletType" required="">
<option disabled="" selected="" value="">Pilih jenis penyimpanan uang</option>
<option value="cash">Uang Tunai (Cash)</option>
<option value="ewallet">E-Wallet (GoPay, DANA, OVO, dll)</option>
<option value="bank">Bank (Rekening Tabungan / Giro)</option>
<option value="other">Lainnya (Other / Logam Mulia / Celengan)</option>
</select>
<span class="material-symbols-outlined text-[20px] text-on-surface-variant absolute right-3 top-3 pointer-events-none">
              expand_more
            </span>
</div>
</div>
<!-- Field 3: Saldo Awal -->
<div>
<label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5" for="walletBalance">
            Saldo Awal (Initial Balance)
          </label>
<div class="relative flex items-center">
<div class="absolute left-3.5 pointer-events-none font-headline-sm text-headline-sm text-on-surface-variant font-bold">
              Rp
            </div>
<input class="w-full h-12 pl-12 pr-4 rounded-xl bg-surface text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary-container transition-all" id="walletBalance" min="0" placeholder="0" type="number"/>
</div>
<div class="flex items-center gap-1.5 mt-1.5 text-on-secondary-container">
<span class="material-symbols-outlined text-[14px]">info</span>
<span class="font-label-sm text-label-sm">Saldo awal akan langsung dicatat sebagai alokasi saldo dasar.</span>
</div>
</div>
<!-- Inline feedback message slot -->
<div class="hidden p-3 rounded-xl bg-secondary-fixed text-on-secondary-fixed text-body-sm font-body-sm flex items-center gap-2" id="formValidationFeedback">
<span class="material-symbols-outlined text-[18px]">check_circle</span>
<span id="feedbackText">Dompet berhasil diperbarui!</span>
</div>
<!-- Action Buttons -->
<div class="flex items-center justify-end gap-space-sm pt-space-xs mt-space-md">
<button class="px-5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" id="cancelModalBtn" type="button">
            Batal
          </button>
<button class="px-6 py-2.5 rounded-xl bg-secondary text-on-secondary hover:bg-on-secondary-fixed-variant font-label-lg text-label-lg shadow-sm transition-colors flex items-center gap-2" type="submit">
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
        Apakah Anda yakin ingin menghapus dompet ini? Tindakan ini tidak dapat dibatalkan.
      </p>
<div class="grid grid-cols-2 gap-space-sm w-full mt-space-lg">
<button class="py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors" onclick="closeDeleteDialog()" type="button">
          Batal
        </button>
<button class="py-2.5 rounded-xl bg-error text-on-error hover:bg-on-error-container font-label-lg text-label-lg transition-colors" onclick="executeDelete()" type="button">
          Ya, Hapus
        </button>
</div>
</div>
</div>
<!-- Client-Side Interactive Handling -->
<script>
    let activeDeleteTarget = null;

    function openAddWalletModal() {
      const modal = document.getElementById('addWalletModal');
      const card = document.getElementById('modalCard');
      document.getElementById('walletForm').reset();
      document.getElementById('modalTitle').textContent = 'Tambah Dompet Baru';
      document.getElementById('submitBtnText').textContent = 'Simpan Dompet';
      document.getElementById('formValidationFeedback').classList.add('hidden');
      
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

    function editWallet(name, type, balance) {
      openAddWalletModal();
      document.getElementById('modalTitle').textContent = 'Edit Dompet: ' + name;
      document.getElementById('submitBtnText').textContent = 'Simpan Perubahan';
      document.getElementById('walletName').value = name;
      document.getElementById('walletType').value = type;
      document.getElementById('walletBalance').value = balance;
    }

    function confirmDeleteWallet(walletName) {
      activeDeleteTarget = walletName;
      const dialog = document.getElementById('deleteConfirmDialog');
      document.getElementById('deleteWarningText').textContent = 
        'Seluruh riwayat dan saldo dari dompet "' + walletName + '" tidak akan diperhitungkan dalam total saldo kas.';
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
        activeDeleteTarget = null;
      }, 200);
    }

    function executeDelete() {
      closeDeleteDialog();
      // Optional subtle notification simulation
    }

    function handleFormSubmit(e) {
      e.preventDefault();
      const feedback = document.getElementById('formValidationFeedback');
      const feedbackText = document.getElementById('feedbackText');
      feedbackText.textContent = 'Data dompet berhasil disimpan ke kas mandiri!';
      feedback.classList.remove('hidden');
      setTimeout(() => {
        closeAddWalletModal();
      }, 800);
    }

    document.getElementById('openModalBtn').addEventListener('click', openAddWalletModal);
    document.getElementById('closeModalBtn').addEventListener('click', closeAddWalletModal);
    document.getElementById('cancelModalBtn').addEventListener('click', closeAddWalletModal);
  </script>
@endsection