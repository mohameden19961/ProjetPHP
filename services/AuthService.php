<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../securite/Hash.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Medecin.php';
require_once __DIR__ . '/../models/Assistant.php';

function authService_validateRegistration(array $data): array {
    $errors = [];
    if (empty($data['prenom'])) $errors[] = "Le prénom est requis";
    if (empty($data['nom'])) $errors[] = "Le nom est requis";
    if (empty($data['email'])) $errors[] = "L'email est requis";
    if (empty($data['password'])) $errors[] = "Le mot de passe est requis";
    if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) $errors[] = "Format d'email invalide";
    if ($data['password'] !== $data['confirm_password']) $errors[] = "Les mots de passe ne correspondent pas";
    if (strlen($data['password'] ?? '') < 8) $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    if (in_array($data[SESS_ROLE] ?? '', [ROLE_MEDECIN, ROLE_ASSISTANT])) {
        $validCodes = [ROLE_MEDECIN => 'medecin456', ROLE_ASSISTANT => 'assistant789'];
        if (empty($data['auth_code'])) {
            $errors[] = "Un code d'autorisation est requis pour ce rôle";
        } elseif (($data['auth_code'] ?? '') !== $validCodes[$data[SESS_ROLE]]) {
            $errors[] = "Code d'autorisation invalide pour ce rôle";
        }
    }
    if (!empty($errors)) return $errors;
    $existing = user_findByEmail($data['email']);
    if ($existing) $errors[] = "Cet email est déjà utilisé";
    return $errors;
}

function authService_register(array $data): int {
    try {
        $existing = user_findByEmail($data['email']);
        if ($existing) return -1;

        $userId = user_create([
            'nom' => $data['nom'], 'prenom' => $data['prenom'],
            'email' => $data['email'], 'telephone' => $data['telephone'] ?? '',
            SESS_ROLE => $data[SESS_ROLE] ?? ROLE_PATIENT
        ]);
        if (!$userId) return 0;

        $role = $data[SESS_ROLE] ?? ROLE_PATIENT;
        switch ($role) {
            case ROLE_MEDECIN:
                medecin_createFromUser($userId, $data['nom'], $data['prenom'], $data['specialite_medecin'] ?? 'À définir', $data['email'], $data['telephone'] ?? '');
                break;
            case ROLE_ASSISTANT:
                assistant_createFromUser($userId, $data['specialite_assistant'] ?? 'À définir');
                break;
            case ROLE_PATIENT:
                patient_createFromUser($userId, $data['nom'], $data['prenom'], $data['email'], $data['telephone'] ?? '');
                break;
        }
        $hashed = securite_hashPassword($data['password']);
        connexion_create($userId, $data['email'], $hashed);
        return $userId;
    } catch (Exception $e) {
        $code = $e->getCode();
        if (in_array($code, [1062, 23000], true)) return -1;
        return 0;
    }
}

function authService_login(string $email, string $password): ?array {
    if (empty($email) || empty($password)) return null;

    $user = user_findForLogin($email);
    if ($user && securite_verifyPassword($password, $user['mot_de_passe'])) {
        return $user;
    }

    // Timing-safe dummy comparison to prevent user enumeration
    if (!$user) {
        securite_verifyPassword($password, securite_hashPassword('dummy_constant'));
    }
    return null;
}