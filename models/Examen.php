<?php

require_once __DIR__ . '/../config/database.php';

function examen_getForPatient(int $patientId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT e.id_examen, e.date_examen AS date, e.type_examen, e.résultat AS description,
               m.prenom AS medecin_prenom, m.nom AS medecin_nom
        FROM examen e
        JOIN traitement t ON e.id_traitement = t.id_traitement
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE t.id_patient = ?
        ORDER BY e.date_examen DESC
        LIMIT 5
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $examens = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $examens;
}

function examen_create(int $idTraitement, string $typeExamen, string $resultat): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO examen (id_traitement, type_examen, résultat) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $idTraitement, $typeExamen, $resultat);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function examen_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT e.*, p.nom AS patient_nom, p.prenom AS patient_prenom,
               m.nom AS medecin_nom, m.prenom AS medecin_prenom
        FROM examen e
        JOIN traitement t ON e.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        JOIN medecin m ON t.id_medecin = m.id_medecin
        ORDER BY e.date_examen DESC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}
