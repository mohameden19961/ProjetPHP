<?php

require_once __DIR__ . '/_helpers.php';
require_once __DIR__ . '/../../services/AssistantService.php';

try {
    switch ($_METHOD) {
        case 'GET':
            requireApiRole([ROLE_ADMIN]);
            if ($_ID) {
                $data = assistantService_getById($_ID);
                $data ? api_success($data) : api_error('Introuvable', 404);
            } else {
                api_success(assistantService_getAll());
            }
            break;
        case 'POST':
            requireApiRole([ROLE_ADMIN]);
            assistantService_create((int)($_POST['id_utilisateur'] ?? 0), $_POST['departement'] ?? '');
            api_success(['message' => MSG_CREATED, 'id' => (int)($_POST['id_utilisateur'] ?? 0)], 201);
            break;
        case 'PUT':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            assistantService_update($_ID, $_POST);
            api_success(['message' => MSG_UPDATED]);
            break;
        case 'DELETE':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            assistantService_delete($_ID);
            api_success(['message' => MSG_DELETED]);
            break;
        default:
            api_error('Méthode non autorisée', 405);
    }
} catch (Exception $e) {
    api_error($e->getMessage(), 500);
}
