
<div class="container">
<h2>Usuário</h2>
    <form  class="form" action="../process/process_cU.php" method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" aria-describedby="Nome" name="nome">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">CPF:</label>
            <input type="text" class="form-control" id="cpf" aria-describedby="cpf" name="cpf">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Data de nascimento:</label>
            <input type="date" class="form-control" id="data_nasc" aria-describedby="Data_nasc" name="data_nasc">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Número de telefone:</label>
            <input type="number" class="form-control" id="telefone" aria-describedby="telefone" name="telefone">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>
    </form>
        <h2>Endereço</h2>
        <form  class="form" action="../process/process_cU.php" method="post">
        <div class="mb-3">
            <label for="senha" class="form-label">Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Nº da Residência:</label>
            <input type="text" class="form-control" id="num" name="num">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>