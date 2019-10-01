<?php
include_once("banco.php");
session_save_path('../cache/temp');
session_start();

$titulo = trim($_POST['titulo']);
$tipoSys = $_POST['tipo'];
$motImpl = trim($_POST['implantacao']);
$impacto = trim($_POST['impacto']);
$objetivo = trim($_POST['objetivo']);
$alinhamento = trim($_POST['alinhamento']);
$obser = trim($_POST['observacao']);
$siape = trim($_POST['siape']); #pega o siape do responsavel pela demanda
$ben = array_unique($_POST['ben']); #captura o beneficiario(armazena um array)
$unidade = array_unique($_POST['uni']); #captura a unidade(armazena um array)
$criadorDemandas = $_SESSION['email']; #pega o email de quem cadastrou a demanda
$pertence = $_POST['pertence'];
$motivo = $_POST['motivo'];
// issert into no cadastro na tabela demanda
$insertInto = "INSERT INTO demandas(titulo, tipoSistema, motivoImplantacao,impactoNumBen,alinhamento,objetivoSolucao,obs,fk_Responsavel,criadorDemandas,pertencente,motivo) 
VALUES ('$titulo','$tipoSys','$motImpl','$impacto','$alinhamento','$objetivo','$obser','$siape','$criadorDemandas','$pertence','$motivo')";

// cadastra as demandas
if ($mysqli->query($insertInto)) {

    // pega o ultimo id registrado das demandas
    $id = $mysqli->insert_id;

    // cadastra os beneficiarios da demanda
    foreach ($ben as $a) {
        $query = "INSERT INTO bendem(fk_Beneficiarios, fk_Demandas) VALUES ('$a', $id)";
        $mysqli->query($query);
    }

    // cadastra as unidades envolvidas na demanda
    foreach ($unidade as $a) {
        $query = "INSERT INTO demunid(fk_demandas, fk_Unidades) VALUES ('$id','$a')";
        $mysqli->query($query);
    }

    // avisa que foi cadastrado a demanda e volta para a página de cadastro de demandas
    echo "<script>alert('Demanda foi cadastrada!')</script>";
    echo "<script>window.location ='../cadastroDemandas.php'</script>";
} else {

    // avisa que não foi cadastrado a demanda e volta para a página de cadstro de demandas
    echo "<script>alert('Não foi possivel Cadastrar a demanda!')</script>";
    echo "<script>window.location ='../cadastroDemandas.php'</script>";
}
$id->close();
$mysqli->close();
