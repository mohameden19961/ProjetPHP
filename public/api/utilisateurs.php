<?php

require_once __DIR__ . '/_helpers.php';
require_once __DIR__ . '/../../services/UserService.php';

try {
    switch ($_METHOD) {
        case 'GET':
            requireApiRole([ROLE_ADMIN]);
            if ($_ID) {
                $data = userService_getById($_ID);
                $data ? api_success($data) : api_error('Introuvable', 404);
            } else {
                api_success(userService_getAll($_GET));
            }
            break;
        case 'POST':
            requireApiRole([ROLE_ADMIN]);
            $newId = userService_create($_POST);
            api_success(['message' => MSG_CREATED, 'id' => $newId], 201);
            break;
        case 'PUT':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            $user = userService_getById($_ID);
            if (!$user) api_error('Introuvable', 404);
            userService_update($_ID, $_POST);
            api_success(['message' => MSG_UPDATED]);
            break;
        case 'DELETE':
            requireApiRole([ROLE_ADMIN]);
            api_requireId();
            userService_delete($_ID);
            api_success(['message' => MSG_DELETED]);
            break;
        default:
            api_error('Méthode non autorisée', 405);
    }
} catch (Exception $e) {
    api_error($e->getMessage(), 500);
}
