<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-users"></i>Gestion des Utilisateurs</h1>
</div>
<div class="card mb-4 fade-in">
    <div class="card-body">
        <form method="GET" class="form-row">
            <input type="hidden" name="view" value="users">
            <div class="form-group mb-0">
                <label class="form-label">Rechercher</label>
                <input type="text" name="search" class="form-control" placeholder="Nom, prénom ou email..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Filtre</label>
                <select name="departement" class="form-control" id="dept-filter">
                    <option value="tous" <?= $departement === 'tous' ? 'selected' : '' ?>>Tous</option>
                    <option value="medecin" <?= $departement === 'medecin' ? 'selected' : '' ?>>Médecins</option>
                    <option value="assistant" <?= $departement === 'assistant' ? 'selected' : '' ?>>Assistants</option>
                </select>
            </div>
            <div class="form-group d-flex align-center mb-0 mt-4">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Rechercher</button>
            </div>
        </form>
    </div>
</div>
<div class="card fade-in">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
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
                    <td><span class="badge badge-<?= $u['rôle'] === 'medecin' ? 'green' : ($u['rôle'] === 'assistant' ? 'orange' : 'blue') ?>"><?= htmlspecialchars($u['rôle']) ?></span></td>
                    <td>
                        <div class="table-actions">
                            <a href="?view=user_details&id=<?= $u['id_utilisateur'] ?>" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a>
                            <button class="btn btn-outline btn-sm text-danger" onclick="confirmDelete(<?= $u['id_utilisateur'] ?>, '<?= htmlspecialchars($u['prenom'] . ' ' . $u['nom']) ?>')"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($allUsers)): ?>
                <tr><td colspan="6" class="text-center text-muted">Aucun utilisateur trouvé</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<form id="deleteForm" method="POST" style="display:none;">
    <input type="hidden" name="user_id" id="deleteUserId">
    <input type="hidden" name="supprimer_utilisateur" value="1">
</form>
<?php require __DIR__ . '/modals.php'; ?>
