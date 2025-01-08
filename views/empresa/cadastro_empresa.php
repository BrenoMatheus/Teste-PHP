<div class="form-container">
    <h2>Cadastrar Empresa</h2>

    <!-- Caixa de mensagens (erro ou sucesso) -->
    <div id="message" class="error-message"></div>

    <form id="formEmpresa" action="index.php?action=cadastrar_empresa" method="POST">
        <div class="form-group">
            <label for="nome">Nome da Empresa:</label>
            <input type="text" id="nome" name="nome" >
        </div>

        <button type="submit">Cadastrar</button>

    </form>
</div>
