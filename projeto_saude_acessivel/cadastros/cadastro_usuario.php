<div class="container">
    <h2>Cadastro de Usuário</h2>
    <form class="form" action="../process/process_cU.php" method="post">
        <!-- Dados do usuário -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" aria-describedby="Nome" name="nome">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input oninput="mascaraCpf(this)" type="text" name="cpf" \
			pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" \
			title="Digite um CPF no formato: xxx.xxx.xxx-xx">
        </div>
        <div class="mb-3">
            <label for="data_nasc" class="form-label">Data de nascimento:</label>
            <input type="date" class="form-control" id="data_nasc" aria-describedby="Data_nasc" name="data_nasc">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Número de telefone:</label>
            <input type="text" class="form-control" id="telefone" aria-describedby="telefone" name="telefone">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>

        <!-- Dados do endereço -->
        <h2>Dados do Endereço</h2>
        <div class="mb-3">
            <label for="rua" class="form-label">Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua">
        </div>
        <div class="mb-3">
            <label for="cep" class="form-label">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep">
        </div>
        <div class="mb-3">
            <label for="num" class="form-label">Nº da Residência:</label>
            <input type="text" class="form-control" id="num" name="num">
        </div>
        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro">
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<script>
// Função para aplicar a máscara de telefone brasileira
function mascaraTelefone(event) {
    let telefone = event.target.value
        .replace(/\D/g, '') // Remove todos os caracteres que não são dígitos
        .replace(/(\d{2})(\d)/, '+$1 ($2') // Adiciona o código do país e o primeiro parêntese em volta do DDD
        .replace(/(\d{2})(\d)/, '$1) $2') // Adiciona o segundo parêntese em volta do DDD
        .replace(/(\d{5})(\d)/, '$1-$2'); // Adiciona o hífen entre o quinto e o sexto dígito

    // Limita o número de caracteres ao máximo de 20
    if (telefone.length > 19) {
        telefone = telefone.substring(0, 19);
    }

    event.target.value = telefone;
}

// Adiciona um ouvinte de evento para chamar a função de máscara quando o usuário digitar
document.getElementById('telefone').addEventListener('input', mascaraTelefone);
// Adiciona um ouvinte de evento para verificar o tamanho do telefone antes de enviar o formulário
document.querySelector('form').addEventListener('submit', function(event) {
    let telefone = document.getElementById('telefone').value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

    // Verifica se o tamanho do telefone é igual a 19
    if (telefone.length !== 18) {
        alert('O número de telefone deve ter exatamente 19 caracteres!');
        event.preventDefault(); // Impede o envio do formulário
    }
});

</script>
<?php 
include_once('../templates/footer.php');

 //  HTML  // 
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
 </head>
 <body class="login">

 <header id="header">
     <div class="container2">

         <div class="flex">
             <a href="index.php"><img src="./img/programa.png" alt="logo"></a>

             <nav>
                 <ul>
                     <li><a href="#">HOME</a></li>
                     <li><a href="#">CONTATOS</a></li>
                     <li><a href="#">SOBRE</a></li>
                     <li><a href="loginUsuario.php">LOGIN</a></li>
                 </ul>
             </nav>
         </div>
     </div>
 </header>

 <div class="main-login2">
     <div class="left-login2">
         <h1>SEJA BEM-VINDO AO <span>VITALIS</span></h1>
        <h2>Invista no seu bem-estar hoje para colher uma vida plena e saudável amanhã.
        Cadastre-se agora em nosso plano de saúde e garanta seu futuro com tranquilidade e cuidado.
       </h2>
     </div>
     <div class="right-login2">
         <div class="card-login2">
             <div class="textfield2">
                 <label for="email">NOME</label>
                 <input type="email" name="email">
             </div>
             <div class="textfield2">
                 <label for="number">TELEFONE</label>
                 <input type="number" name="number">
             </div>
             <div class="textfield2">
                <label for="email">EMAIL</label>
                <input type="email" name="email">
            </div>
                <div class="textfield2">
                <label for="password">SENHA</label>
                <input type="password" name="password">
            </div>
            <div class="textfield2">
                <label for="date">DATA DE NASCIMENTO</label>
                <input type="date" name="date">
            </div>

             <a href="index.php"><button class="btn-login2">FINALIZAR CADASTRO</button></a>
         </div>
     </div>
 </div>

 </header>
 </body>
 </html>
