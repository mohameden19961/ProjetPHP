<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../models/Hospitalisation.php';
require_once __DIR__ . '/../../models/Traitement.php';

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
            requireApiAuth();
            if ($id) {
                $data = hospitalisation_findById($id);
                if (!$data) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Introuvable']);
                } else {
                    http_response_code(200);
                    echo json_encode($data);
                }
            } else {
                requireApiRole(['admin', 'medecin', 'assistant']);
                http_response_code(200);
                echo json_encode(hospitalisation_getAllActive());
            }
            break;
        case 'POST':
            requireApiRole(['admin', 'medecin', 'assistant']);
            $patientId = (int)($_POST['patient_id'] ?? 0);
            $medecinId = (int)($_POST['medecin_id'] ?? 0);
            $idTraitement = traitement_findOrCreate($patientId, $medecinId);
            hospitalisation_create($idTraitement, $_POST['date_admission'] ?? '', null, $_POST['motif'] ?? '');
            http_response_code(201);
            echo json_encode(['message' => 'Créé avec succès']);
            break;
        case 'PUT':
            requireApiRole(['admin', 'medecin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            hospitalisation_update($id, $_POST['date_entree'] ?? '', $_POST['date_sortie'] ?? null, $_POST['motif'] ?? '');
            http_response_code(200);
            echo json_encode(['message' => 'Mis à jour avec succès']);
            break;
        case 'DELETE':
            requireApiRole(['admin', 'medecin']);
            if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }
            hospitalisation_delete($id);
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
