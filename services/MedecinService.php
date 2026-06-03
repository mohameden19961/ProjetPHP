<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Medecin.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Ordonnance.php';
require_once __DIR__ . '/../models/Traitement.php';

function medecinService_getAll(): array {
    return medecin_getAll();
}

function medecinService_getById(int $id): ?array {
    return medecin_findById($id);
}

function medecinService_create(int $idUser, string $nom, string $prenom, string $specialite, string $email, string $telephone): void {
    medecin_createFromUser($idUser, $nom, $prenom, $specialite, $email, $telephone);
}

function medecinService_update(int $id, array $data): void {
    medecin_update($id, $data);
}

function medecinService_delete(int $id): void {
    medecin_delete($id);
}

function medecinService_getRendezvous(int $idMedecin): array {
    return rdv_getUpcomingForMedecin($idMedecin);
}

function medecinService_getOrdonnances(int $idMedecin): array {
    return ordonnance_getForMedecin($idMedecin);
}

function medecinService_hasAccessToPatient(int $medecinId, int $patientId): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM traitement WHERE id_medecin = ? AND id_patient = ?");
    $stmt->bind_param("ii", $medecinId, $patientId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['cnt'] > 0;
}

function medecinService_hasAccessToRdv(int $medecinId, int $rdvId): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM rendezvous r JOIN traitement t ON r.id_traitement = t.id_traitement WHERE t.id_medecin = ? AND r.id_rdv = ?");
    $stmt->bind_param("ii", $medecinId, $rdvId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['cnt'] > 0;
}

function medecinService_hasAccessToOrdonnance(int $medecinId, int $ordoId): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM ordonnance o JOIN traitement t ON o.id_traitement = t.id_traitement WHERE t.id_medecin = ? AND o.id_ordonnance = ?");
    $stmt->bind_param("ii", $medecinId, $ordoId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['cnt'] > 0;
}

function medecinService_getPatientById(int $id): ?array {
    return patient_findById($id);
}

function medecinService_getRdvById(int $id): ?array {
    return rdv_findById($id);
}

function medecinService_getPatients(int $idMedecin): array {
    return medecin_getPatients($idMedecin);
}

function medecinService_deletePatient(int $id): void {
    patient_delete($id);
}

function medecinService_updatePatient(int $id, array $data): void {
    patient_update($id, [
        'nom' => sanitize($data['nom'] ?? ''),
        'prenom' => sanitize($data['prenom'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? ''),
        'email' => sanitize($data['email'] ?? ''),
        'adresse' => sanitize($data['adresse'] ?? ''),
        'dossier_medical' => sanitize($data['dossier_medical'] ?? '')
    ]);
}

function medecinService_createRdv(int $medecinId, array $data): void {
    $patientId = (int)($data['patient_id'] ?? 0);
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $data['date_rdv'], $data['heure'], sanitize($data['lieu'] ?? 'Clinique'), sanitize($data['motif'] ?? ''));
}

function medecinService_createOrdonnance(int $medecinId, array $data): void {
    $patientId = (int)($data['patient_id'] ?? 0);
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    ordonnance_create($idTraitement, sanitize($data['medicaments'] ?? ''));
}

function medecinService_deleteOrdonnance(int $id): void {
    ordonnance_delete($id);
}

function medecinService_confirmRdv(int $id): void {
    rdv_updateStatus($id, RDV_CONFIRME);
}

function medecinService_cancelRdv(int $id): void {
    rdv_updateStatus($id, RDV_ANNULE);
}

function medecinService_updateRdv(int $id, array $data): void {
    rdv_update($id, $data['date_rdv'] ?? '', $data['heure'] ?? '', sanitize($data['lieu'] ?? ''), sanitize($data['motif'] ?? ''));
}