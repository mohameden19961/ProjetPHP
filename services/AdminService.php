<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../securite/Hash.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Medecin.php';
require_once __DIR__ . '/../models/Assistant.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Ordonnance.php';
require_once __DIR__ . '/../models/Hospitalisation.php';
require_once __DIR__ . '/../models/Traitement.php';

function adminService_getStats(): array {
    return [
        'patients' => user_countByRole(ROLE_PATIENT),
        'medecins' => user_countByRole(ROLE_MEDECIN),
        'assistants' => user_countByRole(ROLE_ASSISTANT),
        'rdv_aujourdhui' => rdv_countToday(),
        'rdv_prochains' => rdv_countUpcoming(),
        'hospitalises' => hospitalisation_countActive(),
        'ordonnances' => ordonnance_countRecent(),
        'patients_externes' => user_countByRole(ROLE_PATIENT) - hospitalisation_countActive()
    ];
}

function adminService_getProfile(int $userId): ?array {
    return user_findById($userId);
}

function adminService_getUsers(string $view, string $search, string $departement): array {
    if ($view === 'patients') {
        return $search ? user_search($search) : user_findAllByRole(ROLE_PATIENT);
    }
    if ($departement !== 'tous' && !$search) {
        return user_findAllByRole($departement);
    }
    if ($search) {
        return user_search($search);
    }
    return array_merge(user_findAllByRole(ROLE_MEDECIN), user_findAllByRole(ROLE_ASSISTANT));
}

function adminService_getUserById(int $id): ?array {
    return user_findById($id);
}

function adminService_getAllRdvs(): array {
    return rdv_getAll();
}

function adminService_getAllOrdonnances(): array {
    return ordonnance_getAll();
}

function adminService_getAllHospitalisations(): array {
    return hospitalisation_getAllActive();
}

function adminService_updateUser(int $id, array $data): void {
    user_update($id, [
        'nom' => sanitize($data['nom'] ?? ''),
        'prenom' => sanitize($data['prenom'] ?? ''),
        'email' => sanitize($data['email'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? '')
    ]);
}

function adminService_addUser(array $data): ?int {
    $nom = sanitize($data['nom'] ?? '');
    $prenom = sanitize($data['prenom'] ?? '');
    $email = sanitize($data['email'] ?? '');
    $telephone = sanitize($data['telephone'] ?? '');
    $role = sanitize($data[SESS_ROLE] ?? ROLE_PATIENT);
    $password = $data['password'] ?? '';
    if (!$nom || !$prenom || !$email || !$password) return null;
    $userId = user_create(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone, SESS_ROLE => $role]);
    $hashed = securite_hashPassword($password);
    connexion_create($userId, $email, $hashed);
    return $userId;
}

function adminService_updateProfile(int $userId, array $data, array $file): void {
    user_update($userId, [
        'nom' => sanitize($data['nom'] ?? ''),
        'prenom' => sanitize($data['prenom'] ?? ''),
        'email' => sanitize($data['email'] ?? ''),
        'telephone' => sanitize($data['telephone'] ?? '')
    ]);
    if (!empty($file['name'])) {
        $targetDir = "uploads/profiles/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'profile_' . $userId . '_' . time() . '.' . $ext;
        $targetFile = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            user_updatePhoto($userId, $targetFile);
            $_SESSION[SESS_PROFILE_PIC] = $targetFile;
        }
    }
}

function adminService_deleteUser(int $id): void {
    connexion_deleteByUserId($id);
    medecin_delete($id);
    assistant_delete($id);
    user_delete($id);
}

function adminService_addRdv(array $data): void {
    $patientId = (int)($data[SESS_PATIENT_ID] ?? 0);
    $medecinId = (int)($data['medecin_id'] ?? 0);
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $data['date_rdv'], $data['heure'], sanitize($data['lieu'] ?? LIEU_DEFAUT), sanitize($data['motif'] ?? ''));
}
