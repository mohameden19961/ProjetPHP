<h2 class="section-title"><i class="fas fa-folder-open me-2"></i>Dossier Patient</h2>
<?php
$patientId = (int)($_GET['id'] ?? 0);
$patientData = patient_findById($patientId);
if ($patientData):
?>
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Nom :</strong> <?= htmlspecialchars($patientData['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($patientData['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($patientData['email'] ?? '-') ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($patientData['telephone'] ?? '-') ?></p>
                <p><strong>Date naissance :</strong> <?= htmlspecialchars($patientData['date_naissance'] ?? '-') ?></p>
                <p><strong>Sexe :</strong> <?= htmlspecialchars($patientData['sexe'] ?? '-') ?></p>
            </div>
        </div>
        <hr>
        <h5>Dossier Médical</h5>
        <p><?= nl2br(htmlspecialchars($patientData['dossier_medical'] ?? 'Aucune information.')) ?></p>
        <a href="?action=update_patient&id=<?= $patientId ?>" class="btn btn-primary"><i class="fas fa-edit me-1"></i>Modifier</a>
        <a href="?" class="btn btn-secondary">Retour</a>
    </div>
</div>
<?php else: ?>
<p class="text-muted">Patient introuvable.</p>
<?php endif; ?>
