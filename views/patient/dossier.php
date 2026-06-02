<h2 class="page-title"><i class="fas fa-folder-open"></i>Mon Dossier Médical</h2>
<div class="card">
    <div class="card-body">
        <div class="d-flex gap-4 mb-4">
            <div style="flex:1">
                <p class="detail-static"><strong>Nom :</strong> <?= htmlspecialchars($patient['nom']) ?></p>
                <p class="detail-static"><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenom']) ?></p>
                <p class="detail-static"><strong>Email :</strong> <?= htmlspecialchars($patient['email'] ?? '-') ?></p>
            </div>
            <div style="flex:1">
                <p class="detail-static"><strong>Téléphone :</strong> <?= htmlspecialchars($patient['telephone'] ?? '-') ?></p>
                <p class="detail-static"><strong>Adresse :</strong> <?= htmlspecialchars($patient['adresse'] ?? '-') ?></p>
                <p class="detail-static"><strong>Date naissance :</strong> <?= htmlspecialchars($patient['date_naissance'] ?? '-') ?></p>
            </div>
        </div>
        <hr>
        <h5>Dossier Médical</h5>
        <div class="detail-static">
            <?= nl2br(htmlspecialchars($dossier)) ?>
        </div>
    </div>
</div>
