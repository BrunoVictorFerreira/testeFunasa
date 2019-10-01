<?php
include_once('banco.php');

// salva o numero da pagina em que o usuario estava
$pagina = $_GET['pagina'];

// pega o id da demanda
$idDem = $_GET['excluir'];

// verifica se exite no banco
$result = $mysqli->query("SELECT * FROM demandas WHERE idDem = $idDem");
if ($result->num_rows > 0) {

    // deleta do banco a demanda
    $mysqli->query("DELETE FROM demandas WHERE idDem = $idDem");
    echo "<script>alert('Demanda excluida')</script>";
    echo "<script>location = '$pagina'</script>";

} else {
    //echo "<script>alert('Não foi possivel excluir a demanda')</script>";
    echo "<script>location = '$pagina'</script>";
}
$result->close();
$mysqli->close();
