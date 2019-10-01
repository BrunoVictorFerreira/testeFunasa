<?php
error_reporting(0);
	// verificador de sessão
session_save_path('cache/temp/');
session_start();
if (isset($_SESSION['nome'])) {
    header('location: demandas.php');
}

?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>
        *{margin: 0;padding: 0}
        body{
            background-image: url('img/fundoEsqueceu.jpg');
            
        }
        #footerIndex{
            background-color: #1f477a;
            color: white;
            padding: 2px;
            position: absolute;
            bottom: 0;
            left: -5px;
            right: 0;
            width: 100%;
        }
        .focus-in-expand{animation:focus-in-expand 1.2s cubic-bezier(.25,.46,.45,.94) both}
        @keyframes focus-in-expand{0%{letter-spacing:-.5em;filter:blur(12px);opacity:0}100%{filter:blur(0);opacity:1}}
        .tracking-in-contract{animation:tracking-in-contract .8s cubic-bezier(.215,.61,.355,1.000) both}
        @keyframes tracking-in-contract{0%{letter-spacing:1em;opacity:0}40%{opacity:.6}100%{letter-spacing:normal;opacity:1}}
        .text-focus-in{animation:text-focus-in 1s cubic-bezier(.55,.085,.68,.53) both}
        @keyframes text-focus-in{0%{filter:blur(12px);opacity:0}100%{filter:blur(0);opacity:1}}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!--==========-======================-->
    <title>Funasa</title>

</head>
<body>

    
    <section id="section" style="margin-left:auto;margin-right: auto">
    <p id="loginTitle" style="vertical-align:middle;color:black;font-size:30px">LOGIN</p>
    <form method="POST" action="phpc/login.php">
        <p id="usuariotitle">Email ou Usuário</p>
        <input id="usuarioCamp" type="user" name="login"><br>
        <p id="senhatitle">Senha</p>
        <input id="senhaCamp" type="password" name="senha">
        <p style="text-align:center;margin-top: 10px"><a href="confUsuario.php" style="text-decoration: none;color: black;font-family: roboto">Esqueci a senha</a></p>
        <input type="submit" id="boton" style="margin-top: 10px" value="ENTRAR">

    </form>
    <div style="margin-bottom: 23.8%"></div>
    </section>
    
    
    <footer id="footerIndex">

    <p class="tituloFooter">Ministério da Saude</p>
    <p class="tituloFooter">Fundação Nacional de Saúde</p>
        
    </footer>
</body>
</html>
