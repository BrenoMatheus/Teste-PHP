<?php
// controllers/Router.php

class Router
{
    public static function route($action, $pdo)
    {
        switch ($action) {
            case 'login':
                $controller = new AuthController();
                $controller->login($pdo);
                break;

            case 'home':
                // Exibe a página home
                $controller = new FuncionarioController();
                $controller->listarFuncionarios($pdo);
                break;

            case 'excluir_empresa':
                $controller = new EmpresaController();
                $controller->excluir($pdo, $_GET['id']);
                break;

            case 'cadastrar_empresa':
                $controller = new EmpresaController();
                $controller->cadastrar($pdo);
                break;

            case 'empresas': // Nova rota para empresas
                $controller = new EmpresaController();
                $controller->listarEmpresas($pdo); // Chama listarEmpresas
                break;

            case 'excluir_funcionario':
                $controller = new FuncionarioController();
                $controller->excluir($pdo, $_GET['id']);
                break;

            case 'cadastrar_funcionario':
                $controller = new FuncionarioController();
                $controller->cadastrar($pdo);
                break;

            case 'funcionarios': // Rota para listar funcionários com empresas
                $controller = new FuncionarioController();
                $controller->listarFuncionarioseEmpresas($pdo);
                break;

            default:
                include 'views/login.php';  // Se não for encontrada a ação, redireciona para login
        }
    }
}
