<h2 class="section-title"><i class="fas fa-edit me-2"></i>Modifier le Patient</h2>
<?php
$patientId = (int)($_GET['id'] ?? 0);
$patientData = patient_findById($patientId);
if ($patientData):
?>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=update_patient&id=<?= $patientId ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($patientData['prenom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($patientData['nom']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="<?= htmlspecialchars($patientData['date_naissance'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sexe</label>
                    <select name="sexe" class="form-select">
                        <option value="Masculin" <?= ($patientData['sexe'] ?? '') === 'Masculin' ? 'selected' : '' ?>>Masculin</option>
                        <option value="Féminin" <?= ($patientData['sexe'] ?? '') === 'Féminin' ? 'selected' : '' ?>>Féminin</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($patientData['telephone'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($patientData['email'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="<?= htmlspecialchars($patientData['adresse'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Dossier médical</label>
                    <textarea name="dossier_medical" class="form-control" rows="4"><?= htmlspecialchars($patientData['dossier_medical'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                    <a href="?" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php else: ?>
<p class="text-muted">Patient introuvable.</p>
<?php endif; ?>
