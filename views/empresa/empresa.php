<?php
session_start(); // Inicia a sessão

// Verifica se existe uma mensagem de erro na sessão e a exibe usando um alert do JavaScript
if (isset($_SESSION['mensagem_erro'])) {
    echo '<script type="text/javascript">alert("' . addslashes($_SESSION['mensagem_erro']) . '");</script>';
    unset($_SESSION['mensagem_erro']); // Limpa a mensagem de erro após exibição
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/empresas.css">
</head>
<body>
<?php include './views/components/menu.php'; ?>

<div class="container">
    <h2>Empresas</h2>

    <!-- Formulário de Cadastro -->
    <div class="form-container">
        <?php include './views/empresa/cadastro_empresa.php'; ?>
    </div>

    <!-- Tabela de Empresas -->
    <div class="table-container">
        <h2>Lista de Empresas</h2>
        <?php if (isset($mensagem)) : ?>
                <div style="color: red; margin: 10px 0;">
                    <?php echo htmlspecialchars($mensagem); ?>
                </div>
            <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($empresas) && !empty($empresas)) {
                    foreach ($empresas as $empresa) {
                        echo "<tr>";
                        echo "<td>" . $empresa['id_empresa'] . "</td>";
                        echo "<td>" . $empresa['nome'] . "</td>";
                        echo "<td><a href='index.php?action=excluir_empresa&id=" . $empresa['id_empresa'] . "'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhuma empresa encontrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './views/components/footer.php'; ?>
<script src="assets/js/empresas.js"></script>
</body>
</html>
