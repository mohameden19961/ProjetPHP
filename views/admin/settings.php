<h2 class="section-title"><i class="fas fa-wrench me-2"></i>Paramètres</h2>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-cog me-2"></i>Mon Profil</h5>
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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($adminProfile['nom'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($adminProfile['prenom'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($adminProfile['email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($adminProfile['telephone'] ?? '') ?>">
                        </div>
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary mt-3"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-cogs me-2"></i>Paramètres du Système</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Version
                        <span class="badge bg-primary">1.0.0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Base de données
                        <span class="badge bg-success">Connectée</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Mode maintenance
                        <span class="badge bg-secondary">Désactivé</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
