<?php
require_once 'models/Usuario.php';

class AuthController {
    public function login($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $senha = $_POST['senha'];


            // Validações
            if (empty($login) || empty($senha)) {
                $mensagem = "Todos os campos são obrigatórios.";
            } else {
                $usuario = Usuario::verificarLogin($pdo, $login, $senha);
                //var_dump($usuario['id_usuario']);  // Exibe os valores no navegador
                if ($usuario) {
                    $_SESSION['usuario_login'] = $usuario['login'];
                    header('Location: ?action=home');  // Redireciona para home após login
                    exit();
                    //header('Location: home.php');
                } else {
                    $_SESSION['mensagem_erro'] = "Login ou senha inválidos.";
                    // Redireciona para a lista de empresas com a mensagem de erro
                    header('Location: index.php?action=login');
                    exit();
                }
            }
        }

        include 'views/login.php';
    }
}
?>
