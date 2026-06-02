document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.stat-card[data-href]').forEach(function(card) {
        card.addEventListener('click', function() {
            window.location.href = this.dataset.href;
        });
    });
    document.querySelectorAll('[data-confirm]').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            var msg = this.dataset.confirm;
            var href = this.href;
            Swal.fire({
                title: 'Confirmation',
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler'
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Confirmer la suppression',
        html: 'Voulez-vous vraiment supprimer <strong>' + name + '</strong> ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#F44336',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById('deleteUserId').value = id;
            document.getElementById('deleteForm').submit();
        }
    });
}