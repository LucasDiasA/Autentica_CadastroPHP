<?php header("Content-Type: text/html; charset=UTF-8",true);?>
<html>
<head>
    <title>Inclusão de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5;
            color: #333;
            text-align: center;
        }
        h2 {
            color: #003366;
        }
        form {
            display: inline-block;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #003366;
        }
        input[type="text"], textarea, select {
            padding: 8px;
            border: 1px solid #003366;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #003366;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            border: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h2>Inclusão de Produtos</h2>
<hr>
<?php
require_once("conecta.php");

if(!isset($_POST["enviar"])) {
?>
    <form method="POST" action="incluir.php">
        Nome:<input type="text" name="nome" size="30"><br>
        Descrição:<br><textarea rows="2" name="descricao" cols="30"></textarea><br>
        Preço:<input type="text" name="preco" size="10"><br>
        Categoria:<select size="1" name="categoria">
        
        <?php
        // Gera a lista de categorias
        $res=mysqli_query($conexao, "SELECT * FROM tbl_categoria");
        while($registro=mysqli_fetch_row($res)) {
            $cod=$registro[0];
            $nome=$registro[1];
            echo "<option value=\"$cod\">$nome</option>\n";
        }
        ?>
        </select><br>
        <input type="hidden" name="enviar" value="S">
        <input type="submit" value="Incluir Produto" name="incluir">
    </form>
<?php
} else { // Inclui produto
    if ($conexao) {
        $nome=$_POST["nome"];
        $descricao=$_POST["descricao"];
        $preco=$_POST["preco"];
        $categoria=$_POST["categoria"];

        $sql="INSERT INTO tbl_produto (pro_nome, pro_descricao, pro_preco, cat_codigo)
              VALUES ('$nome','$descricao','$preco','$categoria')";
        $res2=mysqli_query($conexao, $sql);

        if ($res2) {
            echo "<p align='center'>Produto incluído com sucesso!</p>";
        } else {
            $erro=mysqli_error($conexao);
            echo "<p align='center'>Erro: $erro</p>";
        }

        mysqli_close($conexao);
    }
}
?>
<p><a href="menu.php">Voltar</a></p>
</body>
</html>
