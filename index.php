<?php
// index.php

session_start();
require_once 'config/db.php'; // Conexão com o banco de dados
require_once 'routes/index.php';  // Inclui o roteador
require_once 'controllers/AuthController.php';
require_once 'controllers/EmpresaController.php';
require_once 'controllers/FuncionarioController.php';

// Definir as rotas

// Pega a ação da URL ou define a ação padrão (neste caso, login)
$action = $_GET['action'] ?? 'login';  // Se não tiver ação, o padrão é login

// Chama o roteador para tratar a ação
Router::route($action, $pdo);
