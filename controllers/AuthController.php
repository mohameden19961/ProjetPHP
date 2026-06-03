<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/AuthService.php';

function auth_showLogin(): void {
    $formData = $_SESSION['form_data'] ?? [];
    unset($_SESSION['form_data']);
    $csrfToken = csrf_generateToken();
    require __DIR__ . '/../views/auth/login.php';
}

function auth_handleRegister(): void {
    if (!csrf_verifyToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => 'Session expirée. Veuillez réessayer.'];
        redirect(URL_LOGIN);
    }

    $data = [
        'prenom' => $_POST['prenom'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'email' => $_POST['email'] ?? '',
        'telephone' => $_POST['telephone'] ?? '',
        'password' => $_POST['password'] ?? '',
        'confirm_password' => $_POST['confirm_password'] ?? '',
        SESS_ROLE => $_POST[SESS_ROLE] ?? ROLE_PATIENT,
        'auth_code' => $_POST['auth_code'] ?? '',
        'specialite_medecin' => $_POST['specialite_medecin'] ?? '',
        'specialite_assistant' => $_POST['specialite_assistant'] ?? ''
    ];

    $errors = authService_validateRegistration($data);
    if (!empty($errors)) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => implode('<br>', $errors)];
        $_SESSION['form_data'] = $_POST;
        redirect(URL_LOGIN);
    }

    $userId = authService_register($data);
    if ($userId <= 0) {
        $errorMsg = $userId === -1
            ? "Cet email est déjà utilisé."
            : "Erreur lors de l'inscription. Veuillez réessayer.";
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => $errorMsg];
        $_SESSION['form_data'] = $_POST;
        redirect(URL_LOGIN);
    }
    $_SESSION['swal'] = ['icon' => 'success', 'title' => 'Succès', 'text' => "Inscription réussie ! Vous pouvez maintenant vous connecter."];
    redirect(URL_LOGIN);
}

function auth_handleLogin(): void {
    if (!csrf_verifyToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => 'Session expirée. Veuillez réessayer.'];
        redirect(URL_LOGIN);
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = authService_login($email, $password);
    if (!$user) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => "Email ou mot de passe incorrect"];
        redirect(URL_LOGIN);
    }

    session_regenerate_id(true);
    $_SESSION = array_merge($_SESSION, securite_buildSession($user));
    redirect(securite_getRedirect($user['rôle']));
}

function auth_logout(): void {
    requireAuth();
    securite_destroySession();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Pragma: no-cache");
    redirect(URL_LOGIN);
}