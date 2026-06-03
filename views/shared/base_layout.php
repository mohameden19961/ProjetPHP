<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = $layout['title']; require __DIR__ . '/head.php'; ?>
</head>
<body>
    <?php require __DIR__ . '/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <?php if ($layout['sidebarHeader'] ?? null): ?>
                <div class="sidebar-label"><?= $layout['sidebarHeader'] ?></div>
                <?php endif; ?>
                <?php if ($layout['sidebarSubtitle'] ?? null): ?>
                <small class="sidebar-subtitle text-muted"><?= $layout['sidebarSubtitle'] ?></small>
                <?php endif; ?>
                <nav class="sidebar-nav">
                    <?php foreach ($layout['navItems'] as $item): ?>
                    <a class="sidebar-link <?= $item['active'] ?? false ? 'active' : '' ?>" href="<?= $item['url'] ?>">
                        <i class="<?= $item['icon'] ?>"></i> <?= $item['label'] ?>
                    </a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php foreach (($layout['alerts'] ?? []) as $a): ?>
            <div class="alert-custom alert-<?= $a['type'] ?>">
                <i class="fas fa-<?= $a['icon'] ?>"></i> <?= htmlspecialchars($a['message']) ?>
            </div>
            <?php endforeach; ?>
            <?php
            $__file = ($layout['viewMap'][$layout['view']] ?? null) ?: 'dashboard.php';
            $__path = __DIR__ . '/../' . $layout['role'] . '/' . $__file;
            require file_exists($__path) ? $__path : (__DIR__ . '/../' . $layout['role'] . '/dashboard.php');
            ?>
        </main>
    </div>
    <script src="assets/js/<?= $layout['jsFile'] ?>"></script>
    <?php require __DIR__ . '/scripts.php'; ?>
</body>
</html>
