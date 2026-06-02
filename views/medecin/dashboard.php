<h2 class="section-title"><i class="fas fa-tachometer-alt"></i>Tableau de Bord</h2>
<div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-icon blue"><i class="fas fa-calendar-check"></i></div>
        <div class="kpi-label">Prochain RDV</div>
        <?php if ($nextRendezvous): ?>
        <div class="kpi-value"><?= htmlspecialchars($nextRendezvous['date_rdv']) ?></div>
        <div class="kpi-sub"><?= htmlspecialchars($nextRendezvous['heure'] ?? '') ?> - <?= htmlspecialchars($nextRendezvous['prenom'] . ' ' . $nextRendezvous['nom']) ?></div>
        <?php else: ?>
        <div class="kpi-sub">Aucun rendez-vous à venir</div>
        <?php endif; ?>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon green"><i class="fas fa-users"></i></div>
        <div class="kpi-label">Mes Patients</div>
        <div class="kpi-value"><?= count($patients) ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon orange"><i class="fas fa-prescription"></i></div>
        <div class="kpi-label">Ordonnances</div>
        <div class="kpi-value"><?= count($ordonnances) ?></div>
    </div>
</div>
<div class="card-grid">
    <div class="card">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-clock"></i> Prochains Rendez-vous</h5></div>
        <div class="card-body">
            <?php if (count($rendezvous) > 0): ?>
                <?php foreach (array_slice($rendezvous, 0, 5) as $rdv): ?>
                <div class="d-flex justify-between align-center">
                    <div>
                        <strong><?= htmlspecialchars($rdv['date_rdv']) ?> <?= htmlspecialchars($rdv['heure'] ?? '') ?></strong>
                        <br><small><?= htmlspecialchars($rdv['prenom'] . ' ' . $rdv['nom']) ?></small>
                    </div>
                    <span class="badge badge-<?= $rdv['statut'] === 'confirme' ? 'confirme' : 'en_attente' ?>"><?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?></span>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted mb-0">Aucun rendez-vous programmé.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-prescription"></i> Dernières Ordonnances</h5></div>
        <div class="card-body">
            <?php if (count($ordonnances) > 0): ?>
                <?php foreach (array_slice($ordonnances, 0, 5) as $ord): ?>
                <div class="d-flex justify-between align-center">
                    <div>
                        <strong><?= htmlspecialchars($ord['date_ordonnance']) ?></strong>
                        <br><small><?= htmlspecialchars($ord['prenom'] . ' ' . $ord['nom']) ?></small>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted mb-0">Aucune ordonnance récente.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
