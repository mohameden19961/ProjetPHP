<?php

require_once __DIR__ . '/../config/database.php';

function user_findByEmail(string $email): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user ?: null;
}

function user_create(array $data): int {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, telephone, rôle) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data['nom'], $data['prenom'], $data['email'], $data['telephone'], $data['role']);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

function user_findById(int $id): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user ?: null;
}

function user_findAllByRole(string $role): array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE rôle = ? ORDER BY nom, prenom");
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $users;
}

function user_countByRole(string $role): int {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM utilisateur WHERE rôle = ?");
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['total'];
}

function user_getAll(): array {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM utilisateur ORDER BY nom, prenom");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function user_update(int $id, array $data): void {
    $conn = getDbConnection();
    $fields = [];
    $types = '';
    $values = [];
    foreach (['nom', 'prenom', 'email', 'telephone'] as $field) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $types .= 's';
            $values[] = $data[$field];
        }
    }
    if (isset($data['role']) || isset($data['rôle'])) {
        $fields[] = "rôle = ?";
        $types .= 's';
        $values[] = $data['role'] ?? $data['rôle'];
    }
    if (!empty($fields)) {
        $types .= 'i';
        $values[] = $id;
        $stmt = $conn->prepare("UPDATE utilisateur SET " . implode(', ', $fields) . " WHERE id_utilisateur = ?");
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        $stmt->close();
    }
}

function connexion_create(int $idUser, string $login, string $password): void {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO connexion (id_utilisateur, login, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $idUser, $login, $password);
    $stmt->execute();
    $stmt->close();
}

function user_findForLogin(string $login): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT c.id_utilisateur, c.mot_de_passe, u.* FROM connexion c JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur WHERE c.login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >= 1) return $result->fetch_assoc();
    return null;
}

function user_findByLoginAndPassword(string $login, string $password): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT c.id_utilisateur, u.* FROM connexion c JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur WHERE c.login = ? AND c.mot_de_passe = ?");
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >= 1) return $result->fetch_assoc();
    return null;
}

function user_updatePhoto(int $id, string $path): void {
    $conn = getDbConnection();
    $stmt = $conn->prepare("UPDATE utilisateur SET photo_profil = ? WHERE id_utilisateur = ?");
    $stmt->bind_param("si", $path, $id);
    $stmt->execute();
    $stmt->close();
}

function connexion_deleteByUserId(int $idUser): void {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM connexion WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $idUser);
    $stmt->execute();
    $stmt->close();
}

function connexion_findByLogin(string $login): ?array {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT c.id_utilisateur, u.* FROM connexion c JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur WHERE c.login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user ?: null;
}

function user_search(string $query): array {
    $conn = getDbConnection();
    $search = "%$query%";
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? ORDER BY nom, prenom");
    $stmt->bind_param("sss", $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $users;
}

function user_delete(int $id): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
