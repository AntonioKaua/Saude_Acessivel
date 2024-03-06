<?php 
include_once ('conn.php');

$method = $_SERVER['REQUEST_METHOD'];

    if ($method === "GET") {
        $especialidadesQuery = $conn->query("SELECT especialidades.nome AS especialidade, funcionarios.nome AS nome_medico
                                            FROM medicos
                                            JOIN especialidades ON medicos.especialidade_id = especialidades.id
                                            JOIN funcionarios ON medicos.funcionario_id = funcionarios.id;");
        $especialidades = $especialidadesQuery->fetchAll();
        
        if (isset($_POST['especialidade'])) {
            $nomeEspecialidade = $_POST['especialidade'];
        
            $horariosQuery = $conn->prepare("SELECT
                funcionarios.nome AS nome_medico,
                especialidades.nome AS especialidade,
                horario_trabalho_medico.dia_semana,
                horario_trabalho_medico.horario_inicio,
                horario_trabalho_medico.horario_fim
                FROM
                medicos
                JOIN
                horario_trabalho_medico ON medicos.funcionario_id = horario_trabalho_medico.medico_id
                JOIN
                especialidades ON medicos.especialidade_id = especialidades.id
                JOIN
                funcionarios ON medicos.funcionario_id = funcionarios.id
                WHERE
                especialidades.nome = :especialidade");
        
            $horariosQuery->bindParam(':especialidade', $nomeEspecialidade);
            $horariosQuery->execute();
        
            $horarios = $horariosQuery->fetchAll();
        }
   }
