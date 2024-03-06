<?php
include_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $type = $_POST['type'];

    //LOGIN
    if ($type == "loginADM"){
        $cod_adm = $_POST['cod_adm'];

        $login_ADMQuery = $conn->prepare("SELECT adm.id,adm.cod_adm, unidades.nome AS unidade
        FROM adm
        JOIN unidades ON adm.unidade_id = unidades.id
        WHERE adm.cod_adm = :cod_adm;");
        $login_ADMQuery->bindParam(":cod_adm", $cod_adm);
        $login_ADMQuery->execute();
        $adm = $login_ADMQuery->fetch(PDO::FETCH_ASSOC);

        if($adm){
            $_SESSION['usuario_id'] = $adm['id'];
            $_SESSION['unidade'] = $adm['unidade'];
            $_SESSION['msg'] = "ACESSO LIBERADO";
            $_SESSION['status'] = "success";
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../loginAdm.php');
        }
        }
    elseif($type == 'loginMED'){
        $cod_med = $_POST['cod_acesso'];
        $cpf = $_POST['cpf'];

        $login_MEDQuery = $conn->prepare("SELECT * FROM medicos WHERE cod_de_acesso = :cod_de_acesso AND cpf = :cpf; JOIN unidades.nome AS unidade WHERE ");
        $login_MEDQuery->bindParam(":cpf", $cod_adm);
        $login_MEDQuery->bindParam(":cod_de_acesso", $unidade);
        $login_MEDQuery->execute();
        $medico = $login_MEDQuery->fetch(PDO::FETCH_ASSOC);
        if($medico){
            $_SESSION['usuario_id'] = $adm['id'];
            $_SESSION['unidade'] = $medico['unidade'];
            $_SESSION['msg'] = "ACESSO LIBERADO";
            $_SESSION['status'] = "success";
            header('Location: ../cadastros/cadastro_estoque.php');
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../loginAdm.php');
        }
    }
    elseif ($type == 'loginU') {
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
    
        try {
            $login_UQuery = $conn->prepare("SELECT * FROM usuarios WHERE cpf = :cpf AND senha = :senha;");
            $login_UQuery->bindParam(":cpf", $cpf);
            $login_UQuery->bindParam(":senha", $senha);
            $login_UQuery->execute();
            $user = $login_UQuery->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nome'] = $user['nome'];
                $_SESSION['msg'] = "ACESSO LIBERADO";
                $_SESSION['status'] = "success";
                header('Location: ../index.php');
                exit(); // Terminar o script após redirecionar
            } else {
                $_SESSION['msg'] = "CREDENCIAIS INVÁLIDAS";
                $_SESSION['status'] = "danger";
                header('Location: ../logins/loginUsuario.php');
                exit(); // Terminar o script após redirecionar
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage(); // Mostrar erro se houver
            exit(); // Terminar o script em caso de erro
        }
    }
}
    
#$unidade = $adm['unidade'];