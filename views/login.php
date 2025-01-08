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
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <form id="loginForm" action="index.php?action=login" method="POST">
            <h2>Login</h2>

            <div class="form-group">
                <label for="login">Login:</label>
                <input type="email" id="login" name="login">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha">
            </div>
            <button type="submit">Entrar</button>
        </form>

        <!-- Div para exibir as mensagens de erro -->
         
        <div id="message" class="error-message"></div>
    </div>

    <!-- Import JavaScript com defer para carregar após o conteúdo da página -->
    <script src="assets/js/login.js" defer></script>
</body>
</html>
