<?php
session_save_path('../cache/temp');
session_start();
include('banco.php');
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    //NOME DO ARQUIVO
    $arquivo = 'demandas.xls';

    //HTML COM FORMATO DE PLANILHA
    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    $html .= '<td colspan="14" align="center">PLANILHA DE DEMANDAS</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="background-color: #5f79a2">Nº</th>';
    $html .= '<th style="background-color: #5f79a2">Titulo</th>';
    $html .= '<th style="background-color: #5f79a2">Tipo de Sistema</th>';
    $html .= '<th style="background-color: #5f79a2">Motivo Da Implantação</th>';
    $html .= '<th style="background-color: #5f79a2">Impacto Esperado</th>';
    $html .= '<th style="background-color: #5f79a2">Alinhamento</th>';
    $html .= '<th style="background-color: #5f79a2">Beneficiarios</th>';
    $html .= '<th style="background-color: #5f79a2">Unidades</th>';
    $html .= '<th style="background-color: #5f79a2">Objetivo</th>';
    $html .= '<th style="background-color: #5f79a2">Observações</th>';
    $html .= '<th style="background-color: #5f79a2">responsavelDemanda</th>';
    $html .= '<th style="background-color: #5f79a2">Data</th>';
    $html .= '<th style="background-color: #5f79a2">Registrado Por</th>';
    $html .= '<th style="background-color: #5f79a2">Pertencente a fabrica</th>';
    $html .= '</tr>';


    $query = "Select * from demandas";
    $result = $mysqli->query($query);
    $numDem = 1; //numeração de demandas
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $responsal = $row['fk_Responsavel'];
        $criadorDemandas = $row['criadorDemandas'];
        $id = $row['idDem'];

        $html .= "<tr><td style='vertical-align:middle;text-align:center;padding:5px;background-color:white;border-bottom: 1px solid black;font-weight: bold' class='tdTitulo'>" . $numDem++ . "</td>";
        $html .= "<td style='vertical-align:middle;text-align:center;padding:5px;background-color:white;border-bottom: 1px solid black;font-weight: bold' class='tdTitulo'>" . $row['titulo'] . "</td>";
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black;text-transform: uppercase' class='tdTipo'>" . $row['tipoSistema'] . "</td>";
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black;padding-left: 0px;padding-right: 0px' class='tdMotivo'>" . $row['motivoImplantacao'] . "</td>";
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black;padding-left: 0px;padding-right: 0px' class='tdImpacto'>" . $row['impactoNumBen'] . "</td>";

        // preenchimento do campo de alimhamento, verifica se o valor é "sim" ou "não"
        if ($row['alinhamento'] == "1") {
            $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black'>Sim</td>";
        } else {
            $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black'>Não</td>";
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
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdBen'>" . $htmlBen . "</td>";
        // ----------------

        // loop para puxar as unidade
        $htmlUni = "";
        $queryInnerUni = "SELECT u.siglasUnid from unidade as u  inner join demunid on  demunid.fk_Unidades = u.idUnid WHERE demunid.fk_Demandas = '$id'";
        $resultInnerUni = $mysqli->query($queryInnerUni);
        $i = 0;
        while ($rowIU = $resultInnerUni->fetch_array(MYSQLI_ASSOC)) {
            if ($i > 0) {
                $htmlUni .= " - ";
            }
            $htmlUni .= $rowIU['siglasUnid'];
            $i++;
        }
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdUnidade'>" . $htmlUni . "</td>";
        // ----------------

        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdObjetivo'>" . $row['objetivoSolucao'] . "</td>";
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdObs'>" . $row['obs'] . "</td>";

        // responsavel pela demanda
        $queryInnerRes = "SELECT r.* from responsavel as r inner join demandas on  demandas.fk_Responsavel = r.siape WHERE r.siape = '$responsal'";
        $resultInnerRes = $mysqli->query($queryInnerRes);
        $rowIR = $resultInnerRes->fetch_array(MYSQLI_ASSOC);
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdResp'>" . $rowIR['nome'] . " " . $rowIR['sobrenome'] . "</td>";
        // ----------------------------------------
        $data = new DateTime($row['dataCadastro']);
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black' class='tdData'>" . $data->format('d/m/Y H:i:s') . "</td>";

        $queryCriador = "SELECT u.nome from usuarios as u inner join demandas on  demandas.criadorDemandas = u.email WHERE u.email = '$criadorDemandas'";
        $queryCriador = $mysqli->query($queryCriador);
        $queryCriador = $queryCriador->fetch_array(MYSQLI_ASSOC);
        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black;border-right: 1px solid black' class='tdCadastro'>" . $queryCriador['nome'] . "</td>";

        if ($row['pertencente'] == 0) {
            $motivo = "Não, " . $row['motivo'];
        } else {
            $motivo = "Sim";
        }


        $html .=  "<td style='vertical-align:middle;text-align:center;background-color: white;border-bottom: 1px solid black;border-right: 1px solid black' class='tdCadastro'>" . $motivo . "</td>";
    }
    $result->close();

    //FORCAR DOWNLOAD
    include('exportarExcell.php');

    //ENVIAR O CONTEUDO DO ARQUIVO
    echo $html;
    exit;
    ?>
</body>

</html>
<?php
$mysqli->close();
