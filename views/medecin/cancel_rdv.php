<h2 class="section-title"><i class="fas fa-times-circle me-2"></i>Annuler le Rendez-vous</h2>
<div class="card">
    <div class="card-body">
        <?php if ($rdvInfo): ?>
        <p>Rendez-vous du <strong><?= htmlspecialchars($rdvInfo['date_rdv']) ?></strong> à <strong><?= htmlspecialchars($rdvInfo['heure'] ?? '') ?></strong></p>
        <form method="POST">
            <input type="hidden" name="motif_annulation" value="1">
            <div class="mb-3">
                <label class="form-label">Motif d'annulation</label>
                <textarea name="motif" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger"><i class="fas fa-times me-1"></i>Confirmer l'annulation</button>
            <a href="?section=agenda" class="btn btn-secondary">Retour</a>
        </form>
        <?php endif; ?>
    </div>
</div>
