<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../services/UserService.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}
if ($method === 'GET' && isset($_GET['_method'])) {
    $method = strtoupper($_GET['_method']);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

try {
    switch ($method) {
        case 'GET':
            requireApiRole(['admin']);
            if ($id) {
                $data = userService_getById($id);
                if (!$data) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Introuvable']);
                } else {
                    http_response_code(200);
                    echo json_encode($data);
                }
            } else {
                http_response_code(200);
                echo json_encode(userService_getAll($_GET));
            }
            break;
        case 'POST':
            requireApiRole(['admin']);
            $newId = userService_create($_POST);
            http_response_code(201);
            echo json_encode(['message' => 'Créé avec succès', 'id' => $newId]);
            break;
        case 'PUT':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            $user = userService_getById($id);
            if (!$user) { http_response_code(404); echo json_encode(['error' => 'Introuvable']); exit; }
            userService_update($id, $_POST);
            http_response_code(200);
            echo json_encode(['message' => 'Mis à jour avec succès']);
            break;
        case 'DELETE':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            userService_delete($id);
            http_response_code(200);
            echo json_encode(['message' => 'Supprimé avec succès']);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
