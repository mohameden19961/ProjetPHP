<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/MedecinService.php';

function medecin_handleRequest(): void {
    requireRole('medecin');
    $idMedecin = (int)$_SESSION['medecin_id'];
    $section = $_GET['section'] ?? 'dashboard';
    $message = $_SESSION['message'] ?? '';
    $msgType = $_SESSION['msg_type'] ?? '';
    unset($_SESSION['message'], $_SESSION['msg_type']);

    $medecin = medecinService_getById($idMedecin);
    if (!$medecin) redirect('connection.php');

    $rendezvous = medecinService_getRendezvous($idMedecin);
    $nextRendezvous = !empty($rendezvous) ? $rendezvous[0] : null;
    $ordonnances = medecinService_getOrdonnances($idMedecin);
    $patients = medecinService_getPatients($idMedecin);
    $mesPatients = [];
    $patientToEdit = null;
    $rdvToEdit = null;
    $rdvInfo = null;

    if ($section === 'mes_patients') {
        $mesPatients = medecinService_getPatients($idMedecin);
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            medecinService_deletePatient((int)$_GET['id']);
            $message = "Patient supprimé avec succès.";
            $msgType = "success";
        }
    }

    if ($section === 'dossiers' && isset($_GET['id'])) {
        $patientToEdit = medecinService_getPatientById((int)$_GET['id']);
    }

    if ($section === 'modifier-patient' && isset($_GET['id'])) {
        $idPatient = (int)$_GET['id'];
        $patientToEdit = medecinService_getPatientById($idPatient);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_patient'])) {
            medecinService_updatePatient($idPatient, $_POST);
            $message = "Patient modifié avec succès.";
            $msgType = "success";
            $section = 'dossiers';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['creer_rdv']) && $section === 'create-rdv') {
            medecinService_createRdv($idMedecin, $_POST);
            $message = "Rendez-vous créé avec succès.";
            $msgType = "success";
        }

        if (isset($_POST['ajouter_ordonnance']) && $section === 'prescriptions') {
            medecinService_createOrdonnance($idMedecin, $_POST);
            $message = "Ordonnance ajoutée avec succès.";
            $msgType = "success";
        }
    }

    if ($section === 'delete-ordonnance' && isset($_GET['id_ordonnance'])) {
        medecinService_deleteOrdonnance((int)$_GET['id_ordonnance']);
        $message = "Ordonnance supprimée.";
        $msgType = "success";
    }

    if ($section === 'confirm-rdv' && isset($_GET['id_rdv'])) {
        medecinService_confirmRdv((int)$_GET['id_rdv']);
        $message = "Rendez-vous confirmé.";
        $msgType = "success";
        $section = 'agenda';
    }

    if ($section === 'cancel-rdv' && isset($_GET['id_rdv'])) {
        $idRdv = (int)$_GET['id_rdv'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['motif_annulation'])) {
            medecinService_cancelRdv($idRdv);
            $message = "Rendez-vous annulé.";
            $msgType = "success";
            $section = 'agenda';
        } else {
            $rdvInfo = medecinService_getRdvById($idRdv);
        }
    }

    if ($section === 'modifier-rdv' && isset($_GET['id_rdv'])) {
        $idRdv = (int)$_GET['id_rdv'];
        $rdvToEdit = medecinService_getRdvById($idRdv);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_rdv'])) {
            medecinService_updateRdv($idRdv, $_POST);
            $message = "Rendez-vous modifié.";
            $msgType = "success";
            $section = 'agenda';
        }
    }

    require __DIR__ . '/../views/medecin/layout.php';
}