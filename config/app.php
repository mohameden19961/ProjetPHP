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