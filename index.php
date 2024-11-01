<?php header("Content-Type: text/html; charset=UTF-8",true);?>
<html>
<head>
    <title>Autenticação Usuários</title>
    <meta charset="UTF-8">
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
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #003366;
            padding: 20px;
            width: 50%;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            padding: 8px;
            border: 1px solid #003366;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #003366;
            color: #ffffff;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h2>Autenticação de Usuários</h2>
<form name="frmAutentica" method="post" action="autentica.php">
<table>
<tr>
    <td>Usuário:</td>
    <td><input type="text" name="txtUsuario" size="25"></td>
</tr>
<tr>
    <td>Senha:</td>
    <td><input type="password" name="txtSenha" size="10"></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <input type="submit" name="btnLogar" value="Logar no sistema >>">
    </td>
</tr>
</table>
</form>
</body>
</html>
