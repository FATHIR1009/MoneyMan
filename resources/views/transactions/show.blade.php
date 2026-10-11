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