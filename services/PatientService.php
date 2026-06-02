<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Ordonnance.php';
require_once __DIR__ . '/../models/Examen.php';
require_once __DIR__ . '/../models/Hospitalisation.php';
require_once __DIR__ . '/../models/Traitement.php';
require_once __DIR__ . '/../models/Medecin.php';

function patientService_getInfo(int $idPatient): ?array {
    return patient_findById($idPatient);
}

function patientService_getUpcomingRdv(int $idPatient): array {
    return rdv_getUpcomingForPatient($idPatient);
}

function patientService_getOrdonnances(int $idPatient): array {
    return ordonnance_getForPatient($idPatient);
}

function patientService_getExamens(int $idPatient): array {
    return examen_getForPatient($idPatient);
}

function patientService_getHospitalisations(int $idPatient): array {
    return hospitalisation_getForPatient($idPatient);
}

function patientService_getDoctors(int $idPatient): array {
    return patient_getDoctors($idPatient);
}

function patientService_updateProfile(int $id, array $data): void {
    patient_update($id, [
        'nom' => sanitize($data['nom'] ?? ''),
        'prenom' => sanitize($data['prenom'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? ''),
        'adresse' => sanitize($data['adresse'] ?? '')
    ]);
}

function patientService_createRdv(int $patientId, array $data): void {
    $medecinId = (int)($data['medecin_id'] ?? 0);
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $data['date_rdv'], $data['heure'], 'Clinique', sanitize($data['motif'] ?? ''));
}

function patientService_createHospitalisation(int $patientId, array $data): void {
    $medecinId = (int)($data['medecin_id'] ?? 0);
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    hospitalisation_create($idTraitement, $data['date_admission'], null, sanitize($data['motif'] ?? ''));
}