<?php

require_once __DIR__ . '/../config/database.php';

function medecin_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM medecin WHERE id_medecin = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medecin = $result->fetch_assoc();
    $stmt->close();
    return $medecin ?: null;
}

function medecin_createFromUser(int $userId, string $nom, string $prenom, string $specialite, string $email, string $telephone): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO medecin (id_medecin, nom, prenom, spécialité, email, telephone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $userId, $nom, $prenom, $specialite, $email, $telephone);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function medecin_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM medecin ORDER BY nom, prenom");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function medecin_getPatients(int $medecinId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT DISTINCT p.id_patient, p.nom, p.prenom, p.email, p.telephone
        FROM traitement t
        JOIN patient p ON p.id_patient = t.id_patient
        WHERE t.id_medecin = ?
        ORDER BY p.prenom, p.nom
    ");
    $stmt->bind_param("i", $medecinId);
    $stmt->execute();
    $result = $stmt->get_result();
    $patients = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $patients;
}

function medecin_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM medecin WHERE id_medecin = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
