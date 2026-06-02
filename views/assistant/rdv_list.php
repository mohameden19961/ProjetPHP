<h2 class="section-title"><i class="fas fa-calendar-check me-2"></i>Liste des Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($rendezvous) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Patient</th>
                        <th>Médecin</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvous as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['date_rdv']) ?></td>
                        <td><?= htmlspecialchars($rdv['heure'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($rdv['patient_prenom'] . ' ' . $rdv['patient_nom']) ?></td>
                        <td>Dr. <?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['motif'] ?? '-') ?></td>
                        <td><span class="badge bg-<?= $rdv['statut'] === 'confirme' ? 'success' : ($rdv['statut'] === 'annule' ? 'danger' : 'warning') ?>"><?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?></span></td>
                        <td>
                            <a href="?action=cancel_rdv&rdv_id=<?= $rdv['id_rdv'] ?>" class="btn btn-sm btn-outline-danger" data-confirm="Annuler ce rendez-vous ?"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted">Aucun rendez-vous trouvé.</p>
        <?php endif; ?>
    </div>
</div>
