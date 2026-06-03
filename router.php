<?php

$mimeTypes = [
    'css' => 'text/css',
    'js' => 'application/javascript',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'ico' => 'image/x-icon',
    'svg' => 'image/svg+xml',
    'woff' => 'font/woff',
    'woff2' => 'font/woff2',
    'ttf' => 'font/ttf',
    'eot' => 'application/vnd.ms-fontobject',
    'map' => 'application/json',
];

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

if ($path === '/') {
    require __DIR__ . '/index.php';
    return true;
}

$publicFile = __DIR__ . '/public' . $path;

$realBase = realpath(__DIR__ . '/public');
$realFile = realpath($publicFile);
if ($realFile === false || strpos($realFile, $realBase) !== 0) {
    $rootIndex = realpath(__DIR__ . $path);
    if ($rootIndex !== false && str_starts_with($rootIndex, realpath(__DIR__))) {
        require $rootIndex;
        return true;
    }
    http_response_code(404);
    echo '404 Not Found';
    return true;
}

if (file_exists($publicFile) && !is_dir($publicFile)) {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        readfile($publicFile);
        return true;
    }
    require $publicFile;
    return true;
}

http_response_code(404);
echo '404 Not Found';
