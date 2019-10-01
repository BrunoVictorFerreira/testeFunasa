<?php
error_reporting(0);
session_save_path('cache/temp');
session_start();
include_once('phpc/banco.php');

$result = $mysqli->query("SELECT * from demandas where pertencente = '1' and statusDemandas = '0'");
$total = $result->num_rows;

$sistema = "";
$ids = [];
$tipos = ['siga', 'siconv', 'sicotweb', 'spgo', 'bi', 'siarh', 'siafi', 'sicavi', 'sei'];
foreach ($tipos as $value) {
    $result = $mysqli->query("SELECT idDem from demandas where pertencente = '1' and statusDemandas = '0' and titulo like '%" . mb_strtolower($value) . "%'");
    $sistema .= "['" . mb_strtoupper($value) . "',$result->num_rows, '" . number_format(($result->num_rows * 100)/ $total, 2, ',', '') . " %'],";
    $ids = array_merge($ids, arrayId($result));
}

function outros($totalDem, $array)
{
    return $totalDem - count($array);
}

function arrayId($result)
{
    $array = [];
    while ($row = $result->fetch_row()) {
        $array[] = $row[0];
    }
    return $array;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/BemVindoStyle.css">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/grafico.css">
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">

    <!--==========-======================-->
    <title>Funasa</title>


    <!-- graficos -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = google.visualization.arrayToDataTable([
                ['Demandas', 'Quantidade de demandas', {
                    role: 'annotation'
                }],
                <?php echo $sistema ?>['Outros', <?php echo outros($total, $ids); ?>, <?php echo "'" . number_format(((outros($total, $ids) * 100) / $total), 2, ',', '') . "%'" ?>],
            ]);
            var options = {
                title: 'Total de demandas: <?php echo $total ?>',
                vAxis: {
                    title: 'Número de demandas'
                },
                // largura do grafico
                width: 800,

                // altura do grafico
                height: 500,

                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
                backgroundColor: 'transparent',
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        // grafico de tipo de sistema
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart)

        // função de construir o grafico
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Tipo de Sistema'],
                <?php

                // gera os dados que será exibido no grafico
                $html = "";
                $result = $mysqli->query("SELECT tipoSistema,count(tipoSistema) FROM demandas  where pertencente = '1'  and statusDemandas = '0' GROUP BY tipoSistema ORDER BY count(tipoSistema)");
                while ($row = $result->fetch_assoc()) {
                    $html .=  "['" . mb_strtoupper($row['tipoSistema']) . "', " . $row['count(tipoSistema)'] . "],";
                }

                echo $html;
                ?>
            ]);

            var options = {
                pieHole: 0.4,
                backgroundColor: 'transparent',

            };

            // construi o grafico
            var chart = new google.visualization.PieChart(document.getElementById('tipo'))
            chart.draw(data, options)
        }
    </script>

    <script type="text/javascript">
        // grafico de demandas cancelados
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart)

        // função de construir o grafico
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'demandas canceladas'],
                <?php

                // gera os dados que será exibido no grafico
                $result = $mysqli->query("SELECT count(statusDemandas) from demandas where pertencente = '1' and statusDemandas = '0'");
                $resultCan = $mysqli->query("SELECT count(statusDemandas) from demandas where pertencente = '1' and statusDemandas = '1'");
                $row = $result->fetch_row();
                $rowCan = $resultCan->fetch_row();

                echo "['Demandas Ativas'," . $row[0] . "],['Demandas Canceladas'," . $rowCan[0] . "]";
                ?>
            ]);

            var options = {
                pieHole: 0.4,
                backgroundColor: 'transparent',

            };

            // construi o grafico
            var chart = new google.visualization.PieChart(document.getElementById('demCancel'))
            chart.draw(data, options)
        }
    </script>
</head>

<body style="background-image: url('Img/backGrafico.jpg')">
    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <div style="background-color: rgba(10,60,150,.6);padding: 11px;box-shadow: 0px 3px rgba(0,0,0,.3)">
            <p id="nomeSessao"><?php echo $_SESSION['nome'] #mostra o nome do usuario logado 
                                ?></p>
        </div>
        <p id="parSair"><a href="confUsuario.php" id="sair">Alterar Senha</a></p>
        <p id="parSair"><a href="phpc/destroiSession.php" id="sair">Sair</a></p>

        <ul id="nav">

            <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroDemandas.php" style="font-family: Roboto"><img src="img/demand.png" class="plus">Cadastro de Demandas</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroResponsavel.php" style="font-family: Roboto;font-size: 15px"><img src="img/reinforcement.png" class="plus">Cadastro de Responsáveis</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="demandas.php" style="font-family: Roboto"><img src="img/tabela.png" class="plus">Relatório de Demandas</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="relatorioAuditoria.php" style="font-family: Roboto"><img src="img/auditoria.png" class="plus">Relatório de Auditoria</a></li>

            <li style="background-color: rgba(10,60,150,.3)"><a href="grafico.php" style="font-family: Roboto"><img src="img/graficoPreto.png" class="plus"> Relatório Gráfico</a></li>

        </ul>
    </nav>
    <div id="divCabeca">
        <img src="Img/graficoPng.png" id="graficoPng">
        <h1 id="h1">Relatório Gráfico</h1>
        <!-- <hr id="hr"> -->
        <fieldset id="field">
            <legend align="center">
                <div style="display:inline-block;height: 30px;background-color: rgba(10,60,150,.8);border-radius: 3px;box-shadow: 2px 2px grey">
                    <p style="font-size: 20px;font-family: roboto;font-weight: bold;color:white;letter-spacing: 3px;text-align: center;margin-top: 2px">FUNASA</p>
                </div>
            </legend>
        </fieldset>
    </div>

    <div id="divGraficoGeral">

        <!-- tag do grafico -->
        <h3 style="margin-left:13%;position:absolute;margin-top: 5%;font-family: roboto">Gráfico de Relatório de Demanda</h3>
        <h3 style="margin-left:64%;position:absolute;margin-top: 5%;font-family: roboto">Tipo de Sistema</h3>

        <!-- tag do grafico de relatório de demandas -->
        <div id="relDem">
            <div id="chart_div"></div>
        </div>

        <!-- tag do grafico de tipo de sistema -->
        <div id="tiposis">
            <div id="tipo" style="height: 500px"></div>
        </div>

        <!-- tag do grafico de demandas cancelados -->
        <div id="">
            <div id="demCancel" style="height: 500px"></div>
        </div>
    </div>


    <footer id="footerBemVindo">

        <p class="tituloFooter">Ministério da Saude</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>

    </footer>
    <?php
    // fechar banco
    $result->close();
    $resultCan->close();
    $mysqli->close();
    ?>
</body>

</html>