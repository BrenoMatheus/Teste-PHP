<?php
require_once 'models/Funcionario.php';

class FuncionarioController {

    // Função para cadastrar funcionário
    public function cadastrar($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se os dados foram enviados via POST
            if (isset($_POST['nome']) && !empty($_POST['nome']) &&
                isset($_POST['cpf']) && !empty($_POST['cpf']) &&
                isset($_POST['email']) && !empty($_POST['email']) &&
                isset($_POST['id_empresa']) && !empty($_POST['id_empresa'])) {

                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'] ?? null;
                $email = $_POST['email'];
                $id_empresa = $_POST['id_empresa'];

                // Remove a formatação do CPF (removendo pontos, traços, etc.)
                $cpf = preg_replace('/\D/', '', $cpf); // Remove tudo que não for número

                    echo $nome, $cpf, $rg, $email, $id_empresa;
                // Chama o método cadastrar do modelo Funcionario
                $sucesso = Funcionario::cadastrar($pdo, $nome, $cpf, $rg, $email, $id_empresa);

                if ($sucesso) {
                    // Redireciona para a página de funcionários após cadastro bem-sucedido
                    header('Location: index.php?action=home');
                    exit(); // Encerra a execução do script após o redirecionamento
                } else {
                    // Mensagem de erro caso o cadastro falhe
                    $mensagem = "Erro ao cadastrar funcionário!";
                }
            } else {
                // Mensagem caso algum campo obrigatório não tenha sido informado
                $mensagem = "Todos os campos são obrigatórios!";
            }
        }

        // Inclui a página de cadastro com a mensagem
        include 'views/home.php';
    }

    // Método para excluir funcionário
    public function excluir($pdo, $id_funcionario) {
        // Chama o método excluir do modelo
        $sucesso = Funcionario::excluir($pdo, $id_funcionario);

        if ($sucesso) {
            // Redireciona para a lista de funcionários após a exclusão
            header('Location: index.php?action=home');
            exit();
        } else {
            // Caso a exclusão falhe, exibe uma mensagem de erro
            echo "Erro ao excluir o funcionário.";
        }
        include 'views/empresa/empresa.php';
    }

        // Função para listar funcionários e empresas na mesma página
        public function listarFuncionarios($pdo) {
            // Busca os funcionários
            $funcionarios = Funcionario::buscarTodos($pdo);
            include 'views/home.php'; 
        }

        // Função para listar funcionários e empresas na mesma página
        public function listarFuncionarioseEmpresas($pdo) {
            // Busca os funcionários
            $funcionarios = Funcionario::buscarTodos($pdo);
            
            // Busca as empresas
            $empresas = Empresa::buscarTodas($pdo);
    
            // Inclui a página principal de funcionários com os dados
            include 'views/funcionario/cadastro_funcionario.php'; // Passando tanto funcionários quanto empresas
        }

    
}
?>
