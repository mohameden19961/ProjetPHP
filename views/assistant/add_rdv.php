<h2 class="section-title"><i class="fas fa-calendar-plus me-2"></i>Ajouter un Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=add_rdv">
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
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date_rdv" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Heure <span class="text-danger">*</span></label>
                    <input type="time" name="heure" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" value="Clinique A">
                </div>
                <div class="col-12">
                    <label class="form-label">Motif <span class="text-danger">*</span></label>
                    <textarea name="motif" class="form-control" rows="2" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
