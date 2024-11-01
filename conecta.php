<?php
// Dados para conexão
$servidor = "localhost";
$bd = "bd_loja";
$usuario = "root";
$senha = "";

// Conectando
$conexao = mysqli_connect($servidor, $usuario, $senha) or die("Erro na conexão");

// Seleciona o banco de dados a ser utilizado
$db = mysqli_select_db($conexao, $bd) or die("Erro na seleção do banco de dados");
?>
