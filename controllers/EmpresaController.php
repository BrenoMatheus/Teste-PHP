<?php
require_once 'models/Empresa.php';

class EmpresaController {

    // Função para cadastrar empresa
    public function cadastrar($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se o nome foi enviado via POST
            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $nome = $_POST['nome'];

                // Chama o método cadastrar do modelo Empresa
                $sucesso = Empresa::cadastrar($pdo, $nome);

                if ($sucesso) {
                    // Redireciona para a página de empresas após cadastro bem-sucedido
                    header('Location: index.php?action=empresas');
                    exit(); // Encerra a execução do script após o redirecionamento
                } else {
                    $_SESSION['mensagem_erro'] = "Erro ao cadastrar empresa!";
                    // Redireciona para a lista de empresas com a mensagem de erro
                    header('Location: index.php?action=empresas');
                    exit();
                }
            } else {
                $_SESSION['mensagem_erro'] = "O nome da empresa é obrigatório!";
                // Redireciona para a lista de empresas com a mensagem de erro
                header('Location: index.php?action=empresas');
                exit();
            }
        }
        include 'views/empresa/empresa.php';
    }

    // Método para excluir empresa
    public function excluir($pdo, $id_empresa) {
        // Chama o método excluir do modelo
        $sucesso = Empresa::excluir($pdo, $id_empresa);

        if ($sucesso) {
            // Redireciona para a lista de empresas após a exclusão
            header('Location: index.php?action=empresas');
            exit();
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao excluir a empresa!";
        
            // Redireciona para a lista de empresas com a mensagem de erro
            header('Location: index.php?action=empresas');
            exit();
        }
    }


    // Função para listar empresas
    public function listarEmpresas($pdo) {
        // Busca todas as empresas no banco de dados
        $empresas = Empresa::buscarTodas($pdo);

        // Inclui a página principal de empresas com os dados
        include 'views/empresa/empresa.php';
    }
}
?>
