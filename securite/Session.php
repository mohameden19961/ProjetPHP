<?php

function securite_startSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params([
            'httponly' => true,
            'samesite' => 'Lax',
            'secure' => isset($_SERVER['HTTPS']),
        ]);
        session_start();
    }
}

function securite_isAuthenticated(): bool {
    return isset($_SESSION[SESS_USER_ID]);
}

function securite_requireAuth(): void {
    if (!securite_isAuthenticated()) {
        header("Location: " . URL_LOGIN);
        exit;
    }
}

function securite_requireRole(string $role): void {
    securite_requireAuth();
    if ($_SESSION[SESS_ROLE] !== $role) {
        header("Location: " . URL_LOGIN);
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
        SESS_USER_ID => $user['id_utilisateur'],
        'email' => $user['email'],
        SESS_ROLE => $user['rôle'],
        'prenom' => $user['prenom'],
        'nom' => $user['nom'],
        'medecin_id' => ($user['rôle'] === ROLE_MEDECIN) ? $user['id_utilisateur'] : null,
        SESS_PATIENT_ID => ($user['rôle'] === ROLE_PATIENT) ? $user['id_utilisateur'] : null,
        'assistant_id' => ($user['rôle'] === ROLE_ASSISTANT) ? $user['id_utilisateur'] : null,
        SESS_PROFILE_PIC => $user['photo_profil'] ?? null
    ];
}

function securite_getRedirect(string $role): string {
    return match ($role) {
        ROLE_ADMIN => URL_ADMIN,
        ROLE_MEDECIN => URL_MEDECIN,
        ROLE_PATIENT => URL_PATIENT,
        ROLE_ASSISTANT => URL_ASSISTANT,
        default => URL_LOGIN
    };
}