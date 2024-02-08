<?php
include_once("conn.php");

$method = $_SERVER['REQUEST_METHOD'];
$unidade = $_SESSION['unidade'];
$medicamentos = [];

if($method == 'GET'){
    $estoqueQuery = $conn->prepare("SELECT * FROM medicamentos WHERE unidade = :unidade;");
    $estoqueQuery->bindParam(':unidade', $unidade);
    $estoqueQuery->execute();
    $medicamentos = $estoqueQuery->fetchAll(PDO::FETCH_ASSOC);
    
}else if($method == 'POST'){
    if($type == 'UPDATE'){
        $valor = $_POST['quantidade'];
        $atualizar_quantidade_de_medicamentos = $conn->prepare("UPDATE medicamentos SET quantidade = quantidade + :valor WHERE id = :id");
        $atualizar_quantidade_de_medicamentos->bindParam(':valor', $valor);
        $atualizar_quantidade_de_medicamentos->execute();
    }
};