<?php
session_start();
include('../prcd/qc.php');
$x=0;
$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$seccion = $_SESSION['seccion'];
$casilla = $_SESSION['casilla'];

// $sql = "SELECT * FROM listado WHERE nominal LIKE '%$nominal%'";
$sql = "SELECT * FROM listado WHERE voto IS NULL AND seccion = '$seccion'";
$resultado = $conn->query($sql);
while ($row = $resultado->fetch_assoc()){
    $x++;
    echo'
    <tr>
        <th scope="row">'.$x.'</th>
        <th scope="row">'.$row['nombre'].'</th>
        <td>'.$row['nominal'].'</td>
        <td><i class="bi bi-x-circle-fill text-danger"></i></td>
    </tr>
    ';
}

?>