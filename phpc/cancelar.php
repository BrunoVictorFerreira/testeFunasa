<?php
include_once('banco.php');

// salva o numero da pagina em que o usuario estava
$pagina = $_GET['pagina'];

// pega o id da demanda
$idDem = $_GET['cancelar'];

// verifica se exite no banco
if ($mysqli->query("UPDATE demandas set statusDemandas = 1 where idDem = $idDem")) {
    echo "<script>alert('Demanda cancelar')</script>";
    echo "<script>location = '$pagina'</script>";
} else {
    echo "<script>alert('Não foi possivel canelar')</script>";
    echo "<script>location = '$pagina'</script>";
}
$mysqli->close();
