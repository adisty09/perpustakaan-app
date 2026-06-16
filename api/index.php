<?php

$publicPath = __DIR__ . '/../public';

// Set Laravel public path as root
chdir($publicPath);

// Set environment variables from Vercel
if (getenv('VERCEL_ENV') === 'production') {
    putenv('APP_ENV=production');
    putenv('APP_DEBUG=false');
}

require $publicPath . '/index.php';