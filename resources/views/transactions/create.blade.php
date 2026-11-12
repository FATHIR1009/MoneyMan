@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto space-y-6 pt-4">
    <div class="flex items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
                    Modul Pemasukan
                </span>
                <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">· Kas Masuk</span>
            </div>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Catat Pemasukan Baru</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Tambahkan catatan penerimaan saldo ke dompet Anda secara teliti</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors cursor-pointer" title="Kembali ke Riwayat">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden">
        <form class="p-6 space-y-6" id="add-tx-form" method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <input type="hidden" name="type" value="income">

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
                        <span class="material-symbols-outlined text-[16px]">sync_alt</span> Transfer
                    </button>
                </div>
            </div>

            <!-- Amount -->
            <div>
                <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Nominal Pemasukan (Rupiah) <span class="text-error">*</span></label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 font-headline-md text-headline-md text-on-surface-variant font-bold pointer-events-none">Rp</span>
                    <input class="w-full h-14 pl-14 pr-4 rounded-xl bg-surface-container-low text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary border border-surface-container" 
                           id="create-amount-input" name="amount" value="{{ old('amount') }}" placeholder="0" min="1" step="any" required type="number"/>
                </div>
                <!-- Quick Denomination Preset Chips -->
                <div class="mt-2">
                    <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Pecahan Cepat:</span>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" onclick="addAmountToInput('create-amount-input', 1000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+1.000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 2000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+2.000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 5000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+5.000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 10000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+10.000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 20000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+20.000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 50000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+50000</button>
                        <button type="button" onclick="addAmountToInput('create-amount-input', 100000)" class="px-2.5 py-1 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm transition-colors cursor-pointer">+100.000</button>
                        <button type="button" onclick="resetInputAmount('create-amount-input')" class="px-2.5 py-1 rounded-lg bg-error-container hover:bg-error-container/80 text-error font-label-sm text-label-sm transition-colors cursor-pointer">Reset</button>
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

            <!-- Wallet -->
            <div>
                <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Dompet Tujuan Pemasukan <span class="text-error">*</span></label>
                @if($wallets->isEmpty())
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container text-body-sm flex items-center justify-between">
                        <span>Anda belum memiliki dompet. Buat dompet terlebih dahulu sebelum mencatat pemasukan.</span>
                        <a href="{{ route('wallets.index') }}" class="font-bold underline ml-2">Kelola Dompet</a>
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
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-surface-container">
                <a href="{{ route('transactions.index') }}" class="h-11 px-5 flex items-center rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors cursor-pointer">
                    Batal
                </a>
                <button class="h-11 px-6 rounded-xl bg-primary text-on-primary hover:opacity-90 font-label-lg text-label-lg font-bold shadow-md transition-opacity cursor-pointer" type="submit" {{ $wallets->isEmpty() ? 'disabled' : '' }}>
                    Simpan Pemasukan
                </button>
            </div>
        </form>
    </div>
</div>

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
</script>
@endsection
