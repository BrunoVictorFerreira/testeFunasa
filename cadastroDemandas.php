<?php
error_reporting(0);

// define onde foi salvo o arquivo de sessão
session_save_path('cache/temp/');

session_start();
include_once("phpc/verSession.php");
include_once("phpc/banco.php");

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Demandas</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/cadastroDemandasStyle.css">
    <link rel="icon" href="img/favicon.png">
    <script src="js/script.js">

   

    </script>
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!--==========-======================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


</head>

<body>

    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <div style="background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)">
            <p id="nomeSessao"><?php echo $_SESSION['nome'] #informa o usuario logado 
                                ?></p>
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

        <!--COMECO FORMULARIO ==========================================-->
        <form method="POST" action="phpc/cadDemandas.php">
            <fieldset style="width: 50%;margin-top: 2.3%;border-radius: 5px;box-shadow:-5px 5px rgba(0,0,0,.2)">
                <legend style="width: 20%">
                    <div style="height: 30px;background-color: rgba(10,60,150,.8);border-radius: 3px;box-shadow: 2px 2px grey">
                        <p style="font-size: 20px;font-family: roboto;font-weight: bold;color:white;letter-spacing: 3px;text-align: center;margin-top: 2px">FUNASA</p>
                    </div>
                </legend>
                <p id="loginTitle" style="margin-top: 2%;"><img src="img/IconCadDemandas.png" class="plus" />Cadastro de Demandas</p>




                <!--TITULO DO SISTEMA =================================-->
                <label for="inputTitulo" id="labelTitulo">1. Título do Sistema/Função<br>
                    <input id="inputTitulo" type="text" name="titulo" placeholder="Ex: Sistema de Cadastro"></label>

                <!--TIPO DE SISTEMA =================================-->
                <label for="inputTipoSistema" id="labelTipoSistema">2. Indique se trata-se de um novo sistema, se é um sistema existente ou então se é um sistema legado
                    <div style="width: 100%">
                        <select id="inputTipoSistema" name="tipo">
                            <option value="novo">NOVO</option>
                            <option value="existente">EXISTENTE</option>
                            <option value="legado">LEGADO</option>
                        </select></label>
                </div>

                <!--MOTIVO IMPLANTAÇÃO =================================-->

                <label for="inputImplantacao" id="labelImplantacao">3. Caso seja uma nova demanda qual a principal medida a ser implementada? Em qual circunstância?
                    <textarea id="inputImplantacao" name="implantacao" rows="5" cols="50"></textarea></label>


                <!--IMPACTO ESPERADO =================================-->

                <label for="inputImpacto" id="labelImpacto">4. Descreva o impacto esperado e indique o número aproximado de usuários beneficiados
                    <textarea id="inputImpacto" name="impacto" rows="5" cols="50"></textarea></label>

                <!--ALINHAMENTO ESRATEGICO ==================================-->
                <label for="inputAlinhamento" id="labelAlinhamento">5. A iniciativa possui alinhamento estratégico?
                    <span id="inputAlinhamento"><input type="radio" name="alinhamento" value="1">Sim&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="alinhamento" value="0">Não</span></label>

                <!--BENEFICIARIOS DA AÇÃO =================================-->

                <!-- Div para formatação do label -->
                <div id="divLabelAcao"><label for="inputBenAcao" id="labelBenAcao">6. Beneficiário da Ação</div>
                <!-- Primeira Div 1.1-->
                <div>
                    <!-- Segunda Div 1.2-->
                    <div>
                        <!-- Select -->
                        <table style="margin-left: 3%">

                            <!-- linha segundaria -->
                            <tr>
                                <td id="form" style="width: 100px;"></td>
                            </tr>
                            <tr>

                                <td id="ben" style="width: 80%;">
                                    <select id="inputBenAcao" name="ben[]">
                                        <option selected value=''>- Selecione um beneficiário -</option>
                                        <?php
                                        include_once("phpc/banco.php");
                                        $query = $mysqli->query("SELECT * FROM beneficiarios");
                                        $num = $query->num_rows;

                                        while ($array = $query->fetch_array(MYSQLI_ASSOC)) {
                                            $html = "<option value='" . $array['idBen'] . "'>";
                                            $html .= $array['beneficiario'];
                                            $html .= "</option>";
                                            echo $html;
                                        }
                                        $query->close();
                                        ?>
                                    </select>
                                </td>
                                <!-- Fim Select -->
                                <!-- Fechamento Segunda Div 1.2 -->

                                <!-- Botão Adicionar -->
                                <td>
                                    <div id=""><input TYPE="BUTTON" NAME="submit" id="btnBenAcao" onclick="adicionar('ben','form','<?php echo $num; ?>')" value=" + "></div>
                                </td>

                            </tr>

                        </table>

                        <!-- Fechamento do Label -->
                        </label>
                    </div>
                    <!-- Fechamento 1 div 1.1 -->
                </div>


                <!-- SETORES ENVOLVIDOS ====================== -->

                <div id="divLabelSetor"><label for="inputSetor" id="labelSetor">7. Setores Envolvidos</div>
                <div>
                    <div>
                        <table style="margin-left: 3%;margin-bottom: 2%">
                            <tr>
                                <td id="form2" style="width:100px;"></td>
                            </tr>
                            <td id="ben2" style="width: 80%"><select id="inputSetor" name="uni[]">
                                    <option selected value=''>- Selecione uma unidade/setor -</option>
                                    <?php

                                    // busca e lista as unidade cadastradar
                                    $query = $mysqli->query("SELECT * FROM unidade");

                                    // define a quantidade de registro de unidade tem no banco
                                    $num = $query->num_rows;



                                    while ($array = $query->fetch_array(MYSQLI_ASSOC)) {
                                        $html = "<option value='" . $array['idUnid'] . "'>";
                                        $html .= $array['siglasUnid'];
                                        $html .= "</option>";
                                        echo $html;
                                    }


                                    // fecha a consulta

                                    $query->close();
                                    ?>
                                </select></td>
                    </div>
                    <td><input TYPE="BUTTON" NAME="submit" id="btnSetor" onclick="adicionarf('ben2','form2','<?php echo $num; ?>')" value=" + "></td>
                    </tr>
                    </table>
                    </label>
                </div>


                <!-- OBJETIVOS SOLUÇÃO ======================================-->

                <label for="inputObjSolucao" id="labelObjSolucao">8. De maneira descritiva e breve, indique os principais objetivos da solução
                    <textarea id="inputObjSolucao" placeholder="Limitado a 500 Caracteres" name="objetivo" rows="5" cols="50" maxlength="500" oninput="delimitador('inputObjSolucao','contagemCarac')"></textarea><span id="contagemCarac"></span></label>



                <!--OBSERVAÇÕES-->
                <label for="inputObs" id="labelObs">9. Observações
                    <textarea id="inputObs" name="observacao" placeholder="Limitado a 500 Caracteres" rows="5" cols="50" maxlength="500" oninput="delimitador('inputObs','contagemCarac1')"></textarea><span id="contagemCarac1"></span></label>


                <!--SETORES ENVOLVIDOS =====================================-->



                <!--RESPONSAVEL PELA DEMANDA =====================================-->

                <div id="form2">
                    <div id="ben2">
                        <label for="inputResp" id="labelResp">10. Responsável pela Demanda
                            <select id="inputResp" name="siape">
                                <option selected value=''>- Selecione um responsavel -</option>
                                <?php

                                // busca e lista os resgistro de responsaveis
                                $query = $mysqli->query("SELECT * FROM responsavel");
                                while ($array = $query->fetch_array(MYSQLI_ASSOC)) {
                                    $html = "<option value='" . $array['siape'] . "'>";
                                    $html .= $array['nome'] . " " . $array['sobrenome'];
                                    $html .= "</option>";
                                    echo $html;
                                }

                                // fecha a consulta
                                $query->close();
                                ?>
                            </select>
                        </label>
                    </div>

  <!-- Pertence a fabrica de software ==================================-->
                    <script>
                        function exibeCaixa(){
                            document.getElementById("caixa").style.display = "inline-block";
                        }
                        function someCaixa(){
                            document.getElementById("caixa").style.display = "none";
                        }
                    </script>
                    <label for="inputRefere" id="labelRefere">11. Refere-se ao processo de contratação da fábrica de software?
                    <span id="inputRefere"><input type="radio" name="pertence" id="pertence" value="1" onClick="someCaixa()"><label for="pertence">Sim</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="pertence" id="pertence2" value="0" onclick="exibeCaixa()"><label for="pertence2">Não</label></span></label>
                    
                    <div id="caixa" style="margin-left: -1%;" hidden>
                    <label id="labelMotivo11"> 11.1 Motivo</label>
                    <select id="inputResp" name="motivo" style="padding:5px;font-family:roboto;font-weight:bold;width: 300px;margin-left: 3%">
                        <option value=""></option>
                        <option value="Aquisição de licenças de software">Aquisição de licenças de software</option>
                        <option value="Sistema proprietário do Governo Federal">Sistema proprietário do Governo Federal</option>
                        <option value="BI">B.I.</option>
                        <option value="Elaboração de normas e procedimentos para o uso do sistema">Elaboração de normas e procedimentos para o uso do sistema</option>
                        <option value="Implantação do SIADS">Implantação do SIADS</option>
                    </select>
                    </div>


                    <input type="submit" id="boton" style="margin-top: 3%;margin-left: 3%;" value="CADASTRAR">

        </form>
        </fieldset>
        <br><br><br>
    </section>


    <footer id="footerCadDemandas">

        <p class="tituloFooter">Ministério da Saúde</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>

    </footer>
</body>

</html>
<?php
$mysqli->close();
