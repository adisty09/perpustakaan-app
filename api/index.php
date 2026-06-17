<?php

// Force log to stderr (Vercel compatible)
putenv("LOG_CHANNEL=stderr");
putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

// Ensure tmp storage directories exist
$storagePath = '/tmp/storage/framework';
$folders = ['views', 'sessions', 'cache'];
foreach ($folders as $folder) {
    if (!is_dir($storagePath . '/' . $folder)) {
        mkdir($storagePath . '/' . $folder, 0755, true);
    }
}

require __DIR__ . '/../public/index.php';