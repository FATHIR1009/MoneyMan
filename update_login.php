<?php
$loginContent = file_get_contents("resources/views/auth/login.blade.php");

// 1. Replace form action and method
$loginContent = preg_replace('/<form class="flex flex-col gap-4 w-full" id="auth-form">/', '<form class="flex flex-col gap-4 w-full" id="auth-form" method="POST" action="{{ route(\'login\') }}">@csrf', $loginContent);

// 2. Add name="email" to email input
$loginContent = preg_replace('/<input class="w-full bg-transparent text-on-surface font-body-md text-body-md focus:outline-none placeholder:text-on-surface-variant peer" id="email-input" placeholder="Masukkan ID akses atau email..." type="email"\/>/', '<input class="w-full bg-transparent text-on-surface font-body-md text-body-md focus:outline-none placeholder:text-on-surface-variant peer" id="email-input" name="email" placeholder="Masukkan ID akses atau email..." type="email" value="{{ old(\'email\', \'owner@example.com\') }}" required/>', $loginContent); // added default value based on DB seed info

// 3. Add name="password" to password input
$loginContent = preg_replace('/<input class="w-full bg-transparent text-on-surface font-body-md text-body-md focus:outline-none placeholder:text-on-surface-variant peer" id="password-input" placeholder="••••••••" type="password"\/>/', '<input class="w-full bg-transparent text-on-surface font-body-md text-body-md focus:outline-none placeholder:text-on-surface-variant peer" id="password-input" name="password" placeholder="••••••••" type="password" value="password" required/>', $loginContent); // dummy data is usually password

// 4. Update errors if any
$errorHtml = <<<EOD
@if (\$errors->any())
    <div class="mb-4 bg-error-container text-on-error-container p-3 rounded-lg text-sm">
        <ul>
            @foreach (\$errors->all() as \$error)
                <li>{{ \$error }}</li>
            @endforeach
        </ul>
    </div>
@endif
EOD;

$loginContent = str_replace('<div class="flex flex-col gap-4 w-full">', '<div class="flex flex-col gap-4 w-full">' . $errorHtml, $loginContent);

file_put_contents("resources/views/auth/login.blade.php", $loginContent);
echo "Login updated.";
?>
