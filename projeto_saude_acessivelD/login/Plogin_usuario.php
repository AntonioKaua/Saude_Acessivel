<?php
include_once("../process/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome']) && isset($_POST['email'])  && isset($_POST['cpf']) && isset($_POST['senha'])) {
        $usuario = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $query = "SELECT id, nome, cpf, email, senha FROM usuarios WHERE cpf = :cpf LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "Senha do Banco de Dados: " . $result['senha'] . "<br>";
            echo "Senha Fornecida: " . $senha . "<br>";
            
            if (password_verify($senha, $result['senha'])) {
                $_SESSION['nome'] = $result['nome'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['senha'] = $result['senha'];
                $_SESSION['cpf'] = $result['cpf'];
                $_SESSION['id_usuario'] = $result['id'];
                header("Location: http://localhost/projeto_saude_acessivel/dashboards/dashboard_estoque.php");
                exit();
            } else {
                $_SESSION["msg"] = "Senha incorreta";
                $_SESSION["status"] = "warning";
                header("Location: http://localhost/projeto_saude_acessivel/login_ususario.php");
                exit();
            }
        } else {
            $_SESSION["msg"] = "Usuário não encontrado";
            $_SESSION["status"] = "warning";
            header("Location: http://localhost/projeto_saude_acessivel/login_ususario.php");
            exit();
        }
    } else {
        $_SESSION["msg"] = "Preencha todos os campos";
        $_SESSION["status"] = "warning";
        header("Location: http://localhost/projeto_saude_acessivel/login_ususario.php");
        exit();
    }
} else {
    $_SESSION["msg"] = "Método de requisição inválido";
    $_SESSION["status"] = "warning";
    header("Location: http://localhost/projeto_saude_acessivel/login_ususario.php");
    exit();
}


?>
