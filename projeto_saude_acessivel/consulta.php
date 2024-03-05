<?php 
  include_once('process/process_consulta.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário com Carrossel</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>        
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<body>

<form id="form1" class="especialidadesForm" action="" method="POST">
  <h1>Qual a especialidade da Consulta?</h1>
  <label for="especialidade">Escolha a especialidade:</label>
  <p>Você pode filtrar na busca ou navegar pela letra inicial</p>
  <?php foreach($especialidades as $especialidade): ?>
    <label class="especialidadesLabel" onclick="submitForm('<?php echo $especialidade['nome']; ?>')"><?php echo $especialidade['nome']; ?></label><br>
  <?php endforeach; ?>
</form>

<form id="form2" class="especialidadesForm" action="" method="POST" style="display: none;">
  <h1>Selecione a data da sua consulta:</h1>
  <label for="data_consulta">Data da consulta:</label>
  <input type="text" id="data_consulta" name="data_consulta">
</form>

<form id="form3" class="especialidadesForm" action="" method="POST" style="display: none;">
  <h1>Confirme o horário da sua consulta:</h1>
  <label for="horario">Horário da consulta:</label>
  <input type="time" id="horario" name="horario">
</form>

<div id="ConfirmarConsulta" style="display: none;">
    <h1>Confira as Informações da <br>consulta:</h1>
    <form action="process_consulta.php" method="post">
        <div class="divConsulta">
            <p>Consulta de </p>
            <input type="text" readonly class="consultaTitulo" name="especialidade" id="especialidade_confirmacao">
            <input type="text" readonly class="dataHora" name="data" id="data_confirmacao"> <p>ás</p><br>
            <input type="text" readonly class="dataHora" name="horario" id="horario_confirmacao">
            <button type="submit">Confirmar</button>
        </div>
    </form>
</div>

<script>
  $(function() {
    $("#data_consulta").datepicker({
      dateFormat: "dd-mm-yy",
      dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
      dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
      dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
      monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
      monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'], // Formato da data
      onSelect: function(date) {
        submitForm2(date);
      }
    });

    $("#horario").change(function() {
      submitForm3();
    });
  });

  function submitForm(especialidade) {
    var form1 = document.getElementById("form1");
    var form2 = document.getElementById("form2");

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "especialidade");
    input.setAttribute("value", especialidade);

    form1.appendChild(input);
    form1.style.display = "none";
    form2.style.display = "block";
  }

  function submitForm2(date) {
    var form2 = document.getElementById("form2");
    var form3 = document.getElementById("form3");

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "data_consulta");
    input.setAttribute("value", date);

    form2.appendChild(input);
    form2.style.display = "none";
    form3.style.display = "block";
  }

  function submitForm3() {
    var form3 = document.getElementById("form3");
    var confirmarConsulta = document.getElementById("ConfirmarConsulta");
    var especialidade = document.querySelector('input[name="especialidade"]').value;
    var dataConsulta = document.getElementById("data_consulta").value;
    var horarioConsulta = document.getElementById("horario").value;

    document.getElementById("especialidade_confirmacao").value = especialidade;
    document.getElementById("data_confirmacao").value = dataConsulta;
    document.getElementById("horario_confirmacao").value = horarioConsulta;

    form3.style.display = "none";
    confirmarConsulta.style.display = "block";
  }
</script>
</body>
</html>
