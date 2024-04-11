<?php
session_start();
include('../prcd/qc.php');

$user = $_POST['usr'];
$pwd = ($_POST['pwd']);

$sql = "SELECT * FROM usr WHERE user = '$user' AND pwd = '$pwd'";
$resultado = $conn->query($sql);
$row = $resultado->fetch_assoc();

$fila = $resultado->num_rows;

if($fila == 1){
    $_SESSION['id'] = $row['id'];
    $_SESSION['usr'] = $row['user'];
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['perfil'] = $row['perfil'];
    $_SESSION['seccion'] = $row['seccion'];
    $_SESSION['casilla'] = $row['casilla'];
    echo json_encode(array(
        'success'=>1,
        'perfil'=>$row['perfil']
    ));
}
else {
    session_destroy();
    echo json_encode(array(
       'success'=>0
    ));
}

?>