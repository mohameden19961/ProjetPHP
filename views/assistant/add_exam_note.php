<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-flask"></i>Ajouter un Examen</h1>
</div>
<div class="card fade-in">
    <div class="card-body">
        <form method="POST" action="?action=add_exam_note">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-control" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($patients as $p): ?>
                        <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Médecin <span class="text-danger">*</span></label>
                    <select name="medecin_id" class="form-control" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($medecins as $m): ?>
                        <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Type d'examen <span class="text-danger">*</span></label>
                    <input type="text" name="type_examen" class="form-control" placeholder="IRM, Scanner, Analyse..." required>
                </div>
                <div class="form-group w-100">
                    <label class="form-label">Résultat</label>
                    <textarea name="resultat" class="form-control" rows="4" placeholder="Résultat de l'examen..."></textarea>
                </div>
                <div class="form-group w-100">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
