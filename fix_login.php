<?php
$content = file_get_contents('resources/views/auth/login.blade.php');

// Replace form tag
$formStr = '<form class="flex flex-col gap-4 w-full" id="loginForm" onsubmit="event.preventDefault(); handleAuthSubmit();">';
$newFormStr = '
    @if($errors->any())
        <div class="mb-4 bg-error-container text-on-error-container p-3 rounded-lg text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="flex flex-col gap-4 w-full" id="loginForm" method="POST" action="{{ route(\'login\') }}">
        @csrf
';

$content = str_replace($formStr, $newFormStr, $content);

// Add name attribute and update value for email
$content = preg_replace(
    '/<input([^>]*?)id="emailInput"([^>]*?)value="ahmad@example\.com"\/>/',
    '<input$1id="emailInput"$2name="email" value="{{ old(\'email\', \'owner@moneyman.com\') }}"/>',
    $content
);

// Add name attribute and remove value for password
$content = preg_replace(
    '/<input([^>]*?)id="passwordInput"([^>]*?)value="[^"]*"\/>/',
    '<input$1id="passwordInput"$2name="password"/>',
    $content
);

// Remove handleAuthSubmit script
$content = preg_replace('/function handleAuthSubmit\(\) \{[\s\S]*?\}(?=\s*<\/script>)/', '', $content);

file_put_contents('resources/views/auth/login.blade.php', $content);
echo "Login blade updated.";
?>
