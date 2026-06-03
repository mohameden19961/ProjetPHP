<?php
$layout = [
    'role'            => ROLE_ADMIN,
    'title'           => 'Dashboard Administrateur',
    'sidebarHeader'   => 'Navigation',
    'navItems'        => [
        ['url' => '?view=dashboard',     'icon' => 'fas fa-th-large',      'label' => 'Tableau de bord', 'active' => $view === 'dashboard'],
        ['url' => '?view=users',         'icon' => 'fas fa-users',         'label' => 'Utilisateurs',     'active' => $view === 'users'],
        ['url' => '?view=patients',      'icon' => 'fas fa-user-injured',  'label' => 'Patients',        'active' => $view === 'patients'],
        ['url' => '?view=appointments',  'icon' => 'fas fa-calendar-check','label' => 'Rendez-vous',      'active' => $view === 'appointments'],
        ['url' => '?view=hospitalized',  'icon' => 'fas fa-hospital',      'label' => 'Hospitalisations', 'active' => $view === 'hospitalized'],
        ['url' => '?view=prescriptions', 'icon' => 'fas fa-prescription',  'label' => 'Ordonnances',      'active' => $view === 'prescriptions'],
        ['url' => '?view=statistics',    'icon' => 'fas fa-chart-bar',     'label' => 'Statistiques',    'active' => $view === 'statistics'],
        ['url' => '?view=settings',      'icon' => 'fas fa-cog',           'label' => 'Paramètres',      'active' => $view === 'settings'],
    ],
    'view'            => $view,
    'viewMap'         => [
        'dashboard'     => 'dashboard.html',
        'users'         => 'users.php',
        'patients'      => 'patients.html',
        'appointments'  => 'appointments.html',
        'hospitalized'  => 'hospitalized.html',
        'prescriptions' => 'prescriptions.html',
        'statistics'    => 'statistics.html',
        'settings'      => 'settings.php',
        'user_details'  => 'user_details.html',
    ],
    'jsFile'          => 'admin.js',
];
require __DIR__ . '/../shared/base_layout.php';
