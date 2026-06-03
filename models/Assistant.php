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
    $userFields = [];
    $userTypes = "";
    $userValues = [];
    foreach (['nom', 'prenom', 'email', 'telephone'] as $field) {
        if (isset($data[$field])) {
            $userFields[] = "$field = ?";
            $userTypes .= "s";
            $userValues[] = $data[$field];
        }
    }
    if (!empty($userFields)) {
        $userTypes .= "i";
        $userValues[] = $id;
        $stmt = $conn->prepare("UPDATE utilisateur SET " . implode(", ", $userFields) . " WHERE id_utilisateur = ?");
        $stmt->bind_param($userTypes, ...$userValues);
        $stmt->execute();
        $stmt->close();
    }
    if (isset($data['departement'])) {
        $stmt = $conn->prepare("UPDATE assistant SET departement = ? WHERE id_utilisateur = ?");
        $stmt->bind_param("si", $data['departement'], $id);
        $stmt->execute();
        $stmt->close();
    }
    return true;
}

function assistant_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM assistant WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
