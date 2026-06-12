<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Default Mailer: " . config('mail.default') . "\n";
echo "SMTP Host: " . config('mail.mailers.smtp.host') . "\n";
echo "SMTP Port: " . config('mail.mailers.smtp.port') . "\n";
echo "SMTP Username: " . config('mail.mailers.smtp.username') . "\n";
echo "SMTP Encryption: " . config('mail.mailers.smtp.encryption') . "\n"; // Let's check if encryption is defined here

// Create a dummy user
$user = new \App\Models\User([
    'name' => 'Pembeli Klinik Ikan',
    'email' => 'asterixaether6@gmail.com' // We send to our test email
]);

try {
    Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
    echo "WelcomeMail sent successfully!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
