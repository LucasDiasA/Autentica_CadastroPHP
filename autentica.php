<?php
header("Content-Type: text/html; charset=UTF-8",true);

// Conecta com o banco de dados
require_once("conecta.php");

// Recebe dados do formulário
$usuario=$_POST["txtUsuario"];
$senha=$_POST["txtSenha"];

// Busca no banco de dados usuário e senha que foram digitadas pelo usuário
$sql = mysqli_query($conexao, "
    SELECT A.usu_id, A.usu_nome FROM tbl_usuario A WHERE
    A.usu_usuario = '$usuario' AND A.usu_senha = '$senha'") or die("Erro no comando SQL");

// Linhas afetadas pela consulta
$row = mysqli_num_rows($sql);

// Verifica se usuário existe
if($row == 0) {
    echo "Usuário/Senha inválidos";
} else {
    while($dados=mysqli_fetch_assoc($sql)) {
        session_start();
        $_SESSION["id"] = $dados['usu_id'];
        $_SESSION["nome"] = $dados['usu_nome'];
        header("Location: menu.php");
    }
}
?>
