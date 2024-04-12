<html>
    <header>
    <meta charset="utf-8">
        <link rel="icon" type="image/png" href="../../assets/brand/img/ico.ico"/>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../QR/ajax_generate_code.js"></script>
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
        <!-- font -->
    <header>
        <style>
            body{
                font-family: 'Titillium Web', sans-serif;
            }
        </style>
<body>
    
<?php    

    session_start();
    include('../prcd/qc.php');
    date_default_timezone_set('America/Mexico_City');
                  setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_qr = strftime("%Y-%m-%d,%H:%M:%S");
    $repetidos = 0;
    $Norepetidos = 0;
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['csv']['name']) && in_array($_FILES['csv']['type'], $fileMimes))
    {
        
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['csv']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {

                // Get row data
                $nominal = $getData[0];
                $apellido_p = $getData[1];
                $apellido_m = $getData[2];
                $nombre = $getData[3];
                $carrera = $getData[4];
                $curp = $getData[5];
                $concatenado = $curp.'_'.$curp;
                $seccion = "1";
                $casilla = "A1";
                $municipio = 54;
                $direccion = "Col. Guadalupe";
                $si_no = 1;
                
                $nombreCompleto = $nombre.' '.$apellido_p.' '.$apellido_m;
                
                $consulta = "SELECT * FROM listado WHERE curp = '$curp'";
                $resultadoConsulta = $conn->query($consulta);
                $filas = $resultadoConsulta->num_rows;
                // If user already exists in the database with the same email

                if($filas == 0){
                    $Norepetidos++;
                    mysqli_query($conn, "INSERT INTO listado (
                        nominal, 
                        nombre, 
                        curp, 
                        seccion, 
                        casilla, 
                        municipio, 
                        direccion, 
                        si_no
                        ) VALUES (
                            '" . $nominal . "', 
                            '" . $nombreCompleto . "', 
                            '" . $curp . "', 
                            '" . $seccion . "', 
                            '" . $casilla . "', 
                            '" . $municipio . "', 
                            '". $direccion ."', 
                            '".$si_no."'
                            )");
                        $error = $conn->error;
                        echo $error;

                }
                else{
                    $repetidos++;
                    echo '
                    <p>'.$repetidos.'.- Se repite el asistente '.$nombre.' '.$apellido_p.' '.$apellido_m.' // '.$curp.' // '.$curp.', no se agregó al sistema.<p>
                    ';

                }
            }

            // Close opened CSV file
            fclose($csvFile);
            
                echo "<script type=\"text/javascript\">
                Swal.fire({
                    icon: 'success',
                    imageUrl: '../assets/brand/fingerprint.svg',
                    imageHeight: 200,
                    imageAlt: 'Elecciones',
                    title: 'Listado agregado',
                    text: 'Se agregaron ".$Norepetidos." y se descartaron ".$repetidos."',
                    confirmButtonColor: '#3085d6',
                    footer: 'Listado'
                }).then(function(){window.location='../sistema/dashboard/';});</script>";
        
    }
    else
    {
        echo "Selecciona un archivo válido";
    }
// }
?>
</body>

</html>