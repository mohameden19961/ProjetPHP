<?php

require_once __DIR__ . '/../../config/app.php';

header('Content-Type: application/json');

$_METHOD = $_SERVER['REQUEST_METHOD'];
if ($_METHOD === 'POST' && isset($_POST['_method'])) {
    $_METHOD = strtoupper($_POST['_method']);
}
if ($_METHOD === 'GET' && isset($_GET['_method'])) {
    $_METHOD = strtoupper($_GET['_method']);
}

$_ID = isset($_GET['id']) ? (int)$_GET['id'] : null;

function api_error(string $msg, int $code = 400): void {
    http_response_code($code);
    echo json_encode(['error' => $msg]);
    exit;
}

function api_success(mixed $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data);
}

function api_requireId(): void {
    global $_ID;
    if (!$_ID) api_error('ID requis', 400);
}
