<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/PatientService.php';

function patient_handleRequest(): void {
    requireRole('patient');
    $idPatient = (int)$_SESSION['patient_id'];
    $section = $_GET['section'] ?? 'dashboard';
    $message = '';
    $msgType = '';

    $patient = patientService_getById($idPatient);
    if (!$patient) redirect('connection.php');

    $upcomingRendezvous = patientService_getUpcomingRdv($idPatient);
    $ordonnances = patientService_getOrdonnances($idPatient);
    $examens = patientService_getExamens($idPatient);
    $hospitalisations = patientService_getHospitalisations($idPatient);
    $medecins = patientService_getDoctors($idPatient);
    $dossier = $patient['dossier_medical'] ?? 'Aucune information disponible.';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['modifier_profil']) && $section === 'modify-profile') {
            patientService_updateProfile($idPatient, $_POST);
            $message = "Profil mis à jour avec succès.";
            $msgType = "success";
            $patient = patientService_getById($idPatient);
        }

        if (isset($_POST['creer_rdv']) && $section === 'create-rdv') {
            patientService_createRdv($idPatient, $_POST);
            $message = "Rendez-vous créé avec succès.";
            $msgType = "success";
        }

        if (isset($_POST['creer_hospitalisation']) && $section === 'hospitalisation') {
            patientService_createHospitalisation($idPatient, $_POST);
            $message = "Demande d'hospitalisation envoyée.";
            $msgType = "success";
        }
    }

    require __DIR__ . '/../views/patient/layout.php';
}