<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/User.php';

function userService_getAll(array $params): array {
    $role = $params['role'] ?? '';
    if ($role) {
        return user_findAllByRole($role);
    }
    return user_getAll();
}

function userService_getById(int $id): ?array {
    return user_findById($id);
}

function userService_create(array $data): int {
    return user_create($data);
}

function userService_update(int $id, array $data): void {
    user_update($id, $data);
}

function userService_delete(int $id): void {
    connexion_deleteByUserId($id);
    medecin_delete($id);
    assistant_delete($id);
    user_delete($id);
}
