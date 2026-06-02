<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-tachometer-alt"></i>Dashboard Assistant</h1>
</div>
<div class="kpi-row fade-in">
    <div class="kpi-card">
        <div class="kpi-icon green"><i class="fas fa-users"></i></div>
        <div class="kpi-label">Patients</div>
        <div class="kpi-value"><?= count($patients) ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon blue"><i class="fas fa-calendar-check"></i></div>
        <div class="kpi-label">RDV à venir</div>
        <div class="kpi-value"><?= count($rendezvous) ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon orange"><i class="fas fa-hospital"></i></div>
        <div class="kpi-label">Hospitalisés</div>
        <div class="kpi-value"><?= count($hospitalisations) ?></div>
    </div>
</div>
<div class="card-grid fade-in">
    <div class="card">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-clock"></i> Prochains RDV</h5></div>
        <div class="card-body">
            <?php if (count($rendezvous) > 0): ?>
            <div class="d-flex flex-column gap-2">
                <?php foreach (array_slice($rendezvous, 0, 5) as $rdv): ?>
                <div class="p-2">
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
    <div class="card">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-user-injured"></i> Derniers Patients</h5></div>
        <div class="card-body">
            <?php if (count($patients) > 0): ?>
            <div class="d-flex flex-column gap-2">
                <?php foreach (array_slice($patients, 0, 5) as $p): ?>
                <div class="d-flex justify-between align-center p-2">
                    <?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?>
                    <a href="?action=dossier&id=<?= $p['id_patient'] ?>" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i></a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-muted mb-0">Aucun patient.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-hospital"></i> Hospitalisations en cours</h5></div>
        <div class="card-body">
            <?php if (count($hospitalisations) > 0): ?>
            <div class="d-flex flex-column gap-2">
                <?php foreach (array_slice($hospitalisations, 0, 5) as $h): ?>
                <div class="p-2">
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
