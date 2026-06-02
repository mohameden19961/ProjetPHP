<h2 class="section-title"><i class="fas fa-calendar-check"></i>Agenda</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($rendezvousList) > 0): ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Patient</th>
                        <th>Motif</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvousList as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['date_rdv']) ?></td>
                        <td><?= htmlspecialchars($rdv['heure'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($rdv['prenom'] . ' ' . $rdv['nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['motif'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($rdv['lieu'] ?? '-') ?></td>
                        <td>
                            <span class="badge badge-<?= $rdv['statut'] === 'confirme' ? 'confirme' : ($rdv['statut'] === 'annule' ? 'annule' : 'en_attente') ?>">
                                <?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?>
                            </span>
                        </td>
                        <td class="table-actions">
                            <?php if ($rdv['statut'] !== 'annule'): ?>
                            <a href="?section=confirm-rdv&id_rdv=<?= $rdv['id_rdv'] ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            <a href="?section=modifier-rdv&id_rdv=<?= $rdv['id_rdv'] ?>" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i></a>
                            <a href="?section=cancel-rdv&id_rdv=<?= $rdv['id_rdv'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted">Aucun rendez-vous programmé.</p>
        <?php endif; ?>
    </div>
</div>
