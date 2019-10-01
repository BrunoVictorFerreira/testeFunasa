<?php
// define a pasta em que foi salvo o arquivo da session
session_save_path('../cache/temp/');

session_start();
unset($_SESSION['nome']);
unset($_SESSION['email']);
session_destroy();
header('location: ../index.html');
