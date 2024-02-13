<?php
include_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $type = $_POST['type'];

    //LOGIN
    if ($type == "loginADM"){
        $cod_adm = $_POST['cod_adm'];
        $unidade = $_POST['unidade'];

        $login_ADMQuery = $conn->prepare("SELECT * FROM adm WHERE cod_adm = :cod_adm AND unidade = :unidade;");
        $login_ADMQuery->bindParam(":cod_adm", $cod_adm);
        $login_ADMQuery->bindParam(":unidade", $unidade);
        $login_ADMQuery->execute();
        $adm = $login_ADMQuery->fetch(PDO::FETCH_ASSOC);

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