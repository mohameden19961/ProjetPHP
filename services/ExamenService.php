<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Examen.php';
require_once __DIR__ . '/../models/Traitement.php';

function examenService_getAll(): array {
    return examen_getAll();
}

function examenService_getById(int $id): ?array {
    return examen_findById($id);
}

function examenService_create(int $patientId, int $medecinId, string $type, string $resultat): void {
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    examen_create($idTraitement, $type, $resultat);
}

function examenService_update(int $id, string $type, string $resultat): void {
    examen_update($id, $type, $resultat);
}

function examenService_delete(int $id): void {
    examen_delete($id);
}
