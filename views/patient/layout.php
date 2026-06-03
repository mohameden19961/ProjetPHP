<?php
$alerts = [];
if (!empty($message)) {
    $isSuccess = ($msgType ?? '') === 'success';
    $alerts[] = ['message' => $message, 'type' => $isSuccess ? 'success' : 'info', 'icon' => $isSuccess ? 'check-circle' : 'info-circle'];
}
$layout = [
    'role'          => ROLE_PATIENT,
    'title'         => 'Espace Patient',
    'sidebarHeader' => 'Mon Espace',
    'navItems'      => [
        ['url' => '?section=dashboard',      'icon' => 'fas fa-th-large',      'label' => 'Dashboard',     'active' => $section === 'dashboard'],
        ['url' => '?section=create-rdv',     'icon' => 'fas fa-calendar-plus', 'label' => 'Nouveau RDV',   'active' => $section === 'create-rdv'],
        ['url' => '?section=upcoming-rdv',   'icon' => 'fas fa-calendar-check','label' => 'Mes RDV',       'active' => $section === 'upcoming-rdv'],
        ['url' => '?section=prescriptions',  'icon' => 'fas fa-prescription',  'label' => 'Ordonnances',   'active' => $section === 'prescriptions'],
        ['url' => '?section=examens',        'icon' => 'fas fa-flask',         'label' => 'Examens',       'active' => $section === 'examens'],
        ['url' => '?section=hospitalisation','icon' => 'fas fa-hospital',      'label' => 'Hospitalisation','active' => $section === 'hospitalisation'],
        ['url' => '?section=dossier',        'icon' => 'fas fa-folder-open',   'label' => 'Dossier',       'active' => $section === 'dossier'],
        ['url' => '?section=modify-profile', 'icon' => 'fas fa-user-edit',     'label' => 'Mon Profil',    'active' => $section === 'modify-profile'],
    ],
    'view'          => $section,
    'viewMap'       => [
        'dashboard'      => 'dashboard.html',
        'create-rdv'     => 'create_rdv.html',
        'upcoming-rdv'   => 'upcoming_rdv.html',
        'prescriptions'  => 'prescriptions.html',
        'examens'        => 'examens.html',
        'hospitalisation'=> 'hospitalisation.html',
        'dossier'        => 'dossier.html',
        'modify-profile' => 'modify_profile.html',
    ],
    'alerts'        => $alerts,
    'jsFile'        => 'patient.js',
];
require __DIR__ . '/../shared/base_layout.php';
