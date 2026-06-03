<?php

require_once __DIR__ . '/../securite/Sanitizer.php';
require_once __DIR__ . '/../exception/_require.php';

function getDbConnection(): mysqli {
    static $conn = null;
    if ($conn === null) {
        $dotenvPath = __DIR__ . '/../.env';
        if (file_exists($dotenvPath)) {
            $lines = file($dotenvPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (str_starts_with(trim($line), '#')) continue;
                [$key, $value] = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }

        $host     = $_ENV['MYSQLHOST']     ?? '';
        $user     = $_ENV['MYSQLUSER']     ?? '';
        $password = $_ENV['MYSQLPASSWORD'] ?? '';
        $database = $_ENV['MYSQLDATABASE'] ?? '';
        $port     = $_ENV['MYSQLPORT']     ?? '3306';

        if (!$host || !$user || !$database) {
            exception_dbError("Fichier .env manquant ou incomplet. Copiez .env.example en .env et configurez vos accès MySQL.");
        }

        $conn = new mysqli($host, $user, $password, $database, (int)$port);
        if ($conn->connect_error) {
            exception_dbError("Connexion MySQL impossible : " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
    }
    return $conn;
}

function sanitize($data): string {
    return securite_sanitize($data);
}