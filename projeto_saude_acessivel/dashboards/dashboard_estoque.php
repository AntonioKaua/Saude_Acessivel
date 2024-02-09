<?php
  include_once("templates/header.php");
  include_once("../process/orders_dash.php");

?>
  <div id="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Gerenciar medicamentos:</h2>
        </div>
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
              <?php foreach($medicamentos as $medicamento): ?>
                <tr>
                  <td><?= $medicamento["nome"] ?></td>
                  <td><?= $medicamento["miligramagem"] ?></td>
                  <td><?= $medicamento["quantidade"] ?></td>
                  <td><?= $medicamento["unidade"] ?></td>
                  
                  <td>
                    <form action="../process/orders_dash.php" method="POST">
                      <input type="number" name="valor">
                      <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
                      <button name="type"value="UPDATE" class="-btn">
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  </td>                  
                </tr>
                  <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php
  include_once("templates/footer.php");
?>