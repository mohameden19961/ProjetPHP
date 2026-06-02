<h2 class="page-title"><i class="fas fa-calendar-check"></i>Mes Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($upcomingRendezvous) > 0): ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Médecin</th>
                        <th>Motif</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($upcomingRendezvous as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['date_rdv']) ?></td>
                        <td><?= htmlspecialchars($rdv['heure'] ?? '-') ?></td>
                        <td>Dr. <?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['motif'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($rdv['lieu'] ?? '-') ?></td>
                        <td>
                            <span class="badge badge-<?= $rdv['statut'] === 'confirme' ? 'confirme' : ($rdv['statut'] === 'annule' ? 'annule' : 'en_attente') ?>">
                                <?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?>
                            </span>
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
