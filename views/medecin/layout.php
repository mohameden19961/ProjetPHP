<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = 'Espace Médecin'; require __DIR__ . '/../shared/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/../shared/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Dr. <?= htmlspecialchars($medecin['prenom'] . ' ' . $medecin['nom']) ?></div>
                <small class="text-muted d-block mb-2 sidebar-subtitle"><?= htmlspecialchars($medecin['spécialité'] ?? '') ?></small>
                <nav class="sidebar-nav">
                    <a class="sidebar-link <?= $section === 'dashboard' ? 'active' : '' ?>" href="?section=dashboard"><i class="fas fa-th-large"></i> Dashboard</a>
                    <a class="sidebar-link <?= $section === 'mes_patients' ? 'active' : '' ?>" href="?section=mes_patients"><i class="fas fa-users"></i> Mes Patients</a>
                    <a class="sidebar-link <?= $section === 'create-rdv' ? 'active' : '' ?>" href="?section=create-rdv"><i class="fas fa-calendar-plus"></i> Nouveau RDV</a>
                    <a class="sidebar-link <?= $section === 'agenda' ? 'active' : '' ?>" href="?section=agenda"><i class="fas fa-calendar-check"></i> Agenda</a>
                    <a class="sidebar-link <?= $section === 'prescriptions' ? 'active' : '' ?>" href="?section=prescriptions"><i class="fas fa-prescription"></i> Ordonnances</a>
                    <a class="sidebar-link <?= $section === 'dossiers' ? 'active' : '' ?>" href="?section=dossiers"><i class="fas fa-folder-open"></i> Dossiers Médicaux</a>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php if ($message): ?>
            <div class="alert alert-<?= $msg_type === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>
            <?php
            $sectionMap = [
                'dashboard' => 'dashboard.php',
                'mes_patients' => 'mes_patients.php',
                'create-rdv' => 'create_rdv.php',
                'agenda' => 'agenda.php',
                'prescriptions' => 'prescriptions.php',
                'dossiers' => 'dossiers.php',
                'modifier-patient' => 'modifier_patient.php',
                'modifier-rdv' => 'modifier_rdv.php',
                'cancel-rdv' => 'cancel_rdv.php'
            ];
            $file = $sectionMap[$section] ?? 'dashboard.php';
            $viewPath = __DIR__ . "/$file";
            if (file_exists($viewPath)) require $viewPath;
            else require __DIR__ . '/dashboard.php';
            ?>
        </main>
    </div>
    <?php require __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>