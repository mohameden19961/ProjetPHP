<?php

require_once __DIR__ . '/../config/app.php';

// Route based on session role
if (isAuthenticated()) {
    $redirect = match ($_SESSION['role']) {
        'admin' => 'dashboard_administrateur.php',
        'medecin' => 'medecin.php',
        'patient' => 'patient.php',
        'assistant' => 'assistant.php',
        default => 'connection.php'
    };
    redirect($redirect);
}

redirect('connection.php');
