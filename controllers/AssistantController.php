<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/AssistantService.php';

function assistant_handleRequest(): void {
    requireRole('assistant');
    $action = $_GET['action'] ?? '';
    $success = $_GET['success'] ?? '';
    $error = $_GET['error'] ?? '';

    $assistant = assistantService_getProfile((int)$_SESSION['user_id']);
    $patients = assistantService_getAllPatients();
    $medecins = assistantService_getAllMedecins();
    $rendezvous = assistantService_getUpcomingRdv();
    $examens = assistantService_getAllExamens();
    $hospitalisations = assistantService_getActiveHospitalisations();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($action === 'add_patient') {
            $err = assistantService_addPatient($_POST);
            $err ? $error = $err : redirect('assistant.php?success=' . urlencode("Patient ajouté avec succès"));
        }

        if ($action === 'add_rdv') {
            $err = assistantService_addRdv($_POST);
            $err ? $error = $err : redirect('assistant.php?success=' . urlencode("Rendez-vous ajouté avec succès"));
        }

        if ($action === 'add_exam_note') {
            $err = assistantService_addExamNote($_POST);
            $err ? $error = $err : redirect('assistant.php?success=' . urlencode("Examen ajouté avec succès"));
        }

        if ($action === 'add_hospitalisation') {
            $err = assistantService_addHospitalisation($_POST);
            $err ? $error = $err : redirect('assistant.php?success=' . urlencode("Hospitalisation enregistrée avec succès"));
        }

        if ($action === 'update_patient' && isset($_GET['id'])) {
            assistantService_updatePatient((int)$_GET['id'], $_POST);
            redirect('assistant.php?success=' . urlencode("Patient mis à jour avec succès"));
        }
    }

    if ($action === 'cancel_rdv' && isset($_GET['rdv_id'])) {
        assistantService_cancelRdv((int)$_GET['rdv_id']);
        redirect('assistant.php?success=' . urlencode("Rendez-vous annulé"));
    }

    if ($action === 'delete_hospitalisation' && isset($_GET['id'])) {
        assistantService_deleteHospitalisation((int)$_GET['id']);
        redirect('assistant.php?success=' . urlencode("Hospitalisation supprimée"));
    }

    require __DIR__ . '/../views/assistant/layout.php';
}