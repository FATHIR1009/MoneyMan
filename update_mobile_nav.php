<?php

$layoutContent = file_get_contents("resources/views/layouts/app.blade.php");

$layoutContent = preg_replace(
    '/<a class="flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1" data-path="dashboard" href="#">/',
    '<a class="{{ request()->routeIs(\'dashboard\') ? \'flex flex-col items-center justify-center py-1 text-primary font-bold\' : \'flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1\' }}" data-path="dashboard" href="{{ route(\'dashboard\') }}">',
    $layoutContent
);
$layoutContent = preg_replace(
    '/<a class="flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1" data-path="wallets" href="#">/',
    '<a class="{{ request()->routeIs(\'wallets.*\') ? \'flex flex-col items-center justify-center py-1 text-primary font-bold\' : \'flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1\' }}" data-path="wallets" href="{{ route(\'wallets.index\') }}">',
    $layoutContent
);
$layoutContent = preg_replace(
    '/<a class="flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1" data-path="transactions" href="#">/',
    '<a class="{{ request()->routeIs(\'transactions.*\') ? \'flex flex-col items-center justify-center py-1 text-primary font-bold\' : \'flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1\' }}" data-path="transactions" href="{{ route(\'transactions.index\') }}">',
    $layoutContent
);
$layoutContent = preg_replace(
    '/<a class="flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1" data-path="settings" href="#">/',
    '<a class="{{ request()->routeIs(\'settings.*\') ? \'flex flex-col items-center justify-center py-1 text-primary font-bold\' : \'flex flex-col items-center justify-center text-on-surface-variant font-label-sm text-label-sm py-1\' }}" data-path="settings" href="{{ route(\'settings.index\') }}">',
    $layoutContent
);

file_put_contents("resources/views/layouts/app.blade.php", $layoutContent);
echo "Mobile nav updated.";

?>
