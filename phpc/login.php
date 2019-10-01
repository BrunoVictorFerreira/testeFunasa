<?php
include_once('banco.php');

$login = mb_strtolower($_POST['login']);
$senha = $_POST['senha'];

$result = $mysqli->query("SELECT * FROM usuarios WHERE (email = '$login' OR nome = '$login') AND senha = '$senha'");
$array = $result->fetch_array(MYSQLI_ASSOC);

// inicia a sessão
if ($result->num_rows > 0) {

    // define a pasta que sera salva o arquivo da session
	session_save_path('../cache/temp');
    session_start();
    $_SESSION['nome'] = $array['nome'];
    $_SESSION['email'] = $array['email'];
	echo ("<script>window.location = '../bemVindo.php'</script>");
} else {
    echo ("<script>alert('Senha e login incorretos!')</script>");
    unset($login);
    unset($senha);
    echo ("<script>window.location = '../index.html'</script>");
}

$result->close();
$mysqli->close();
