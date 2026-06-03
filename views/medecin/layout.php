<?php
$alerts = [];
if (!empty($message)) {
    $isSuccess = ($msgType ?? '') === 'success';
    $alerts[] = ['message' => $message, 'type' => $isSuccess ? 'success' : 'danger', 'icon' => $isSuccess ? 'check-circle' : 'exclamation-triangle'];
}
$layout = [
    'role'            => ROLE_MEDECIN,
    'title'           => 'Espace Médecin',
    'sidebarHeader'   => 'Dr. ' . htmlspecialchars(($medecin['prenom'] ?? '') . ' ' . ($medecin['nom'] ?? '')),
    'sidebarSubtitle' => htmlspecialchars($medecin['spécialité'] ?? ''),
    'navItems'        => [
        ['url' => '?section=dashboard',     'icon' => 'fas fa-th-large',      'label' => 'Dashboard',       'active' => $section === 'dashboard'],
        ['url' => '?section=mes_patients',  'icon' => 'fas fa-users',         'label' => 'Mes Patients',    'active' => $section === 'mes_patients'],
        ['url' => '?section=create-rdv',    'icon' => 'fas fa-calendar-plus', 'label' => 'Nouveau RDV',     'active' => $section === 'create-rdv'],
        ['url' => '?section=agenda',        'icon' => 'fas fa-calendar-check','label' => 'Agenda',          'active' => $section === 'agenda'],
        ['url' => '?section=prescriptions', 'icon' => 'fas fa-prescription',  'label' => 'Ordonnances',     'active' => $section === 'prescriptions'],
        ['url' => '?section=dossiers',      'icon' => 'fas fa-folder-open',   'label' => 'Dossiers Médicaux','active' => $section === 'dossiers'],
    ],
    'view'            => $section,
    'viewMap'         => [
        'dashboard'      => 'dashboard.php',
        'mes_patients'   => 'mes_patients.php',
        'create-rdv'     => 'create_rdv.php',
        'agenda'         => 'agenda.php',
        'prescriptions'  => 'prescriptions.php',
        'dossiers'       => 'dossiers.php',
        'modifier-patient' => 'modifier_patient.php',
        'modifier-rdv'   => 'modifier_rdv.php',
        'cancel-rdv'     => 'cancel_rdv.php',
    ],
    'alerts'          => $alerts,
    'jsFile'          => 'medecin.js',
];
require __DIR__ . '/../shared/base_layout.php';
