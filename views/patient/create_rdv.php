<h2 class="page-title"><i class="fas fa-calendar-plus"></i>Nouveau Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="creer_rdv" value="1">
            <div class="d-flex gap-3">
                <div class="form-group" style="flex:2">
                    <label class="form-label">Médecin</label>
                    <select name="medecin_id" class="form-control" required>
                        <option value="">Sélectionner...</option>
                        <?php
                        $allMedecins = medecin_getAll();
                        foreach ($allMedecins as $m): ?>
                        <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?> (<?= htmlspecialchars($m['spécialité'] ?? 'Généraliste') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" style="flex:1">
                    <label class="form-label">Date</label>
                    <input type="date" name="date_rdv" class="form-control" required>
                </div>
                <div class="form-group" style="flex:1">
                    <label class="form-label">Heure</label>
                    <input type="time" name="heure" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Motif</label>
                <textarea name="motif" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Prendre Rendez-vous</button>
        </form>
    </div>
</div>
