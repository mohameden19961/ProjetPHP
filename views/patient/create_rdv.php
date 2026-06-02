<h2 class="section-title"><i class="fas fa-calendar-plus me-2"></i>Nouveau Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="creer_rdv" value="1">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Médecin</label>
                    <select name="medecin_id" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        <?php
                        $allMedecins = medecin_getAll();
                        foreach ($allMedecins as $m): ?>
                        <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?> (<?= htmlspecialchars($m['spécialité'] ?? 'Généraliste') ?>)</option>
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
                <div class="col-12">
                    <label class="form-label">Motif</label>
                    <textarea name="motif" class="form-control" rows="3" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Prendre Rendez-vous</button>
                </div>
            </div>
        </form>
    </div>
</div>
