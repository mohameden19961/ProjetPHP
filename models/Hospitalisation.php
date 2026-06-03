<?php

require_once __DIR__ . '/../config/database.php';

function hospitalisation_getForPatient(int $patientId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT h.*, m.prenom AS medecin_prenom, m.nom AS medecin_nom
        FROM hospitalisation h
        JOIN traitement t ON h.id_traitement = t.id_traitement
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE t.id_patient = ?
        ORDER BY h.date_entree DESC
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $hospitalisations = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $hospitalisations;
}

function hospitalisation_create(int $idTraitement, string $dateEntree, ?string $dateSortie, string $service): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO hospitalisation (id_traitement, date_entree, date_sortie, service) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $idTraitement, $dateEntree, $dateSortie, $service);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function hospitalisation_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM hospitalisation WHERE id_hospitalisation = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hosp = $result->fetch_assoc();
    $stmt->close();
    return $hosp ?: null;
}

function hospitalisation_update(int $id, string $dateEntree, ?string $dateSortie, string $service): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("UPDATE hospitalisation SET date_entree = ?, date_sortie = ?, service = ? WHERE id_hospitalisation = ?");
    $stmt->bind_param("sssi", $dateEntree, $dateSortie, $service, $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function hospitalisation_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM hospitalisation WHERE id_hospitalisation = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function hospitalisation_getAllActive(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT h.*, p.nom AS patient_nom, p.prenom AS patient_prenom,
               m.nom AS medecin_nom, m.prenom AS medecin_prenom
        FROM hospitalisation h
        JOIN traitement t ON h.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE h.date_sortie IS NULL OR h.date_sortie >= CURDATE()
        ORDER BY h.date_entree DESC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function hospitalisation_countActive(): int {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(DISTINCT t.id_patient) as total FROM hospitalisation h JOIN traitement t ON h.id_traitement = t.id_traitement WHERE h.date_sortie IS NULL OR h.date_sortie >= CURDATE()");
    return $result->fetch_assoc()['total'];
}
