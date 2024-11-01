<?php header("Content-Type: text/html; charset=UTF-8",true); ?>
<html>
<head>
    <title>Gerenciar Produtos</title>
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
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #003366;
        }
        th, td {
            padding: 10px;
            border: 1px solid #003366;
            text-align: center;
        }
        th {
            background-color: #003366;
            color: #ffffff;
        }
        a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #0055a5;
        }
        .action-link {
            margin: 0 5px;
        }
    </style>
</head>
<body>
<h2>Gerenciar Produtos</h2><hr>

<div>
    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        <?php
        require_once("conecta.php");

        // Consulta para listar todos os produtos com o nome da categoria
        $sql = "SELECT p.pro_codigo, p.pro_nome, p.pro_descricao, p.pro_preco, c.cat_nome 
                FROM tbl_produto AS p
                JOIN tbl_categoria AS c ON p.cat_codigo = c.cat_codigo
                ORDER BY p.pro_codigo";
        
        $res = mysqli_query($conexao, $sql);

        // Exibe cada produto na tabela
        while ($registro = mysqli_fetch_assoc($res)) {
            $codigo = $registro['pro_codigo'];
            $nome = $registro['pro_nome'];
            $descricao = $registro['pro_descricao'];
            $preco = number_format($registro['pro_preco'], 2, ",", ".");
            $categoria = $registro['cat_nome'];

            echo "<tr>";
            echo "<td>$codigo</td>";
            echo "<td>$nome</td>";
            echo "<td>$descricao</td>";
            echo "<td>R$ $preco</td>";
            echo "<td>$categoria</td>";
            echo "<td>
                    <a href='alterar.php?codigo=$codigo' class='action-link'>Alterar</a> | 
                    <a href='excluir.php?codigo=$codigo' class='action-link'>Excluir</a>
                  </td>";
            echo "</tr>";
        }

        mysqli_close($conexao);
        ?>
    </table>
</div>
<p><a href="menu.php">Voltar ao Menu</a></p>
</body>
</html>
