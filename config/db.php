<?php
// Arquivo de configuração do banco de dados

$host = 'localhost';      // ou o IP do seu servidor MySQL
$dbname = 'db_controle_funcionarios';
$username = 'root';       // Seu usuário do MySQL
$password = 'root';           // Sua senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configura o modo de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>
