document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: this.dataset.confirm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler'
            }).then(function (result) {
                if (result.isConfirmed) window.location.href = el.href;
            });
        });
    });
});
