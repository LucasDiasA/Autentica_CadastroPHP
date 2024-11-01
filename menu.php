<?php
header("Content-Type: text/html; charset=UTF-8",true);
?>
<html>
<head>
    <title>Menu de Administração</title>
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
        .menu-link {
            display: block;
            padding: 10px;
            margin: 10px auto;
            background-color: #003366;
            color: #ffffff;
            width: 200px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .menu-link:hover {
            background-color: #0055a5;
            color: #ffffff; /* Garante que o texto permaneça visível ao passar o mouse */
        }
    </style>
</head>
<body>
<?php
// Verifica sessão ativa
require_once("verifica.php");
echo "<h2>Autenticação de Usuários</h2>";
echo "Usuário logado no sistema: ".$_SESSION["nome"];
?>
<h2>Menu de administração de loja</h2><hr>

<!-- Link para incluir produtos -->
<a href="incluir.php" class="menu-link">Incluir Produto</a>

<!-- Link para gerenciar produtos -->
<a href="buscar_produto.php" class="menu-link">Gerenciar Produtos</a>

<!-- Link para listar todos os produtos -->
<a href="listar.php" class="menu-link">Listar Produtos</a>

<!-- Link para logout -->
<a href="logout.php" class="menu-link">Logout</a>

</body>
</html>
