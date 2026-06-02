<h2 class="section-title"><i class="fas fa-calendar-plus me-2"></i>Nouveau Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="creer_rdv" value="1">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($patients as $p): ?>
                        <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date_rdv" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Heure</label>
                    <input type="time" name="heure" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" value="Clinique">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Motif</label>
                    <input type="text" name="motif" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Créer le rendez-vous</button>
                </div>
            </div>
        </form>
    </div>
</div>
