<?php
// Modelo para a tabela tbl_empresa

class Empresa {
    public $id_empresa;
    public $nome;

    // Construtor para inicializar os dados
    public function __construct($nome = null, $id_empresa = null) {
        $this->nome = $nome;
        $this->id_empresa = $id_empresa;
    }

    // Função para cadastrar uma empresa
    public static function cadastrar($pdo, $nome) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tbl_empresa (nome) VALUES (:nome)");
            $stmt->bindParam(':nome', $nome);
            $stmt->execute(); // Executa a consulta
            return true; // Sucesso no cadastro
        } catch (PDOException $e) {
            return false; // Falha no cadastro
        }
    }

        // Função para excluir uma empresa
        public static function excluir($pdo, $id_empresa) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tbl_empresa WHERE id_empresa = :id_empresa");
            $stmt->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Sucesso na exclusão
        } catch (PDOException $e) {
            return false; // Falha na exclusão
        }
    }

    // Função para buscar todas as empresas
    public static function buscarTodas($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM tbl_empresa ORDER BY id_empresa DESC");
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
