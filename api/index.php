<?php

// Mengalihkan folder cache Laravel ke folder temporer Vercel (/tmp)
$storagePath = '/tmp/storage/framework';
if (!is_dir($storagePath . '/views')) {
    mkdir($storagePath . '/views', 0755, true);
    mkdir($storagePath . '/sessions', 0755, true);
    mkdir($storagePath . '/cache', 0755, true);
}

putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

// Memuat bootstraper utama Laravel
require __DIR__ . '/../public/index.php';