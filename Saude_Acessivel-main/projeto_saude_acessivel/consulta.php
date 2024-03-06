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
    <label class="especialidadesLabel" onclick="submitForm('<?php echo $especialidade['especialidade']; ?>')"><?php echo $especialidade['especialidade']; ?></label><br>
  <?php endforeach; ?>
</form>

<form id="form2" class="especialidadesForm" action="" method="POST" style="display: none;">
  <h1>Selecione a data da sua consulta:</h1>
  <label for="data_consulta">Data da consulta:</label>
  <input type="text" id="data_consulta" name="data_consulta">
</form>

<?php if(isset($horarios) && !empty($horarios)): ?>
    <form id="form3" class="especialidadesForm" action="" method="POST" style="display: none;">
        <h1>Confirme o horário da sua consulta:</h1>
        <?php foreach($horarios as $horario): ?>
            <h2><?php echo $horario['nome_medico']?></h2>
            <label for="horario"><?php echo $horario['horario_inicio'] ?></label>
        <?php endforeach; ?>
    </form>
<?php endif; ?>

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
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        onSelect: function(date) {
            submitForm2(date);
            handleConsultaResponse(date); // Nova função para lidar com a resposta da consulta
        }
    });

    // Função para lidar com a resposta da consulta
    function handleConsultaResponse(selectedDate) {
        // Realize uma chamada AJAX para obter informações sobre os dias disponíveis
        $.ajax({
            type: 'POST',
            url: 'process/process_disponibilidade.php', // Substitua pelo caminho correto do seu arquivo PHP
            data: { selectedDate: selectedDate },
            success: function(response) {
                // 'response' deve conter informações sobre os dias disponíveis
                var diasDisponiveis = JSON.parse(response);

                // Destaque os dias disponíveis no calendário
                $("#data_consulta").datepicker("option", "beforeShowDay", function(date) {
                    var dateString = $.datepicker.formatDate("dd-mm-yy", date);
                    return [diasDisponiveis.includes(dateString), ''];
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});


    $("#horario").change(function() {
      submitForm3();
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
  function verificarHorarios(){
    var data = document.getElementById("data_consulta").value;
  }
</script>
</body>
</html>
