<h2 class="section-title"><i class="fas fa-prescription me-2"></i>Ordonnances</h2>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nouvelle Ordonnance</h5></div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="ajouter_ordonnance" value="1">
                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <select name="patient_id" class="form-select" required>
                            <option value="">Sélectionner...</option>
                            <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Médicaments</label>
                        <textarea name="medicaments" class="form-control" rows="5" placeholder="Liste des médicaments..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-history me-2"></i>Historique</h5></div>
            <div class="card-body">
                <?php if (count($ordonnances) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Médicaments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ordonnances as $ord): ?>
                            <tr>
                                <td><?= htmlspecialchars($ord['date_ordonnance']) ?></td>
                                <td><?= htmlspecialchars($ord['prenom'] . ' ' . $ord['nom']) ?></td>
                                <td><?= htmlspecialchars(substr($ord['médicaments'], 0, 50)) ?>...</td>
                                <td>
                                    <a href="?section=delete-ordonnance&id_ordonnance=<?= $ord['id_ordonnance'] ?>" class="btn btn-sm btn-outline-danger" data-confirm="Supprimer cette ordonnance ?"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="text-muted">Aucune ordonnance.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
