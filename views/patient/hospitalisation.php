<h2 class="page-title"><i class="fas fa-hospital"></i>Hospitalisation</h2>
<div class="card-grid">
    <div class="card">
        <div class="card-header"><i class="fas fa-plus-circle"></i>Demander une Hospitalisation</div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="creer_hospitalisation" value="1">
                <div class="form-group">
                    <label class="form-label">Médecin traitant</label>
                    <select name="medecin_id" class="form-control" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach ($medecins as $m): ?>
                        <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Date d'admission souhaitée</label>
                    <input type="date" name="date_admission" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Motif</label>
                    <textarea name="motif" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer la demande</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><i class="fas fa-history"></i>Historique des Hospitalisations</div>
        <div class="card-body">
            <?php if (count($hospitalisations) > 0): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Admission</th>
                            <th>Sortie</th>
                            <th>Motif</th>
                            <th>Médecin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hospitalisations as $h): ?>
                        <tr>
                            <td><?= htmlspecialchars($h['date_entree']) ?></td>
                            <td><?= $h['date_sortie'] ? htmlspecialchars($h['date_sortie']) : '<span class="badge badge-en_cours">En cours</span>' ?></td>
                            <td><?= htmlspecialchars($h['service'] ?? '-') ?></td>
                            <td>Dr. <?= htmlspecialchars(($h['medecin_prenom'] ?? '') . ' ' . ($h['medecin_nom'] ?? '')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted">Aucune hospitalisation.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
