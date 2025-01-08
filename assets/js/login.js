document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm'); // Seleciona o formulário
    const loginInput = document.getElementById('login'); // Campo de login
    const senhaInput = document.getElementById('senha'); // Campo de senha
    const messageBox = document.getElementById('message'); // Exibe mensagens

    // Função para validar e-mail
    function validarEmail(email) {
        // Regex aprimorada para validar e-mails
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }

    // Adiciona evento no formulário
    form.addEventListener('submit', function (event) {
        let mensagens = []; // Armazena os erros

        // Valida se o login foi preenchido
        if (loginInput.value.trim() === '') {
            mensagens.push('O campo de login é obrigatório.');
        } else if (!validarEmail(loginInput.value)) {
            mensagens.push('Informe um e-mail válido.');
        }

        // Valida se a senha foi preenchida
        if (senhaInput.value.trim() === '') {
            mensagens.push('O campo de senha é obrigatório.');
        }

        // Se houver mensagens de erro, impede o envio
        if (mensagens.length > 0) {
            event.preventDefault(); // Impede o envio do formulário
            messageBox.innerHTML = mensagens.join('<br>'); // Exibe mensagens
            messageBox.style.display = 'block'; 
        } 
    });
});
