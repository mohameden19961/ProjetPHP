<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-folder-open"></i>Dossier Patient</h1>
</div>
<?php
$patientId = (int)($_GET['id'] ?? 0);
$patientData = patient_findById($patientId);
if ($patientData):
?>
<div class="card fade-in">
    <div class="card-body">
        <div class="form-row mb-3">
            <div class="form-group">
                <p><strong>Nom :</strong> <?= htmlspecialchars($patientData['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($patientData['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($patientData['email'] ?? '-') ?></p>
            </div>
            <div class="form-group">
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($patientData['telephone'] ?? '-') ?></p>
                <p><strong>Date naissance :</strong> <?= htmlspecialchars($patientData['date_naissance'] ?? '-') ?></p>
                <p><strong>Sexe :</strong> <?= htmlspecialchars($patientData['sexe'] ?? '-') ?></p>
            </div>
        </div>
        <hr>
        <h5>Dossier Médical</h5>
        <p><?= nl2br(htmlspecialchars($patientData['dossier_medical'] ?? 'Aucune information.')) ?></p>
        <a href="?action=update_patient&id=<?= $patientId ?>" class="btn btn-primary"><i class="fas fa-edit"></i>Modifier</a>
        <a href="?" class="btn btn-outline">Retour</a>
    </div>
</div>
<?php else: ?>
<p class="text-muted">Patient introuvable.</p>
<?php endif; ?>
