<?php
include_once("conn.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nasc = $_POST['data_nasc'];
$cargo = $_POST['cargo'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara a consulta para verificar se o usuário já está cadastrado
    $stmt = $conn->prepare("SELECT COUNT(*) FROM funcionarios WHERE cpf = :cpf");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();
    // Obtém o número de linhas retornadas pela consulta
    $num_of_rows = $stmt->fetchColumn();

    // Verifica se encontrou algum registro
    if ($num_of_rows > 0) {
        echo "Usuário já cadastrado.";
    } else {
        // Prepara a instrução SQL usando prepared statements
        $sql = $conn->prepare("INSERT INTO funcionarios(nome, cpf, data_nasc, cargo) VALUES (:nome, :cpf, :data_nasc, :cargo)");
        $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sql->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $sql->bindParam(':data_nasc', $data_nasc, PDO::PARAM_STR);
        $sql->bindParam(':cargo', $cargo, PDO::PARAM_STR);
        // Executa a instrução SQL
        if ($sql->execute()) {
            echo "funcionário cadastrado com sucesso";
            #$_SESSION["msg"] = "Cadastro feito com sucesso";
            #$_SESSION["status"] = "success";
        } else {
            echo "Erro ao inserir dados: " . $sql->errorInfo()[2];
        }
    }
}
