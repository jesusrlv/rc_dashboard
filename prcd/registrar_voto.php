<?php
include('../prcd/qc.php');

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');

    $fechaSistema = strftime("%Y-%m-%d,%H:%M:%S");

    $id = $_POST['id'];
    $voto = 1;

    $sqlInsert ="UPDATE listado SET 
        voto = '$voto'
        WHERE id = '$id'";
    $resultadosqlInsert = $conn->query($sqlInsert);

    if($resultadosqlInsert){
        echo json_encode(array(
            "success" => 1
        ));
    }
    else{
        echo json_encode(array(
            "success" => 0
        ));
    }

?>