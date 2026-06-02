<h2 class="section-title"><i class="fas fa-prescription me-2"></i>Mes Ordonnances</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($ordonnances) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Médecin</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordonnances as $ord): ?>
                    <tr>
                        <td><?= htmlspecialchars($ord['date']) ?></td>
                        <td>Dr. <?= htmlspecialchars($ord['medecin_prenom'] . ' ' . $ord['medecin_nom']) ?></td>
                        <td><?= nl2br(htmlspecialchars($ord['description'] ?? '')) ?></td>
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
