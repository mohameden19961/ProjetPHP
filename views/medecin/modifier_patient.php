<h2 class="section-title"><i class="fas fa-edit me-2"></i>Modifier le Patient</h2>
<div class="card">
    <div class="card-body">
        <?php if ($patientToEdit): ?>
        <form method="POST">
            <input type="hidden" name="modifier_patient" value="1">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($patientToEdit['prenom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($patientToEdit['nom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($patientToEdit['email'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($patientToEdit['telephone'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="<?= htmlspecialchars($patientToEdit['adresse'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Dossier Médical</label>
                    <textarea name="dossier_medical" class="form-control" rows="5"><?= htmlspecialchars($patientToEdit['dossier_medical'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                    <a href="?section=dossiers" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
        <?php else: ?>
        <p class="text-muted">Patient introuvable.</p>
        <a href="?section=mes_patients" class="btn btn-secondary">Retour</a>
        <?php endif; ?>
    </div>
</div>
