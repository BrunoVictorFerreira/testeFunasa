<?php
error_reporting(0);
session_save_path('cache/temp/');
session_start();
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

    <!--==========-======================-->
    <title>Troca de Senha</title>
    <style>
        body {
            background-image: url('img/fundoEsqueceu.jpg');

        }

        #footerConfUsuario {
            background-color: #1f477a;
            color: white;
            padding: 2px;
            position: absolute;
            bottom: 0;
            left: -4px;
            right: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    


    <section id="section" style="margin-left:auto;margin-right:auto;display:block">
        <p id="loginTitle">Alterar Senha</p>
        <form method="post" action="phpc/alterSenha.php">
            <p id="usuariotitle">E-mail</p>
            <input id="usuarioCamp" type="email" name="email" placeholder="email@email.com"><br>
            <p id="senhatitle" style="margin-top: 2%">Nova Senha</p>
            <input id="senhaCamp" type="password" name="senha">
            <input name="salvar" type="submit" id="boton" style="" value="Salvar">

        </form>
        <div style="height: 10%"></div>
        
    </section>


    <footer id="footerConfUsuario">

        <p class="tituloFooter">Ministério da Saude</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>

    </footer>
</body>

</html>