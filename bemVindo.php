<?php
error_reporting(0);
session_save_path('cache/temp');
session_start();

include_once('phpc/banco.php');
$query = "SELECT * from demandas";
$result = mysqli_query($mysqli,$query);
$total = mysqli_num_rows($result);
$fs = $mysqli->query("SELECT * from demandas WHERE pertencente = '1'");
$fs = $fs->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/BemVindoStyle.css">
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap&subset=latin-ext" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">

    <!--==========-======================-->
    <title>Funasa</title>

</head>

<body>
    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <div style="background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)">
            <p id="nomeSessao"><?php echo $_SESSION['nome']#mostra o nome do usuario logado ?></p>
        </div>
        <p id="parSair"><a href="confUsuario.php" id="sair">Alterar Senha</a></p>
        <p id="parSair"><a href="phpc/destroiSession.php" id="sair">Sair</a></p>

        <ul id="nav">
       <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroDemandas.php" style="font-family: Roboto"><img src="img/IconCadDemandas.png" class="plus">Cadastro de Demandas</a></li>

        <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroResponsavel.php" style="font-family: Roboto;font-size: 15px"><img src="img/IconCadDemandas.png" class="plus">Cadastro de Responsáveis</a></li>

        <li style="background-color: rgba(10,60,150,.3)"><a href="demandas.php" style="font-family: Roboto"><img src="img/IconRelatorios.png" class="plus">Relatório de Demandas</a></li>

        <li style="background-color: rgba(10,60,150,.3)"><a href="relatorioAuditoria.php" style="font-family: Roboto"><img src="img/IconRelatorios.png" class="plus">Relatório de Auditoria</a></li>

        <li style="background-color: rgba(10,60,150,.3)"><a href="grafico.php" style="font-family: Roboto"><img src="img/iconGrafico.png" class="plus"> Relatório Gráfico</a></li>

        </ul>
    </nav>


    <section id="section" class="alinharObjeto">


        <p class="focus-in-expand" style="letter-spacing:-3px;text-align:left;margin-top:5%;font-size: 60px;font-family: montSerrat;color: #325480;animation-name: focus-in-expand;animation-duration: 2s;text-shadow: 2px 1px rgba(0,0,0,.3)">BEM VINDO <span style="text-transform: uppercase;color: #19877d;text-shadow: 2px 1px rgba(0,0,0,.5)"><?php echo $_SESSION['nome']# puxa o nome do usuario logado ?><Clique>
        </p>
        <p class="tracking-in-contract" style="margin-left: 5%;margin-top:0%;font-size: 30px;font-family: 'Roboto';font-weight: bold;color: #325480;animation-name: focus-in-expand;animation-duration: 2s;text-shadow: 3px 2px rgba(0,0,0,.3)">ao Sistema de Cadastro de demandas de Tecnologia da Informação da <span style="text-transform: uppercase;color: #ce2c33;animation-name: tracking-in-contract;animation-duration: 2s;text-shadow: 2px 1px rgba(0,0,0,.5)">Funasa</span></p>



        <!-- <ul style="animation-duration: 2s;animation-name: text-focus-in">
            <li style="color:#325480;font-family: roboto;font-weight: bold;font-size: 20px;margin-top: 20px">Demandas<br>
                &emsp;&emsp;|<br>&emsp;&emsp;| _ _ _ _ _ _ _ <span style="text-shadow: 1px 1px rgba(0,0,0,.2)">Clique em tabelas para visualizar todas as demandas cadastradas atualmente</span></li>
            <li style="color:#325480;font-family: roboto;font-weight: bold;font-size: 20px;margin-top: 20px">Cadastro de Demandas<br>
                &emsp;&emsp;|<br>&emsp;&emsp;| _ _ _ _ _ _ _ <span style="text-shadow: 2px 2px rgba(0,0,0,.2)">Clique em Cadastro de Demandas para cadastrar uma nova demanda</span></li>
            <li style="color:#325480;font-family: roboto;font-weight: bold;font-size: 20px;margin-top: 20px">Cadastro de Responsáveis<br>
                &emsp;&emsp;|<div>&emsp;&emsp;| _ _ _ _ _ _ _ <span style="text-shadow: 2px 2px rgba(0,0,0,.2)">Clique em cadastro de responsáveis para cadastrar um novo usuário no sistema</span></li>
        </ul> -->
        <div id="divGeral">
        <div id="divComoUsar"><p id="pComoUsar">Como usar o site? <span id="spanPasse">(Passe o mouse por cima de cada Item!)</span></p></div>
        <div class="tooltip" id="cadastrarResponsaveis">&emsp;Cadastrar Responsáveis&emsp;<br><span class="tooltiptext">Ao Clicar em <span style="color:yellow">"Cadastro de Responsáveis"</span> você será redirecionado para à página de cadastro de <span style="color:yellow">NOVOS</span> responsáveis</span></div>
        <div class="tooltip" id="cadastrarDemandas">&emsp;&emsp;Cadastrar Demandas&emsp;&emsp;<br><span class="tooltiptext">Ao clicar em <span style="color:yellow">"Cadastrar Demandas"</span> você será redirecionado para à página de cadastro de <span style="color:yellow">NOVAS</span> demandas</span></div>
        <div class="tooltip" id="demandas">&emsp;&emsp;Demandas&emsp;&emsp;<br><span class="tooltiptext">Clique em <span style="color:yellow">"Demandas"</span> para acessar todas as demandas registradas atualmente</span></div>
        </div>

        <div>
            <h2 style="color:#335580;margin-top:2%;margin-left: 3%; font-family: roboto">No momento estão cadastradas <span style="color: #19877d"><?php echo $total; ?></span> demandas</h2>
			<h3 style="color:#335580;margin-top:2%;margin-left: 3%; font-family: roboto"><span style="color: #19877d"><?php echo $fs; ?></span> demandas são referentes a fábrica de software e <span style="color: #19877d"><?php echo $total - $fs; ?></span> referem-se a demandas de diferentes objetos não correlatados a fábrica.</h3>
        </div>


    </section>


    <footer id="footerBemVindo">

        <p class="tituloFooter">Ministério da Saude</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>

    </footer>
</body>

</html>