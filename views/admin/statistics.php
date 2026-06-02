<div class="page-header fade-in">
    <h1 class="page-title"><i class="fas fa-chart-bar"></i>Statistiques</h1>
</div>
<div class="card-grid fade-in">
    <div class="card">
        <div class="card-header"><i class="fas fa-users"></i> Utilisateurs par rôle</div>
        <div class="card-body">
            <canvas id="usersChart" height="200"
                data-labels='["Patients","Médecins","Assistants"]'
                data-values='[<?= $stats['patients'] ?>,<?= $stats['medecins'] ?>,<?= $stats['assistants'] ?>]'>
            </canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><i class="fas fa-activity"></i> Activité récente</div>
        <div class="card-body">
            <canvas id="activityChart" height="200"
                data-labels='["RDV ajd","RDV à venir","Hospitalisés","Ordonnances"]'
                data-values='[<?= $stats['rdv_aujourdhui'] ?>,<?= $stats['rdv_prochains'] ?>,<?= $stats['hospitalises'] ?>,<?= $stats['ordonnances'] ?>]'>
            </canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/admin.js"></script>
