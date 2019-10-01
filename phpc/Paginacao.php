<?php

class Paginacao
{

    function pagina($pagina)
    {
        return (!$pagina) ? 1 : $pagina;
        /*
         * define que a primeira pagina sempre seja igual a 1.
         * @pagina captura o número da pagina atual com $_GET['pagina'].
         */
    }

    function regInicial($pagina, $totalReg)
    {
        return ($pagina - 1) * $totalReg;
        /*
         * retorna o valor da posição que iniciara a busca do registro (LIMIT ['regInicial'],[$totalReg]).
         * @pagina recebe o número da pagina atual.
         * @totalReg recebe o número total de resgistro no banco.
         */
    }

    function anterior($pagina)
    {
        return --$pagina;
        /*
         * retorna um valor a menos da pagina atual.
         */
    }

    function proximo($pagina)
    {
        return ++$pagina;
        /*
         * retorna um valor a mais da pagina atual.
         */
    }
    function botao($totalReg, $numrows, $pagina, $style, $styleSpan)
    {
        $pag = $numrows / $totalReg;
        if ($pagina > 1) {
            echo "<a href='?pagina=" . $this->anterior($pagina) . "'><button type='button' $style><- Anterior</button></a>";
        }

        // cria a lista de pagina existente
        $numPag = 1;
        while (ceil($pag) >= $numPag) {

            // verifica se o numPagina tem o msm valor da pagina atual, vai imprimir um span caso verdadeiro, caso falso imprime um link com para a pagina desejada
            if ($numPag == $pagina) {
                echo "<span $styleSpan>" . $numPag . "</span> ";
            }
            
            // verifica se esta numPag está 5 casas a baixo da pagina atual ou 5 casas a cima
            elseif (($numPag >= ($pagina - 5) && $numPag < $pagina) || ($numPag >= ($pagina + 1) && $numPag < ($pagina + 6))) {
                echo "<a href='?pagina=" . $numPag . "' $styleSpan>" . $numPag . "</a> ";
            }
            
            // verifica se numPag está 6 casas a cima da pagina atual
            elseif($numPag == ($pagina + 7)){
                echo "<a href='?pagina=" . ($pagina + 6) . "' $styleSpan> ... </a> ";
            }
            
            // verifica se numPag está 6 casas a baixo da pagina atual
            elseif($numPag == ($pagina - 6)){
                echo "<a href='?pagina=" . ($pagina - 6) . "' $styleSpan> ... </a> ";
            }

            $numPag++;
        }


        if ($pagina < $pag) {
            echo "<a href='?pagina=" . $this->proximo($pagina) . "'><button type='button' $style>Proximo -></button></a>";
        }

        /*
         * cria os botões de "Voltar" e "Prosseguir".
         * @pagina recebe o numero atual da pagina.
         * @numrows recebe o valor total de resgistro do banco(mysqli_num_rows).
         */
    }
}
