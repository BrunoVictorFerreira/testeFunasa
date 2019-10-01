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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- FONTES =========================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/cadastroDemandasStyle.css">
    <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="js/cadSistema.js"></script>

    <title>Cadastro de Sistemas</title>
</head>

<body>
    <div class="container-fluid">
        <nav id="barra-lateral">
            <a href="bemVindo.php"><img src="Img/Funasa.png" id="logo"></a>
            <div style="background-color: rgba(10,60,150,.6);padding: 10px;box-shadow: 0px 3px rgba(0,0,0,.3)">
                <p id="nomeSessao"><?php echo $_SESSION['nome'] ?></p>
            </div>
            <p id="parSair"><a href="confUsuario.php" id="sair">Alterar Senha</a></p>
            <p id="parSair"><a href="phpc/destroiSession.php" id="sair">Sair</a></p>
            <ul id="nav">

                <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroDemandas.php" style="font-family: Roboto"><img src="img/IconCadDemandas.png" class="plus">Cadastro de
                        Demandas</a></li>

                <li style="background-color: rgba(10,60,150,.3)"><a href="cadastroResponsavel.php" style="font-family: Roboto;font-size: 15px"><img src="img/IconCadDemandas.png" class="plus">Cadastro de Responsáveis</a></li>

                <li style="background-color: rgba(10,60,150,.3)"><a href="cadSistemas.php" style="font-family: Roboto;font-size: 15px"><img src="img/IconCadDemandas.png" class="plus">Cadastro de Sistema</a></li>

                <li style="background-color: rgba(10,60,150,.3)"><a href="demandas.php" style="font-family: Roboto"><img src="img/IconRelatorios.png" class="plus">Relatório de Demandas</a></li>

                <li style="background-color: rgba(10,60,150,.3)"><a href="relatorioAuditoria.php" style="font-family: Roboto"><img src="img/IconRelatorios.png" class="plus">Relatório de
                        Auditoria</a></li>

                <li style="background-color: rgba(10,60,150,.3)"><a href="grafico.php" style="font-family: Roboto"><img src="img/iconGrafico.png" class="plus"> Relatório Gráfico</a></li>

            </ul>
        </nav>



        <div class="container">
            <form method="POST" action="phpc/cadastro_sistema.php" style="margin-left: -10%;">
                <fieldset style="width: 60%;margin-top: 2.3%;border: 1px solid black; padding: 30px;border-radius: 5px;box-shadow:-5px 5px 5px 5px  rgba(0,0,0,.2)">
                    <legend style="width: 20%">
                        <div style="height: 30px;background-color: rgba(10,60,150,.8);border-radius: 3px;box-shadow: 2px 2px grey">
                            <p style="font-size: 20px;font-family: roboto;font-weight: bold;color:white;letter-spacing: 3px;text-align: center;margin-top: 2px">
                                FUNASA</p>
                        </div>
                    </legend>

                    <p id="loginTitle" style="margin-top: 0"><img src="img/IconCadDemandas.png" class="plus" />Cadastro
                        de Sistemas</p>




                    <!--TITULO DO SISTEMA =================================-->
                    <div class="row">
                        <div class="col-12">
                            <label style="font-family: roboto;">1. Nome Aplicação</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="titulo" class="form-control form-control-sm" style="width: 100%" placeholder="Ex: Sistema de Cadastro">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label style="font-family: roboto;">2. Descrição</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" name="descricao" style="width: 100%" class="form-control form-control-sm" placeholder="Ex: Sistema de Cadastro">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label style="font-family: roboto;">3. Finalidade</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"><input type="text" name="finalidade" class="form-control form-control-sm" style="width: 100%" placeholder="Ex: Sistema de Cadastro"></div>
                    </div>


                    <!--TIPO DE SISTEMA =================================-->
                    <!-- <div class="row"> -->
                    <fieldset style="width: 100%;margin-top: 1%;border: 1px solid black; padding: 25px;border-radius: 5px;">
                        <div class="row ">
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">4.
                                    Tipo Área
                                    <select name="tipoArea" class="form-control form-control-sm">
                                        <option value="F">Fim</option>
                                        <option value="M">Meio</option>
                                        <option value="C">Controle</option>
                                    </select>
                                </label>
                            </div>


                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">5.
                                    Área (Principal Usuária)
                                    <div id="areaPrin">
                                        <select name="areaUsuario[]" class="form-control form-control-sm">
                                            <option selected value="">Escolha uma área</option>
                                            <?php
                                            $query = $mysqli->query("SELECT * from unidade");
                                            while ($row = $query->fetch_assoc()) {
                                                echo ("<option value='" . $row['idUnid'] . "'>" . $row['siglasUnid'] . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                                <button class="btn" type="button" onclick="adicionar('addAreUser','areaPrin')"><span class="oi oi-plus"></span></button>
                                <div id="addAreUser"></div>
                            </div>


                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">6.
                                    Situação
                                    <select name="situacao" class="form-control form-control-sm">
                                        <option value="P">Produção</option>
                                        <option value="D">Desenvolvimento</option>
                                        <option value="N">Nova Versão</option>
                                        <option value="DC">Descontinuada</option>
                                        <option value="C">Só consulta</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-left: auto;margin-right:auto;display:block">7.
                                    Disponibilidade

                                    <select name="disponibilidade" class="form-control form-control-sm">
                                        <option value="24X7">24X7</option>

                                    </select>

                                </label>
                            </div>


                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-left: auto;margin-right:auto;display:block">8.
                                    Arquitetura
                                    <div id="arq">
                                        <select name="arquitetura[]" class="form-control form-control-sm">
                                        <option selected value="">Escolha uma arquitetura</option>
                                            <?php
                                            $query = $mysqli->query("SELECT * from arquitetura");
                                            while ($row = $query->fetch_assoc()) {
                                                echo ("<option value='" . $row['id'] . "'>" . $row['tipo'] . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                                <button class="btn" type="button" onclick="adicionar('addArq','arq')"><span class="oi oi-plus"></span></button>
                                <div id="addArq"></div>
                            </div>
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-left: auto;margin-right:auto;display:block">9.
                                    Linguagem
                                    <div id="ling">
                                        <select name="liguagem[]" class="form-control form-control-sm">
                                        <option selected value="">Escolha uma linguagem</option>
                                            <?php
                                            $query = $mysqli->query("SELECT * from ligua");
                                            while ($row = $query->fetch_assoc()) {
                                                echo ("<option value='" . $row['id'] . "'>" . $row['tipo'] . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                                <button class="btn" type="button" onclick="adicionar('addLing','ling')"><span class="oi oi-plus"></span></button>
                                <div id="addLing"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">10.
                                    Banco de Dados
                                    <select name="bd" class="form-control form-control-sm">
                                        <option value="O">Oracle</option>
                                        <option value="A">Acess</option>
                                        <option value="I">Interbase</option>
                                        <option value="P">Postgree</option>
                                        <option value="M">MySQL</option>
                                    </select>
                                </label>

                            </div>

                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">11.
                                    Desenvolvimento
                                    <select name="desenv" class="form-control form-control-sm">
                                        <option value="P">próprio</option>
                                        <option value="TI">Terceiro Interno</option>
                                        <option value="TE">Terceiro Externo Governo</option>
                                        <option value="PM">Produto do Mercado</option>
                                    </select>
                                </label>

                            </div>

                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">12.
                                    Cadastro
                                    <select name="cadastro" class="form-control form-control-sm">
                                        <option value="EA">Excel Aplicação</option>
                                        <option value="ELDAP">ELDAP</option>
                                        <option value="C">Compartilhado</option>
                                        <option value="CSPU">CSPU</option>
                                        <option value="SCA">SCA</option>
                                    </select>
                                </label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">13.
                                    Autenticação
                                    <select name="autenti" class="form-control form-control-sm">
                                        <option value="LA">Login na Aplicação</option>
                                        <option value="LR">Login na Rede</option>
                                        <option value="SSO">Single Sing On</option>
                                    </select>
                                </label>
                            </div>


                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">14.
                                    Plataforma
                                    <select name="plataforma" class="form-control form-control-sm">
                                        <option value="AM">Alta/ Mainframe</option>
                                        <option value="CS">Cliente - Servidor</option>
                                        <option value="S">Server/Storage</option>
                                        <option value="M">Mobile</option>
                                        <option value="SA">Stand Alone</option>
                                        <option value="W">Web</option>
                                    </select>
                                </label>
                            </div>


                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">15.
                                    Público Alvo
                                    <select name="pubAlvo" class="form-control form-control-sm">
                                        <option value="I">Interno</option>
                                        <option value="OPE">Orgão Público Externo</option>
                                        <option value="C">Convenente</option>
                                        <option value="PC">População/Cidadão</option>
                                        <option value="SE">Sistema Estruturante</option>
                                        <option value="OC">Orgão Controle</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">16.
                                    Acesso
                                    <select name="acesso" class="form-control form-control-sm">
                                        <option value="RI">Rede Interna</option>
                                        <option value="IE">Internet</option>
                                        <option value="IA">intranet</option>
                                        <option value="M">Mobile</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">17.
                                    Acessos Dia
                                    <textarea name="acessoDia" rows="1" cols="37"></textarea>
                                </label>
                            </div>

                            <div class="col-6">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">18.
                                    Acessos Simultâneo
                                    <textarea name="acessoSim" rows="1" cols="37"></textarea>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">19.
                                    Nível Sigilo
                                    <div style="width: 100%">
                                        <select name="sigilo" class="form-control form-control-sm">
                                            <option value="S">Sigiloso</option>
                                            <option value="P">Público</option>
                                            <option value="H">Híbrido</option>
                                        </select>
                                    </div>
                                </label>
                            </div>

                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">20.
                                    Autenticação
                                    <div style="width: 100%">
                                        <select name="atenti" class="form-control form-control-sm">
                                            <option value="SS">Senha Simples</option>
                                            <option value="SF">Senha Forte</option>
                                            <option value="C">Certificado Digital</option>
                                        </select>
                                    </div>
                                </label>
                            </div>

                            <div class="col-4">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">21.
                                    Impactos
                                    <div id="impac" style="width: 100%">
                                        <select name="impacto[]" class="form-control form-control-sm">
                                        <option selected value="">Escolha uma impacto</option>
                                            <?php
                                            $query = $mysqli->query("SELECT * from impacto");
                                            while ($row = $query->fetch_assoc()) {
                                                echo ("<option value='" . $row['id'] . "'>" . $row['tipo'] . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                                <button class="btn" type="button" onclick="adicionar('addImpac','impac')"><span class="oi oi-plus"></span></button>
                                <div id="addImpac"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">22.
                                    Envia Dados
                                    <div>
                                        <textarea name="enviarDados" rows="1" cols="37"></textarea>
                                    </div>
                                </label>
                            </div>

                            <div class="col-6">
                                <label style="font-family: roboto;margin-left: auto;margin-right:auto;display:block">23.
                                    Recebe Dados
                                    <div>
                                        <textarea name="receberDados" rows="1" cols="37"></textarea>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label style="font-family: roboto;">24. Gera BI: </label>
                                <span>
                                    <input type="radio" name="bi" value="1">Sim&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="bi" value="0">Não
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label style="font-family: roboto;">25. Observações
                                    <textarea name="observacao" placeholder="Limitado a 500 Caracteres" rows="4" cols="77" maxlength="500" oninput="delimitador('inputObs','contagemCarac1')"></textarea>
                                </label>
                                <span id="contagemCarac1"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="submit" id="boton" style="padding: 4px;margin-top: 10px;" value="CADASTRAR">
                            </div>
                        </div>
                    </fieldset>
            </form>
        </div>
        <br><br><br>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>