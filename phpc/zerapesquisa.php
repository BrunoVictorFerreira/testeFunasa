<?php
error_reporting(0);
session_save_path('../cache/temp/');
session_start();

$pagina = $_GET['pagina'];
unset($_SESSION['pesquisa']);
unset($_SESSION['pesquisaDem']);

header("location:".$pagina);