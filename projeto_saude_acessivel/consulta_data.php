<?php
    // Verifica se a variável result está definida e não está vazia
if (isset($_GET['result']) && !empty($_GET['result'])) {
    // Desserializa a variável result
    $result_data = unserialize($_GET['result']);
    print_r($result_data);

    $especialidade = urldecode($_GET['especialidade']);

} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
</head>
<bodys>
 <form id="form2" class="especialidadesForm" action="process/process_consulta.php" method="POST" target="_self">
  <h1>Selecione a data da sua consulta:</h1>
  <label for="data_consulta">Data da consulta:</label>
  <input type="text" id="data_consulta" name="data_consulta">
  <button type="submit" class="submitBtn">Prosseguir</button>
  <input type="text" hidden name="type" id="" value="data">
  <input type="text" hidden name="especialidade" value="<?php echo $especialidade ?>">
</form>

<script>
$(document).ready(function() {
    // Dias da semana a serem destacados
    var diasDestacados = <?php echo json_encode($result_data); ?>;

    $("#data_consulta").datepicker({
        dateFormat: "dd-mm-yy",
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        minDate: 0,
        maxDate: "+1M",
        beforeShowDay: function(date) {
            // Obter o número do dia da semana (0 para Domingo, 1 para Segunda, etc.)
            var dayOfWeek = date.getDay();
            // Verificar se o número do dia da semana está presente no array de dias destacados
            if (diasDestacados.indexOf(dayOfWeek) !== -1) {
                // Retorna [true, 'destacado'] para destacar o dia
                return [true, 'destacado'];
            } else {
                // Retorna [false] para desabilitar a seleção de dias não destacados
                return [false];
            }
        }
    });
});
</script>
<style>
    .ui-datepicker-calendar .destacado a {
        background-color: lightgreen !important;
    }
    .submitBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 999;
        }
</style>
</body>
</html>