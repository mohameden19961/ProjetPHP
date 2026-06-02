<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Ajouter un Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ajouter_utilisateur" value="1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-select">
                                <option value="patient">Patient</option>
                                <option value="medecin">Médecin</option>
                                <option value="assistant">Assistant</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add RDV Modal -->
<div class="modal fade" id="addRdvModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-plus me-2"></i>Ajouter un Rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ajouter_rdv" value="1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Patient</label>
                            <select name="patient_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                <?php
                                $allPatients = patient_getAll();
                                foreach ($allPatients as $p): ?>
                                <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Médecin</label>
                            <select name="medecin_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                <?php
                                $allMedecins = medecin_getAll();
                                foreach ($allMedecins as $m): ?>
                                <option value="<?= $m['id_medecin'] ?>"><?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date_rdv" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Heure</label>
                            <input type="time" name="heure" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="lieu" class="form-control" value="Clinique">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Motif</label>
                            <textarea name="motif" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
