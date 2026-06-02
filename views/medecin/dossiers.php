<h2 class="section-title"><i class="fas fa-folder-open me-2"></i>Dossiers Médicaux</h2>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-users me-2"></i>Mes Patients</h5></div>
            <div class="card-body">
                <?php if (count($patients) > 0): ?>
                <div class="list-group">
                    <?php foreach ($patients as $p): ?>
                    <a href="?section=dossiers&id=<?= $p['id_patient'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= (isset($_GET['id']) && $_GET['id'] == $p['id_patient']) ? 'active' : '' ?>">
                        <?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted">Aucun patient.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <?php if ($patientToEdit): ?>
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-file-medical me-2"></i>Dossier de <?= htmlspecialchars($patientToEdit['prenom'] . ' ' . $patientToEdit['nom']) ?></h5></div>
            <div class="card-body">
                <p><strong>Email :</strong> <?= htmlspecialchars($patientToEdit['email'] ?? '-') ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($patientToEdit['telephone'] ?? '-') ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($patientToEdit['adresse'] ?? '-') ?></p>
                <p><strong>Date naissance :</strong> <?= htmlspecialchars($patientToEdit['date_naissance'] ?? '-') ?></p>
                <hr>
                <h6>Dossier Médical</h6>
                <p><?= nl2br(htmlspecialchars($patientToEdit['dossier_medical'] ?? 'Aucune information.')) ?></p>
                <a href="?section=modifier-patient&id=<?= $patientToEdit['id_patient'] ?>" class="btn btn-primary"><i class="fas fa-edit me-1"></i>Modifier</a>
            </div>
        </div>
        <?php else: ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                <p class="text-muted">Sélectionnez un patient pour voir son dossier médical.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
