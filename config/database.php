<?php

require_once __DIR__ . '/../securite/Sanitizer.php';

function getDbConnection(): mysqli {
    static $conn = null;
    if ($conn === null) {
        $host     = $_ENV['MYSQLHOST']     ?? 'localhost';
        $user     = $_ENV['MYSQLUSER']     ?? 'supnum';
        $password = $_ENV['MYSQLPASSWORD'] ?? 'Supnum';
        $database = $_ENV['MYSQLDATABASE'] ?? 'gestion_cabinet_medical';
        $port     = $_ENV['MYSQLPORT']     ?? '3306';
        $conn = new mysqli($host, $user, $password, $database, $port);
        if ($conn->connect_error) {
            die("Erreur de connexion : " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
    }
    return $conn;
}

function sanitize($data): string {
    return securite_sanitize($data);
}