<?php

function exception_dbError(string $message = 'Erreur de base de données', int $code = 500): never
{
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}
