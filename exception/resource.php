<?php

function exception_notFound(string $message = 'Ressource introuvable', int $code = 404): never
{
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}
