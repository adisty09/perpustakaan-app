<?php

// Memaksa Laravel memindahkan folder kompilasi view ke /tmp (Wajib untuk Vercel)
$_ENV['VIEW_COMPILED_PATH'] = '/tmp';

// Memaksa Laravel menggunakan driver session berbasis cookie/array agar tidak menulis file lokal
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';

require __DIR__ . '/../public/index.php';