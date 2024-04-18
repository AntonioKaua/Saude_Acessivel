<?php
include_once("../templates/header.php");

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['filtro'])) {
    $filtro = $_POST['filtro'];
    $unidade = $_SESSION['unidade'];

    $estoqueQuery = $conn->prepare("SELECT * FROM medicamentos WHERE unidade = :unidade AND nome LIKE :filtro;");
    $estoqueQuery->bindParam(':unidade', $unidade);
    $filtro = "%" . $filtro . "%"; // Adiciona wildcards para a consulta LIKE
    $estoqueQuery->bindParam(':filtro', $filtro);
    $estoqueQuery->execute();
    $medicamentos = $estoqueQuery->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="col-md-12 table-container">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"><span>Medicamentos</span> #</th>
                <th scope="col">Miligramagem</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Unidade</th>
              </tr>
            </thead>
    <tbody>

    <?php
    foreach($medicamentos as $medicamento) {
        $id_input = "quantidade" . strtolower(str_replace(" ", "_", $medicamento["nome"])); ?>
        <tr>
          <td><?= $medicamento["nome"] ?></td>
          <td><?= $medicamento["miligramagem"] ?></td>
          <td><?= $medicamento["quantidade"] ?></td>
          <td><?= $medicamento["unidade"] ?></td>
          <td>
            <form action="../process/orders_dash.php" method="POST" onsubmit="return confirmarEnvio()">
              <div onclick="inserirAumento('<?php echo $id_input ?>')">
                <i class="bi bi-plus-lg"></i>
                <i class="bi bi-plus-lg"></i>
              </div>
              <div onclick="aumentar('<?php echo $id_input ?>')">
                <i class="bi bi-plus-lg"></i>
              </div>
              <input type="number" name="valor" id="<?php echo $id_input ?>" value="0" readonly>
              <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
              <input type="hidden" name="type" value="ATUALIZAR">
              <div onclick="diminuir('<?php echo $id_input ?>')">
                <i class="bi bi-dash"></i>
              </div>
              <div onclick="inserirDiminuicao('<?php echo $id_input ?>')">
                <i class="bi bi-dash"></i>
                <i class="bi bi-dash"></i>
              </div>
            <button type="submit" class="update-button">
                <i class="bi bi-arrow-repeat"></i>
          </button>
        </form>
      </td>
      <td>
        <form action="../process/orders_dash.php" method="post" id="zerar" onsubmit="return confirmarEnvio2('zerar')">
          <input type="hidden" name="type" id="tipo" value="ZERAR">
          <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
          <button type="submit" class="zerar-button">
            <i class="bi bi-0-square"></i>
          </button>
        </form>
      </td>
      <td>
        <form action="../process/orders_dash.php" method="post" id="deletar" onsubmit="return confirmarEnvio2('deletar')">
          <input type="hidden" name="type" id="tipo" value="DELETAR">
          <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
          <button type="submit" class="delete-button">
            <i class="fas fa-times"></i>
          </button>
        </form>
      </td>
    </tr>
<?php
    }
}
?>
<?php
  include_once("../templates/footer.php");
?>
