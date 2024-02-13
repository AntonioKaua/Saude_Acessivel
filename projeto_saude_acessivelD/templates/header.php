    <?php
    include("../process/conn.php");
    $msg = "";

    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        $status = $_SESSION['status'];
        //limpar a msg
        $_SESSION['msg'] = "";
        $_SESSION['status'] = "";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Saúde Acessível</title>
    </head>
    <body>
        
