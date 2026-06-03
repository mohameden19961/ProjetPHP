<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Hospitalisation.php';
require_once __DIR__ . '/../models/Traitement.php';

function hospitalisationService_getAll(): array {
    return hospitalisation_getAllActive();
}

function hospitalisationService_getById(int $id): ?array {
    return hospitalisation_findById($id);
}

function hospitalisationService_create(int $patientId, int $medecinId, string $dateEntree, string $motif): void {
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    hospitalisation_create($idTraitement, $dateEntree, null, $motif);
}

function hospitalisationService_update(int $id, string $dateEntree, ?string $dateSortie, string $motif): void {
    hospitalisation_update($id, $dateEntree, $dateSortie, $motif);
}

function hospitalisationService_delete(int $id): void {
    hospitalisation_delete($id);
}
