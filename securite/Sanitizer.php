<?php

require_once __DIR__ . '/../config/database.php';

function securite_sanitize($data): string {
    $conn = getDbConnection();
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}