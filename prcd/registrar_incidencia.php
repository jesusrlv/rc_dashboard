<?php
include('../prcd/qc.php');
session_start();

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');

    $fechaSistema = strftime("%Y-%m-%d,%H:%M:%S");
    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $seccion = $_SESSION['seccion'];
    $casilla = $_SESSION['casilla'];

    $incidencia = $_POST['incidencia'];

    $sqlInsert ="INSERT INTO incidencias (
        incidencia,
        idRC,
        nombre,
        seccion,
        casilla,
        horafecha
        ) 
        VALUES(
            '$incidencia',
            '$id',
            '$nombre',
            '$seccion',
            '$casilla',
            '$fechaSistema'
            )";
    $resultadosqlInsert = $conn->query($sqlInsert);

    if($resultadosqlInsert){
        echo json_encode(array(
            "success" => 1
        ));
    }
    else{
        $error = $conn->error;
        echo json_encode(array(
            "success" => 0,
            "error" => $error
        ));
    }

?>