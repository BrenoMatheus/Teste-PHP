document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEmpresa'); // Seleciona o formulário
    const inputNome = document.getElementById('nome'); // Campo de nome da empresa
    const messageBox = document.getElementById('message'); // Caixa de mensagens de erro

    // Adiciona evento no formulário
    form.addEventListener('submit', function (event) {
        let mensagens = []; // Armazena os erros

        // Limpa a mensagem de erro anterior
        messageBox.innerHTML = ''; // Limpa as mensagens anteriores

        // Valida se o nome da empresa foi preenchido
        if (inputNome.value.trim() === '') {
            mensagens.push('O nome da empresa é obrigatório.');
        }

        // Se houver mensagens de erro, impede o envio
        if (mensagens.length > 0) {
            event.preventDefault(); // Impede o envio do formulário
            messageBox.innerHTML = mensagens.join('<br>'); // Exibe as mensagens
            messageBox.style.display = 'block'; // Exibe a caixa de mensagens
        } else {
            // Caso contrário, pode enviar o formulário
            messageBox.style.display = 'none'; // Esconde a mensagem de erro, se houver
        }
    });
});
