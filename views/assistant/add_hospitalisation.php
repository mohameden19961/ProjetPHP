<h2 class="section-title"><i class="fas fa-hospital me-2"></i>Ajouter une Hospitalisation</h2>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=add_hospitalisation">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($patients as $p): ?>
                        <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Médecin <span class="text-danger">*</span></label>
                    <select name="medecin_id" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($medecins as $m): ?>
                        <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date d'admission <span class="text-danger">*</span></label>
                    <input type="date" name="date_admission" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Motif <span class="text-danger">*</span></label>
                    <textarea name="motif" class="form-control" rows="3" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
