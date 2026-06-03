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
        'dashboard'      => 'dashboard.html',
        'mes_patients'   => 'mes_patients.html',
        'create-rdv'     => 'create_rdv.html',
        'agenda'         => 'agenda.html',
        'prescriptions'  => 'prescriptions.html',
        'dossiers'       => 'dossiers.html',
        'modifier-patient' => 'modifier_patient.html',
        'modifier-rdv'   => 'modifier_rdv.html',
        'cancel-rdv'     => 'cancel_rdv.html',
    ],
    'alerts'          => $alerts,
    'jsFile'          => 'medecin.js',
];
require __DIR__ . '/../shared/base_layout.php';
