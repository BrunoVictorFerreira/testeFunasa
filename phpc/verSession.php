<?php
// verificador de sessão
session_save_path('../cache/temp/');
session_start();
if (empty($_SESSION['nome'])) {
    header('location: ../index.html');
}
