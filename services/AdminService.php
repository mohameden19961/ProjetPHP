<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../securite/Hash.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Rendezvous.php';
require_once __DIR__ . '/../models/Ordonnance.php';
require_once __DIR__ . '/../models/Hospitalisation.php';

function adminService_getStats(): array {
    return [
        'patients' => user_countByRole('patient'),
        'medecins' => user_countByRole('medecin'),
        'assistants' => user_countByRole('assistant'),
        'rdv_aujourdhui' => rdv_countToday(),
        'rdv_prochains' => rdv_countUpcoming(),
        'hospitalises' => hospitalisation_countActive(),
        'ordonnances' => ordonnance_countRecent(),
        'patients_externes' => user_countByRole('patient') - hospitalisation_countActive()
    ];
}

function adminService_getProfile(int $userId): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT nom, prenom, email, telephone, photo_profil FROM utilisateur WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result ?: null;
}

function adminService_getUsers(string $view, string $search, string $departement): array {
    if ($view === 'patients') {
        return $search ? user_search($search) : user_findAllByRole('patient');
    }
    if ($departement !== 'tous' && !$search) {
        return user_findAllByRole($departement);
    }
    if ($search) {
        return user_search($search);
    }
    return array_merge(user_findAllByRole('medecin'), user_findAllByRole('assistant'));
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
    $conn = getDbConnection();
    $nom = sanitize($data['nom'] ?? '');
    $prenom = sanitize($data['prenom'] ?? '');
    $email = sanitize($data['email'] ?? '');
    $telephone = sanitize($data['telephone'] ?? '');
    $stmt = $conn->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id_utilisateur = ?");
    $stmt->bind_param("ssssi", $nom, $prenom, $email, $telephone, $id);
    $stmt->execute();
    $stmt->close();
    setAlert('success', 'Succès', "Utilisateur modifié avec succès");
}

function adminService_addUser(array $data): void {
    $nom = sanitize($data['nom'] ?? '');
    $prenom = sanitize($data['prenom'] ?? '');
    $email = sanitize($data['email'] ?? '');
    $telephone = sanitize($data['telephone'] ?? '');
    $role = sanitize($data['role'] ?? 'patient');
    $password = $data['password'] ?? '';
    if (!$nom || !$prenom || !$email || !$password) return;
    $conn = getDbConnection();
    $userId = user_create(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone, 'role' => $role]);
    $hashed = securite_hashPassword($password);
    $stmt = $conn->prepare("INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $email, $hashed);
    $stmt->execute();
    $stmt->close();
    setAlert('success', 'Succès', "Utilisateur $prenom $nom ajouté avec succès");
}

function adminService_updateProfile(int $userId, array $data, array $file): void {
    $conn = getDbConnection();
    $nom = sanitize($data['nom'] ?? '');
    $prenom = sanitize($data['prenom'] ?? '');
    $email = sanitize($data['email'] ?? '');
    $telephone = sanitize($data['telephone'] ?? '');
    $stmt = $conn->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id_utilisateur = ?");
    $stmt->bind_param("ssssi", $nom, $prenom, $email, $telephone, $userId);
    $stmt->execute();
    if (!empty($file['name'])) {
        $targetDir = "uploads/profiles/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'profile_' . $userId . '_' . time() . '.' . $ext;
        $targetFile = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $stmt2 = $conn->prepare("UPDATE utilisateur SET photo_profil = ? WHERE id_utilisateur = ?");
            $stmt2->bind_param("si", $targetFile, $userId);
            $stmt2->execute();
            $_SESSION['profile_picture'] = $targetFile;
        }
    }
    setAlert('success', 'Succès', "Profil mis à jour avec succès");
}

function adminService_deleteUser(int $id): void {
    $conn = getDbConnection();
    $conn->query("DELETE FROM connexion WHERE id_utilisateur=$id");
    $conn->query("DELETE FROM assistant WHERE id_utilisateur=$id");
    $conn->query("DELETE FROM medecin WHERE id_medecin=$id");
    $conn->query("DELETE FROM utilisateur WHERE id_utilisateur=$id");
    setAlert('success', 'Succès', "Utilisateur supprimé avec succès");
}

function adminService_addRdv(array $data): void {
    $patientId = (int)($data['patient_id'] ?? 0);
    $medecinId = (int)($data['medecin_id'] ?? 0);
    require_once __DIR__ . '/../models/Traitement.php';
    $idTraitement = traitement_findOrCreate($patientId, $medecinId);
    rdv_create($idTraitement, $data['date_rdv'], $data['heure'], sanitize($data['lieu'] ?? 'Clinique'), sanitize($data['motif'] ?? ''));
    setAlert('success', 'Succès', "Rendez-vous ajouté avec succès");
}