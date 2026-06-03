<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Ordonnance.php';
require_once __DIR__ . '/../models/Traitement.php';

function ordonnanceService_getAll(): array {
    return ordonnance_getAll();
}

function ordonnanceService_getById(int $id): ?array {
    return ordonnance_findById($id);
}

function ordonnanceService_create(int $patientId, int $medecinId, string $medicaments): void {
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    ordonnance_create($idTraitement, $medicaments);
}

function ordonnanceService_update(int $id, string $medicaments): void {
    ordonnance_update($id, $medicaments);
}

function ordonnanceService_delete(int $id): void {
    ordonnance_delete($id);
}
