<?php
error_reporting(0);
include('banco.php');
session_save_path('../cache/temp/');
session_start();
include('verSession.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório De Demandas</title>
    <p align="center" style="margin-left: 9%;">Fabrica de Software</p>
</head>

<body>

    <style>
        tr {
            page-break-inside: avoid
        }

        .thNum{
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .thTitulo {
            padding-right: 30px;
            padding-left: 30px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .tdTitulo {
            font-size: 10px;
        }

        .thTabela {
            padding-right: 15px;
            padding-left: 15px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .thMotivo {
            padding-right: 40px;
            padding-left: 40px;
            background-color: #cecece;
            font-size: 12px;
            border-top: 1px solid black;
        }

        .thImpacto {
            padding-right: 60px;
            padding-left: 60px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .tdImpacto {
            font-size: 11px;
        }

        .tdMotivo {
            font-size: 11px;
        }

        .tdObjetivo {
            font-size: 11px;
        }

        .tdBen {
            font-size: 10px;
        }

        .tdObs {
            font-size: 11px;
        }

        .thAlinhamento {
            padding-right: 5px;
            padding-left: 5px;
            background-color: #cecece;
            font-size: 11px;
            border-top: 1px solid black;
        }

        .thBen {
            padding-right: 5px;
            padding-left: 5px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .thObjetivo {
            padding-right: 40px;
            padding-left: 40px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .thObs {
            padding-right: 10px;
            padding-left: 10px;
            background-color: #cecece;
            font-size: 14px;
            border-top: 1px solid black;
        }

        .tdResp {
            font-size: 10px;
        }

        .tdData {
            font-size: 10px;
        }

        .tdCadastro {
            font-size: 10px;
        }

        .tdTipo {
            font-size: 10px;
        }

        .tdUnidade {
            font-size: 10px;
        }
    </style>

    </div>

    <div id="tabela-imprimir">

        <table border="1" style='border-right:0;border-top:0;border-bottom:0;border-radius: 5px;text-align:center;width: 90%;border-spacing: 0px;font-size: 13px;font-family:Montserrat'>
            <th class="thNum">
                Nº
            </th>
            <th class="thTitulo">
                TÍTULO
            </th>
            <th class="thTabela">
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
            <th class="thBen">
                BENEFICIÁRIOS
            </th>
            <th class="thTabela">
                UNIDADES
            </th>
            <th class="thObjetivo">
                OBJETIVO
            </th>
            <th class="thObs">
                OBSERVAÇÕES
            </th>
            <th class="thTabela" style="border-right: 1px solid black">
                RESPONSÁVEL
            </th>

            <?php

            // gera a tabela
            $result = $mysqli->query("SELECT * FROM demandas WHERE pertencente = '1'");
            $numDem = 1; //numeração de demandas
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $responsal = $row['fk_Responsavel'];
                $criadorDemandas = $row['criadorDemandas'];
                $id = $row['idDem'];

                echo "<tr><td style='vertical-align:middle;text-align:center;padding:5px;background-color:white;border-bottom: 1px solid black;font-weight: bold' class='tdTitulo'>" . $numDem++ . "</td>";
                echo "<td style='padding:5px;background-color:white;border-bottom: 1px solid black;font-weight: bold' class='tdTitulo'>" . $row['titulo'] . "</td>";
                echo "<td style='background-color: white;border-bottom: 1px solid black;text-transform: uppercase' class='tdTipo'>" . $row['tipoSistema'] . "</td>";
                echo "<td style='background-color: white;border-bottom: 1px solid black;padding-left: 0px;padding-right: 0px' class='tdMotivo'>" . $row['motivoImplantacao'] . "</td>";
                echo "<td style='background-color: white;border-bottom: 1px solid black;padding-left: 0px;padding-right: 0px' class='tdImpacto'>" . $row['impactoNumBen'] . "</td>";

                // preenchimento do campo de alimhamento, verifica se o valor é "sim" ou "não"
                if ($row['alinhamento'] == "1") {
                    echo "<td style='background-color: white;border-bottom: 1px solid black'>Sim</td>";
                } else {
                    echo "<td style='background-color: white;border-bottom: 1px solid black'>Não</td>";
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
                echo "<td style='background-color: white;border-bottom: 1px solid black' class='tdBen'>" . $htmlBen . "</td>";
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
                echo "<td style='background-color: white;border-bottom: 1px solid black' class='tdUnidade'>" . $htmlUni . "</td>";
                // ----------------

                echo "<td style='background-color: white;border-bottom: 1px solid black' class='tdObjetivo'>" . $row['objetivoSolucao'] . "</td>";
                echo "<td style='background-color: white;border-bottom: 1px solid black' class='tdObs'>" . $row['obs'] . "</td>";

                // responsavel pela demanda
                $queryInnerRes = "SELECT r.* from responsavel as r inner join demandas on  demandas.fk_Responsavel = r.siape WHERE r.siape = '$responsal'";
                $resultInnerRes = $mysqli->query($queryInnerRes);
                $rowIR = $resultInnerRes->fetch_array(MYSQLI_ASSOC);
                echo "<td style='background-color: white;border-bottom: 1px solid black;border-right: 1px solid black' class='tdResp'>" . $rowIR['nome'] . " " . $rowIR['sobrenome'] . "</td>";
            }
            $result->close();
            ?>
        </table>
        <script>
            close()
        </script>
</body>

</html>