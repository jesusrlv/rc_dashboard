<?php
session_start();
include('../prcd/qc.php');

$nominal = ($_POST['nominal']);

// $sql = "SELECT * FROM listado WHERE nominal LIKE '%$nominal%'";
$sql = "SELECT * FROM listado WHERE nominal = '$nominal'";
$resultado = $conn->query($sql);

$fila = $resultado->num_rows;

if($fila == 1){
    $row = $resultado->fetch_assoc();
    if($row['voto'] == 1){
        $voto = 1;
    }
    else {
        $voto = 0;
    }
    echo json_encode(array(
        'success'=>1,
        'id'=>$row['id'],
        'nombre'=>$row['nombre'],
        'clave'=>$row['nominal'],
        'seccion'=>$row['seccion'],
        'municipio'=>$row['municipio'],
        'voto'=>$voto
    ));
}
else {
    session_destroy();
    echo json_encode(array(
       'success'=>0
    ));
}

?>