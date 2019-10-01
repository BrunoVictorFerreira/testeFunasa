<?php
/**
 * Undocumented telefone
 *
 * @param String $tel
 * @return int
 * 
 * filtra os caracteres gerados pela mascara.
 */
function telefone($tel)
{
    $telefone = str_replace("(", "", $tel);
    $telefone = str_replace(")", "", $telefone);
    $telefone = str_replace(" ", "", $telefone);
    $telefone = str_replace("-", "", $telefone);
    return (int) $telefone;
}
