<?php
error_reporting(0);
session_save_path('cache/temp/');
session_start();
include('phpc/banco.php');
include('phpc/verSession.php');
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/respStyle.css">

    <script src="js/script.js"></script>
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!--==========-======================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(".celular").mask("(00) 00000-0000");
    </script>
    
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!--==========-======================-->
    <title>Cadastro de Responsavel</title>
</head>

<body>
    <nav id="barra-lateral">
        <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
        <div style="background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)">
            <p id="nomeSessao"><?php echo $_SESSION['nome'] # mostra o nome do usuario logado
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


    <section id="section" class="alinharObjeto">


        <!--COMECO DO FORM====================================-->

        <fieldset style="width: 50%;margin-top: 2.3%;border-radius: 5px;box-shadow:-5px 5px rgba(0,0,0,.2)">
            <legend style="width: 20%">
                <div style="height: 30px;background-color: rgba(10,60,150,.8);border-radius: 3px;box-shadow: 2px 2px grey">
                    <p style="font-size: 20px;font-family: roboto;font-weight: bold;color:white;letter-spacing: 3px;text-align: center;margin-top: 2px">FUNASA</p>
                </div>
            </legend>
            <p id="loginTitle" style="margin-top: 0px;margin-bottom: 2%"><img src="img/IconCadDemandas.png" class="plus">Cadastro de Responsável</p>
            <form method="POST" action="phpc/cadResponsavel.php">



                </div>

                <!--FORM 'nome' =====================================-->
                <label for="inputNome" id="labelNome">1. Nome &emsp;&emsp;&nbsp;
                    <input id="inputNome" type="text" name="nome" placeholder="João"></label>

                <!--FORM 'sobrenome' =====================================-->
                <label for="inputSobrenome" id="labelSobrenome">2. Sobrenome
                    <input id="inputSobrenome" type="text" name="sobrenome" placeholder="Silva Santos"></label>


                <!--FORM 'telefone' =====================================-->
                <label for="inputTelefone" id="labelTelefone">3. Telefone &nbsp;&nbsp;&nbsp;&nbsp;
                    <input id="inputTelefone" class="celular" placeholder="(DDD) XXXXX - XXXX" type="text" name="telefone"></label>

                <!--FORM 'email' =====================================-->
                <label for="inputEmail" id="labelEmail">4. Email &emsp;&emsp;&nbsp;
                    <input id="inputEmail" type="email" name="email" placeholder="email@email.com"></label>

                <!--FORM 'siape' =====================================-->
                <label for="inputSiape" id="labelSiape">5. Siape &emsp;&emsp;&nbsp;
                    <input id="inputSiape" type="number" maxlength="7" name="siape" placeholder="XXXXXXX"></label>


                <!--FORM 'setor/unidade' =====================================-->
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
                    <td><input TYPE="BUTTON" NAME="submit" id="btnSetor" onclick="adicionarf('ben2','form2','<?php echo $num;?>')" value=" + "></td>
                    </tr>
                    </table>
                    </label>
                </div>

                </label>
                <input type="submit" id="botaoCad" value="CADASTRAR">
        </fieldset>

        </form>
        <!--FIM DO FORM====================================-->
        <!-- <img src="img/funasaImg.png" id="imgFunasaCadResponsavel">     -->
    </section>


    <footer id="footerCadResponsavel">

        <p class="tituloFooter">Ministério da Saude</p>
        <p class="tituloFooter">Fundação Nacional de Saúde</p>

    </footer>
</body>

</html>
<?php
$mysqli->close();
?>