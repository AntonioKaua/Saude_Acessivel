<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body class="login">

<form action="../process/login.php" method="POST" >
    <div class="main-login">
        <div class="rigth-login">
            <img src="../img/Pediatrician-cuate.png" class="rigth-login-image" alt="CONSULTAIMAGEM">
        </div>
        <div class="left-login">
            <div class="card-login">
                <div class="textfield">
                    <label for="email">Digite seu e-mail:</label>
                    <input type="email" name="email" placeholder="Digite seu email...">
                </div>
                <div class="textfield">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" placeholder="Digite sua senha...">
                </div>
                <div>
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <input type="text" name="type" value="loginU" id="">
                <button class="btn-login" type="submit">Login</button>
</form>
            <a href="index.php"><button class="btn-loginG">Login with Google</button></a>
        </div>
    </div>
</div>
</header>
</body>
</html>
