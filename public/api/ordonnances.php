<?php

require_once __DIR__ . '/_helpers.php';
require_once __DIR__ . '/../../services/OrdonnanceService.php';

try {
    switch ($_METHOD) {
        case 'GET':
            requireApiAuth();
            if ($_ID) {
                $data = ordonnanceService_getById($_ID);
                $data ? api_success($data) : api_error('Introuvable', 404);
            } else {
                requireApiRole([ROLE_ADMIN, ROLE_MEDECIN]);
                api_success(ordonnanceService_getAll());
            }
            break;
        case 'POST':
            requireApiRole([ROLE_ADMIN, ROLE_MEDECIN]);
            ordonnanceService_create((int)($_POST['patient_id'] ?? 0), (int)($_POST['medecin_id'] ?? 0), $_POST['medicaments'] ?? '');
            api_success(['message' => MSG_CREATED], 201);
            break;
        case 'PUT':
            requireApiRole([ROLE_ADMIN, ROLE_MEDECIN]);
            api_requireId();
            ordonnanceService_update($_ID, $_POST['medicaments'] ?? '');
            api_success(['message' => MSG_UPDATED]);
            break;
        case 'DELETE':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            ordonnanceService_delete($_ID);
            api_success(['message' => MSG_DELETED]);
            break;
        default:
            api_error('Méthode non autorisée', 405);
    }
} catch (Exception $e) {
    api_error($e->getMessage(), 500);
}
