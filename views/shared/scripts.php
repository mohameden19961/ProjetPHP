<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="assets/js/dashboard.js"></script>
<?php if ($alert = getAlert()): ?>
<script>
Swal.fire({ icon: '<?= $alert['icon'] ?>', title: '<?= $alert['title'] ?>', html: '<?= $alert['text'] ?>', confirmButtonColor: '#2563eb', timer: 3000, timerProgressBar: true });
</script>
<?php endif; ?>