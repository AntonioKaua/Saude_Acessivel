<?php
include_once("conn.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nasc = $_POST['data_nasc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara a consulta para verificar se o usuário já está cadastrado
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE cpf = :cpf");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();
    // Obtém o número de linhas retornadas pela consulta
    $num_of_rows = $stmt->fetchColumn();

    // Verifica se encontrou algum registro
    if ($num_of_rows > 0) {
        echo "Usuário já cadastrado.";
    } else {
        // Prepara a instrução SQL usando prepared statements
        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
        $sql = $conn->prepare("INSERT INTO usuarios(nome, cpf, data_nasc, telefone, email, senha) VALUES (:nome, :cpf, :data_nasc, :telefone, :email, :senha)");
        $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sql->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $sql->bindParam(':data_nasc', $data_nasc, PDO::PARAM_STR);
        $sql->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':senha', $senha_hashed, PDO::PARAM_STR);

        // Executa a instrução SQL
        if ($sql->execute()) {
            session_start();
            $_SESSION["msg"] = "Cadastro feito com sucesso";
            $_SESSION["status"] = "success";
            header("Location: http://localhost/pizzaJoao/login.php");
            exit();
        } else {
            echo "Erro ao inserir dados: " . $sql->errorInfo()[2];
        }
    }
}

