<?php
// Inicializa a sessão
session_start();

// Destrói as variáveis
unset($_SESSION['id']);
unset($_SESSION['nome']);

// Redireciona para tela de login
Header("Location: index.php");
?>
