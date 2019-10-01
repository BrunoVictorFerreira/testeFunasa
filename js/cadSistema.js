var id = 0

function adicionar(idDiv, idInput) {
    /**
     * @input pega o codigo do campo.
     * @element pega o codigo que esta dentro da super div.
     */
    var input = "<div id ='" + id + "' >"
    input += document.getElementById(idInput).innerHTML
    input += '<button class="btn" onclick="'
    input += "excluir(" + id + ")"
    input += '" type="button"><span class="oi oi-trash"></span></button>'
    input += "</div>"

    id++

    var element = document.getElementById(idDiv).innerHTML
    document.getElementById(idDiv).innerHTML = element + input
}

function excluir(id) {
    var html = document.getElementById(id)
    html.parentNode.removeChild(html)
}