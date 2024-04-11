<?php
session_start();
include('../prcd/qc.php');

$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$seccion = $_SESSION['seccion'];
$casilla = $_SESSION['casilla'];

// $sql = "SELECT * FROM listado WHERE nominal LIKE '%$nominal%'";
$sql = "SELECT * FROM listado WHERE voto = 1 AND seccion = '$seccion'";
$resultado = $conn->query($sql);
while ($row = $resultado->fetch_assoc()){
    echo'
    <tr>
        <th scope="row">'.$row['nombre'].'</th>
        <td>'.$row['nominal'].'</td>
        <td><i class="bi bi-check-circle-fill text-success"></i></td>
    </tr>
    ';
}

?>