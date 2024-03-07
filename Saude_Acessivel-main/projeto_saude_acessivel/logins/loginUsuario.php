<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body class="login">

<header id="header">
    <div class="container2">

        <div class="flex">
            <a href="index.php"><img src="../img/vitalis.png" alt="logo"></a>

            <nav>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">CONTATOS</a></li>
                    <li><a href="#">SOBRE</a></li>
                </ul>
            </nav>

            <div class="btn-cadastro">
                <a href="cadastro_usuario.php"><button>CADASTRO</button></a>
            </div>
        </div>
    </div>
</header>

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
            <a href="index.php"><button class="btn-login">Login</button></a>
            <a href="index.php"><button class="btn-loginG">Login with Google</button></a>
        </div>
    </div>
</div>
</header>
</body>
</html>
