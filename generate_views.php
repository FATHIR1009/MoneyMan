<?php

$stitchDir = "stitch_mandiri_digital_finance_web_app";
$viewsDir = "resources/views";
$layoutsDir = $viewsDir . "/layouts";

if (!is_dir($layoutsDir)) mkdir($layoutsDir, 0755, true);
if (!is_dir($viewsDir . "/wallets")) mkdir($viewsDir . "/wallets", 0755, true);
if (!is_dir($viewsDir . "/transactions")) mkdir($viewsDir . "/transactions", 0755, true);
if (!is_dir($viewsDir . "/settings")) mkdir($viewsDir . "/settings", 0755, true);
if (!is_dir($viewsDir . "/auth")) mkdir($viewsDir . "/auth", 0755, true);

function getInnerContent($html) {
    // Find the start of the content inside <main ...><div class="flex flex-col w-full">
    $startToken = '<div class="flex flex-col w-full">';
    $startPos = strpos($html, $startToken);
    
    // Find the end of <main>
    $endToken = '</main>';
    $endPos = strpos($html, $endToken, $startPos);
    
    if ($startPos !== false && $endPos !== false) {
        // Extract everything between the start token and the end of the div
        $content = substr($html, $startPos + strlen($startToken), $endPos - ($startPos + strlen($startToken)));
        // Remove the closing </div> of the flex flex-col w-full if it's the last thing before </main>
        // But there might be <script> tags before </main>. Let's just find the last </div> before <script> or </main>
        
        // Simpler approach: Split by <div class="flex flex-col w-full"> and </main>
        $parts = explode('<div class="flex flex-col w-full">', $html);
        if(count($parts) > 1) {
             $afterStart = $parts[1];
             $subParts = explode('</main>', $afterStart);
             $content = $subParts[0];
             // The content ends with a </div>. Let's remove the last </div>
             $content = preg_replace('/<\/div>\s*$/', '', $content);
             return trim($content);
        }
    }
    return "";
}

// 1. Layout
$dashHtml = file_get_contents("$stitchDir/dashboard_pengelolaan_uang_digital_mandiri/code.html");

// Extract layout parts
$headStart = 0;
$mainStart = strpos($dashHtml, '<div class="flex flex-col w-full">');
$mainEnd = strpos($dashHtml, '</main>');

$layoutTop = substr($dashHtml, 0, $mainStart + strlen('<div class="flex flex-col w-full">'));
$layoutBottom = substr($dashHtml, $mainEnd);

// Replace active classes in sidebar dynamically
$layoutTop = str_replace('aria-current="page" class="flex items-center gap-space-sm px-space-md py-2.5 transition-colors bg-primary-container text-on-primary font-semibold rounded-xl"', 'class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors"', $layoutTop);
$layoutBottom = str_replace('aria-current="page" class="flex flex-col items-center justify-center py-1 text-primary font-bold"', 'class="flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1"', $layoutBottom);

$layoutTop = str_replace('<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" data-path="dashboard"', '<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl {{ request()->routeIs(\'dashboard\') ? \'bg-primary-container text-on-primary font-semibold\' : \'font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors\' }}" data-path="dashboard"', $layoutTop);
$layoutTop = str_replace('<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" data-path="wallets"', '<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl {{ request()->routeIs(\'wallets.*\') ? \'bg-primary-container text-on-primary font-semibold\' : \'font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors\' }}" data-path="wallets"', $layoutTop);
$layoutTop = str_replace('<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" data-path="transactions"', '<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl {{ request()->routeIs(\'transactions.*\') ? \'bg-primary-container text-on-primary font-semibold\' : \'font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors\' }}" data-path="transactions"', $layoutTop);
$layoutTop = str_replace('<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" data-path="settings"', '<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl {{ request()->routeIs(\'settings.*\') ? \'bg-primary-container text-on-primary font-semibold\' : \'font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors\' }}" data-path="settings"', $layoutTop);
$layoutTop = str_replace('href="#"', 'href="{{ route(\'dashboard\') }}"', $layoutTop); // Hacky replace for href, we will fix later

$layout = $layoutTop . "\n@yield('content')\n</div>" . $layoutBottom;
file_put_contents("$layoutsDir/app.blade.php", $layout);

// 2. Login
$loginHtml = file_get_contents("$stitchDir/login_pengelolaan_uang_digital_mandiri/code.html");
file_put_contents("$viewsDir/auth/login.blade.php", $loginHtml);

// 3. Dashboard
$dashContent = getInnerContent($dashHtml);
file_put_contents("$viewsDir/dashboard.blade.php", "@extends('layouts.app')\n\n@section('content')\n" . $dashContent . "\n@endsection");

// 4. Wallets
$walletHtml = file_get_contents("$stitchDir/wallets_pengelolaan_uang_digital_mandiri/code.html");
$walletContent = getInnerContent($walletHtml);
file_put_contents("$viewsDir/wallets/index.blade.php", "@extends('layouts.app')\n\n@section('content')\n" . $walletContent . "\n@endsection");

// 5. Transactions
$txHtml = file_get_contents("$stitchDir/transactions_pengelolaan_uang_digital_mandiri/code.html");
$txContent = getInnerContent($txHtml);
file_put_contents("$viewsDir/transactions/index.blade.php", "@extends('layouts.app')\n\n@section('content')\n" . $txContent . "\n@endsection");

// 6. Settings (No Stitch provided specifically for settings? Let's check if there is one. If not, use an empty state or basic structure)
$settingsContent = '
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
</div>';
file_put_contents("$viewsDir/settings/index.blade.php", "@extends('layouts.app')\n\n@section('content')\n" . $settingsContent . "\n@endsection");

echo "Views generated successfully.";

?>
