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

    $pri = $_POST['pri'];
    $pan = $_POST['pan'];
    $prd = $_POST['prd'];
    $morena = $_POST['morena'];
    $pt = $_POST['pt'];
    $mc = $_POST['mc'];
    $otroVoto = $_POST['otroVoto'];
    $anulados = $_POST['anulados'];

    $sqlInsert ="INSERT INTO votacion_casilla(
        pri,
        pan,
        prd,
        morena,
        pt,
        mc,
        otro,
        anulados,
        rc_captura,
        fecha_hora,
        seccion,
        casilla
        ) 
        VALUES(
            '$pri',
            '$pan',
            '$prd',
            '$morena',
            '$pt',
            '$mc',
            '$otroVoto',
            '$anulados',
            '$id',
            '$fechaSistema',
            '$seccion',
            '$casilla'
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