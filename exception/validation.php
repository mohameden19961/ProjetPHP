<?php

function exception_validationError(string $message = 'Données invalides', int $code = 400): never
{
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}
