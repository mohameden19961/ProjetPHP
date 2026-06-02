document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.stat-card').forEach(function (card) {
        card.addEventListener('click', function () {
            if (this.dataset.href) window.location.href = this.dataset.href;
        });
    });
});
