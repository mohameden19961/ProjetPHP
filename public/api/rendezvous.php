<?php

require_once __DIR__ . '/_helpers.php';
require_once __DIR__ . '/../../services/RendezvousService.php';

try {
    switch ($_METHOD) {
        case 'GET':
            requireApiAuth();
            if ($_ID) {
                $data = rdvService_getById($_ID);
                $data ? api_success($data) : api_error('Introuvable', 404);
            } else {
                requireApiRole([ROLE_ADMIN, ROLE_MEDECIN, ROLE_ASSISTANT]);
                api_success(rdvService_getAll());
            }
            break;
        case 'POST':
            requireApiRole([ROLE_ADMIN, ROLE_MEDECIN, ROLE_ASSISTANT, ROLE_PATIENT]);
            rdvService_create((int)($_POST['patient_id'] ?? 0), (int)($_POST['medecin_id'] ?? 0), $_POST['date_rdv'] ?? '', $_POST['heure'] ?? '', $_POST['lieu'] ?? 'Clinique', $_POST['motif'] ?? '');
            api_success(['message' => MSG_CREATED], 201);
            break;
        case 'PUT':
            requireApiRole([ROLE_ADMIN, ROLE_MEDECIN]);
            api_requireId();
            rdvService_update($_ID, $_POST['date_rdv'] ?? '', $_POST['heure'] ?? '', $_POST['lieu'] ?? '', $_POST['motif'] ?? '');
            api_success(['message' => MSG_UPDATED]);
            break;
        case 'DELETE':
            requireApiRole([ROLE_ADMIN, ROLE_MEDECIN, ROLE_ASSISTANT]);
            api_requireId();
            rdvService_cancel($_ID);
            api_success(['message' => 'Annulé avec succès']);
            break;
        default:
            api_error('Méthode non autorisée', 405);
    }
} catch (Exception $e) {
    api_error($e->getMessage(), 500);
}
