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
    // include('../QR/phpqrcode/qrlib.php'); 

    date_default_timezone_set('America/Mexico_City');
                  setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_qr = strftime("%Y-%m-%d,%H:%M:%S");
    $repetidos = 0;
    $Norepetidos = 0;

    // $id = $_POST['id'];
 
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
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {

                //falta definir la mesa, evento, tipo de invitado, la consulta para definir el $rowEvent

                // código temporal para crear las variables de QR
                // archivo query_agregar_invitados.php para acomodar las variables
                // function generarCodigo($longitud) {
                //     $key = '';
                //     $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                //     $max = strlen($pattern)-1;
                //     for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
                //     return $key;
                //     }
                //     //genera un código de 9 caracteres de longitud.
                //     $codigo = generarCodigo(9);
                //     $contatena = $evento.'_'.$codigo.'_'.$mesa.'_'.$fecha_qr;
            
                //     $codesDir = "QR/codes/";   
                //     $codesDir2 = "../QR/codes/";   

                    // $codeFile = $evento.'_'.$codigo.'_'.$mesa.'.png';
                    // $qrDirectorio = $codesDir.'/'.$codeFile;
                    // QRcode::png($contatena, $codesDir2.$codeFile, 'H', 10); 
                    // echo '
                    // <div id="div_print">
                    //     <p><strong>Código Eventos<br>2022</strong></p>
                    //     <p class="text-center"><img class="img-thumbnail" src="../'.$codesDir.$codeFile.'" /></p>
                    // </div>'
                    // ;
                // código temporal para crear las variables de QR



                // Get row data
                $nominal = $getData[0];
                $apellido_p = $getData[1];
                $apellido_m = $getData[2];
                $nombre = $getData[3];
                $carrera = $getData[4];
                $curp = $getData[5];
                $concatenado = $curp.'_'.$no_control;
                $perfil = 6;
                
                $nombreCompleto = $nombre.' '.$apellido_p.' '.$apellido_m;
                

                $consulta = "SELECT * FROM listado WHERE curp = '$curp'";
                $resultadoConsulta = $conn->query($consulta);
                $filas = $resultadoConsulta->num_rows;
                // If user already exists in the database with the same email
                // $query = "SELECT id FROM invitados WHERE id_evento = '" . $getData[5] . "'";

                if($filas == 0){
                // $check = mysqli_query($conn, $query);
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

                    // $insertUsuarios = "INSERT INTO usuarios(nombre, usr, pwd, perfil) VALUES('$nombreCompleto', '$no_control', '$no_control', '$perfil')";
                    // $resultadoUsr = $conn->query($insertUsuarios);

                    // $error = $conn->error;
                    // echo $error;
                }
                else{
                    $repetidos++;
                    echo '
                    <p>'.$repetidos.'.- Se repite el asistente '.$nombre.' '.$apellido_p.' '.$apellido_m.' // '.$no_control.' // '.$curp.', no se agregó al sistema.<p>
                    ';

                }
            }

            // Close opened CSV file
            fclose($csvFile);

            // header("Location: ../home_events.php?id=$id");
            
                echo "<script type=\"text/javascript\">
                Swal.fire({
                    icon: 'success',
                    imageUrl: '../../assets/brand/img/somos_fca_halcon_azul_15.png',
                    imageHeight: 200,
                    imageAlt: 'UACYA UAZ',
                    title: 'Asistentes agregados',
                    text: 'Se agregaron ".$Norepetidos." y se descartaron ".$repetidos."',
                    confirmButtonColor: '#3085d6',
                    footer: 'UACYA'
                }).then(function(){window.location='../alta_asistentes.php';});</script>";

        
    }
    else
    {
        echo "Selecciona un archivo válido";
    }
// }
?>
</body>

</html>