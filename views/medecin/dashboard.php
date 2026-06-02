<h2 class="section-title"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</h2>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card position-relative">
            <i class="fas fa-calendar-check stat-icon"></i>
            <h5>Prochain RDV</h5>
            <?php if ($nextRendezvous): ?>
            <h3><?= htmlspecialchars($nextRendezvous['date_rdv']) ?></h3>
            <p class="mb-0"><?= htmlspecialchars($nextRendezvous['heure'] ?? '') ?> - <?= htmlspecialchars($nextRendezvous['prenom'] . ' ' . $nextRendezvous['nom']) ?></p>
            <?php else: ?>
            <p class="mb-0">Aucun rendez-vous à venir</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-card-green position-relative">
            <i class="fas fa-users stat-icon"></i>
            <h5>Mes Patients</h5>
            <h3><?= count($patients) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-card-orange position-relative">
            <i class="fas fa-prescription stat-icon"></i>
            <h5>Ordonnances</h5>
            <h3><?= count($ordonnances) ?></h3>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-clock me-2"></i>Prochains Rendez-vous</h5></div>
            <div class="card-body">
                <?php if (count($rendezvous) > 0): ?>
                <div class="list-group">
                    <?php foreach (array_slice($rendezvous, 0, 5) as $rdv): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($rdv['date_rdv']) ?> <?= htmlspecialchars($rdv['heure'] ?? '') ?></strong>
                            <br><small><?= htmlspecialchars($rdv['prenom'] . ' ' . $rdv['nom']) ?></small>
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
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-prescription me-2"></i>Dernières Ordonnances</h5></div>
            <div class="card-body">
                <?php if (count($ordonnances) > 0): ?>
                <div class="list-group">
                    <?php foreach (array_slice($ordonnances, 0, 5) as $ord): ?>
                    <div class="list-group-item">
                        <strong><?= htmlspecialchars($ord['date_ordonnance']) ?></strong>
                        <br><small><?= htmlspecialchars($ord['prenom'] . ' ' . $ord['nom']) ?></small>
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
