<h2 class="section-title"><i class="fas fa-user-edit me-2"></i>Modifier mon Profil</h2>
<div class="card">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="modifier_profil" value="1">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($patient['prenom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($patient['nom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($patient['telephone'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="<?= htmlspecialchars($patient['adresse'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
