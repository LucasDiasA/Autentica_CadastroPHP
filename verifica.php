<?php
// Inicializa sessão
session_start();

// Se não tiver variáveis registradas, retorna para tela de login
if( (!isset($_SESSION["id"])) AND (!isset($_SESSION["nome"])) )
    Header("Location: index.php");
?>
