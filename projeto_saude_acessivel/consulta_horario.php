<?php
date_default_timezone_set('America/Sao_Paulo');
if (isset($_GET['result']) && !empty($_GET['result']) && isset($_GET['data'])) {
    $result_horario = unserialize($_GET['result']);
    $especialidade = urldecode($_GET['especialidade']);
    $data = urldecode($_GET['data']);

    print_r($result_horario);

} else {
    // Lógica para o caso em que não há resultados
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="process/process_consulta.php" method="POST">
    <h1>Escolha o Horario</h1>
    <?php foreach ($result_horario as $row): ?>
            <?php $nome_medico = $row['nome_medico'];
            $horario_inicio = $row['horario_inicio'];
            $horario_fim = $row['horario_fim'];
            $medico_id = $row['medico_id'];
            $inicio = new DateTime($horario_inicio);
            $fim = new DateTime($horario_fim);

            $intervalo = new DateInterval('PT30M');

            $atual = clone $inicio; ?>
            <h2><?php echo $nome_medico ?></h2>
        

            <h2>Horários disponíveis</h2>
            <div class='horarios'>
            <?php
            $inputs_por_linha = 5; // Defina o número de inputs por linha
            $contador = 0;
            while ($atual <= $fim): ?>
                <button type="button" class="horario-btn" data-horario="<?php echo $atual->format('H:i') ?>" data-medico="<?php echo $medico_id ?>">
                <?php echo $atual->format('H:i') ?>
                </button>

                <?php
                $atual->add($intervalo); // Adiciona o intervalo de 30 minutos
            
                $contador++;

                if ($contador % $inputs_por_linha == 0) {
                        echo "<br>";
                }
                ?>
            <?php endwhile; ?>
        </div>
    <?php endforeach; ?>
    <input type="hidden" name="horario_selecionado" id="horario_selecionado">
    <input type="hidden" name="medico_id" id="medico_selecionado">
    <input type="text" name="especialidade" hidden id="" value="<?php echo $especialidade ?>">
    <input type="text" name="data" hidden id="" value="<?php echo $data ?>">
    <input type="text" hidden name="type" id="" value="horario">
    <button type="submit" id="prosseguir-btn">Prosseguir</button>
    </form>
    <script>
      // Captura todos os botões de horário
const horarioBtns = document.querySelectorAll('.horario-btn');

// Adiciona um ouvinte de evento para cada botão de horário
horarioBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove a classe 'selecionado' de todos os botões de horário
        horarioBtns.forEach(btn => {
            btn.classList.remove('selecionado');
        });

        // Adiciona a classe 'selecionado' ao botão de horário clicado
        this.classList.add('selecionado');

        // Atualiza o valor do input hidden com o horário selecionado
        document.getElementById('horario_selecionado').value = this.dataset.horario;

        // Define o ID do médico selecionado no input hidden
        document.getElementById('medico_selecionado').value = this.dataset.medico;
    });
});

    </script>
</body>
</html>