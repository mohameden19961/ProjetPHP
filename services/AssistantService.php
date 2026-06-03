<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Assistant.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Medecin.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Examen.php';
require_once __DIR__ . '/../models/Hospitalisation.php';
require_once __DIR__ . '/../models/Traitement.php';

function assistantService_getAll(): array {
    return assistant_getAll();
}

function assistantService_getById(int $id): ?array {
    return assistant_findById($id);
}

function assistantService_create(int $idUser, string $departement): void {
    assistant_createFromUser($idUser, $departement);
}

function assistantService_update(int $id, array $data): void {
    assistant_update($id, $data);
}

function assistantService_delete(int $id): void {
    assistant_delete($id);
}

function assistantService_getProfile(int $userId): ?array {
    return user_findById($userId);
}

function assistantService_getAllPatients(): array {
    return patient_getAll();
}

function assistantService_getAllMedecins(): array {
    return medecin_getAll();
}

function assistantService_getUpcomingRdv(): array {
    return rdv_getUpcomingForAssistant();
}

function assistantService_getAllExamens(): array {
    return examen_getAll();
}

function assistantService_getActiveHospitalisations(): array {
    return hospitalisation_getAllActive();
}

function assistantService_addPatient(array $data): ?string {
    $nom = sanitize($data['nom'] ?? '');
    $prenom = sanitize($data['prenom'] ?? '');
    $email = sanitize($data['email'] ?? '');
    if (!$nom || !$prenom || !$data['date_naissance'] || !$data['sexe'] || !$email) {
        return 'Veuillez remplir tous les champs obligatoires';
    }
    if (patient_findByEmail($email)) {
        return 'Un patient avec cet email existe déjà';
    }
    patient_create([
        'nom' => $nom, 'prenom' => $prenom,
        'date_naissance' => $data['date_naissance'], 'sexe' => $data['sexe'],
        'adresse' => sanitize($data['adresse'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? ''),
        'email' => $email,
        'dossier_medical' => sanitize($data['dossier_medical'] ?? '')
    ]);
    return null;
}

function assistantService_addRdv(array $data): ?string {
    $patientId = (int)($data['patient_id'] ?? 0);
    $medecinId = (int)($data['medecin_id'] ?? 0);
    if (!$patientId || !$medecinId || !($data['date_rdv'] ?? '') || !($data['heure'] ?? '') || empty($data['motif'] ?? '')) {
        return 'Veuillez remplir tous les champs obligatoires';
    }
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $data['date_rdv'], $data['heure'], sanitize($data['lieu'] ?? 'Clinique A'), sanitize($data['motif'] ?? ''));
    return null;
}

function assistantService_addExamNote(array $data): ?string {
    $patientId = (int)($data['patient_id'] ?? 0);
    $medecinId = (int)($data['medecin_id'] ?? 0);
    if (!$patientId || !$medecinId || empty($data['type_examen'] ?? '')) {
        return 'Veuillez remplir tous les champs obligatoires';
    }
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    examen_create($idTraitement, sanitize($data['type_examen'] ?? ''), sanitize($data['resultat'] ?? ''));
    return null;
}

function assistantService_addHospitalisation(array $data): ?string {
    $patientId = (int)($data['patient_id'] ?? 0);
    $medecinId = (int)($data['medecin_id'] ?? 0);
    if (!$patientId || !$medecinId || !($data['date_admission'] ?? '') || empty($data['motif'] ?? '')) {
        return 'Veuillez remplir tous les champs obligatoires';
    }
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    hospitalisation_create($idTraitement, $data['date_admission'], null, sanitize($data['motif'] ?? ''));
    return null;
}

function assistantService_updatePatient(int $id, array $data): void {
    patient_update($id, [
        'nom' => sanitize($data['nom'] ?? ''),
        'prenom' => sanitize($data['prenom'] ?? ''),
        'date_naissance' => $data['date_naissance'] ?? '',
        'sexe' => $data['sexe'] ?? '',
        'adresse' => sanitize($data['adresse'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? ''),
        'email' => sanitize($data['email'] ?? ''),
        'dossier_medical' => sanitize($data['dossier_medical'] ?? '')
    ]);
}

function assistantService_cancelRdv(int $id): void {
    rdv_updateStatus($id, RDV_ANNULE);
}

function assistantService_deleteHospitalisation(int $id): void {
    hospitalisation_delete($id);
}