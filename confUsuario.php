<?php
error_reporting(0);
session_save_path('cache/temp/');
session_start();
if(!isset($_SESSION['nome']) || !isset($_SESSION['email'])){
    header('Location: EsqueceuSenha.php');
}
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
            background-image: url('img/backAlterar.jpg');

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
    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <p id="nomeSessao">
            <?php if (isset($_SESSION['nome'])) {
                echo "<div style='background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)'>
                <p id='nomeSessao'>" . $_SESSION['nome'] . "</p></div>";
                echo "<p id='parSair'><a href='phpc/destroiSession.php' id='sair'>Sair</a></p>";
            } ?></p>
        </div>


        <ul id="nav">

            <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroDemandas.php" style="font-family: Roboto"><img src="img/demand.png" class="plus">Cadastro de Demandas</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroResponsavel.php" style="font-family: Roboto;font-size: 15px"><img src="img/reinforcement.png" class="plus">Cadastro de Responsáveis</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="demandas.php" style="font-family: Roboto"><img src="img/tabela.png" class="plus">Relatório de Demandas</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="relatorioAuditoria.php" style="font-family: Roboto"><img src="img/auditoria.png" class="plus">Relatório de Auditoria</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="grafico.php" style="font-family: Roboto"><img src="img/graficoPreto.png" class="plus"> Relatório Gráfico</a></li>
 
        </ul>
    </nav>


    <section id="section">
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