<?php
include_once('conn.php');

$method = $_SERVER['REQUEST_METHOD'];

    if ($method === "GET") {
        $especialidadesQuery = $conn->query("SELECT especialidades.nome AS especialidade, funcionarios.nome AS nome_medico
                                            FROM medicos
                                            JOIN especialidades ON medicos.especialidade_id = especialidades.id
                             JOIN funcionarios ON medicos.funcionario_id = funcionarios.id;");
        $especialidades = $especialidadesQuery->fetchAll();
}