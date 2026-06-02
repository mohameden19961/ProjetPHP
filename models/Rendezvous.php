<?php

require_once __DIR__ . '/../config/database.php';

function rdv_getUpcomingForPatient(int $patientId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT r.id_rdv, r.date_rdv, r.heure, r.motif, r.lieu, r.statut,
               m.prenom AS medecin_prenom, m.nom AS medecin_nom
        FROM rendezvous r
        JOIN traitement t ON r.id_traitement = t.id_traitement
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE t.id_patient = ? AND r.date_rdv >= CURDATE() AND r.statut != 'annule'
        ORDER BY r.date_rdv ASC, r.heure ASC
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $rdvs = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rdvs;
}

function rdv_getUpcomingForMedecin(int $medecinId): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("
        SELECT r.id_rdv, r.date_rdv, r.heure, r.lieu, r.motif, p.nom, p.prenom, r.statut, p.id_patient
        FROM rendezvous r
        JOIN traitement t ON r.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        WHERE t.id_medecin = ? AND r.date_rdv >= CURDATE() AND r.statut != 'annule'
        ORDER BY r.date_rdv ASC, r.heure ASC
    ");
    $stmt->bind_param("i", $medecinId);
    $stmt->execute();
    $result = $stmt->get_result();
    $rdvs = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rdvs;
}

function rdv_getUpcomingForAssistant(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT r.id_rdv, r.date_rdv, r.heure, r.motif, r.lieu, r.statut,
               p.nom AS patient_nom, p.prenom AS patient_prenom,
               m.nom AS medecin_nom, m.prenom AS medecin_prenom
        FROM rendezvous r
        JOIN traitement t ON r.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        JOIN medecin m ON t.id_medecin = m.id_medecin
        WHERE r.date_rdv >= CURDATE()
        ORDER BY r.date_rdv ASC, r.heure ASC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function rdv_create(int $idTraitement, string $date, string $heure, string $lieu, string $motif): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO rendezvous (id_traitement, date_rdv, heure, lieu, motif) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $idTraitement, $date, $heure, $lieu, $motif);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function rdv_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM rendezvous WHERE id_rdv = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rdv = $result->fetch_assoc();
    $stmt->close();
    return $rdv ?: null;
}

function rdv_updateStatus(int $id, string $statut): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("UPDATE rendezvous SET statut = ? WHERE id_rdv = ?");
    $stmt->bind_param("si", $statut, $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function rdv_update(int $id, string $date, string $heure, string $lieu, string $motif): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("UPDATE rendezvous SET date_rdv = ?, heure = ?, lieu = ?, motif = ? WHERE id_rdv = ?");
    $stmt->bind_param("ssssi", $date, $heure, $lieu, $motif, $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function rdv_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT r.*, p.nom AS patient_nom, p.prenom AS patient_prenom,
               m.nom AS medecin_nom, m.prenom AS medecin_prenom
        FROM rendezvous r
        JOIN traitement t ON r.id_traitement = t.id_traitement
        JOIN patient p ON t.id_patient = p.id_patient
        JOIN medecin m ON t.id_medecin = m.id_medecin
        ORDER BY r.date_rdv DESC, r.heure DESC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function rdv_countToday(): int {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(*) as total FROM rendezvous WHERE date_rdv = CURDATE()");
    return $result->fetch_assoc()['total'];
}

function rdv_countUpcoming(): int {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(*) as total FROM rendezvous WHERE date_rdv > CURDATE()");
    return $result->fetch_assoc()['total'];
}
