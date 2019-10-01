<?php
error_reporting(0);
include('phpc/banco.php');
session_save_path('cache/temp/');
session_start();
include('phpc/verSession.php');

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/demandaStyle.css">
    <script src="js/script.js"></script>

    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--==========-======================-->
    <title>Demandas</title>
    <style>

        .idIcon{
            max-height:25px;
            display:inline-block;
            margin:5px;
        }
        #tdACAO{
            border-right:1px solid black;
            border-left: 1px solid black;
        }

        #footer{
        background-color: #1f477a;
        color: white;
        padding: 2px;
        position: fixed;
        bottom: 0;
        left: -4;
        right: 0;
        width: 100%;
        }
        #tabela-imprimir{
        margin-left: 1%;
        }

        body {
            background-size: 100%;
            background-image: url('../img/backDemandas.png');
        }
    </style>
</head>

<body>


    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <div style="background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)">
            <p id="nomeSessao"><?php echo $_SESSION['nome'] ?></p>
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


    <section id="section">
        <p id="loginTitle" style="margin-bottom: 1%">DEMANDAS</p>
        <p style="text-align:center"><a href="phpc/zerapesquisa.php?pagina=<?php echo $_SERVER["REQUEST_URI"] ?>" style="opacity: 0.7;color: black;text-decoration:none;font-family: roboto;font-size: 12px;font-weight:bold" onclick="zerar()">ZERAR FILTRO</a></p>
        <div style="margin-left: 36%;margin-bottom: 2.5%">

            <!--PRIMEIRO FORM =======================-->
            <div style="display: inline-block;width: 12%;margin-left: -2%;margin-right:2%">
                <form action="cadastroDemandas.php">
                    <input type="submit" value="Nova Demanda" style="cursor:pointer;box-shadow: 2px 2px rgba(0,0,0,.2);padding: 5px;background-color:rgba(0,0,0,.0);font-size: 15px;border: 1px solid #00a158;color:#00a158;border-radius: 5px;font-weight: bold;outline: 0;">
                </form>
            </div>
            <!--background-color:#19877d;padding: 5px;cursor: pointer;font-family:roboto; border: 1px solid darkblue;color:white;border-radius: 3px-->

            <!--SEGUNDO FORM =======================-->

            <div class="tooltip" style="display: inline-block;width: 18%;">
                <form action="" method="post">
                    <div style="box-shadow: 2px 2px rgba(0,0,0,.2);padding:4px;border: 1px solid #1f477a;border-radius: 5px">
                        <input name="cam_pesquisa" type="search" style="color:#1f477a;width: 85%;height: 20px;display: inline-block;padding:10px;outline:0;background-color:rgba(0,0,0,.0);border:0">
                        <div style="float: right;border-radius: 2px"><button type="submit" style="background-color:rgba(0,0,0,.0);border: 0 solid rgba(0,0,0,.0);cursor:pointer"><img src="img/lupa.png" style="max-height:20px"></button></div>
                    </div>




                </form>

                <span class="tooltiptext">Pesquise Por <span style="color:red">Título</span> ou <span style="color:red">Motivo de Implantação</span></span>
            </div>

            <!--TERCEIRO FORM =======================-->
            <div style="display: inline-block;width: 15%;margin-left: 2%">
                <form action="" method="post">
                    <input name="MinhasDemandas" type="submit" value="Minhas Demandas" style="cursor:pointer;box-shadow: 2px 2px rgba(0,0,0,.2);padding: 5px;background-color:rgba(0,0,0,.0);font-size: 15px;border: 1px solid #00a158;color:#00a158;border-radius: 5px;font-weight: bold;outline: 0;">
                </form>
            </div>

        </div>

        <!-- FINAL DOS FORMS =====================-->

        <div id="tabela-imprimir" style="margin-left: auto">
		
            <table border="1" style='border-right:0;border-top:0;border-bottom:0;border-radius: 5px;text-align:center;width: 90%;border-spacing: 0px;font-size: 13px;font-family:Montserrat'>
                <th class="thTitulo">
                    TÍTULO
                </th>
                <th class="thTabela" style="font-size: 12px">
                    TIPO DE SISTEMA
                </th>
                <th class="thMotivo">
                    MOTIVO IMPLANTAÇÃO
                </th>
                <th class="thImpacto">
                    IMPACTO
                </th>
                <th class="thAlinhamento">
                    ALINHAMENTO
                </th>
                <th class="thBen" style="font-size: 12px;padding:1">
                    BENEFICIÁRIOS
                </th>
                <th class="thTabela" style="font-size: 12px;padding:1">
                    UNIDADES
                </th>
                <th class="thObjetivo">
                    OBJETIVO
                </th>
                <th class="thObs">
                    OBSERVAÇÕES
                </th>
                <th class="thTabela">
                    RESPONSÁVEL
                </th>
                <th class="thTabela">
                    DATA
                </th>
                <th class="thTabela" style="font-size: 10px">
                    REGISTRADO POR
                </th>
                <th style="padding: 20px; background-color:#cecece;border-top: 1px solid black;border-right: 1px solid black;border-bottom: 0px solid black">
                    AÇÃO
                </th>
                
                
                <?php

                // gerando class da paginação
                include_once('phpc/Paginacao.php');

                // cria o objeto da paginação
                $paginacao = new Paginacao();

                // total de registro que deve ser mostrado
                $totalReg = 20;

                // pega o número da página
                $pagina = $paginacao->pagina($_GET['pagina']);

                // pesquisa de demandas
                if (isset($_POST['cam_pesquisa'])) {
                    $_SESSION['pesquisaDem'] = $_POST['cam_pesquisa'];
                    // define a query de pesquisa
                    $query = "SELECT * FROM demandas where statusDemandas = 0 and pertencente = '1' AND (titulo like '%" . $_SESSION['pesquisaDem'] . "%' or motivoImplantacao like '%" . $_SESSION['pesquisaDem'] . "%') LIMIT " . $paginacao->regInicial($pagina, $totalReg) . ",$totalReg";
                    $query2 = "SELECT * FROM demandas where statusDemandas = 0 and pertencente = '1' AND (titulo like '%" . $_SESSION['pesquisaDem'] . "%' or motivoImplantacao like '%" . $_SESSION['pesquisaDem'] . "%')";
                } else if (isset($_SESSION['pesquisaDem'])) {
                    $query = "SELECT * FROM demandas where statusDemandas = 0 and pertencente = '1' AND (titulo like '%" . $_SESSION['pesquisaDem'] . "%' or motivoImplantacao like '%" . $_SESSION['pesquisaDem'] . "%') LIMIT " . $paginacao->regInicial($pagina, $totalReg) . ",$totalReg";
                    $query2 = "SELECT * FROM demandas where statusDemandas = 0 and pertencente = '1' AND (titulo like '%" . $_SESSION['pesquisaDem'] . "%' or motivoImplantacao like '%" . $_SESSION['pesquisaDem'] . "%')";
                }
                // filtra as demandas do usuario da sessão atual
                elseif (isset($_POST['MinhasDemandas'])) {
                    $email = $_SESSION['email'];
                    // define a query de filtro
                    $query = "SELECT * FROM demandas where statusDemandas = 0 and criadorDemandas = '$email'  AND pertencente = '1' LIMIT " . $paginacao->regInicial($pagina, $totalReg) . ",$totalReg";
                    $query2 = "SELECT * FROM demandas where statusDemandas = 0 and criadorDemandas = '$email' AND pertencente = '1'";
                } else {
                    // sem nenhuma bucas ou filtro
                    $query = "SELECT * FROM demandas WHERE statusDemandas = 0 and pertencente = '1' LIMIT " . $paginacao->regInicial($pagina, $totalReg) . ",$totalReg";
                    $query2 = "SELECT * FROM demandas WHERE statusDemandas = 0 and pertencente = '1'";
                }

                // gera a tabela
                $result = $mysqli->query($query);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $responsal = $row['fk_Responsavel'];
                    $criadorDemandas = $row['criadorDemandas'];
                    $id = $row['idDem'];

                    echo "<tr><td style='background-color:white;font-weight: bold;text-transform: uppercase' class='tdTitulo'>" . $row['titulo'] . "</td>";
                    echo "<td style='background-color: white;text-transform: uppercase' class='tdTipo'>" . $row['tipoSistema'] . "</td>";
                    echo "<td style='background-color: white' class='tdMotivo'>" . $row['motivoImplantacao'] . "</td>";
                    echo "<td style='background-color: white' class='tdImpacto'>" . $row['impactoNumBen'] . "</td>";

                    // preenchimento do campo de alimhamento, verifica se o valor é "sim" ou "não"
                    if ($row['alinhamento'] == "1") {
                        echo "<td style='background-color: white;'>Sim</td>";
                    } else {
                        echo "<td style='background-color: white;'>Não</td>";
                    }
                    // ---------------------------

                    // loop para puxar os beneficiarios'
                    $htmlBen = "";
                    $queryInnerBen = "SELECT b.beneficiario from beneficiarios as b  inner join bendem on  bendem.fk_Beneficiarios = b.idBen WHERE bendem.fk_Demandas = '$id'";
                    $resultInnerBen = $mysqli->query($queryInnerBen);
                    $i = 0;
                    while ($rowIB = $resultInnerBen->fetch_array(MYSQLI_ASSOC)) {
                        if ($i > 0) {
                            $htmlBen .= " ";
                        }
                        $htmlBen .= $rowIB['beneficiario'] . "<br>";
                        $i++;
                    }
                    echo "<td style='background-color: white;' class='tdBen'>" . $htmlBen . "</td>";
                    // ----------------

                    // loop para puxar as unidade
                    $htmlUni = "";
                    $queryInnerUni = "SELECT u.siglasUnid from unidade as u  inner join demunid on  demunid.fk_Unidades = u.idUnid WHERE demunid.fk_Demandas = '$id'";
                    $resultInnerUni = $mysqli->query($queryInnerUni);
                    $i = 0;
                    while ($rowIU = $resultInnerUni->fetch_array(MYSQLI_ASSOC)) {
                        if ($i > 0) {
                            $htmlUni .= "<br>";
                        }
                        $htmlUni .= $rowIU['siglasUnid'];
                        $i++;
                    }
                    echo "<td style='background-color: white;' class='tdUnidade'>" . $htmlUni . "</td>";
                    // ----------------

                    echo "<td style='background-color: white;' class='tdObjetivo'>" . $row['objetivoSolucao'] . "</td>";
                    echo "<td style='background-color: white;' class='tdObs'>" . $row['obs'] . "</td>";

                    // responsavel pela demanda
                    $queryInnerRes = "SELECT r.* from responsavel as r inner join demandas on  demandas.fk_Responsavel = r.siape WHERE r.siape = '$responsal'";
                    $resultInnerRes = $mysqli->query($queryInnerRes);
                    $rowIR = $resultInnerRes->fetch_array(MYSQLI_ASSOC);
                    echo "<td style='background-color: white;' class='tdResp'>" . $rowIR['nome'] . " " . $rowIR['sobrenome'] . "</td>";
                    // ----------------------------------------
                    $data = new DateTime($row['dataCadastro']);
                    echo "<td style='background-color: white;' class='tdData'>" . $data->format('d/m/Y H:i:s') . "</td>";

                    $queryCriador = "SELECT u.nome from usuarios as u inner join demandas on  demandas.criadorDemandas = u.email WHERE u.email = '$criadorDemandas'";
                    $queryCriador = $mysqli->query($queryCriador);
                    $queryCriador = $queryCriador->fetch_array(MYSQLI_ASSOC);
                    echo "<td style='background-color: white;' class='tdCadastro'>" . $queryCriador['nome'] . "</td>";

                    echo "<td id='tdACAO' style=''>
                            <a class='hrefExcluir' href='phpc/excluirDemanda.php?excluir=$id&pagina=".$_SERVER["REQUEST_URI"]."'><img src='img/excluir.png' class='idIcon'></a> 
                            <a class='hrefExcluir' href='phpc/cancelar.php?cancelar=$id&pagina=".$_SERVER["REQUEST_URI"]."'><img src='img/cancelar.png' class='idIcon'></a> 
                    </td></tr>" ;
                }
                echo "<td colspan='13' style='border-top: 1px solid black'></td></table>";
                $result->close();
                ?>
                
            </table>
            <!-- botões da paginação -->
        </div>
        <div style="margin-left: 45%;">
            <?php

            $style = "style='
                margin-top: 2%;
                
                cursor:pointer;
                
                color:white;
                font-family:roboto;
                border:1px solid black;
                background-color:#355681;
                outline: 0;
                padding: 2px;
                border-radius: 6px;
                '";

            $styleSpan = "style='
                font-family:sans-serif;
                font-weight:bold;
                padding: 2px;
                text-decoration:none;
                '";

            $query2 = $mysqli->query($query2);
            $paginacao->botao($totalReg, $query2->num_rows, $pagina, $style, $styleSpan);
            $query2->close();
            ?>
        </div>

        <!-- gerar planilha -->
        <a href="phpc/gerarPlanilha.php">
            <button type="button" style="margin-left: 4%;margin-top: 2%;float:center;box-shadow:2px 2px grey;cursor:pointer;color:white;font-family:roboto;border:1px solid black;background-color:darkgreen;outline: 0;padding: 5px;border-radius: 6px;">Gerar Excel</button>
        </a>
        <!-- imprimir tabela -->
        <button type="submit" value="imprimir" style="margin-top: 2%;float:center;box-shadow:2px 2px grey;cursor:pointer;color:white;font-family:roboto;border:1px solid black;background-color:darkgreen;outline: 0;padding: 5px;border-radius: 6px;" onclick="imprimir('tabela-imprimir')">Imprimir</button>


        <div style="height: 14%"></div> <!-- espaçamento para fechamento de rodapé -->

    </section>

    <footer id="footer">
        <p class="tituloFooter">Ministério da Saude</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>
    </footer>
</body>

</html>
<?php
$resultInnerBen->close();
$resultInnerUni->close();
$resultInnerRes->close();
$queryCriador->close();
$mysqli->close();
