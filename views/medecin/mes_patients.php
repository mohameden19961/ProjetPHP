<h2 class="section-title"><i class="fas fa-users"></i>Mes Patients</h2>
<div class="card">
    <div class="card-body">
        <?php if (count($mesPatients) > 0): ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mesPatients as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= htmlspecialchars($p['prenom']) ?></td>
                        <td><?= htmlspecialchars($p['email'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['telephone'] ?? '-') ?></td>
                        <td class="table-actions">
                            <a href="?section=dossiers&id=<?= $p['id_patient'] ?>" class="btn btn-sm btn-outline"><i class="fas fa-folder-open"></i></a>
                            <a href="?section=modifier-patient&id=<?= $p['id_patient'] ?>" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i></a>
                            <a href="?section=mes_patients&action=delete&id=<?= $p['id_patient'] ?>" class="btn btn-sm btn-danger" data-confirm="Supprimer ce patient ?"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted">Aucun patient associé.</p>
        <?php endif; ?>
    </div>
</div>
