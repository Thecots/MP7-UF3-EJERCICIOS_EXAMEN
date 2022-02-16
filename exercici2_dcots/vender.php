<?php
  include('db/connector.php');

  $accio = $_REQUEST['accio'];
  $data = $_REQUEST['data'];
  $quantiat = $_REQUEST['quantiat'];
  $preu = $_REQUEST['preu'];
  
  $sql = ("SELECT accio, quantitat FROM tb_cartera WHERE accio = $accio");
  $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
  $res=mysqli_fetch_array($result);

  

  if(mysqli_num_rows($result) == 0){
    echo 'error';
  }else{
    if($quantiat > $res['quantitat']){
      echo "error";
    }else{
      $x = $res['quantitat'] - $quantiat;

      if($x == 0){
        $sql = ("DELETE FROM tb_Cartera WHERE accio = $accio");
        $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
      }else{
        $sql = ("UPDATE tb_Cartera SET quantitat = $x WHERE accio = $accio");
        $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
      }
      
      /* insertar movimiento */
      $sql = ("INSERT INTO tb_moviment VALUES(null, '".$data."', $accio, -$quantiat, $preu)");
      $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
      echo 'ok';
    }
  }
  
    
  
