<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../models/User.php';

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
                $data = user_findById($id);
                if (!$data) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Introuvable']);
                } else {
                    http_response_code(200);
                    echo json_encode($data);
                }
            } else {
                $role = $_GET['role'] ?? '';
                if ($role) {
                    http_response_code(200);
                    echo json_encode(user_findAllByRole($role));
                } else {
                    $conn = getDbConnection();
                    $result = $conn->query("SELECT * FROM utilisateur ORDER BY nom, prenom");
                    http_response_code(200);
                    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
                }
            }
            break;
        case 'POST':
            requireApiRole(['admin']);
            $newId = user_create($_POST);
            http_response_code(201);
            echo json_encode(['message' => 'Créé avec succès', 'id' => $newId]);
            break;
        case 'PUT':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            $user = user_findById($id);
            if (!$user) { http_response_code(404); echo json_encode(['error' => 'Introuvable']); exit; }
            $conn = getDbConnection();
            $fields = [];
            $types = '';
            $values = [];
            foreach (['nom', 'prenom', 'email', 'telephone', 'rôle'] as $field) {
                if (isset($_POST[$field])) {
                    $fields[] = "$field = ?";
                    $types .= 's';
                    $values[] = $_POST[$field];
                }
            }
            if (!empty($fields)) {
                $types .= 'i';
                $values[] = $id;
                $stmt = $conn->prepare("UPDATE utilisateur SET " . implode(', ', $fields) . " WHERE id_utilisateur = ?");
                $stmt->bind_param($types, ...$values);
                $stmt->execute();
                $stmt->close();
            }
            http_response_code(200);
            echo json_encode(['message' => 'Mis à jour avec succès']);
            break;
        case 'DELETE':
            requireApiRole(['admin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            user_delete($id);
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
