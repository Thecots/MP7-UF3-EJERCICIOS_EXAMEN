<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dcots</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<?php
  include('db/connector.php');
?>
<body>
  <main>
    <header>
      <h1>Borsa</h1>
    </header>
    <form>
      <div>
        <h2>Acció:</h2>
        <select id="accio">
          <?php
            $sql = ("SELECT * FROM tb_accions");
            $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
            $res=mysqli_fetch_array($result);
            while($reg=mysqli_fetch_array($result)){?>
              <option value='<?php echo $reg['id']?>'><?php echo $reg['nom']?></option>
            <?php };
            ?>
        </select>
      </div>
      <div>
        <h2>Data:</h2>
        <input type="date" value="<?php echo date("Y-m-d"); ?>">
      </div>
      <div>
        <h2>Quantitat:</h2>
        <input type="number" min='0'>
      </div>
      <div>
        <h2>Preu:</h2>
        <input id="preu" type="number" min='0'>
      </div>
      <aside>
        <button id="comprar">Comprar</button>
        <button id="vender">Vendre</button>
      </aside>
    </form>
    <div>
      <section>
        <h1>Accions</h1>
        <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Preu</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $sql = ("SELECT nom, preu FROM tb_accions");
            $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
            $res=mysqli_fetch_array($result);
            while($reg=mysqli_fetch_array($result)){?>
            <tr>
              <td><?php echo $reg['nom']?></td>
              <td><?php echo $reg['preu']?></td>
            </tr>
            <?php };
          ?>
        </tbody>
      </table>
      </section>
      <section>
        <h1>Moviments</h1>
        <?php
              $sql = ("SELECT tb_moviment.quantitat, tb_moviment.preu ,tb_moviment.data, tb_accions.nom FROM tb_moviment LEFT JOIN tb_accions ON tb_moviment.accio = tb_accions.id");
              $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
              if(mysqli_num_rows($result) == 0){
                echo "<p>Sense moviments</p>";
              }else{
                ?>
                  <table>
                    <thead>
                      <tr>
                        <th>Accio</th>
                        <th>Data</th>
                        <th>Quantitat</th>
                        <th>Preu</th>
                      </tr>
                    </thead>
                    <tobdy>
                    <?php
                    while($res=mysqli_fetch_array($result)){?>
                      <tr
                        <?php 
                        if($res['quantitat']  < 0){
                          echo "class='sell'";
                        }else{echo "class='buy'";} ?>
                      >
                        <td><?php echo $res['nom']?></td>
                        <td><?php echo $res['data']?></td>
                        <td><?php echo $res['quantitat']?></td>
                        <td><?php echo $res['preu']?>€</td>
                      </tr>
                    <?php };
                    ?>
                  </tobdy>
                </table>
                <?php
              }
            ?>
      </section>
      <section>
        <h1>Cartera</h1>
        <?php
              $sql = ("SELECT tb_accions.nom, tb_cartera.quantitat FROM tb_cartera INNER JOIN tb_accions ON tb_cartera.accio = tb_accions.id");
              $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
              if(mysqli_num_rows($result) == 0){
                echo "<p>Cartera buida</p>";
              }else{
                ?>
                  <table>
                    <thead>
                      <tr>
                        <th>Accio</th>
                        <th>Quantitat</th>
                      </tr>
                    </thead>
                    <tobdy>
                    <?php
                    while($res=mysqli_fetch_array($result)){?>
                      <tr>
                        <td><?php echo $res['nom']?></td>
                        <td><?php echo $res['quantitat']?></td>
                      </tr>
                    <?php };
                    ?>
                  </tobdy>
                </table>
                <?php
              }
            ?>
      </section>
    </div>
  </main>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/ajaxModule.js"></script>
  <script src="./js//script.js"></script>
</body>
</html>


           
