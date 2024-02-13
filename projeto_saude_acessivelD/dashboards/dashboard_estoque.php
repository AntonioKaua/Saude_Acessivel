<?php
  include_once("../templates/header.php");
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
              <?php foreach($medicamentos as $medicamento):
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
                </div>        
                    </form>
                  </td>
                  <td>
                    <form action="../process/orders_dash.php" method="post" id="zerar" onsubmit="return confirmarEnvio2('zerar')">
                      <input type="hidden" name="type" id="tipo" value="ZERAR">
                      <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
                      <button type="submit" class="zerar-button">
                        <i class="bi bi-0-square"></i>
                      </button>
                  </td>
                  </form>
                  <form action="../process/orders_dash.php" method="post" id="deletar" onsubmit="return confirmarEnvio2('deletar')">
                      <input type="hidden" name="type" id="tipo" value="DELETAR">
                      <input type="hidden" name="id" value="<?= $medicamento["id"] ?>">
                      <button type="submit" class="delete-button">
                        <i class="fas fa-times"></i>
                      </button>
                  </td>
                  </form>                                    
                </tr>
                  <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php
  include_once("../templates/footer.php");
?>