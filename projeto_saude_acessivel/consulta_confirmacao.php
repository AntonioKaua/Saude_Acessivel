<?php
include_once('process/conn.php');

// Verifique se os parâmetros estão definidos na URL
if (isset($_GET['especialidade'], $_GET['medico_id'], $_GET['data_hora'], $_GET['paciente_id'])) {
    // Resgate os parâmetros da URL
    $especialidade = $_GET['especialidade'];
    $medico_id = $_GET['medico_id'];
    $data_hora = $_GET['data_hora'];
    $paciente_id = $_GET['paciente_id'];

    // Faça o que for necessário com os parâmetros resgatados
    echo "Especialidade: $especialidade<br>";
    echo "ID do médico: $medico_id<br>";
    echo "Data e hora: $data_hora<br>";
    echo "ID do paciente: $paciente_id<br>";

    // Consulta para obter o nome do paciente
    $pacienteQuery = $conn->prepare('SELECT nome FROM usuarios WHERE id = :id');
    $pacienteQuery->bindParam(':id', $paciente_id);
    $pacienteQuery->execute();
    $paciente = $pacienteQuery->fetchColumn();

    // Consulta para obter o nome do médico
    $medicoQuery = $conn->prepare('SELECT f.nome AS nome_medico
        FROM medicos AS m
        JOIN funcionarios AS f ON m.funcionario_id = f.id
        WHERE m.funcionario_id = :medico_id;');
    $medicoQuery->bindParam(':medico_id', $medico_id);
    $medicoQuery->execute();
    $medico = $medicoQuery->fetchColumn();
} else {
    echo "Parâmetros ausentes na URL.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Consulta</title>
</head>
<body>
<div id="ConfirmarConsulta">
    <h1>Confira as Informações da Consulta:</h1>
    <form action="process/process_consulta.php" method="post">
        <div class="divConsulta">
            <h2>Consulta de <?php echo $especialidade ?></h2>
            <p>Paciente: <?php echo $paciente ?></p>
            <p>Data e hora: <?php echo $data_hora ?></p>
            <p>Médico responsável: <?php echo $medico ?></p>

            <input type="hidden" value="<?php echo $especialidade ?>" name="especialidade">
            <input type="hidden" value="<?php echo $data_hora ?>" name="data_hora"> 
            <input type="hidden" value="<?php echo $paciente_id ?>" name="paciente_id">
            <input type="hidden" value="<?php echo $medico_id ?>" name="medico_id">
            <input type="text" value="cadastrarC" name="type" id="">
            <button type="submit">Confirmar</button>
        </div>
    </form>
</div>
</body>
</html>
