<?php
  include('db/connector.php');

  $accio = $_REQUEST['accio'];
  $data = $_REQUEST['data'];
  $quantiat = $_REQUEST['quantiat'];
  $preu = $_REQUEST['preu'];

  /* insertar movimiento */
  $sql = ("INSERT INTO tb_moviment VALUES(null, '".$data."', $accio, $quantiat, $preu)");
  $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));

  $sql = ("SELECT accio, quantitat FROM tb_cartera WHERE accio = $accio");
  $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
  $res=mysqli_fetch_array($result);


  if(mysqli_num_rows($result) == 0){
    $sql = ("INSERT INTO tb_cartera VALUES(null,$accio,$quantiat)");
    $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
  }else{
    $x = $quantiat+$res['quantitat'];
    $sql = ("UPDATE tb_cartera SET quantitat=$x WHERE accio = $accio");
    $result=mysqli_query($dblink,$sql) or exit(mysqli_error($dblink));
  }
  echo 'ok';
