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
      <h1>Seleción de candidatos</h1>
    </header>
    <form action="index.php">
      <div>
        <h2>Estudios</h2>
        <select name="estudios">
          <option value='0'>Todos</option>
          <?php
            $sql = ("SELECT * FROM estudis");
            $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
            $res=mysqli_fetch_array($result);
            while($reg=mysqli_fetch_array($result)){?>
              <option value='<?php echo $reg['id']?>' <?php
              if(isset($_REQUEST['estudios'])){
                if($reg['id'] == $_REQUEST['estudios']){
                  echo 'selected="selected"';
                }
              } ?>
              ><?php echo $reg['nom']?></option>
            <?php };
          ?>
        </select>
      </div>
      <div>
        <h2>Sector</h2>
        <select name="sector">
          <option value='0'>Todos</option>
          <?php
            $sql = ("SELECT * FROM sector");
            $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
            $res=mysqli_fetch_array($result);
            while($reg=mysqli_fetch_array($result)){?>
              <option value='<?php echo $reg['id']?>' <?php
              if(isset($_REQUEST['sector'])){
                if($reg['id'] == $_REQUEST['sector']){
                  echo 'selected="selected"';
                }
              } ?>><?php echo $reg['nom']?></option>
            <?php };
          ?>
        </select>
      </div>
      <div>
        <h2>Cargo</h2>
        <select name="cargo">
          <option value="0">Todos</option>
          <?php
            $sql = ("SELECT * FROM carrec");
            $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
            $res=mysqli_fetch_array($result);
            while($reg=mysqli_fetch_array($result)){?>
              <option value='<?php echo $reg['id']?>' <?php
              if(isset($_REQUEST['cargo'])){
                if($reg['id'] == $_REQUEST['cargo']){
                  echo 'selected="selected"';
                }
              } ?>><?php echo $reg['nom']?></option>
            <?php };
          ?>
        </select>
      </div>
      <div>
        <h2>Edad mínima</h2>
        <input type="number" min="0" max="100" name="edadmi" <?php
          if(isset($_REQUEST['edadmi'])){ echo 'value="'.$_REQUEST['edadmi'].'"'; }else{ echo 'value="0"'; };
        ?>
        >
      </div>
      <div>
        <h2>Edad máxima</h2>
        <input type="number" min="0" max="100" name="edadma"<?php
          if(isset($_REQUEST['edadma'])){ echo 'value="'.$_REQUEST['edadma'].'"'; }else{ echo 'value="100"'; };
        ?>
        >
      </div>
      <div>
        <h2>Años de experiencia mínimos</h2>
        <input type="number" min="0" max="100" name="experiencia" <?php
          if(isset($_REQUEST['experiencia'])){ echo 'value="'.$_REQUEST['experiencia'].'"'; }else{ echo 'value="0"'; }; ?>>
      </div>
      <div class="buttons">
        <button type="submit">Buscar</button>
        <a href="index.php">Reiniciar</a>
      </div>
    </form>
    <section>
      <?php

      $x = '';
      $arr = [];
      if(isset($_REQUEST['estudios']) && $_REQUEST['estudios'] != 0){
        array_push($arr,'tb_candidats.estudis ='.$_REQUEST['estudios']);
      }
      if(isset($_REQUEST['sector']) && $_REQUEST['sector'] != 0){
        array_push($arr,'tb_candidats.sector ='.$_REQUEST['sector']);
      }
      if(isset($_REQUEST['cargo']) && $_REQUEST['cargo'] != 0){
        array_push($arr,'tb_candidats.carrec ='.$_REQUEST['cargo']);
      }
      if(isset($_REQUEST['edadmi']) && $_REQUEST['edadmi'] != 0){
        array_push($arr,'tb_candidats.edat >='.$_REQUEST['edadmi']);
      }
      if(isset($_REQUEST['edadma']) && $_REQUEST['edadma'] != 0){
        array_push($arr,'tb_candidats.edat <='.$_REQUEST['edadma']);
      }
      if(isset($_REQUEST['experiencia']) && $_REQUEST['experiencia'] != 0){
        array_push($arr,'tb_candidats.anys_experiencia >='.$_REQUEST['experiencia']);
      }

      for($i = 0; $i < count($arr);$i++){
        if($i == 0){
          $x = ' WHERE '.$arr[0];
        }else{
          $x = $x.' AND '.$arr[$i];
        }
      }
        $sql = ("SELECT tb_candidats.nom nom,
                        tb_candidats.edat,
                        tb_candidats.anys_experiencia experiencia,
                        tb_candidats.sector sectorid,
                        tb_candidats.carrec carrecid,
                        tb_candidats.estudis estudisid,
                        sector.nom sector,
                        carrec.nom carrec,
                        estudis.nom estudis
                        FROM tb_candidats 
                        LEFT JOIN sector ON tb_candidats.sector = sector.id
                        LEFT JOIN carrec ON tb_candidats.carrec = carrec.id
                        LEFT JOIN estudis ON tb_candidats.estudis = estudis.id $x
                        ");
        $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
        if(mysqli_num_rows($result) == 0){
          echo "<h5>No hay candidatos</h5>";
        }else{
          echo "<table><thead><tr><th>Nombre</th><th>Edat</th><th>Años de experiencia</th><th>Sector</th><th>Cargo</th><th>Estudios</th></tr></thead><tbody>";
          while($reg=mysqli_fetch_array($result)){?>
            <tr>
              <td><?php echo $reg['nom']?></td>
              <td><?php echo $reg['edat']?></td>
              <td><?php echo $reg['experiencia']?></td>
              <td><?php echo $reg['sector']?></td>
              <td><?php echo $reg['carrec']?></td>
              <td><?php echo $reg['estudis']?></td>
            </tr>
          <?php }
          echo "</tbody></table>";
        }; ?>
    </section>
  </main>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/ajaxModule.js"></script>
  <script src="./js//script.js"></script>
</body>
</html>


           
