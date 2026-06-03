<?php

require_once __DIR__ . '/config/app.php';

if (isAuthenticated()) {
    redirect(securite_getRedirect($_SESSION['role']));
}

redirect(securite_getRedirect(''));
