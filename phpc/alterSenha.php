<?php
error_reporting(0);
include_once("banco.php");
session_save_path('../cache/temp/');
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email' LIMIT 1");

// verifica se existe os email no banco e muda a senha
if ($result->num_rows == 1) {

    // altera a senha do usuario
    $mysqli->query("UPDATE usuarios SET senha = '$senha' WHERE email = '$email'");
    echo "<script>alert('Sua senha foi alterada com sucesso!')</script>";
    echo "<script>window.location = '../confUsuario.php'</script>";
    
} else {

    // informa que o e-mail de usuario e invalido
    echo "<script>alert('Nome e E-mail incorretos!')</script>";
    if(isset($_SESSION['nome'])){
    echo "<script>window.location = '../confUsuario.php'</script>";
    }else{
    echo "<script>window.location = '../esqueceuSenha.php'</script>";
    }
}
$result->close();
$mysqli->close();
