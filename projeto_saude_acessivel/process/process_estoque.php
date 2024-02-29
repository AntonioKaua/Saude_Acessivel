<?php
    include_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $medicamento = $_POST['medicamento'];
    $miligramagem = $_POST['miligramagem'];
    $quantidade = $_POST['quantidade'];
    $unidade = $_SESSION['unidade'];
    
    $estoqueQuery = $conn->prepare("SELECT * FROM medicamentos WHERE unidade = :unidade AND nome = :nome;");
    $estoqueQuery->bindParam(':unidade', $unidade);
    $estoqueQuery->bindParam(':nome', $medicamento);
    $estoqueQuery->execute();
    $medicamentos = $estoqueQuery->fetchAll(PDO::FETCH_ASSOC);


    if($medicamentos){
        echo"REMÉDIO JÁ CADASTRADO";
    }else{
        $inserir_medicamento = $conn->prepare("INSERT INTO medicamentos(nome, miligramagem, quantidade, unidade) VALUES
        (:nome, :miligramagem, :quantidade, :unidade);");
        $inserir_medicamento->bindParam(":nome", $medicamento);
        $inserir_medicamento->bindParam(":miligramagem", $miligramagem);
        $inserir_medicamento->bindParam(":quantidade", $quantidade);
        $inserir_medicamento->bindParam(":unidade", $unidade);
        $inserir_medicamento->execute();
        $medicamento = $inserir_medicamento->fetch(PDO::FETCH_ASSOC);

        $_SESSION['msg'] = "ESTOQUE ATUALIZADO";
        $_SESSION['status'] = "success";
        header('Location: ../dashboards/dashboard_estoque.php');
    
        }

    
}

