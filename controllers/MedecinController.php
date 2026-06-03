<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/MedecinService.php';

function medecin_handleRequest(): void {
    requireRole(ROLE_MEDECIN);
    $idMedecin = (int)$_SESSION['medecin_id'];
    $section = $_GET['section'] ?? 'dashboard';
    $message = $_SESSION['message'] ?? '';
    $msgType = $_SESSION['msg_type'] ?? '';
    unset($_SESSION['message'], $_SESSION['msg_type']);

    $medecin = medecinService_getById($idMedecin);
    if (!$medecin) redirect(URL_LOGIN);

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
            $targetId = (int)$_GET['id'];
            if (medecinService_hasAccessToPatient($idMedecin, $targetId)) {
                medecinService_deletePatient($targetId);
                $message = "Patient supprimé avec succès.";
                $msgType = "success";
            } else {
                $message = "Accès non autorisé à ce patient.";
                $msgType = "error";
            }
        }
    }

    if ($section === 'dossiers' && isset($_GET['id'])) {
        $idPatient = (int)$_GET['id'];
        $patientToEdit = medecinService_hasAccessToPatient($idMedecin, $idPatient) ? medecinService_getPatientById($idPatient) : null;
        if (!$patientToEdit) {
            $message = "Accès non autorisé à ce dossier.";
            $msgType = "error";
        }
    }

    if ($section === 'modifier-patient' && isset($_GET['id'])) {
        $idPatient = (int)$_GET['id'];
        $patientToEdit = medecinService_hasAccessToPatient($idMedecin, $idPatient) ? medecinService_getPatientById($idPatient) : null;
        if (!$patientToEdit) {
            $message = "Accès non autorisé à ce patient.";
            $msgType = "error";
            $section = 'mes_patients';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_patient'])) {
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
        $ordoId = (int)$_GET['id_ordonnance'];
        if (medecinService_hasAccessToOrdonnance($idMedecin, $ordoId)) {
            medecinService_deleteOrdonnance($ordoId);
            $message = "Ordonnance supprimée.";
            $msgType = "success";
        } else {
            $message = "Accès non autorisé à cette ordonnance.";
            $msgType = "error";
        }
    }

    if ($section === 'confirm-rdv' && isset($_GET['id_rdv'])) {
        $idRdv = (int)$_GET['id_rdv'];
        if (medecinService_hasAccessToRdv($idMedecin, $idRdv)) {
            medecinService_confirmRdv($idRdv);
            $message = "Rendez-vous confirmé.";
            $msgType = "success";
        } else {
            $message = "Accès non autorisé à ce rendez-vous.";
            $msgType = "error";
        }
        $section = 'agenda';
    }

    if ($section === 'cancel-rdv' && isset($_GET['id_rdv'])) {
        $idRdv = (int)$_GET['id_rdv'];
        if (!medecinService_hasAccessToRdv($idMedecin, $idRdv)) {
            $message = "Accès non autorisé à ce rendez-vous.";
            $msgType = "error";
            $section = 'agenda';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['motif_annulation'])) {
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
        if (!medecinService_hasAccessToRdv($idMedecin, $idRdv)) {
            $message = "Accès non autorisé à ce rendez-vous.";
            $msgType = "error";
            $section = 'agenda';
        } else {
            $rdvToEdit = medecinService_getRdvById($idRdv);
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_rdv'])) {
                medecinService_updateRdv($idRdv, $_POST);
                $message = "Rendez-vous modifié.";
                $msgType = "success";
                $section = 'agenda';
            }
        }
    }

    require __DIR__ . '/../views/medecin/layout.php';
}