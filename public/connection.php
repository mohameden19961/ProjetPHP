<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        auth_handleRegister();
    } elseif (isset($_POST['login'])) {
        auth_handleLogin();
    }
}

auth_showLogin();
