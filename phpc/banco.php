<?php

// conexão com o banco
$mysqli = new mysqli('localhost', 'root', '', 'funasa');
if (mysqli_connect_errno()) {
    echo "<script>alert('Erro na conexão de banco de dados:" . mysqli_connect_error() . "')</script>";
}

// definição de utf8 para os dados
$mysqli->query('SET NAME utf-8');
$mysqli->query('SET chatacter_set_connection=utf8');
$mysqli->query('SET chatacter_set_cliention=utf8');
$mysqli->query('SET chatacter_set_results=utf8');
?>