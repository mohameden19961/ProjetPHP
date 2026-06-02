<h2 class="section-title"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Assistant</h2>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card position-relative">
            <i class="fas fa-users stat-icon"></i>
            <h5>Patients</h5>
            <h3><?= count($patients) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-card-green position-relative">
            <i class="fas fa-calendar-check stat-icon"></i>
            <h5>RDV à venir</h5>
            <h3><?= count($rendezvous) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-card-orange position-relative">
            <i class="fas fa-hospital stat-icon"></i>
            <h5>Hospitalisés</h5>
            <h3><?= count($hospitalisations) ?></h3>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-clock me-2"></i>Prochains RDV</h5></div>
            <div class="card-body">
                <?php if (count($rendezvous) > 0): ?>
                <div class="list-group">
                    <?php foreach (array_slice($rendezvous, 0, 5) as $rdv): ?>
                    <div class="list-group-item">
                        <strong><?= htmlspecialchars($rdv['date_rdv']) ?></strong>
                        <br><small><?= htmlspecialchars($rdv['patient_prenom'] . ' ' . $rdv['patient_nom']) ?> - Dr. <?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted mb-0">Aucun rendez-vous.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-user-injured me-2"></i>Derniers Patients</h5></div>
            <div class="card-body">
                <?php if (count($patients) > 0): ?>
                <div class="list-group">
                    <?php foreach (array_slice($patients, 0, 5) as $p): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?>
                        <a href="?action=dossier&id=<?= $p['id_patient'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted mb-0">Aucun patient.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-hospital me-2"></i>Hospitalisations en cours</h5></div>
            <div class="card-body">
                <?php if (count($hospitalisations) > 0): ?>
                <div class="list-group">
                    <?php foreach (array_slice($hospitalisations, 0, 5) as $h): ?>
                    <div class="list-group-item">
                        <?= htmlspecialchars($h['patient_prenom'] . ' ' . $h['patient_nom']) ?>
                        <br><small><?= htmlspecialchars($h['service'] ?? '-') ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted mb-0">Aucune hospitalisation en cours.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
