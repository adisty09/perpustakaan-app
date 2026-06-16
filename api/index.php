<?php

// Force storage & logs to /tmp (writeable in Vercel)
putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");
putenv("LOG_CHANNEL=stderr");

// Ensure tmp storage directories exist
$storagePath = '/tmp/storage/framework';
$folders = ['views', 'sessions', 'cache'];
foreach ($folders as $folder) {
    if (!is_dir($storagePath . '/' . $folder)) {
        mkdir($storagePath . '/' . $folder, 0755, true);
    }
}

// Memuat bootstraper utama Laravel
require __DIR__ . '/../public/index.php';