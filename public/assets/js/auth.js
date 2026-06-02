function switchTab(tab) {
    document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('active'));
    if (tab === 'login') {
        document.querySelector('.auth-tab:first-child').classList.add('active');
        document.getElementById('panel-login').classList.add('active');
    } else {
        document.querySelector('.auth-tab:last-child').classList.add('active');
        document.getElementById('panel-register').classList.add('active');
    }
}
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const btn = input.nextElementSibling;
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<i class="fas fa-eye"></i>';
    }
}
function selectRole(role) {
    document.querySelectorAll('#panel-register .role-card').forEach(c => c.classList.remove('selected'));
    document.querySelector('#panel-register .role-card[data-role="' + role + '"]').classList.add('selected');
    document.getElementById('selected-role').value = role;
    document.getElementById('auth-code-field').classList.toggle('active', role !== 'patient');
    document.getElementById('specialite-medecin').classList.toggle('active', role === 'medecin');
    document.getElementById('specialite-assistant').classList.toggle('active', role === 'assistant');
}
const passInput = document.getElementById('register-password');
const confirmInput = document.getElementById('register-confirm-password');
const passError = document.getElementById('password-error');
const confirmError = document.getElementById('confirm-password-error');
function validatePasswords() {
    let valid = true;
    if (passInput.value.length < 8) { passError.classList.add('show-error'); valid = false; }
    else { passError.classList.remove('show-error'); }
    if (passInput.value !== confirmInput.value) { confirmError.classList.add('show-error'); valid = false; }
    else { confirmError.classList.remove('show-error'); }
    return valid;
}
passInput.addEventListener('input', validatePasswords);
confirmInput.addEventListener('input', validatePasswords);
document.getElementById('registration-form').addEventListener('submit', function(e) {
    if (!validatePasswords()) { e.preventDefault(); Swal.fire({ icon: 'error', title: 'Erreur de validation', html: 'Veuillez corriger les erreurs dans le formulaire', confirmButtonColor: '#2563eb' }); }
});