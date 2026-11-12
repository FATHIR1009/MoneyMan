# Frontend and UI Conventions

- **Layout Inheritance:** All authenticated views must extend `@extends('layouts.app')` and inject content via `@section('content')`.
- **Styling Architecture:** Follow the Stitch Design system using Tailwind CSS utility tokens defined in `layouts/app.blade.php`.
- **Spacing:** Use flex/grid with `gap` utilities instead of arbitrary sibling margins.
- **Empty States:** When a dataset (wallets, transactions, expenses) is empty, render an informative empty state component with guidance and an action button, rather than hiding the section or rendering broken elements.
- **Data Formatting:** Format currency with Indonesian standard `Rp{{ number_format($amount, 0, ',', '.') }}` and dates using Indonesian locale Carbon format (`l, d F Y` / `d M Y`).
