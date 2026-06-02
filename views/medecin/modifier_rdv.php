<h2 class="section-title"><i class="fas fa-edit me-2"></i>Modifier le Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <?php if ($rdvToEdit): ?>
        <form method="POST">
            <input type="hidden" name="modifier_rdv" value="1">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input type="date" name="date_rdv" class="form-control" value="<?= htmlspecialchars($rdvToEdit['date_rdv']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Heure</label>
                    <input type="time" name="heure" class="form-control" value="<?= htmlspecialchars($rdvToEdit['heure'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" value="<?= htmlspecialchars($rdvToEdit['lieu'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Motif</label>
                    <input type="text" name="motif" class="form-control" value="<?= htmlspecialchars($rdvToEdit['motif'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                    <a href="?section=agenda" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>
