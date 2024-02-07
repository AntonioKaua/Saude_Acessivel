<?php
    include_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $medicamento = $_POST['medicamento'];
    $miligramagem = $_POST['miligramagem'];
    $quantidade = $_POST['quantidade'];
    $unidade = $_SESSION['unidade'];

    $inserir_medicamento = $conn->prepare("INSERT INTO medicamentos(nome, miligramagem, quantidade, unidade) VALUES
    (:nome, :miligramagem, :quantidade, :unidade);");
    $inserir_medicamento->bindParam(":nome", $medicamento);
    $inserir_medicamento->bindParam(":miligramagem", $miligramagem);
    $inserir_medicamento->bindParam(":quantidade", $quantidade);
    $inserir_medicamento->bindParam(":unidade", $unidade);
    $inserir_medicamento->execute();
    $medicamento = $inserir_medicamento->fetch(PDO::FETCH_ASSOC);
    if($medicamento){
    $_SESSION['msg'] = "ESTOQUE ATUALIZADO";
    $_SESSION['status'] = "success";
    header('Location: ../dashboard/dashboard_estoque.php');
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../CadastroP.php');
        } 
}