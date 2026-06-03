<?php
$alerts = [];
if (!empty($success)) $alerts[] = ['message' => $success, 'type' => 'success', 'icon' => 'check-circle'];
if (!empty($error))   $alerts[] = ['message' => $error,   'type' => 'danger',  'icon' => 'exclamation-triangle'];
$layout = [
    'role'          => ROLE_ASSISTANT,
    'title'         => 'Espace Assistant',
    'sidebarHeader' => 'Assistant',
    'navItems'      => [
        ['url' => '?',                          'icon' => 'fas fa-th-large',      'label' => 'Dashboard',       'active' => $action === ''],
        ['url' => '?action=add_patient',        'icon' => 'fas fa-user-plus',     'label' => 'Ajouter Patient',  'active' => $action === 'add_patient'],
        ['url' => '?action=add_rdv',            'icon' => 'fas fa-calendar-plus', 'label' => 'Ajouter RDV',      'active' => $action === 'add_rdv'],
        ['url' => '?action=rdv_list',           'icon' => 'fas fa-calendar-check','label' => 'Rendez-vous',      'active' => $action === 'rdv_list'],
        ['url' => '?action=add_exam_note',      'icon' => 'fas fa-flask',         'label' => 'Examens',          'active' => $action === 'add_exam_note'],
        ['url' => '?action=add_hospitalisation','icon' => 'fas fa-hospital',      'label' => 'Hospitalisations', 'active' => $action === 'add_hospitalisation'],
    ],
    'view'          => $action,
    'viewMap'       => [
        ''                  => 'dashboard.php',
        'add_patient'       => 'add_patient.php',
        'add_rdv'           => 'add_rdv.php',
        'rdv_list'          => 'rdv_list.php',
        'add_exam_note'     => 'add_exam_note.php',
        'add_hospitalisation'=> 'add_hospitalisation.php',
        'dossier'           => 'dossier.php',
        'update_patient'    => 'update_patient.php',
    ],
    'alerts'        => $alerts,
    'jsFile'        => 'assistant.js',
];
require __DIR__ . '/../shared/base_layout.php';
