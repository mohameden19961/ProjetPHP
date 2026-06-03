<?php

function exception_authRequired(string $message = 'Authentification requise', int $code = 401): never
{
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

function exception_forbidden(string $message = 'Accès interdit', int $code = 403): never
{
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}
