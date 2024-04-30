<?php 
  include_once('process/especialidades.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário consulta</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>        
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<body>

<form id="form1" action="process/process_consulta.php" class="especialidadesForm" method="POST">
  <h1>Qual a especialidade da Consulta?</h1>
  <label for="especialidade">Escolha a especialidade:</label>
  <p>Você pode filtrar na busca ou navegar pela letra inicial</p>
  <?php foreach($especialidades as $especialidade): ?>
    <label class="especialidadesLabel" onclick="submitForm('<?php echo $especialidade['especialidade']; ?>')">
    <?php echo $especialidade['especialidade']; ?></label>
  <?php endforeach; ?>
  <input type="hidden" id="especialidadeInput" name="especialidade" value="">
  <input type="text" hidden name="type" id="" value="especialidades">
</form>

<script>
  function submitForm(especialidade) {
    var form1 = document.getElementById("form1");
    form1.target = "_self"; // Define o target como _self
    document.getElementById("especialidadeInput").value = especialidade;
    document.getElementById("form1").submit();
    form1.style.display = "none";

    return false;
  }
</script>
</body>
</html>
