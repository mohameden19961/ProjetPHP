<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-calendar-check"></i>Rendez-vous</h1>
</div>
<div class="card fade-in">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Motif</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $rdv): ?>
                <tr>
                    <td><?= htmlspecialchars($rdv['patient_prenom'] . ' ' . $rdv['patient_nom']) ?></td>
                    <td><?= htmlspecialchars($rdv['medecin_prenom'] . ' ' . $rdv['medecin_nom']) ?></td>
                    <td><?= htmlspecialchars($rdv['date_rdv']) ?></td>
                    <td><?= htmlspecialchars($rdv['heure'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($rdv['motif'] ?? '-') ?></td>
                    <td><span class="badge badge-<?= $rdv['statut'] === 'confirme' ? 'green' : ($rdv['statut'] === 'annule' ? 'red' : 'orange') ?>"><?= htmlspecialchars($rdv['statut'] ?? 'en_attente') ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
