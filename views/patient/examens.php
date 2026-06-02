<h2 class="section-title"><i class="fas fa-flask me-2"></i>Mes Examens</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($examens) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Résultat</th>
                        <th>Médecin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($examens as $ex): ?>
                    <tr>
                        <td><?= htmlspecialchars($ex['date']) ?></td>
                        <td><?= htmlspecialchars($ex['type_examen'] ?? '-') ?></td>
                        <td><?= nl2br(htmlspecialchars($ex['description'] ?? '-')) ?></td>
                        <td>Dr. <?= htmlspecialchars($ex['medecin_prenom'] . ' ' . $ex['medecin_nom']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted">Aucun examen.</p>
        <?php endif; ?>
    </div>
</div>
