<h2 class="section-title"><i class="fas fa-folder-open me-2"></i>Mon Dossier Médical</h2>
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($patient['email'] ?? '-') ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($patient['telephone'] ?? '-') ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($patient['adresse'] ?? '-') ?></p>
                <p><strong>Date naissance :</strong> <?= htmlspecialchars($patient['date_naissance'] ?? '-') ?></p>
            </div>
        </div>
        <hr>
        <h5>Dossier Médical</h5>
        <div class="p-3 bg-light rounded">
            <?= nl2br(htmlspecialchars($dossier)) ?>
        </div>
    </div>
</div>
