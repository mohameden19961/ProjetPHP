<?php

require_once __DIR__ . '/../config/database.php';

function traitement_findOrCreate(int $patientId, int $medecinId): int {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT id_traitement FROM traitement WHERE id_patient = ? AND id_medecin = ? ORDER BY id_traitement DESC LIMIT 1");
    $stmt->bind_param("ii", $patientId, $medecinId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row['id_traitement'];
    }
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO traitement (id_patient, id_medecin) VALUES (?, ?)");
    $stmt->bind_param("ii", $patientId, $medecinId);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

function traitement_findId(int $patientId, int $medecinId): ?int {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT id_traitement FROM traitement WHERE id_patient = ? AND id_medecin = ? ORDER BY id_traitement DESC LIMIT 1");
    $stmt->bind_param("ii", $patientId, $medecinId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row['id_traitement'];
    }
    $stmt->close();
    return null;
}
