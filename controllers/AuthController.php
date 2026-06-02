<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/AuthService.php';

function auth_showLogin(): void {
    $formData = $_SESSION['form_data'] ?? [];
    unset($_SESSION['form_data']);
    require __DIR__ . '/../views/auth/login.php';
}

function auth_handleRegister(): void {
    $data = [
        'prenom' => $_POST['prenom'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'email' => $_POST['email'] ?? '',
        'telephone' => $_POST['telephone'] ?? '',
        'password' => $_POST['password'] ?? '',
        'confirm_password' => $_POST['confirm_password'] ?? '',
        'role' => $_POST['role'] ?? 'patient',
        'auth_code' => $_POST['auth_code'] ?? '',
        'specialite_medecin' => $_POST['specialite_medecin'] ?? '',
        'specialite_assistant' => $_POST['specialite_assistant'] ?? ''
    ];

    $errors = authService_validateRegistration($data);
    if (!empty($errors)) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => implode('<br>', $errors)];
        $_SESSION['form_data'] = $_POST;
        redirect('connection.php');
    }

    authService_register($data);
    $_SESSION['swal'] = ['icon' => 'success', 'title' => 'Succès', 'text' => "Inscription réussie ! Vous pouvez maintenant vous connecter."];
    redirect('connection.php');
}

function auth_handleLogin(): void {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = authService_login($email, $password);
    if (!$user) {
        $_SESSION['swal'] = ['icon' => 'error', 'title' => 'Erreur', 'text' => "Email ou mot de passe incorrect"];
        redirect('connection.php');
    }

    $_SESSION = securite_buildSession($user);
    redirect(securite_getRedirect($user['rôle']));
}

function auth_logout(): void {
    securite_destroySession();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Pragma: no-cache");
    redirect('connection.php');
}