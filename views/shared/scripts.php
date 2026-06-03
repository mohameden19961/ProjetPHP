<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="assets/js/dashboard.js"></script>
<?php if ($alert = getAlert()): ?>
<script>
Swal.fire(<?= json_encode(['icon' => $alert['icon'], 'title' => $alert['title'], 'html' => $alert['text'], 'confirmButtonColor' => '#1a56db', 'timer' => 3000, 'timerProgressBar' => true], JSON_THROW_ON_ERROR) ?>);
</script>
<?php endif; ?>
