<?php

require_once __DIR__ . '/../config/database.php';

function ordonnance_getForPatient(int $patientId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT o.id_ordonnance, o.date_ordonnance AS date, o.médicaments AS description,
               m.prenom AS medecin_prenom, m.nom AS medecin_nom
        FROM ordonnance o
        JOIN traitement t ON o.id_traitement = t.id_traitement
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE t.id_patient = ?
        ORDER BY o.date_ordonnance DESC
        LIMIT 5
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $ordonnances = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $ordonnances;
}

function ordonnance_getForMedecin(int $medecinId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT o.id_ordonnance, o.date_ordonnance, o.médicaments, p.nom, p.prenom
        FROM ordonnance o
        JOIN traitement t ON o.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        WHERE t.id_medecin = ?
        ORDER BY o.date_ordonnance DESC
    ");
    $stmt->bind_param("i", $medecinId);
    $stmt->execute();
    $result = $stmt->get_result();
    $ordonnances = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $ordonnances;
}

function ordonnance_create(int $idTraitement, string $medicaments): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO ordonnance (id_traitement, médicaments) VALUES (?, ?)");
    $stmt->bind_param("is", $idTraitement, $medicaments);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function ordonnance_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT o.*, p.nom AS patient_nom, p.prenom AS patient_prenom,
               m.nom AS medecin_nom, m.prenom AS medecin_prenom
        FROM ordonnance o
        JOIN traitement t ON o.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        JOIN medecin m ON t.id_medecin = m.id_medecin
        ORDER BY o.date_ordonnance DESC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function ordonnance_countRecent(): int {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(*) as total FROM ordonnance WHERE date_ordonnance >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
    return $result->fetch_assoc()['total'];
}
