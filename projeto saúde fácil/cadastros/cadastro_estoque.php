<?php
include_once("templates/header.php");
include_once("process/process_estoque.php");

?>

<div id="main-banner">
    <h1>Cadastrar medicamento</h1>
</div>

<div id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Adicione um medicamento ao estoque e sua unidade de saúde</h2>
                <form action="process_estoque.php" method="POST" id="cadastro-form">

                    <div class="form-group">
                        <label for="medicamento">Medicamento:</label>
                        <input type="text" name="medicamento" id="medicamento" class="form-control" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="preco">Unidade:</label>
                        <input type="text" name="unidade" id="unidade" class="form-control" required>
                    </div> -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Cadastrar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include_once("templates/footer.php");
 ?>