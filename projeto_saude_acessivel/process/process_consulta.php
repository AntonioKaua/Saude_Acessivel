<?php
include_once ('conn.php');

$method = $_SERVER['REQUEST_METHOD'];

$result_horario = [];

if ($method === "POST") {
    $type = $_POST['type'];
    if ($type === "especialidades") {
        // Verifique se a especialidade foi enviada via POST

        $especialidade = $_POST['especialidade'];

        $query = $conn->prepare("SELECT DISTINCT dia_semana
        FROM horario_trabalho_medico AS htm
        JOIN medicos AS m ON htm.medico_id = m.funcionario_id
        JOIN especialidades AS e ON m.especialidade_id = e.id
        WHERE e.nome = :especialidade");
        $query->bindParam(':especialidade', $especialidade);
        $query->execute();
        $result_data = $query->fetchAll(PDO::FETCH_COLUMN);

        $result_serialized = serialize($result_data);

        // Construa a URL com a variável result serializada como parâmetro de consulta
        $redirect_url = "../consulta_data.php?especialidade=" . urlencode($especialidade) . "&result=" . urlencode($result_serialized);

        // Redirecione para a outra página
        header("Location: " . $redirect_url);
        exit;
    } else if ($type === 'data') {
        $data = $_POST['data_consulta'];
        $numero_dia_semana = date('w', strtotime($data));

        $especialidade = $_POST['especialidade'];

        $query = $conn->prepare("SELECT htm.horario_inicio, htm.horario_fim, f.nome AS nome_medico, m.funcionario_id AS medico_id
        FROM horario_trabalho_medico AS htm
        JOIN medicos AS m ON htm.medico_id = m.funcionario_id
        JOIN funcionarios AS f ON m.funcionario_id = f.id
        JOIN especialidades AS e ON m.especialidade_id = e.id
        WHERE htm.dia_semana = :dia_semana
        AND e.nome = :especialidade
        ");

        $query->bindParam(':dia_semana', $numero_dia_semana);
        $query->bindParam(':especialidade', $especialidade);
        $query->execute();
        $result_horario = $query->fetchAll();

        $hora_result_serialized = serialize($result_horario);

        $redirect_url = "../consulta_horario.php?especialidade=" . urlencode($especialidade) . "&result=" . urlencode($hora_result_serialized) . "dia=" . $data;
        header("Location: " . $redirect_url);
        exit;

    }else if($type === 'horario'){
        $especialidade = $_POST['especialidade'];
        $medico_id = $_POST['medico_id'];
        $horario = $_POST['horario_selecionado'];
        $data = $_POST['data'];
        $paciente_id = $_SESSION['usuario_id'];

        $data_hora = new DateTime($data . '' . $horario);

        $params = http_build_query([
            'especialidade' => $especialidade,
            'medico_id' => $medico_id,
            'data_hora' => $data_hora->format('Y-m-d H:i:s'),
            'paciente_id' => $paciente_id
        ]);
    
        header("Location: ../consulta_confirmacao.php?" . $params);
        exit;

        
    }elseif ($type === 'cadastrarC') {
        $especialidade = $_POST['especialidade'];
        $medico_id = $_POST['medico_id'];
        $paciente_id = $_SESSION['usuario_id'];
        $data_hora = $_POST['data_hora'];

        //resgatar o id da especialidade
        $query = $conn->prepare("SELECT id FROM especialidades WHERE nome = :nome");
        $query->bindParam(':nome', $especialidade);
        $query->execute();
        $especialidade_id = $query->fetchColumn();

        $insert= $conn->prepare('INSERT INTO consultas(medico_id, paciente_id, especialidadeC_id, data_hora) VALUES (:medico_id, :paciente_id, :especialidadeC_id, :data_hora)');
        $insert->bindParam(':medico_id', $medico_id);
        $insert->bindParam(':paciente_id', $paciente_id);
        $insert->bindParam(':especialidadeC_id', $especialidade_id);
        $insert->bindParam(':data_hora', $data_hora);
        $insert->execute();
    }
}
