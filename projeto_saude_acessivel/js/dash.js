function aumentar(id) {
    var input = document.getElementById(id);
    var valor = parseInt(input.value);
    input.value = valor + 1;
}

function diminuir(id) {
    var input = document.getElementById(id);
    var valor = parseInt(input.value);
    input.value = valor - 1;
}

function inserirAumento(id) {
    var valorAdicionado = window.prompt("Digite a quantidade a ser adicionada");
    valorAdicionado = parseInt(valorAdicionado);
    var input = document.getElementById(id);
    var valor = parseInt(input.value);
    input.value = valor + valorAdicionado;
}

function inserirDiminuicao(id) {
    var valorRemovido = window.prompt("Digite a quantidade a ser retirada");
    valorRemovido = parseInt(valorRemovido);
    valorRemovido = valorRemovido * -1;
    var input = document.getElementById(id);
    var valor = parseInt(input.value);
    input.value = valor + valorRemovido
}
function confirmarEnvio(id) {
    var input = document.getElementById(id);
    var valor = parseInt(input.value);
    if (valor > 0) {
        var confirmar = confirm("Deseja adicionar " + valor + " unidades?");
    } else if (valor < 0) {
        valor = valor * -1;
        var confirmar = confirm("Deseja remover " + valor + " unidades?");
    } else {
        alert("Nenhum valor inserido. \nInsira os Valores Novamente!");
    }
    if (confirmar) {
        document.getElementById("formUpdate").submit();
    } else {
        return false;
    }
}
function confirmarEnvio2(tipo){
    if(tipo == 'deletar'){
        var confirmar = confirm("Deseja mesmo apagar esse medicamento do estoque?")
    }else if(tipo == 'zerar'){
        var confirmar = confirm("Deseja mesmo zerar a quantidade desse medicamento no estoque?")
    }
    if(confirmar){
        document.getElementById(tipo).submit();
    }else{
        return false;
    }
}
function filtrarMedicamentos() {
    var input, filtro;
    input = document.getElementById("filtroMedicamentos");
    filtro = input.value;
  
    // Envia o texto digitado para o servidor via AJAX para processamento
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process/filtrar_medicamentos.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Atualiza a tabela com os medicamentos filtrados
          var tabela = document.querySelector(".table-striped");
          tabela.innerHTML = xhr.responseText;
        } else {
          console.error("Erro ao processar requisição.");
        }
      }
    };
    xhr.send("filtro=" + filtro);
  }