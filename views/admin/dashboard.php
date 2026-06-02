<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-th-large"></i>Tableau de Bord</h1>
</div>
<div class="kpi-row fade-in">
    <div class="kpi-card" data-href="?view=patients">
        <div class="kpi-icon blue"><i class="fas fa-user-injured"></i></div>
        <div class="kpi-label">Patients</div>
        <div class="kpi-value"><?= $stats['patients'] ?></div>
        <div class="kpi-sub"><?= $stats['patients_externes'] ?> externes, <?= $stats['hospitalises'] ?> hospitalisés</div>
    </div>
    <div class="kpi-card" data-href="?view=users&departement=medecin">
        <div class="kpi-icon green"><i class="fas fa-user-md"></i></div>
        <div class="kpi-label">Médecins</div>
        <div class="kpi-value"><?= $stats['medecins'] ?></div>
    </div>
    <div class="kpi-card" data-href="?view=users&departement=assistant">
        <div class="kpi-icon orange"><i class="fas fa-user-nurse"></i></div>
        <div class="kpi-label">Assistants</div>
        <div class="kpi-value"><?= $stats['assistants'] ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon purple"><i class="fas fa-calendar-check"></i></div>
        <div class="kpi-label">RDV Aujourd'hui</div>
        <div class="kpi-value"><?= $stats['rdv_aujourdhui'] ?></div>
        <div class="kpi-sub"><?= $stats['rdv_prochains'] ?> à venir</div>
    </div>
</div>
<div class="card-grid fade-in">
    <div class="card">
        <div class="card-header"><i class="fas fa-bolt"></i> Actions Rapides</div>
        <div class="card-body">
            <div class="d-flex gap-2 flex-column">
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-user-plus"></i> Ajouter un Utilisateur</button>
                <button class="btn btn-outline w-100" data-bs-toggle="modal" data-bs-target="#addRdvModal"><i class="fas fa-calendar-plus"></i> Ajouter un Rendez-vous</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><i class="fas fa-info-circle"></i> Informations</div>
        <div class="card-body">
            <div class="d-flex justify-between align-center mb-3">
                <span class="text-muted">Ordonnances (30 jours)</span>
                <span class="badge badge-blue"><?= $stats['ordonnances'] ?></span>
            </div>
            <div class="d-flex justify-between align-center mb-3">
                <span class="text-muted">Patients hospitalisés</span>
                <span class="badge badge-orange"><?= $stats['hospitalises'] ?></span>
            </div>
            <div class="d-flex justify-between align-center">
                <span class="text-muted">Total utilisateurs</span>
                <span class="badge badge-green"><?= array_sum($stats) ?></span>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/modals.php'; ?>
