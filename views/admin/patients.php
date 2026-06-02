<h2 class="section-title"><i class="fas fa-user-injured me-2"></i>Gestion des Patients</h2>
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <input type="hidden" name="view" value="patients">
            <div class="col-md-8">
                <label class="form-label">Rechercher un patient</label>
                <input type="text" name="search" class="form-control" placeholder="Nom, prénom ou email..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i>Rechercher</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
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
                    <?php foreach ($allUsers as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['nom']) ?></td>
                        <td><?= htmlspecialchars($u['prenom']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= htmlspecialchars($u['telephone'] ?? '-') ?></td>
                        <td>
                            <a href="?view=user_details&id=<?= $u['id_utilisateur'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($allUsers)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Aucun patient trouvé</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
