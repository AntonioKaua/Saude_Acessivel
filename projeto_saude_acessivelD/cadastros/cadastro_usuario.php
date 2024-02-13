
<div class="container">
    <form  class="form" action="../process/process_cU.php" method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" aria-describedby="Nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">CPF:</label>
            <input type="text" class="form-control" id="cpf" aria-describedby="cpf" name="cpf" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Data de nascimento:</label>
            <input type="date" class="form-control" id="data_nasc" aria-describedby="Data_nasc" name="data_nasc" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Número de telefone:</label>
            <input type="number" class="form-control" id="telefone" aria-describedby="telefone" name="telefone" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Confirmar senha:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <script>
            var password = document.getElementById("senha")
                , confirm_password = document.getElementById("confirm_password");

            function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Senhas diferentes!");
            } else {
                confirm_password.setCustomValidity('');
            }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
