<?php

require_once __DIR__ . '/_helpers.php';
require_once __DIR__ . '/../../services/MedecinService.php';

try {
    switch ($_METHOD) {
        case 'GET':
            requireApiAuth();
            if ($_ID) {
                $data = medecinService_getById($_ID);
                $data ? api_success($data) : api_error('Introuvable', 404);
            } else {
                requireApiRole([ROLE_ADMIN, ROLE_MEDECIN, ROLE_ASSISTANT]);
                api_success(medecinService_getAll());
            }
            break;
        case 'POST':
            requireApiRole([ROLE_ADMIN]);
            medecinService_create(
                (int)($_POST['id_utilisateur'] ?? 0),
                $_POST['nom'] ?? '',
                $_POST['prenom'] ?? '',
                $_POST['specialite'] ?? '',
                $_POST['email'] ?? '',
                $_POST['telephone'] ?? ''
            );
            api_success(['message' => MSG_CREATED, 'id' => (int)($_POST['id_utilisateur'] ?? 0)], 201);
            break;
        case 'PUT':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            medecinService_update($_ID, $_POST);
            api_success(['message' => MSG_UPDATED]);
            break;
        case 'DELETE':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            medecinService_delete($_ID);
            api_success(['message' => MSG_DELETED]);
            break;
        default:
            api_error('Méthode non autorisée', 405);
    }
} catch (Exception $e) {
    api_error($e->getMessage(), 500);
}
