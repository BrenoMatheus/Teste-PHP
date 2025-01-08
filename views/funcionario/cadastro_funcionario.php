<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/funcionarios.css">
</head>

<body>
    <?php include './views/components/menu.php'; ?>

    <div class="container">
        <h2>Funcionários</h2>

        <div class="form-container">
            <h2>Cadastrar Funcionário</h2>

            <!-- Caixa de mensagens de erro (Inicialmente escondida) -->
            <div id="message" class="error-message"></div>

            <form id="formFuncionario" action="index.php?action=cadastrar_funcionario" method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf">
                </div>

                <div class="form-group">
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg">
                </div>


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="id_empresa">Empresa:</label>
                    <select name="id_empresa" id="id_empresa">
                        <option value="">Selecione uma Empresa</option>
                        <?php
                        // Verifica se há empresas
                        if (isset($empresas) && !empty($empresas)) {
                            // Loop para preencher as opções do select
                            foreach ($empresas as $empresa) {
                                echo "<option value='" . $empresa['id_empresa'] . "'>" . $empresa['nome'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhuma empresa encontrada</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit">Cadastrar</button>
            </form>

        </div>
    </div>

    <?php include './views/components/footer.php'; ?>
    <script src="assets/js/funcionarios.js"></script>
</body>

</html>