<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/AdminService.php';

function admin_handleRequest(): void {
    requireRole('admin');
    $view = $_GET['view'] ?? 'dashboard';
    $stats = adminService_getStats();
    $allUsers = [];
    $userDetails = null;
    $search = $_GET['search'] ?? '';
    $departement = $_GET['departement'] ?? 'tous';

    $adminId = (int)$_SESSION['user_id'];
    $adminProfile = adminService_getProfile($adminId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        admin_handlePost();
        $view = $_GET['view'] ?? 'dashboard';
    }

    if ($view === 'users' || $view === 'patients') {
        $allUsers = adminService_getUsers($view, $search, $departement);
    }

    if ($view === 'user_details' && isset($_GET['id'])) {
        $userDetails = adminService_getUserById((int)$_GET['id']);
    }

    if ($view === 'appointments') {
        $appointments = adminService_getAllRdvs();
    }

    if ($view === 'prescriptions') {
        $prescriptions = adminService_getAllOrdonnances();
    }

    if ($view === 'hospitalized') {
        $hospitalized = adminService_getAllHospitalisations();
    }

    require __DIR__ . '/../views/admin/layout.php';
}

function admin_handlePost(): void {
    if (isset($_POST['ajouter_utilisateur'])) {
        $userId = adminService_addUser($_POST);
        if ($userId) {
            setAlert('success', 'Succès', "Utilisateur ajouté avec succès");
        }
    }

    if (isset($_POST['modifier_utilisateur'])) {
        adminService_updateUser((int)$_POST['user_id'], $_POST);
        setAlert('success', 'Succès', "Utilisateur modifié avec succès");
    }

    if (isset($_POST['update_profile'])) {
        adminService_updateProfile((int)$_SESSION['user_id'], $_POST, $_FILES['profile_picture'] ?? []);
        setAlert('success', 'Succès', "Profil mis à jour avec succès");
    }

    if (isset($_POST['supprimer_utilisateur'])) {
        adminService_deleteUser((int)$_POST['user_id']);
        setAlert('success', 'Succès', "Utilisateur supprimé avec succès");
    }

    if (isset($_POST['ajouter_rdv'])) {
        adminService_addRdv($_POST);
        setAlert('success', 'Succès', "Rendez-vous ajouté avec succès");
    }
}