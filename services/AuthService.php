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
    if (in_array($data['role'] ?? '', ['medecin', 'assistant'])) {
        $validCodes = ['medecin' => 'medecin456', 'assistant' => 'assistant789'];
        if (empty($data['auth_code'])) {
            $errors[] = "Un code d'autorisation est requis pour ce rôle";
        } elseif (($data['auth_code'] ?? '') !== $validCodes[$data['role']]) {
            $errors[] = "Code d'autorisation invalide pour ce rôle";
        }
    }
    if (!empty($errors)) return $errors;
    $existing = user_findByEmail($data['email']);
    if ($existing) $errors[] = "Cet email est déjà utilisé";
    return $errors;
}

function authService_register(array $data): int {
    $userId = user_create([
        'nom' => $data['nom'], 'prenom' => $data['prenom'],
        'email' => $data['email'], 'telephone' => $data['telephone'] ?? '',
        'role' => $data['role'] ?? 'patient'
    ]);
    $role = $data['role'] ?? 'patient';
    switch ($role) {
        case 'medecin':
            medecin_createFromUser($userId, $data['nom'], $data['prenom'], $data['specialite_medecin'] ?? 'À définir', $data['email'], $data['telephone'] ?? '');
            break;
        case 'assistant':
            assistant_createFromUser($userId, $data['specialite_assistant'] ?? 'À définir');
            break;
        case 'patient':
            patient_createFromUser($userId, $data['nom'], $data['prenom'], $data['email'], $data['telephone'] ?? '');
            break;
    }
    $conn = getDbConnection();
    $hashed = securite_hashPassword($data['password']);
    $stmt = $conn->prepare("INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $data['email'], $hashed);
    $stmt->execute();
    $stmt->close();
    return $userId;
}

function authService_login(string $email, string $password): ?array {
    if (empty($email) || empty($password)) return null;
    $conn = getDbConnection();
    $hashed = securite_hashPassword($password);
    $stmt = $conn->prepare("SELECT c.id_utilisateur, u.* FROM connexion c JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur WHERE c.login = ? AND c.mot_de_passe = ?");
    $stmt->bind_param("ss", $email, $hashed);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >= 1) return $result->fetch_assoc();
    return null;
}