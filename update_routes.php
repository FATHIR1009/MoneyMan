<?php

$routesContent = file_get_contents("routes/web.php");
$newRoutes = <<<'EOD'
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/wallets', function () {
        return view('wallets.index');
    })->name('wallets.index');

    Route::get('/transactions', function () {
        return view('transactions.index');
    })->name('transactions.index');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
EOD;

$routesContent = preg_replace('/Route::get\(\'\/dashboard\', function \(\) \{[\s\S]*?\}\)->name\(\'dashboard\'\);/', $newRoutes, $routesContent);
file_put_contents("routes/web.php", $routesContent);

$layoutContent = file_get_contents("resources/views/layouts/app.blade.php");
// Fix the generic replace of href="#"
$layoutContent = str_replace('data-path="dashboard" href="{{ route(\'dashboard\') }}"', 'data-path="dashboard" href="{{ route(\'dashboard\') }}"', $layoutContent);
$layoutContent = str_replace('data-path="wallets" href="{{ route(\'dashboard\') }}"', 'data-path="wallets" href="{{ route(\'wallets.index\') }}"', $layoutContent);
$layoutContent = str_replace('data-path="transactions" href="{{ route(\'dashboard\') }}"', 'data-path="transactions" href="{{ route(\'transactions.index\') }}"', $layoutContent);
$layoutContent = str_replace('data-path="settings" href="{{ route(\'dashboard\') }}"', 'data-path="settings" href="{{ route(\'settings.index\') }}"', $layoutContent);

// Fix logout (assuming there is a logout button with href="#")
$layoutContent = preg_replace('/<a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-error hover:bg-error-container hover:text-on-error-container transition-colors" data-path="logout" href="[^"]+"/', '<form action="{{ route(\'logout\') }}" method="POST" class="w-full">@csrf<button type="submit" class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl font-label-lg text-label-lg text-error hover:bg-error-container hover:text-on-error-container transition-colors w-full" data-path="logout"', $layoutContent);
$layoutContent = preg_replace('/<\/span><span>Logout<\/span><\/a>/', '</span><span>Logout</span></button></form>', $layoutContent);

file_put_contents("resources/views/layouts/app.blade.php", $layoutContent);
echo "Routes and Layout updated.";

?>
