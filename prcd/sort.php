<?php
session_start();
include('qc.php');
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');

$fecha_cierresesion = strftime("%Y-%m-%d,%H:%M:%S");

$idSesion=$_SESSION['id'];
        
// $sqlCierreSesion = "INSERT INTO log_usrlogin(id_usr, fecha_cierresesion) VALUES ('$idSesion','$fecha_cierresesion')";
// $resultadoCierreSesion= $conn->query($sqlCierreSesion);

echo '
    <script>
        alert("Haz cerrado sesión exitosamente");
    </script>
';

session_destroy();
$_SESSION = "";
header('Location: ../index.html');



?>