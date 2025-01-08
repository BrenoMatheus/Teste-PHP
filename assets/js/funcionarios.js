document.addEventListener('DOMContentLoaded', function () {
    // Função para validar email
    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex para email válido
        return regex.test(email);
    }

    // Função para validar CPF (considerando CPF válido com 11 dígitos numéricos)
    function validarCPF(cpf) {
        // Remove tudo o que não for número (como pontos e traços)
        cpf = cpf.replace(/\D/g, "");
        
        // Verifica se o CPF tem exatamente 11 dígitos numéricos
        const regex = /^\d{11}$/; // Deve ter exatamente 11 dígitos numéricos
        return regex.test(cpf);
    }

    // Função para validar RG (somente 9 dígitos numéricos + 1 dígito verificador)
    function validarRG(rg) {
        // Se o RG estiver vazio, pula a validação
        if (!rg || rg.trim() === "") return true;

        // Remove tudo o que não for número (como pontos e traços)
        rg = rg.replace(/\D/g, "");
        
        // Verifica se o RG tem exatamente 9 dígitos numéricos + 1 dígito verificador
        const regex = /^\d{9}$/; // Deve ter exatamente 9 dígitos numéricos
        return regex.test(rg);
    }

    // Função para verificar se o campo está vazio
    function validarCampoVazio(campo) {
        return campo.trim() !== "";
    }

    // Função para exibir a mensagem de erro
    function exibirMensagemErro(mensagem) {
        const messageBox = document.getElementById("message");
        messageBox.innerHTML = mensagem;
        messageBox.style.display = 'block'; // Exibe a mensagem
    }

    // Função para esconder a mensagem de erro
    function esconderMensagemErro() {
        const messageBox = document.getElementById("message");
        messageBox.style.display = 'none'; // Esconde a mensagem
    }

    // Função para formatar o CPF automaticamente enquanto o usuário digita
    function formatarCPF(cpf) {
        // Remove qualquer coisa que não seja número
        cpf = cpf.replace(/\D/g, "");
        // Formata para o padrão xxx.xxx.xxx-xx
        if (cpf.length <= 3) {
            return cpf;
        } else if (cpf.length <= 6) {
            return cpf.substring(0, 3) + "." + cpf.substring(3, 6);
        } else if (cpf.length <= 9) {
            return cpf.substring(0, 3) + "." + cpf.substring(3, 6) + "." + cpf.substring(6, 9);
        } else {
            return cpf.substring(0, 3) + "." + cpf.substring(3, 6) + "." + cpf.substring(6, 9) + "-" + cpf.substring(9, 11);
        }
    }

    // Função para formatar o RG automaticamente enquanto o usuário digita
    function formatarRG(rg) {
        // Remove qualquer coisa que não seja número
        rg = rg.replace(/\D/g, "");
        // Formata para o padrão xx.xxx.xxx-x
        if (rg.length <= 2) {
            return rg;
        } else if (rg.length <= 5) {
            return rg.substring(0, 2) + "." + rg.substring(2, 5);
        } else if (rg.length <= 8) {
            return rg.substring(0, 2) + "." + rg.substring(2, 5) + "." + rg.substring(5, 8);
        } else {
            return rg.substring(0, 2) + "." + rg.substring(2, 5) + "." + rg.substring(5, 8) + "-" + rg.substring(8, 9);
        }
    }

    // Função para remover a formatação do CPF antes de enviar o formulário
    function removerFormatacaoCPF(cpf) {
        return cpf.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    }

    // Função para remover a formatação do RG antes de enviar o formulário
    function removerFormatacaoRG(rg) {
        return rg.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    }

    // Adicionar evento ao campo CPF para formatar enquanto o usuário digita
    const cpfField = document.getElementById("cpf");
    cpfField.addEventListener("input", function() {
        let cpf = cpfField.value;
        cpf = formatarCPF(cpf); // Formatar CPF
        cpfField.value = cpf; // Atualiza o valor do campo
    });

    // Adicionar evento ao campo RG para formatar enquanto o usuário digita
    const rgField = document.getElementById("rg");
    rgField.addEventListener("input", function() {
        let rg = rgField.value;
        rg = formatarRG(rg); // Formatar RG
        rgField.value = rg; // Atualiza o valor do campo
    });

    // Função principal de validação
    function validarFormulario(event) {
        console.log('Validando o formulário');
        // Limpar a mensagem de erro antes de validar
        esconderMensagemErro();
        
        let mensagensErro = [];
        
        // Obter os valores dos campos
        const nome = document.getElementById("nome").value;
        let cpf = document.getElementById("cpf").value;
        let rg = document.getElementById("rg").value; // Novo campo RG
        const email = document.getElementById("email").value;
        const empresa = document.getElementById("id_empresa").value;
        
        // Remover a formatação do CPF antes de enviar
        cpf = removerFormatacaoCPF(cpf);
        // Remover a formatação do RG antes de enviar
        rg = removerFormatacaoRG(rg);

        // Verificar se todos os campos obrigatórios foram preenchidos
        if (!validarCampoVazio(nome) || !validarCampoVazio(cpf) || !validarCampoVazio(email) || !validarCampoVazio(empresa)) {
            mensagensErro.push("Todos os campos obrigatórios devem ser preenchidos.");
        }

        // Validações específicas
        if (validarCampoVazio(nome)) {
            if (!validarCPF(cpf)) {
                mensagensErro.push("O CPF deve estar no formato xxx.xxx.xxx-xx.");
            }
            
            if (!validarEmail(email)) {
                mensagensErro.push("O e-mail fornecido não é válido.");
            }

            // Validação do RG somente se preenchido
            if (rg && !validarRG(rg)) {
                mensagensErro.push("O RG deve conter exatamente 9 dígitos numéricos.");
            }
        }
        
        // Se houver mensagens de erro, exibe e impede o envio
        if (mensagensErro.length > 0) {
            event.preventDefault(); // Impede o envio do formulário
            exibirMensagemErro(mensagensErro.join("<br>")); // Exibe as mensagens de erro
        } 
    }

    // Adicionar evento ao formulário
    const formulario = document.querySelector("form");
    formulario.addEventListener("submit", validarFormulario);
});
