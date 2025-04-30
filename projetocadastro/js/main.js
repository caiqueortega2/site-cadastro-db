// Espera o DOM carregar completamente
document.addEventListener('DOMContentLoaded', () => {
    console.log('Portal CyberSec JS Loaded');

    // --- Validação de Formulário (Exemplo para Bootstrap 5) ---
    const forms = document.querySelectorAll('.needs-validation'); // Se usar a classe do Bootstrap

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated'); // Mostra feedback visual do Bootstrap
        }, false);
    });

    // --- Validação Específica (Ex: Senhas Coincidirem no Registro) ---
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        const password = registerForm.querySelector('#password');
        const passwordConfirm = registerForm.querySelector('#password_confirm');
        const confirmFeedback = passwordConfirm ? passwordConfirm.nextElementSibling : null; // Pega a div de feedback

        if (password && passwordConfirm && confirmFeedback) {
            const validatePasswords = () => {
                if (password.value !== passwordConfirm.value && passwordConfirm.value !== '') {
                    passwordConfirm.setCustomValidity("As senhas não coincidem."); // Define erro customizado
                    passwordConfirm.classList.add('is-invalid'); // Adiciona classe manualmente se necessário
                    confirmFeedback.textContent = "As senhas não coincidem."; // Atualiza texto
                    confirmFeedback.style.display = 'block'; // Força exibição
                } else {
                    passwordConfirm.setCustomValidity(""); // Limpa erro customizado
                    passwordConfirm.classList.remove('is-invalid');
                    confirmFeedback.textContent = "As senhas não coincidem."; // Reseta texto padrão
                     confirmFeedback.style.display = ''; // Deixa o Bootstrap controlar
                }
            };

            password.addEventListener('input', validatePasswords);
            passwordConfirm.addEventListener('input', validatePasswords);

             // Adiciona validação no submit também, caso o usuário não desfoque os campos
             registerForm.addEventListener('submit', (event) => {
                 validatePasswords(); // Roda a validação de senha novamente
                 if (!registerForm.checkValidity()) { // Verifica todas as validações do form
                     event.preventDefault();
                     event.stopPropagation();
                 }
                 registerForm.classList.add('was-validated');
             }, false);

        }
    }

     // Adicionar mais interatividade aqui depois...
});