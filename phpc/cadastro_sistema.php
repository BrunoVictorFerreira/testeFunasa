<?php
include_once("banco.php");
session_save_path('../cache/temp');
session_start();

$nome = $_POST['titulo'];
$descricao = $_POST['descricao'];
$finalidade = $_POST['finalidade'];
$tipoArea = $_POST['tipoArea'];
$situacao = $_POST['situacao'];
$disponibilidade = $_POST['disponibilidade'];
$bd = $_POST['bd'];
$desenv = $_POST['desenv'];
$cadastro = $_POST['cadastro'];
$autenti = $_POST['autenti'];
$plataforma = $_POST['plataforma'];
$pubAlvo = $_POST['pubAlvo'];
$acesso = $_POST['acesso'];
$acessoDia = $_POST['acessoDia'];
$acessoSim = $_POST['acessoSim'];
$sigilo = $_POST['sigilo'];
$atenti = $_POST['atenti'];
$enviarDados = $_POST['enviarDados'];
$receberDados = $_POST['receberDados'];
$bi = $_POST['bi'];
$observacao = $_POST['observacao'];

$areaUsuario = $_POST['areaUsuario'];
$arquitetura = $_POST['arquitetura'];
$liguagem = $_POST['liguagem'];
$impacto = $_POST['impacto'];

do {
    $idApli = md5(mt_rand());

    $sqlCatalagoSistema = "INSERT INTO catalago_sistema
    (idApli,
    nome,
    descricao,
    finalidade,
    tipoArea,
    situacao,
    disponibilidade,
    bd,
    desenv,
    cadastro,
    autenti,
    plataforma,
    pubAlvo,
    acesso,
    acessoDia,
    acessoSim,
    sigilo,
    atenti,
    enviarDados,
    receberDados,
    bi,
    observacao)
    VALUES
    ('$idApli',
    '$nome',
    '$descricao',
    '$finalidade',
    '$tipoArea',
    '$situacao',
    '$disponibilidade',
    '$bd',
    '$desenv',
    '$cadastro',
    '$autenti',
    '$plataforma',
    '$pubAlvo',
    '$acesso',
    '$acessoDia',
    '$acessoSim',
    '$sigilo',
    '$atenti',
    '$enviarDados',
    '$receberDados',
    '$bi',
    '$observacao')";

    $mysqli->query($sqlCatalagoSistema);
} while ($mysqli->errno == 1062);

if ($mysqli->errno == 0) {
    foreach ($arquitetura as $value) {
        $mysqli->query("INSERT INTO arquitetura_has_catalago_sistema
        (arquitetura_id,
        catalago_sistema_idApli)
        VALUES
        ('$value',
        '$idApli')");
    }

    foreach ($areaUsuario as $value) {
        $mysqli->query("INSERT INTO catalago_sistema_has_unidade
        (catalago_sistema_idApli,
        unidade_idUnid)
        VALUES
        ('$idApli',
        '$value')");
    }

    foreach ($liguagem as $value) {
        $mysqli->query("INSERT INTO ligua_has_catalago_sistema
        (ligua_id,
        catalago_sistema_idApli)
        VALUES
        ('$value',
        '$idApli')");
    }

    foreach ($impacto as $value) {
        $mysqli->query("INSERT INTO impacto_has_catalago_sistema
        (impacto_id,
        catalago_sistema_idApli)
        VALUES
        ('$value',
        '$idApli')");
    }
} else
    printf($mysqli->errno + ": " + $mysqli->error);
