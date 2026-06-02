document.addEventListener('DOMContentLoaded', function() {
    var usersChart = document.getElementById('usersChart');
    var activityChart = document.getElementById('activityChart');
    if (usersChart) {
        new Chart(usersChart, {
            type: 'doughnut',
            data: {
                labels: usersChart.dataset.labels.split(','),
                datasets: [{
                    data: usersChart.dataset.values.split(',').map(Number),
                    backgroundColor: ['#2563eb', '#16a34a', '#ea580c']
                }]
            }
        });
    }
    if (activityChart) {
        new Chart(activityChart, {
            type: 'bar',
            data: {
                labels: activityChart.dataset.labels.split(','),
                datasets: [{
                    data: activityChart.dataset.values.split(',').map(Number),
                    backgroundColor: ['#2563eb', '#16a34a', '#ea580c', '#9333ea']
                }]
            }
        });
    }
    var deptFilter = document.getElementById('dept-filter');
    if (deptFilter) {
        deptFilter.addEventListener('change', function() {
            this.form.submit();
        });
    }
});
function confirmDelete(userId, userName) {
    Swal.fire({
        title: 'Confirmer la suppression',
        html: 'Supprimer <strong>' + userName + '</strong> ?<br>Cette action est irréversible.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteUserId').value = userId;
            document.getElementById('deleteForm').submit();
        }
    });
}
