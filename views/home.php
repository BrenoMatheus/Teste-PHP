<?php

if (!isset($_SESSION['usuario_login'])) {
    // Se o usuário não estiver logado, redireciona para o login
    header('Location: index.php?action=login');
    exit();
}

// Verifica se existe uma mensagem de erro na sessão e a exibe usando um alert do JavaScript
if (isset($_SESSION['mensagem_erro'])) {
    echo '<script type="text/javascript">alert("' . addslashes($_SESSION['mensagem_erro']) . '");</script>';
    unset($_SESSION['mensagem_erro']); // Limpa a mensagem de erro após exibição
}

require_once 'config/db.php';
require_once 'models/Funcionario.php';

//$funcionarios = Funcionario::getAll($pdo); 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/funcionarios.css">
</head>

<body>

    <!-- Inclui o menu -->
    <?php include './views/components/menu.php'; ?>

    <div class="container">
        <h2>Cadastrar Funcionário</h2>
        <a href="?action=funcionarios" class="button">Novo Funcionario</a>
        <!-- Tabela de Funcionários -->
        <div class="table-container">
            <?php if (isset($mensagem)) : ?>
                <div style="color: red; margin: 10px 0;">
                    <?php echo htmlspecialchars($mensagem); ?>
                </div>
            <?php endif; ?>
            <h2>Lista de Funcionários</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Email</th>
                        <th>Empresa</th> <!-- Exibe a empresa associada -->
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($funcionarios) && !empty($funcionarios)) {
                        function formatarCPF($cpf) {
                            return preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{2})$/", "$1.$2.$3-$4", $cpf);
                        }
                        
                        function formatarRG($rg) {
                            return preg_replace("/^(\d{2})(\d{3})(\d{3})([\dX])$/", "$1.$2.$3-$4", $rg);
                        }
                        foreach ($funcionarios as $funcionario) {
                            echo "<tr>";
                            echo "<td>" . $funcionario['id_funcionario'] . "</td>";
                            echo "<td>" . $funcionario['nome'] . "</td>";
                            echo "<td>" . formatarCPF($funcionario['cpf']) . "</td>";
                            echo "<td>" . formatarRG($funcionario['rg']) . "</td>";
                            echo "<td>" . $funcionario['email'] . "</td>";
                            echo "<td>" . $funcionario['empresa_nome'] . "</td>"; // Aqui pode-se usar o nome da empresa se quiser fazer a associação com o nome da empresa
                            echo "<td><a href='index.php?action=excluir_funcionario&id=" . $funcionario['id_funcionario'] . "'>Excluir</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum funcionário encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        </main>

        <!-- Inclui o footer -->
        <?php include './views/components/footer.php'; ?>

</body>

</html>