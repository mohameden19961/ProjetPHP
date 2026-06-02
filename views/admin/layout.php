<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = 'Dashboard Administrateur'; require __DIR__ . '/../shared/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/../shared/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Navigation</div>
                <nav class="sidebar-nav">
                    <a class="sidebar-link <?= $view === 'dashboard' ? 'active' : '' ?>" href="?view=dashboard"><i class="fas fa-th-large"></i> Tableau de bord</a>
                    <a class="sidebar-link <?= $view === 'users' ? 'active' : '' ?>" href="?view=users"><i class="fas fa-users"></i> Utilisateurs</a>
                    <a class="sidebar-link <?= $view === 'patients' ? 'active' : '' ?>" href="?view=patients"><i class="fas fa-user-injured"></i> Patients</a>
                    <a class="sidebar-link <?= $view === 'appointments' ? 'active' : '' ?>" href="?view=appointments"><i class="fas fa-calendar-check"></i> Rendez-vous</a>
                    <a class="sidebar-link <?= $view === 'hospitalized' ? 'active' : '' ?>" href="?view=hospitalized"><i class="fas fa-hospital"></i> Hospitalisations</a>
                    <a class="sidebar-link <?= $view === 'prescriptions' ? 'active' : '' ?>" href="?view=prescriptions"><i class="fas fa-prescription"></i> Ordonnances</a>
                    <a class="sidebar-link <?= $view === 'statistics' ? 'active' : '' ?>" href="?view=statistics"><i class="fas fa-chart-bar"></i> Statistiques</a>
                    <a class="sidebar-link <?= $view === 'settings' ? 'active' : '' ?>" href="?view=settings"><i class="fas fa-cog"></i> Paramètres</a>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php
            $viewPath = __DIR__ . "/$view.php";
            if (file_exists($viewPath)) {
                require $viewPath;
            } else {
                require __DIR__ . '/dashboard.php';
            }
            ?>
        </main>
    </div>
    <script src="assets/js/admin.js"></script>
    <?php require __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>