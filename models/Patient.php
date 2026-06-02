<?php

require_once __DIR__ . '/../config/database.php';

function patient_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM patient WHERE id_patient = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();
    return $patient ?: null;
}

function patient_createFromUser(int $userId, string $nom, string $prenom, string $email, string $telephone): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO patient (id_patient, nom, prenom, email, telephone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $userId, $nom, $prenom, $email, $telephone);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function patient_create(array $data): int {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO patient (nom, prenom, date_naissance, sexe, adresse, telephone, email, dossier_medical) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $data['nom'], $data['prenom'], $data['date_naissance'], $data['sexe'], $data['adresse'], $data['telephone'], $data['email'], $data['dossier_medical']);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

function patient_update(int $id, array $data): bool {
    $conn = getDbConnection();
    $fields = [];
    $types = "";
    $values = [];
    foreach (['nom', 'prenom', 'date_naissance', 'sexe', 'adresse', 'telephone', 'email', 'dossier_medical'] as $field) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $types .= "s";
            $values[] = $data[$field];
        }
    }
    if (empty($fields)) return false;
    $types .= "i";
    $values[] = $id;
    $sql = "UPDATE patient SET " . implode(", ", $fields) . " WHERE id_patient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function patient_findByEmail(string $email): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT id_patient FROM patient WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();
    return $patient ?: null;
}

function patient_getDoctors(int $patientId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT DISTINCT m.id_medecin, m.nom, m.prenom, m.spécialité
        FROM traitement t
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE t.id_patient = ?
        ORDER BY m.prenom, m.nom
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctors = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $doctors;
}

function patient_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM patient ORDER BY nom, prenom");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function patient_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM patient WHERE id_patient = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
