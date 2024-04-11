<?php
session_start();
include('../prcd/qc.php');

$user = $_POST['usr'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM usr WHERE usr = '$user' AND pwd = '$pwd' AND estatus = 0";
$resultado = $conn->query($sql);

$fila = $resultado->num_rows;

if($fila == 1){
    $row = $resultado->fetch_assoc();
    $_SESSION['id'] = $row['id'];
    $_SESSION['usr'] = $row['usr'];
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