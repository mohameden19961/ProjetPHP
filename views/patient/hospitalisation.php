<h2 class="section-title"><i class="fas fa-hospital me-2"></i>Hospitalisation</h2>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Demander une Hospitalisation</h5></div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="creer_hospitalisation" value="1">
                    <div class="mb-3">
                        <label class="form-label">Médecin traitant</label>
                        <select name="medecin_id" class="form-select" required>
                            <option value="">Sélectionner...</option>
                            <?php foreach ($medecins as $m): ?>
                            <option value="<?= $m['id_medecin'] ?>">Dr. <?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date d'admission souhaitée</label>
                        <input type="date" name="date_admission" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motif</label>
                        <textarea name="motif" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i>Envoyer la demande</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-history me-2"></i>Historique des Hospitalisations</h5></div>
            <div class="card-body">
                <?php if (count($hospitalisations) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
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
                                <td><?= $h['date_sortie'] ? htmlspecialchars($h['date_sortie']) : '<span class="badge bg-warning">En cours</span>' ?></td>
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
</div>
