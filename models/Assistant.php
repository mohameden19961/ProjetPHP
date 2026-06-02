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

function assistant_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT a.*, u.nom, u.prenom, u.email FROM assistant a JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur WHERE a.id_utilisateur = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $assistant = $result->fetch_assoc();
    $stmt->close();
    return $assistant ?: null;
}

function assistant_update(int $id, array $data): bool {
    $conn = getDbConnection();
    $fields = [];
    $types = "";
    $values = [];
    foreach (['nom', 'prenom', 'email', 'téléphone', 'departement'] as $field) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $types .= "s";
            $values[] = $data[$field];
        }
    }
    if (empty($fields)) return false;
    $types .= "i";
    $values[] = $id;
    $sql = "UPDATE assistant SET " . implode(", ", $fields) . " WHERE id_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function assistant_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM assistant WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
