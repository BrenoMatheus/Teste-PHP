<?php
// Modelo para a tabela tbl_usuario

class Usuario {
    public $id_usuario;
    public $login;
    public $senha;

    public function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = $senha;
    }

    // Função para verificar se o login é válido
    public static function verificarLogin($pdo, $login, $senha) {
        $stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE login = :login AND senha = :senha");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
