<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../models/Assistant.php';

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
                $data = assistant_findById($id);
                if (!$data) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Introuvable']);
                } else {
                    http_response_code(200);
                    echo json_encode($data);
                }
            } else {
                http_response_code(200);
                echo json_encode(assistant_getAll());
            }
            break;
        case 'POST':
            requireApiRole(['admin']);
            assistant_createFromUser(
                (int)($_POST['id_utilisateur'] ?? 0),
                $_POST['departement'] ?? ''
            );
            http_response_code(201);
            echo json_encode(['message' => 'Créé avec succès', 'id' => (int)($_POST['id_utilisateur'] ?? 0)]);
            break;
        case 'PUT':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            assistant_update($id, $_POST);
            http_response_code(200);
            echo json_encode(['message' => 'Mis à jour avec succès']);
            break;
        case 'DELETE':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            assistant_delete($id);
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
