/**
 * adiciona um novo campo.
 * @idDivInput recebe o id da div que deseja copiar o codigo.
 * @idDiv recebe o id da super div que deseja colar @idDivInput o codigo.
 */

var i = 1

function adicionar(idDivInput, idDiv, idCount) {

    /**
     * @input pega o codigo do campo.
     * @element pega o codigo que esta dentro da super div.
     */
    var input = document.getElementById(idDivInput).innerHTML;
    var element = document.getElementById(idDiv).innerHTML;


    if (i < idCount) {
        // adiciona o codigo do campo na super div e depois altera o codigo da super div
        element += input;
        document.getElementById(idDiv).innerHTML = element;
        i++;
    }
}

var a = 1

function adicionarf(idDivInput, idDiv, idCount) {

    /**
     * @input pega o codigo do campo.
     * @element pega o codigo que esta dentro da super div.
     */
    var input = document.getElementById(idDivInput).innerHTML;
    var element = document.getElementById(idDiv).innerHTML;


    if (a < idCount) {
        // adiciona o codigo do campo na super div e depois altera o codigo da super div
        element += input;
        document.getElementById(idDiv).innerHTML = element;
        a++;
    }
}

/**
 *calcua a quantidade de string no campo te texto.
 *@idInput recebe o id do campo de texto.
 *@idSpan recb i id do campo onde irar mostra a quantidade de strings atuais.
 */
function delimitador(idInput, idSpan) {

    // pega a area de texto
    var text = document.getElementById(idInput);

    /**
     * @conta pega o tamanho da string dentro do campo de texto.
     * @tamanho pela o valor do maxLength.
     */
    var contar = text.value.length;
    var tamanho = text.maxLength;

    // calcula em tempo real a quantidade de caracteres que ainda pode ser adicionada
    document.getElementById(idSpan).innerText = "Restam: " + (tamanho - contar) + " Caracteres";

    // verifica se atingiu a quantidade maxima de caracteres permitidos e avisa
    if (contar == 500) {
        document.getElementById(idInput).style.borderColor = 'red';
        document.getElementById(idSpan).style.color = 'red';
    } else {
        document.getElementById(idInput).style.borderColor = 'blue';
        document.getElementById(idSpan).style.color = 'blue';
    }
}

/**
 * imprimi a tabela.
 * @idDiv recebe o id da div que a tabela estiver dentro.
 */
function imprimir(idDiv) {

    var win = window.open("phpc/print.php")
    win.print()
}


    // $(document).ready(function () {
    //     var coluna = 12
    //     $(document.getElementsByTagName('th')[coluna]).hide()

    //     document.getElementsByTagName('tbody')[0].querySelectorAll('tr').forEach(function (a) {
    //         $(a.querySelectorAll("td")[coluna]).hide()
    //     })

    // }) função para retirar elementos