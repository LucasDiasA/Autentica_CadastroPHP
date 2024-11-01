<?php header("Content-Type: text/html; charset=UTF-8",true); ?>
<html>
<head>
    <title>Excluir Produto</title>
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
        .confirmation-box {
            display: inline-block;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #003366;
            margin-top: 20px;
        }
        .button {
            background-color: #003366;
            color: #ffffff;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0055a5;
        }
    </style>
</head>
<body>
<h2>Excluir Produto</h2>

<?php
require_once("conecta.php");

// Verifica se o código do produto foi passado
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Busca o nome do produto pelo código
    $sql = "SELECT pro_nome FROM tbl_produto WHERE pro_codigo = $codigo";
    $res = mysqli_query($conexao, $sql);

    // Verifica se o produto existe
    if (mysqli_num_rows($res) > 0) {
        $produto = mysqli_fetch_assoc($res);
        $nomeProduto = $produto['pro_nome'];

        // Exibe a confirmação para excluir o produto
        echo "<div class='confirmation-box'>";
        echo "<p>Você deseja excluir: <strong>$nomeProduto</strong>?</p>";
        echo "<form method='POST' action='excluir.php'>";
        echo "<input type='hidden' name='codigo' value='$codigo'>";
        echo "<button type='submit' name='confirmar' value='sim' class='button'>Sim</button>";
        echo "<button type='submit' name='confirmar' value='nao' class='button'>Não</button>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "<p>Produto não encontrado.</p>";
        echo "<p><a href='buscar_produto.php' class='button'>Voltar para Gerenciar Produtos</a></p>";
    }
} elseif (isset($_POST['confirmar'])) {
    // Processa a exclusão se o usuário confirmou
    $codigo = $_POST['codigo'];
    $confirmacao = $_POST['confirmar'];

    if ($confirmacao === 'sim') {
        // Executa a exclusão do produto
        $sql = "DELETE FROM tbl_produto WHERE pro_codigo = $codigo";
        $res = mysqli_query($conexao, $sql);

        if ($res && mysqli_affected_rows($conexao) > 0) {
            echo "<p>Produto excluído com sucesso!</p>";
        } else {
            echo "<p>Erro ao excluir o produto.</p>";
        }
    } else {
        echo "<p>Produto não excluído.</p>";
    }

    echo "<p><a href='buscar_produto.php' class='button'>Voltar para Gerenciar Produtos</a></p>";
}

mysqli_close($conexao);
?>

</body>
</html>
