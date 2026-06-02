<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = 'Espace Assistant'; require __DIR__ . '/../shared/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/../shared/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Assistant</div>
                <nav class="sidebar-nav">
                    <a class="sidebar-link <?= $action === '' ? 'active' : '' ?>" href="?"><i class="fas fa-th-large"></i> Dashboard</a>
                    <a class="sidebar-link <?= $action === 'add_patient' ? 'active' : '' ?>" href="?action=add_patient"><i class="fas fa-user-plus"></i> Ajouter Patient</a>
                    <a class="sidebar-link <?= $action === 'add_rdv' ? 'active' : '' ?>" href="?action=add_rdv"><i class="fas fa-calendar-plus"></i> Ajouter RDV</a>
                    <a class="sidebar-link <?= $action === 'rdv_list' ? 'active' : '' ?>" href="?action=rdv_list"><i class="fas fa-calendar-check"></i> Rendez-vous</a>
                    <a class="sidebar-link <?= $action === 'add_exam_note' ? 'active' : '' ?>" href="?action=add_exam_note"><i class="fas fa-flask"></i> Examens</a>
                    <a class="sidebar-link <?= $action === 'add_hospitalisation' ? 'active' : '' ?>" href="?action=add_hospitalisation"><i class="fas fa-hospital"></i> Hospitalisations</a>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php if ($success): ?>
            <div class="alert-custom alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="alert-custom alert-danger"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php
            $actionMap = [
                '' => 'dashboard.php',
                'add_patient' => 'add_patient.php',
                'add_rdv' => 'add_rdv.php',
                'rdv_list' => 'rdv_list.php',
                'add_exam_note' => 'add_exam_note.php',
                'add_hospitalisation' => 'add_hospitalisation.php',
                'dossier' => 'dossier.php',
                'update_patient' => 'update_patient.php'
            ];
            $file = $actionMap[$action] ?? 'dashboard.php';
            $viewPath = __DIR__ . "/$file";
            if (file_exists($viewPath)) require $viewPath;
            else require __DIR__ . '/dashboard.php';
            ?>
        </main>
    </div>
    <script src="assets/js/assistant.js"></script>
    <?php require __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>