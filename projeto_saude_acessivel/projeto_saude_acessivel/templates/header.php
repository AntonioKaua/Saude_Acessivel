<?php
include("process/conn.php");
$msg = "";

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    $status = $_SESSION['status'];
    //limpar a msg
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "";
}
?>