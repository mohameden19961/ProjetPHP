<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = 'Espace Patient'; require __DIR__ . '/../shared/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/../shared/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Mon Espace</div>
                <nav class="sidebar-nav">
                    <a class="sidebar-link <?= $section === 'dashboard' ? 'active' : '' ?>" href="?section=dashboard"><i class="fas fa-th-large"></i> Dashboard</a>
                    <a class="sidebar-link <?= $section === 'create-rdv' ? 'active' : '' ?>" href="?section=create-rdv"><i class="fas fa-calendar-plus"></i> Nouveau RDV</a>
                    <a class="sidebar-link <?= $section === 'upcoming-rdv' ? 'active' : '' ?>" href="?section=upcoming-rdv"><i class="fas fa-calendar-check"></i> Mes RDV</a>
                    <a class="sidebar-link <?= $section === 'prescriptions' ? 'active' : '' ?>" href="?section=prescriptions"><i class="fas fa-prescription"></i> Ordonnances</a>
                    <a class="sidebar-link <?= $section === 'examens' ? 'active' : '' ?>" href="?section=examens"><i class="fas fa-flask"></i> Examens</a>
                    <a class="sidebar-link <?= $section === 'hospitalisation' ? 'active' : '' ?>" href="?section=hospitalisation"><i class="fas fa-hospital"></i> Hospitalisation</a>
                    <a class="sidebar-link <?= $section === 'dossier' ? 'active' : '' ?>" href="?section=dossier"><i class="fas fa-folder-open"></i> Dossier</a>
                    <a class="sidebar-link <?= $section === 'modify-profile' ? 'active' : '' ?>" href="?section=modify-profile"><i class="fas fa-user-edit"></i> Mon Profil</a>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php if ($message): ?>
            <div class="alert-custom alert-<?= $msg_type === 'success' ? 'success' : 'info' ?>">
                <i class="fas fa-<?= $msg_type === 'success' ? 'check-circle' : 'info-circle' ?>"></i>
                <?= htmlspecialchars($message) ?>
            </div>
            <?php endif; ?>
            <?php
            $sectionMap = [
                'dashboard' => 'dashboard.php',
                'create-rdv' => 'create_rdv.php',
                'upcoming-rdv' => 'upcoming_rdv.php',
                'prescriptions' => 'prescriptions.php',
                'examens' => 'examens.php',
                'hospitalisation' => 'hospitalisation.php',
                'dossier' => 'dossier.php',
                'modify-profile' => 'modify_profile.php'
            ];
            $file = $sectionMap[$section] ?? 'dashboard.php';
            $viewPath = __DIR__ . "/$file";
            if (file_exists($viewPath)) require $viewPath;
            else require __DIR__ . '/dashboard.php';
            ?>
        </main>
    </div>
    <script src="assets/js/patient.js"></script>
    <?php require __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>