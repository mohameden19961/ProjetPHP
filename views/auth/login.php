<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Cabinet Médical</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-sidebar">
            <div class="auth-sidebar-content">
                <div class="auth-logo">
                    <div class="auth-logo-icon"><i class="fas fa-heartbeat"></i></div>
                    <span class="auth-logo-text">Cabinet Médical</span>
                </div>
                <h2>Bienvenue sur notre plateforme médicale</h2>
                <p>Un système complet pour gérer vos consultations, patients et rendez-vous en toute simplicité.</p>
                <ul class="auth-features">
                    <li><i class="fas fa-calendar-check"></i> Gestion des rendez-vous en temps réel</li>
                    <li><i class="fas fa-file-medical"></i> Dossiers patients sécurisés</li>
                    <li><i class="fas fa-user-md"></i> Interface adaptée pour médecins et assistants</li>
                    <li><i class="fas fa-bell"></i> Notification automatiques</li>
                    <li><i class="fas fa-shield-alt"></i> Sécurité des données conforme RGPD</li>
                </ul>
            </div>
        </div>
        <div class="auth-form">
            <div class="auth-form-header">
                <h2>Accès au système</h2>
                <p>Connectez-vous ou créez un compte selon votre profil</p>
            </div>
            <div class="auth-tabs">
                <button class="auth-tab <?= empty($formData) ? 'active' : '' ?>" onclick="switchTab('login')">Connexion</button>
                <button class="auth-tab <?= !empty($formData) ? 'active' : '' ?>" onclick="switchTab('register')">Inscription</button>
            </div>
            <div class="auth-form-body">
                <div class="form-panel <?= empty($formData) ? 'active' : '' ?>" id="panel-login">
                    <form method="POST" action="connection.php">
                        <div class="form-group">
                            <label class="form-label" for="login-email">Email</label>
                            <input type="email" id="login-email" name="email" class="form-control" placeholder="votre@email.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="login-password">Mot de passe</label>
                            <div class="password-wrapper">
                                <input type="password" id="login-password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('login-password')"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn-submit"><i class="fas fa-sign-in-alt"></i> Connexion</button>
                        <div class="form-footer">Première visite ? <a href="#" onclick="switchTab('register');return false">Créer un compte</a></div>
                    </form>
                </div>
                <div class="form-panel <?= !empty($formData) ? 'active' : '' ?>" id="panel-register">
                    <form method="POST" action="connection.php" id="registration-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="register-prenom">Prénom</label>
                                <input type="text" id="register-prenom" name="prenom" class="form-control" placeholder="Votre prénom" required value="<?= htmlspecialchars($formData['prenom'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="register-nom">Nom</label>
                                <input type="text" id="register-nom" name="nom" class="form-control" placeholder="Votre nom" required value="<?= htmlspecialchars($formData['nom'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="register-email">Email</label>
                                <input type="email" id="register-email" name="email" class="form-control" placeholder="votre@email.com" required value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="register-phone">Téléphone</label>
                                <input type="tel" id="register-phone" name="telephone" class="form-control" placeholder="Votre numéro" value="<?= htmlspecialchars($formData['telephone'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Vous êtes</label>
                            <div class="role-selector">
                                <div class="role-card <?= (!isset($formData['role']) || $formData['role'] === 'patient') ? 'selected' : '' ?>" data-role="patient" onclick="selectRole('patient')">
                                    <i class="fas fa-user-injured"></i>
                                    <span>Patient</span>
                                </div>
                                <div class="role-card <?= (isset($formData['role']) && $formData['role'] === 'medecin') ? 'selected' : '' ?>" data-role="medecin" onclick="selectRole('medecin')">
                                    <i class="fas fa-user-md"></i>
                                    <span>Médecin</span>
                                </div>
                                <div class="role-card <?= (isset($formData['role']) && $formData['role'] === 'assistant') ? 'selected' : '' ?>" data-role="assistant" onclick="selectRole('assistant')">
                                    <i class="fas fa-user-nurse"></i>
                                    <span>Assistant</span>
                                </div>
                            </div>
                            <div class="auth-code-field <?= (isset($formData['role']) && $formData['role'] !== 'patient') ? 'active' : '' ?>" id="auth-code-field">
                                <label class="form-label" for="auth-code">Code d'autorisation</label>
                                <input type="password" id="auth-code" name="auth_code" class="form-control" placeholder="Code fourni par l'administrateur" value="<?= htmlspecialchars($formData['auth_code'] ?? '') ?>">
                                <small class="error-message">Ce code est obligatoire pour les rôles spéciaux</small>
                            </div>
                            <div id="specialite-medecin" class="auth-code-field <?= (isset($formData['role']) && $formData['role'] === 'medecin') ? 'active' : '' ?>">
                                <label class="form-label" for="specialite-medecin-input">Spécialité médicale</label>
                                <input type="text" id="specialite-medecin-input" name="specialite_medecin" class="form-control" placeholder="Votre spécialité" value="<?= htmlspecialchars($formData['specialite_medecin'] ?? '') ?>">
                            </div>
                            <div id="specialite-assistant" class="auth-code-field <?= (isset($formData['role']) && $formData['role'] === 'assistant') ? 'active' : '' ?>">
                                <label class="form-label" for="specialite-assistant-input">Département</label>
                                <input type="text" id="specialite-assistant-input" name="specialite_assistant" class="form-control" placeholder="Votre département" value="<?= htmlspecialchars($formData['specialite_assistant'] ?? '') ?>">
                            </div>
                            <input type="hidden" id="selected-role" name="role" value="<?= htmlspecialchars($formData['role'] ?? 'patient') ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="register-password">Mot de passe</label>
                                <div class="password-wrapper">
                                    <input type="password" id="register-password" name="password" class="form-control" placeholder="Au moins 8 caractères" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('register-password')"><i class="fas fa-eye"></i></button>
                                </div>
                                <small class="inline-error" id="password-error">Le mot de passe doit contenir au moins 8 caractères</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="register-confirm-password">Confirmer</label>
                                <div class="password-wrapper">
                                    <input type="password" id="register-confirm-password" name="confirm_password" class="form-control" placeholder="Répéter le mot de passe" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('register-confirm-password')"><i class="fas fa-eye"></i></button>
                                </div>
                                <small class="inline-error" id="confirm-password-error">Les mots de passe ne correspondent pas</small>
                            </div>
                        </div>
                        <button type="submit" name="register" class="btn-submit"><i class="fas fa-user-plus"></i> S'inscrire</button>
                        <div class="form-footer">Déjà inscrit ? <a href="#" onclick="switchTab('login');return false">Se connecter</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
    <?php if (isset($formData['role'])): ?>
    selectRole('<?= $formData['role'] ?>');
    <?php else: ?>
    selectRole('patient');
    <?php endif; ?>
    <?php if ($alert = getAlert()): ?>
    Swal.fire({ icon: '<?= $alert['icon'] ?>', title: '<?= $alert['title'] ?>', html: '<?= $alert['text'] ?>', confirmButtonColor: '#2563eb', timer: 3000, timerProgressBar: true });
    <?php endif; ?>
    </script>
    <script src="assets/js/auth.js"></script>
</body>
</html>