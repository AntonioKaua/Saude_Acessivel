<?php 
include_once ('conn.php');

$method = $_SERVER['REQUEST_METHOD'];

    if ($method === "GET") {
        $especialidadesQuery = $conn -> query("SELECT * FROM especialidades;");
        $especialidades = $especialidadesQuery->fetchAll();
        
   }
