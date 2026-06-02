<?php

function securite_startSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function securite_isAuthenticated(): bool {
    return isset($_SESSION['user_id']);
}

function securite_requireAuth(): void {
    if (!securite_isAuthenticated()) {
        header("Location: connection.php");
        exit;
    }
}

function securite_requireRole(string $role): void {
    securite_requireAuth();
    if ($_SESSION['role'] !== $role) {
        header("Location: connection.php");
        exit;
    }
}

function securite_destroySession(): void {
    $_SESSION = [];
    session_unset();
    session_destroy();
}

function securite_buildSession(array $user): array {
    return [
        'user_id' => $user['id_utilisateur'],
        'email' => $user['email'],
        'role' => $user['rôle'],
        'prenom' => $user['prenom'],
        'nom' => $user['nom'],
        'medecin_id' => ($user['rôle'] === 'medecin') ? $user['id_utilisateur'] : null,
        'patient_id' => ($user['rôle'] === 'patient') ? $user['id_utilisateur'] : null,
        'assistant_id' => ($user['rôle'] === 'assistant') ? $user['id_utilisateur'] : null,
        'profile_picture' => $user['photo_profil'] ?? null
    ];
}

function securite_getRedirect(string $role): string {
    return match ($role) {
        'admin' => 'dashboard_administrateur.php',
        'medecin' => 'medecin.php',
        'patient' => 'patient.php',
        'assistant' => 'assistant.php',
        default => 'connection.php'
    };
}