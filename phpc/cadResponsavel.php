<?php
include_once("banco.php");

// arquivo da função que filtra o número de telefone(caso foi usada a mascara)
include_once("telefone.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$siape = $_POST['siape'];
$email = $_POST['email'];
$telefone = telefone($_POST['telefone']);
$unidade = $_POST['unidade']; #armazena um array

// verifica se existe o responsavel no banco, se não existir será cadastrado
$result = $mysqli->query("SELECT siape FROM responsavel WHERE siape = '$siape'");
if ($result->num_rows < 1) {

    // issert into de cadastro de responsavel
    $insertInto = "INSERT INTO responsavel VALUES ('$siape','$nome','$sobrenome','$email','$telefone')";

    // cadastra o responsavel
    if ($mysqli->query($insertInto)) {
        foreach ($unidade as $unid) {

            // relaciona a unidade com o seu responsavel
            $isertUnidade = "UPDATE unidade SET fk_Responsavel = '$siape' WHERE idUnid = '$unid'";
            $mysqli->query($isertUnidade);
        }
        echo "<script>alert('Responsavel foi cadastrado!')</script>";
        echo "<script>window.location = '../cadastroResponsavel.php'</script>";
    } else {

        // caso não cadastre vai alerta que não foi cadastrado e volta para a página de cadastro de usuario
        echo "<script>alert('Não foi possivel cadastrar o responsavel!')</script>";
        echo "<script>window.location = '../cadastroResponsavel.php'</script>";
    }
} else {

    // caso exista o siape no banco será informado ao usuario e voltará para a pagina de cadastro de responsavel
    echo "<script>alert('Siape já esta cadastrado!')</script>";
    echo "<script>window.location = '../cadastroResponsavel.php'</script>";
}
$result->close();
$mysqli->close();
