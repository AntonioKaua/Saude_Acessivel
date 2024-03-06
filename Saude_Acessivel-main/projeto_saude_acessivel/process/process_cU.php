<?php
include_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todos os campos obrigatórios estão preenchidos
    if (
        isset($_POST['nome']) && 
        isset($_POST['cpf']) && 
        isset($_POST['data_nasc']) && 
        isset($_POST['telefone']) && 
        isset($_POST['email']) && 
        isset($_POST['senha']) &&
        isset($_POST['rua']) &&
        isset($_POST['cep']) &&
        isset($_POST['num']) &&
        isset($_POST['bairro']) &&
        isset($_POST['cidade']) &&
        isset($_POST['estado'])
    ) {
        // Dados do usuário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $data_nasc = $_POST['data_nasc'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Dados do endereço
        $rua = $_POST['rua'];
        $cep = $_POST['cep'];
        $num = $_POST['num'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Inserir dados na tabela enderecos
        $sqlEndereco = $conn->prepare("INSERT INTO enderecos (cep, rua, num, bairro, cidade, estado) VALUES (:cep, :rua, :num, :bairro, :cidade, :estado)");
        $sqlEndereco->bindParam(':cep', $cep);
        $sqlEndereco->bindParam(':rua', $rua);
        $sqlEndereco->bindParam(':num', $num);
        $sqlEndereco->bindParam(':bairro', $bairro);
        $sqlEndereco->bindParam(':cidade', $cidade);
        $sqlEndereco->bindParam(':estado', $estado);

        if ($sqlEndereco->execute()) {
            $endereco_id = $conn->lastInsertId();

            // Inserir dados na tabela usuarios
            $sqlUsuario = $conn->prepare("INSERT INTO usuarios(nome, cpf, email, data_nasc, telefone, senha, endereco_id) VALUES (:nome, :cpf, :email, :data_nasc, :telefone, :senha, :endereco_id)");
            $sqlUsuario->bindParam(':nome', $nome);
            $sqlUsuario->bindParam(':cpf', $cpf);
            $sqlUsuario->bindParam(':email', $email);
            $sqlUsuario->bindParam(':data_nasc', $data_nasc);
            $sqlUsuario->bindParam(':telefone', $telefone);
            $sqlUsuario->bindParam(':senha', $senha);
            $sqlUsuario->bindParam(':endereco_id', $endereco_id);

            if ($sqlUsuario->execute()) {
                echo "Cadastro realizado com sucesso!";
                header("Location: ../logins/loginUsuario.php");
                // Redirecionar ou fazer qualquer outra operação necessária
            } else {
                echo "Erro ao inserir dados do usuário: " . implode(" ", $sqlUsuario->errorInfo());
            }
        } else {
            echo "Erro ao inserir dados do endereço: " . implode(" ", $sqlEndereco->errorInfo());
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>
