<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Traitement.php';

function rdvService_getAll(): array {
    return rdv_getAll();
}

function rdvService_getById(int $id): ?array {
    return rdv_findById($id);
}

function rdvService_create(int $patientId, int $medecinId, string $date, string $heure, string $lieu, string $motif): void {
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $date, $heure, $lieu, $motif);
}

function rdvService_update(int $id, string $date, string $heure, string $lieu, string $motif): void {
    rdv_update($id, $date, $heure, $lieu, $motif);
}

function rdvService_cancel(int $id): void {
    rdv_updateStatus($id, RDV_ANNULE);
}
