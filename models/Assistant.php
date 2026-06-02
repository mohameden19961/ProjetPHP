<?php

require_once __DIR__ . '/../config/database.php';

function assistant_createFromUser(int $userId, string $departement): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO assistant (id_utilisateur, departement) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $departement);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function assistant_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT a.*, u.nom, u.prenom, u.email
        FROM assistant a
        JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur
        ORDER BY u.nom, u.prenom
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}
