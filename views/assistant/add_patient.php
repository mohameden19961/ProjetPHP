<h2 class="section-title"><i class="fas fa-user-plus me-2"></i>Ajouter un Patient</h2>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=add_patient">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" name="date_naissance" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        <option value="Masculin">Masculin</option>
                        <option value="Féminin">Féminin</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Dossier médical</label>
                    <textarea name="dossier_medical" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Ajouter le Patient</button>
                </div>
            </div>
        </form>
    </div>
</div>
