<nav class="navbar-custom">
    <a class="navbar-brand" href="?section=dashboard">
        <div class="navbar-brand-icon"><i class="fas fa-heartbeat"></i></div>
        <span>Cabinet Médical</span>
    </a>
    <div class="navbar-actions">
        <div class="navbar-user">
            <?php $pic = $_SESSION['profile_picture'] ?? ''; ?>
            <?php if ($pic): ?>
            <img src="<?= $pic ?>" alt="" class="navbar-user-avatar">
            <?php else: ?>
            <div class="navbar-user-avatar-placeholder">
                <?= strtoupper(substr($_SESSION['prenom'] ?? '', 0, 1) . substr($_SESSION['nom'] ?? '', 0, 1)) ?>
            </div>
            <?php endif; ?>
            <div class="navbar-user-info">
                <span class="navbar-user-name"><?= htmlspecialchars(($_SESSION['prenom'] ?? '') . ' ' . ($_SESSION['nom'] ?? '')) ?></span>
                <span class="navbar-user-role"><?= htmlspecialchars($_SESSION['role'] ?? '') ?></span>
            </div>
        </div>
        <a href="deconnexion.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Quitter</a>
    </div>
</nav>