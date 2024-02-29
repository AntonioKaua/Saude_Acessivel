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
    $type = $_POST['type'];
    $id = $_POST['id'];
    if($type == 'ATUALIZAR'){
        $valor = $_POST['valor'];
        $atualizar_quantidade_de_medicamentos = $conn->prepare("UPDATE medicamentos SET quantidade = quantidade + :valor WHERE id = :id");
        $atualizar_quantidade_de_medicamentos->bindParam(':valor', $valor);
        $atualizar_quantidade_de_medicamentos->bindParam(':id', $id);
        $atualizar_quantidade_de_medicamentos->execute();
        header('Location: ../dashboards/dashboard_estoque.php');
    }
    elseif($type == 'ZERAR'){
        $zerar_estoque = $conn->prepare('UPDATE medicamentos SET quantidade = 0 WHERE id = :id');
        $zerar_estoque->bindParam(':id', $id);
        $zerar_estoque->execute();
        header('Location: ../dashboards/dashboard_estoque.php');
    }
    elseif($type == 'DELETAR'){
        $deletar_medicamento = $conn->prepare('DELETE FROM medicamentos WHERE id = :id');
        $deletar_medicamento->bindParam(':id', $id);
        $deletar_medicamento->execute();
        header('Location: ../dashboards/dashboard_estoque.php');
    }
}