<?php
$dbname = "bd_loja";

# Conexão ao banco de dados
$conexao = mysqli_connect('localhost', 'root', '') or die("Erro de conexão");

# Criação do banco de dados se não existir
$criabd = mysqli_query($conexao, "CREATE DATABASE if not exists $dbname");
$abre = mysqli_query($conexao, "USE $dbname");

# Definição dos nomes das tabelas
$tbNome1 = "tbl_usuario";
$tbNome2 = "tbl_produto";
$tbNome3 = "tbl_categoria";

# Estrutura da tabela de usuários
$criacao1 = "CREATE TABLE if not exists $tbNome1 (
    usu_id smallint NOT NULL AUTO_INCREMENT,
    usu_nome varchar(80) NOT NULL,
    usu_usuario varchar(30) NOT NULL,
    usu_senha varchar(15) NOT NULL,
    PRIMARY KEY (usu_id)
)";

# Estrutura da tabela de produtos
$criacao2 = "CREATE TABLE if not exists $tbNome2 (
    pro_codigo smallint NOT NULL AUTO_INCREMENT,
    pro_nome varchar(80) NOT NULL,
    pro_descricao text,
    pro_preco float NOT NULL,
    cat_codigo smallint NOT NULL,
    PRIMARY KEY (pro_codigo)
)";

# Estrutura da tabela de categorias
$criacao3 = "CREATE TABLE if not exists $tbNome3 (
    cat_codigo smallint NOT NULL AUTO_INCREMENT,
    cat_nome varchar(60) NOT NULL,
    PRIMARY KEY (cat_codigo)
)";

# Execução da criação das tabelas
$resCria1 = mysqli_query($conexao, $criacao1);
$resCria2 = mysqli_query($conexao, $criacao2);
$resCria3 = mysqli_query($conexao, $criacao3);

# Verificação de sucesso da criação de cada tabela
if ($resCria1 > 0) {
    echo "Tabela $tbNome1 criada.<br>";
} else {
    echo "Tabela $tbNome1 não pode ser criada.<br>";
}

if ($resCria2 > 0) {
    echo "Tabela $tbNome2 criada.<br>";
} else {
    echo "Tabela $tbNome2 não pode ser criada.<br>";
}

if ($resCria3 > 0) {
    echo "Tabela $tbNome3 criada.<br>";
} else {
    echo "Tabela $tbNome3 não pode ser criada.<br>";
}

# Criação dos índices
$indice2 = "CREATE UNIQUE INDEX indProd ON $tbNome2(pro_codigo)";
$indice3 = "CREATE UNIQUE INDEX indCat ON $tbNome3(cat_codigo)";
$resIndx2 = mysqli_query($conexao, $indice2);
$resIndx3 = mysqli_query($conexao, $indice3);

# Verificação de sucesso dos índices
if ($resIndx2 > 0) {
    echo "Índice da Tabela $tbNome2 criado.<br>";
} else {
    echo "Índice da Tabela $tbNome2 não pode ser criado.<br>";
}

if ($resIndx3 > 0) {
    echo "Índice da Tabela $tbNome3 criado.<br>";
} else {
    echo "Índice da Tabela $tbNome3 não pode ser criado.<br>";
}

# Inserção de dados nas tabelas de teste
$inserte1 = ("INSERT INTO $tbNome1 VALUES(1,'administrador 1','administrador1','adm123')");
$inserte2 = ("INSERT INTO $tbNome1 VALUES(2,'administrador 2','administrador2','adm123')");
$inserte3 = ("INSERT INTO $tbNome3 VALUES (1,'Eletrodomésticos')");
$inserte4 = ("INSERT INTO $tbNome3 VALUES (2,'Cama, Mesa e Banho')");
$inserte5 = ("INSERT INTO $tbNome3 VALUES (3,'Áudio e Video')");

$res1 = mysqli_query($conexao, $inserte1);
$res2 = mysqli_query($conexao, $inserte2);
$res3 = mysqli_query($conexao, $inserte3);
$res4 = mysqli_query($conexao, $inserte4);
$res5 = mysqli_query($conexao, $inserte5);

if ($res1>0 && $res2>0) {
    echo "Dados inseridos na tabela $tbNome1<br>";
} else {
    echo "Dados não podem se inseridos na tabela $tbNome1<br>";
}

if ($res3>0 && $res4>0 && $res5>0) {
    echo "Dados inseridos na Tabela $tbNome3.<br>";
} else {
    echo "Não foram inseridos dados na Tabela $tbNome3.<br>";
}

mysqli_close($conexao);
?>
