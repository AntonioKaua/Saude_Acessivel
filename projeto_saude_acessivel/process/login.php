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

        $login_MEDQuery = $conn->prepare("SELECT * FROM medicos WHERE cod_de_acesso = :cod_de_acesso AND cpf = :cpf;");
        $login_MEDQuery->bindParam(":cpf", $cod_adm);
        $login_MEDQuery->bindParam(":cod_de_acesso", $unidade);
        $login_MEDQuery->execute();
        $medico = $login_MEDQuery->fetch(PDO::FETCH_ASSOC);
        if($adm){
            $_SESSION['usuario_id'] = $adm['id'];
            $_SESSION['unidade'] = $adm['unidade'];
            $_SESSION['msg'] = "ACESSO LIBERADO";
            $_SESSION['status'] = "success";
            header('Location: ../cadastros/cadastro_estoque.php');
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../loginAdm.php');
        }
    }
    }
#$unidade = $adm['unidade'];