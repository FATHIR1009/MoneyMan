<?php

$viewsDir = "resources/views/transactions";
$createContent = <<<'EOD'
@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto space-y-6 pt-4">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Catat Transaksi Baru</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Tambahkan catatan keuangan secara teliti</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden">
        <form class="p-6 space-y-6" id="add-tx-form">
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
                        <span class="material-symbols-outlined text-[16px]">sync_alt</span> Transfer
                    </button>
                </div>
            </div>

            <!-- Amount -->
            <div>
                <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Nominal Transaksi</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 font-headline-md text-headline-md text-on-surface-variant font-bold">Rp</span>
                    <input class="w-full h-14 pl-14 pr-4 rounded-xl bg-surface-container-low text-on-surface font-headline-md text-headline-md font-bold focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0" type="number"/>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-1">Deskripsi Singkat</label>
                <input class="w-full h-11 px-4 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Contoh: Honor Proyek, Makan Siang, dll." type="text"/>
            </div>

            <!-- Wallet and Category -->
            <div class="grid grid-cols-2 gap-4">
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
                        <option>Makanan &amp; Minuman</option>
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
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-outline-variant/30">
                <a href="{{ route('transactions.index') }}" class="h-11 px-5 flex items-center rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg transition-colors">
                    Batal
                </a>
                <button class="h-11 px-6 rounded-xl bg-primary text-on-primary hover:opacity-90 font-label-lg text-label-lg font-bold shadow-md transition-opacity" type="submit">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
EOD;

file_put_contents("$viewsDir/create.blade.php", $createContent);

$editContent = str_replace('Catat Transaksi Baru', 'Edit Transaksi', $createContent);
$editContent = str_replace('Tambahkan catatan keuangan secara teliti', 'Ubah rincian transaksi yang sudah ada', $editContent);
$editContent = str_replace('Simpan Transaksi', 'Perbarui Transaksi', $editContent);
file_put_contents("$viewsDir/edit.blade.php", $editContent);

$showContent = <<<'EOD'
@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto space-y-6 pt-4">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Rincian Transaksi</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Detail informasi mutasi keuangan</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden p-6">
        <div class="flex flex-col items-center justify-center mb-8">
            <div class="w-16 h-16 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed mb-4">
                <span class="material-symbols-outlined text-[32px]">payments</span>
            </div>
            <h2 class="font-numerical-balance text-numerical-balance text-secondary font-bold">+Rp500.000</h2>
            <p class="font-label-lg text-label-lg text-on-surface mt-1">Uang Saku</p>
            <span class="inline-flex items-center gap-1 mt-2 px-2.5 py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm">
                24 Mei 2025 • 08:30 WIB
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-outline-variant/30 pt-6">
            <div>
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Jenis Mutasi</p>
                <p class="font-body-lg text-body-lg text-on-surface font-medium">Pemasukan</p>
            </div>
            <div>
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Kategori</p>
                <p class="font-body-lg text-body-lg text-on-surface font-medium">Pemasukan Bulanan</p>
            </div>
            <div>
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Dompet Terlibat</p>
                <p class="font-body-lg text-body-lg text-on-surface font-medium">Cash</p>
            </div>
            <div>
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Status</p>
                <p class="font-body-lg text-body-lg text-secondary font-medium">Selesai</p>
            </div>
        </div>

        <div class="pt-8 flex items-center justify-end gap-3 mt-6">
            <a href="{{ route('transactions.edit', 1) }}" class="h-11 px-6 rounded-xl bg-surface-container-highest text-on-surface hover:bg-surface-container-high font-label-lg text-label-lg font-bold transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">edit</span> Edit
            </a>
            <button class="h-11 px-6 rounded-xl bg-error text-on-error hover:opacity-90 font-label-lg text-label-lg font-bold shadow-md transition-opacity flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
            </button>
        </div>
    </div>
</div>
@endsection
EOD;
file_put_contents("$viewsDir/show.blade.php", $showContent);

$routesContent = file_get_contents("routes/web.php");
$newRoutes = <<<'EOD'
    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/{id}', function ($id) {
        return view('transactions.show');
    })->name('transactions.show');

    Route::get('/transactions/{id}/edit', function ($id) {
        return view('transactions.edit');
    })->name('transactions.edit');
});
EOD;
$routesContent = str_replace('});', $newRoutes, $routesContent);
file_put_contents("routes/web.php", $routesContent);

echo "Create/Edit/Show views generated and routes added.";
?>
