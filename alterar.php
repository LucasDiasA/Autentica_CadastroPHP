<?php header("Content-Type: text/html; charset=UTF-8",true);?>
<html>
<head>
    <title>Alteração de Produto</title>
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
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #003366;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h2>Alteração de Produto</h2><hr>
<?php
require_once("conecta.php");

// Verifica se o formulário foi enviado para salvar alterações
if(isset($_POST["enviar"])) {
    // Recebe os dados do formulário
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];

    // Atualiza o produto no banco de dados
    $sql = "UPDATE tbl_produto SET 
                pro_nome='$nome',
                pro_descricao='$descricao',
                pro_preco=$preco,
                cat_codigo=$categoria 
            WHERE pro_codigo=$codigo";
    $res = mysqli_query($conexao, $sql);

    if ($res && mysqli_affected_rows($conexao) > 0) {
        echo "<p>Produto alterado com sucesso!</p>";
    } else {
        echo "<p>Erro ao alterar o produto ou nenhum dado foi alterado.</p>";
    }

    mysqli_close($conexao);
} else if (isset($_GET["codigo"])) {
    // Código fornecido via GET, exibe o formulário com dados atuais do produto
    $codigo = $_GET["codigo"];
    $sql = "SELECT * FROM tbl_produto WHERE pro_codigo=$codigo";
    $res = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($res) == 0) {
        echo "<p>Produto não encontrado.</p>";
    } else {
        $registro = mysqli_fetch_assoc($res);
        ?>
        <form method="POST" action="alterar.php">
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
            Nome:<input type="text" name="nome" value="<?php echo $registro['pro_nome']; ?>"><br>
            Descrição:<br><textarea name="descricao"><?php echo $registro['pro_descricao']; ?></textarea><br>
            Preço:<input type="text" name="preco" value="<?php echo $registro['pro_preco']; ?>"><br>
            Categoria:<select name="categoria">
                <?php
                $resCat = mysqli_query($conexao, "SELECT * FROM tbl_categoria");
                while ($cat = mysqli_fetch_assoc($resCat)) {
                    echo "<option value='{$cat['cat_codigo']}'";
                    if ($cat['cat_codigo'] == $registro['cat_codigo']) echo " selected";
                    echo ">{$cat['cat_nome']}</option>";
                }
                ?>
            </select><br>
            <input type="hidden" name="enviar" value="S">
            <input type="submit" value="Alterar produto">
        </form>
        <?php
    }
    mysqli_close($conexao);
} else {
    // Caso nem GET nem POST estejam definidos, exibe a mensagem de erro
    echo "<p>Erro: Código do produto não informado.</p>";
}
?>
<p><a href="buscar_produto.php">Voltar para busca</a></p>
</body>
</html>
