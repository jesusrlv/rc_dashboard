<?php
session_start();
include('../prcd/qc.php');

$sql = "SELECT * FROM usr WHERE perfil = 1 AND seccion 1 ORDER BY id ASC";
$resultado = $conn->query($sql);
while ($row = $resultado->fetch_assoc()){
    $seccion = $row['seccion'];
    $sqlListado = "SELECT * FROM listado WHERE seccion = '$seccion'";
    $resultadoListado = $conn->query($sqlListado);
    $rowListado = $resultadoListado->fetch_assoc();

    echo'
    <tr>
        <th scope="row">'.$row['nombre'].'</th>
        <td>'.$row['nominal'].'</td>
        <td><i class="bi bi-x-circle-fill text-danger"></i></td>
    </tr>
    ';
}

?>