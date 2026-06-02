<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-wrench"></i>Paramètres</h1>
</div>
<div class="card-grid fade-in">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user-cog"></i> Mon Profil</h5>
            <form method="POST" enctype="multipart/form-data">
                <div class="text-center mb-3">
                    <?php $photo = $_SESSION['profile_picture'] ?? $adminProfile['photo_profil'] ?? ''; ?>
                    <?php if ($photo): ?>
                    <img src="<?= $photo ?>" alt="Photo de profil" class="profile-image">
                    <?php else: ?>
                    <div class="profile-placeholder">
                        <i class="fas fa-user fa-3x text-muted"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo de profil</label>
                    <input type="file" name="profile_picture" class="form-control" accept="image/*">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($adminProfile['nom'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($adminProfile['prenom'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($adminProfile['email'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($adminProfile['telephone'] ?? '') ?>">
                    </div>
                </div>
                <button type="submit" name="update_profile" class="btn btn-primary mt-3"><i class="fas fa-save"></i>Enregistrer</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-cogs"></i> Paramètres du Système</h5>
            <div class="d-flex flex-column gap-2">
                <div class="d-flex justify-between align-center p-2">
                    <span>Version</span>
                    <span class="badge badge-blue">1.0.0</span>
                </div>
                <div class="d-flex justify-between align-center p-2">
                    <span>Base de données</span>
                    <span class="badge badge-green">Connectée</span>
                </div>
                <div class="d-flex justify-between align-center p-2">
                    <span>Mode maintenance</span>
                    <span class="badge badge-gray">Désactivé</span>
                </div>
            </div>
        </div>
    </div>
</div>
