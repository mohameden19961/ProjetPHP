<h2 class="section-title"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</h2>
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card position-relative">
            <i class="fas fa-calendar-check stat-icon"></i>
            <h5>Prochains Rendez-vous</h5>
            <h3><?= count($upcomingRendezvous) ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-card-green position-relative">
            <i class="fas fa-prescription stat-icon"></i>
            <h5>Ordonnances</h5>
            <h3><?= count($ordonnances) ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-card-orange position-relative">
            <i class="fas fa-flask stat-icon"></i>
            <h5>Examens</h5>
            <h3><?= count($examens) ?></h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-clock me-2"></i>Mes Prochains RDV</h5></div>
            <div class="card-body">
                <?php if (count($upcomingRendezvous) > 0): ?>
                <div class="list-group">
                    <?php foreach ($upcomingRendezvous as $rdv): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($rdv['date_rdv']) ?> <?= htmlspecialchars($rdv['heure'] ?? '') ?></strong>
                            <br><small>Dr. <?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></small>
                        </div>
                        <span class="badge bg-<?= $rdv['statut'] === 'confirme' ? 'success' : 'warning' ?>"><?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted mb-0">Aucun rendez-vous programmé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-file-medical me-2"></i>Dernières Ordonnances</h5></div>
            <div class="card-body">
                <?php if (count($ordonnances) > 0): ?>
                <div class="list-group">
                    <?php foreach ($ordonnances as $ord): ?>
                    <div class="list-group-item">
                        <strong><?= htmlspecialchars($ord['date']) ?></strong>
                        <br><small>Dr. <?= htmlspecialchars($ord['medecin_prenom'] . ' ' . $ord['medecin_nom']) ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted mb-0">Aucune ordonnance récente.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
