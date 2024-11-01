<?php header("Content-Type: text/html; charset=UTF-8",true); ?>
<html>
<head>
    <title>Pesquisar Produto</title>
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
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            width: 50%;
            border: 1px solid #003366;
            text-align: center;
        }
        input[type="text"], select {
            padding: 8px;
            border: 1px solid #003366;
            width: 100%;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #003366;
            color: #ffffff;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border: none;
            margin-top: 10px;
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
    </style>
</head>
<body>
<h2>Pesquisar Produto</h2><hr>

<!-- Formulário de Pesquisa -->
<form method="GET" action="listar.php">
    <label for="pesquisa">Pesquisar por Nome, Código ou Categoria:</label>
    <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite o nome, código ou categoria do produto">
    <input type="submit" value="Pesquisar">
</form>

<div>
    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categoria</th>
        </tr>
        <?php
        require_once("conecta.php");

        // Verifica se há uma palavra de pesquisa
        $pesquisa = isset($_GET['pesquisa']) ? mysqli_real_escape_string($conexao, $_GET['pesquisa']) : '';

        // Monta a consulta SQL com filtro, caso o termo de pesquisa seja fornecido
        $sql = "SELECT p.pro_codigo, p.pro_nome, p.pro_descricao, p.pro_preco, c.cat_nome 
                FROM tbl_produto AS p
                JOIN tbl_categoria AS c ON p.cat_codigo = c.cat_codigo";

        if ($pesquisa != '') {
            $sql .= " WHERE p.pro_nome LIKE '%$pesquisa%' 
                      OR p.pro_codigo LIKE '%$pesquisa%' 
                      OR c.cat_nome LIKE '%$pesquisa%'";
        }

        $sql .= " ORDER BY p.pro_codigo"; // Ordena pelo código

        $res = mysqli_query($conexao, $sql);

        // Verifica se há resultados
        if (mysqli_num_rows($res) > 0) {
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
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
        }

        mysqli_close($conexao);
        ?>
    </table>
</div>
<p><a href="menu.php">Voltar ao Menu</a></p>
</body>
</html>
