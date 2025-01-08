<?php
class Funcionario {
    public $id_funcionario;
    public $nome;
    public $cpf;
    public $rg;
    public $email;
    public $id_empresa;

    // Construtor para inicializar os dados
    public function __construct($nome = null, $cpf = null, $rg = null, $email = null, $id_empresa = null, $id_funcionario = null) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->email = $email;
        $this->id_empresa = $id_empresa;
        $this->id_funcionario = $id_funcionario;
    }

    // Função para cadastrar um funcionário
    public static function cadastrar($pdo, $nome, $cpf, $rg, $email, $id_empresa) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa) VALUES (:nome, :cpf,:rg, :email, :id_empresa)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id_empresa', $id_empresa);
            $stmt->execute(); // Executa a consulta
            return true; // Sucesso no cadastro
        } catch (PDOException $e) {
            return false; // Falha no cadastro
        }
    }

    // Função para excluir um funcionário
    public static function excluir($pdo, $id_funcionario) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tbl_funcionario WHERE id_funcionario = :id_funcionario");
            $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
            $stmt->execute(); // Executa a consulta
            return true; // Sucesso na exclusão
        } catch (PDOException $e) {
            return false; // Falha na exclusão
        }
    }

    // Função para buscar todos os funcionários
    public static function buscarTodos($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT f.*, e.nome AS empresa_nome 
                FROM tbl_funcionario f
                LEFT JOIN tbl_empresa e ON f.id_empresa = e.id_empresa
                ORDER BY f.id_funcionario DESC;
                ");

            $stmt->execute(); // Executa a consulta
            
            // Verifica se há registros
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os dados
            } else {
                return []; // Retorna array vazio se não houver dados
            }
        } catch (PDOException $e) {
            return []; // Retorna array vazio em caso de erro
        }
    }
}
?>
