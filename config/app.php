<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../securite/Session.php';

securite_startSession();

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function isAuthenticated(): bool {
    return securite_isAuthenticated();
}

function requireAuth(): void {
    securite_requireAuth();
}

function requireRole(string $role): void {
    securite_requireRole($role);
}

function setAlert(string $icon, string $title, string $text): void {
    $_SESSION['swal'] = ['icon' => $icon, 'title' => $title, 'text' => $text];
}

function getAlert(): ?array {
    if (isset($_SESSION['swal'])) {
        $alert = $_SESSION['swal'];
        unset($_SESSION['swal']);
        return $alert;
    }
    return null;
}

function requireApiAuth(): void {
    securite_startSession();
    if (!securite_isAuthenticated()) {
        http_response_code(401);
        echo json_encode(['error' => 'Authentification requise']);
        exit;
    }
}

function requireApiRole(array $roles): void {
    requireApiAuth();
    if (!in_array($_SESSION['role'] ?? '', $roles)) {
        http_response_code(403);
        echo json_encode(['error' => 'Accès interdit. Rôle requis: ' . implode(', ', $roles)]);
        exit;
    }
}