<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../securite/Session.php';

// ── Roles ──
define('ROLE_ADMIN', 'admin');
define('ROLE_MEDECIN', 'medecin');
define('ROLE_ASSISTANT', 'assistant');
define('ROLE_PATIENT', 'patient');

// ── URLs ──
define('URL_LOGIN', 'connection.php');
define('URL_ADMIN', 'dashboard_administrateur.php');
define('URL_MEDECIN', 'medecin.php');
define('URL_PATIENT', 'patient.php');
define('URL_ASSISTANT', 'assistant.php');

// ── RDV Status ──
define('RDV_ANNULE', 'annule');
define('RDV_CONFIRME', 'confirme');
define('RDV_EN_ATTENTE', 'en_attente');

// ── API Messages ──
define('MSG_CREATED', 'Créé avec succès');
define('MSG_UPDATED', 'Mis à jour avec succès');
define('MSG_DELETED', 'Supprimé avec succès');

// ── Defaults ──
define('LIEU_DEFAUT', 'Clinique');

// ── Session keys ──
define('SESS_USER_ID', 'user_id');
define('SESS_ROLE', 'role');
define('SESS_PATIENT_ID', 'patient_id');
define('SESS_PROFILE_PIC', 'profile_picture');

// ── Uploads ──
define('UPLOAD_PATH', __DIR__ . '/../public/uploads/profiles/');

// ── Hash ──
define('HASH_ALGO', 'sha256');

securite_startSession();

function isAllowedRedirect(string $url): bool {
    if (str_starts_with($url, '/')) return true;
    $allowed = [URL_LOGIN, URL_ADMIN, URL_MEDECIN, URL_PATIENT, URL_ASSISTANT];
    return in_array($url, $allowed, true);
}

function redirect(string $url): void {
    if (!isAllowedRedirect($url)) {
        $url = URL_LOGIN;
    }
    header("Location: $url");
    exit;
}

function csrf_generateToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verifyToken(string $token): bool {
    if (empty($_SESSION['csrf_token'])) return false;
    $valid = hash_equals($_SESSION['csrf_token'], $token);
    unset($_SESSION['csrf_token']);
    return $valid;
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
    $_SESSION['swal'] = compact('icon', 'title', 'text');
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
    if (!securite_isAuthenticated()) {
        http_response_code(401);
        echo json_encode(['error' => 'Authentification requise']);
        exit;
    }
}

function requireApiRole(array $roles): void {
    requireApiAuth();
    if (!in_array($_SESSION[SESS_ROLE] ?? '', $roles)) {
        http_response_code(403);
        echo json_encode(['error' => 'Accès interdit. Rôle requis: ' . implode(', ', $roles)]);
        exit;
    }
}
