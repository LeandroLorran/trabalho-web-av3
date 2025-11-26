function validarFormulario() {
    var nome = document.getElementById('nome').value;
    var preco = document.getElementById('preco').value;

    if (nome.length < 3) {
        alert("O nome do produto deve ter pelo menos 3 letras.");
        return false; // Impede o envio
    }

    if (preco <= 0) {
        alert("O preço deve ser maior que zero.");
        return false; // Impede o envio
    }

    return true; // Permite o envio
}