<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-prescription"></i>Ordonnances</h1>
</div>
<div class="card fade-in">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Date</th>
                    <th>Médicaments</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prescriptions as $o): ?>
                <tr>
                    <td><?= htmlspecialchars($o['patient_prenom'] . ' ' . $o['patient_nom']) ?></td>
                    <td><?= htmlspecialchars($o['medecin_prenom'] . ' ' . $o['medecin_nom']) ?></td>
                    <td><?= htmlspecialchars($o['date_ordonnance']) ?></td>
                    <td><?= htmlspecialchars($o['médicaments']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>