<h2 class="section-title"><i class="fas fa-flask me-2"></i>Ajouter un Examen</h2>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=add_exam_note">
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
                    <label class="form-label">Type d'examen <span class="text-danger">*</span></label>
                    <input type="text" name="type_examen" class="form-control" placeholder="IRM, Scanner, Analyse..." required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Résultat</label>
                    <textarea name="resultat" class="form-control" rows="4" placeholder="Résultat de l'examen..."></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
