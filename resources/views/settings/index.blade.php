@extends('layouts.app')

@section('content')

<div class="w-full max-w-7xl mx-auto space-y-6 pt-4">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Settings</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Pengaturan akun dan aplikasi</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
        <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
            <div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant mb-4">
                <span class="material-symbols-outlined text-[32px]">construction</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-1">
                Dalam Pengembangan
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">
                Halaman pengaturan sedang dalam tahap konstruksi UI.
            </p>
        </div>
    </div>
</div>
@endsection