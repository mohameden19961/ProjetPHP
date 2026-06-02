<!-- Add User Modal -->
<div id="addUserModal" style="display:none;">
    <div class="floating-card">
        <div class="card">
            <form method="POST">
                <div class="card-header d-flex justify-between align-center">
                    <h5 class="card-title mb-0"><i class="fas fa-user-plus"></i> Ajouter un Utilisateur</h5>
                    <button type="button" class="btn btn-outline btn-sm" onclick="document.getElementById('addUserModal').style.display='none'">&times;</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="ajouter_utilisateur" value="1">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control">
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-control">
                                <option value="patient">Patient</option>
                                <option value="medecin">Médecin</option>
                                <option value="assistant">Assistant</option>
                            </select>
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-between gap-2 p-2">
                    <button type="button" class="btn btn-outline" onclick="document.getElementById('addUserModal').style.display='none'">Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add RDV Modal -->
<div id="addRdvModal" style="display:none;">
    <div class="floating-card">
        <div class="card">
            <form method="POST">
                <div class="card-header d-flex justify-between align-center">
                    <h5 class="card-title mb-0"><i class="fas fa-calendar-plus"></i> Ajouter un Rendez-vous</h5>
                    <button type="button" class="btn btn-outline btn-sm" onclick="document.getElementById('addRdvModal').style.display='none'">&times;</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="ajouter_rdv" value="1">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Patient</label>
                            <select name="patient_id" class="form-control" required>
                                <option value="">Sélectionner...</option>
                                <?php
                                $allPatients = patient_getAll();
                                foreach ($allPatients as $p): ?>
                                <option value="<?= $p['id_patient'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Médecin</label>
                            <select name="medecin_id" class="form-control" required>
                                <option value="">Sélectionner...</option>
                                <?php
                                $allMedecins = medecin_getAll();
                                foreach ($allMedecins as $m): ?>
                                <option value="<?= $m['id_medecin'] ?>"><?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" name="date_rdv" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Heure</label>
                            <input type="time" name="heure" class="form-control" required>
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="lieu" class="form-control" value="Clinique">
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label">Motif</label>
                            <textarea name="motif" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-between gap-2 p-2">
                    <button type="button" class="btn btn-outline" onclick="document.getElementById('addRdvModal').style.display='none'">Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
