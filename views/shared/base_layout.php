<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = $layout['title']; require __DIR__ . '/head.html'; ?>
</head>
<body>
    <?php require __DIR__ . '/header.php'; ?>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <?php if ($layout['sidebarHeader'] ?? null): ?>
                <div class="sidebar-label"><?= htmlspecialchars($layout['sidebarHeader']) ?></div>
                <?php endif; ?>
                <?php if ($layout['sidebarSubtitle'] ?? null): ?>
                <small class="sidebar-subtitle text-muted"><?= htmlspecialchars($layout['sidebarSubtitle']) ?></small>
                <?php endif; ?>
                <nav class="sidebar-nav">
                    <?php foreach ($layout['navItems'] as $item): ?>
                    <a class="sidebar-link <?= $item['active'] ?? false ? 'active' : '' ?>" href="<?= htmlspecialchars($item['url']) ?>">
                        <i class="<?= htmlspecialchars($item['icon']) ?>"></i> <?= htmlspecialchars($item['label']) ?>
                    </a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </aside>
        <main class="main-content">
            <?php foreach (($layout['alerts'] ?? []) as $a): ?>
            <div class="alert-custom alert-<?= htmlspecialchars($a['type']) ?>">
                <i class="fas fa-<?= htmlspecialchars($a['icon']) ?>"></i> <?= htmlspecialchars($a['message']) ?>
            </div>
            <?php endforeach; ?>
            <?php
$__file = ($layout['viewMap'][$layout['view']] ?? null) ?: 'dashboard.html';
$__path = __DIR__ . '/../' . $layout['role'] . '/' . $__file;
require file_exists($__path) ? $__path : (__DIR__ . '/../' . $layout['role'] . '/dashboard.html');
            ?>
        </main>
    </div>
    <script src="assets/js/<?= htmlspecialchars($layout['jsFile']) ?>"></script>
    <?php require __DIR__ . '/scripts.php'; ?>
</body>
</html>
