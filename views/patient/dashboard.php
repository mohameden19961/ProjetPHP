<h2 class="page-title"><i class="fas fa-calendar-check"></i>Tableau de Bord</h2>
<div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-icon blue"><i class="fas fa-calendar-check"></i></div>
        <div class="kpi-value"><?= count($upcomingRendezvous) ?></div>
        <div class="kpi-label">Prochains Rendez-vous</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon green"><i class="fas fa-prescription"></i></div>
        <div class="kpi-value"><?= count($ordonnances) ?></div>
        <div class="kpi-label">Ordonnances</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon orange"><i class="fas fa-flask"></i></div>
        <div class="kpi-value"><?= count($examens) ?></div>
        <div class="kpi-label">Examens</div>
    </div>
</div>

<div class="card-grid">
    <div class="card">
        <div class="card-header"><i class="fas fa-clock"></i>Mes Prochains RDV</div>
        <div class="card-body">
            <?php if (count($upcomingRendezvous) > 0): ?>
                <?php foreach ($upcomingRendezvous as $rdv): ?>
                <div class="d-flex justify-between align-center mb-2">
                    <div>
                        <strong><?= htmlspecialchars($rdv['date_rdv']) ?> <?= htmlspecialchars($rdv['heure'] ?? '') ?></strong>
                        <br><small>Dr. <?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></small>
                    </div>
                    <span class="badge badge-<?= $rdv['statut'] === 'confirme' ? 'confirme' : 'en_attente' ?>"><?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?></span>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted">Aucun rendez-vous programmé.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><i class="fas fa-file-medical"></i>Dernières Ordonnances</div>
        <div class="card-body">
            <?php if (count($ordonnances) > 0): ?>
                <?php foreach ($ordonnances as $ord): ?>
                <div class="mb-2">
                    <strong><?= htmlspecialchars($ord['date']) ?></strong>
                    <br><small>Dr. <?= htmlspecialchars($ord['medecin_prenom'] . ' ' . $ord['medecin_nom']) ?></small>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted">Aucune ordonnance récente.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
