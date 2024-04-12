<?php    
    session_start();
    include('qc.php');

    date_default_timezone_set('America/Mexico_City');
                  setlocale(LC_TIME, 'es_MX.UTF-8');

    $id = $_POST['id']; //evento
    $tipo_asistente = 1;
    $unidad_academica = 1;
 
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
                // Get row data
                $nombre = $getData[0];
                $apellidos = $getData[1];
                $curp = $getData[2];
                $tipo_sangre = $getData[3];
                $semestre = $getData[4];
                $grupo = $getData[5];
                $carrera = $getData[6];
                $numero_control = $getData[7];
                $concatenado = $curp.'_'.$numero_control;
                // If user already exists in the database with the same email
                // $query = "SELECT id FROM invitados WHERE id_evento = '" . $getData[5] . "'";
 
                $check = mysqli_query($conn, $query);
 
                // if ($check->num_rows > 0)
                // {
                //     mysqli_query($conn, "UPDATE users SET name = '" . $name . "', phone = '" . $phone . "', status = '" . $status . "', created_at = NOW() WHERE email = '" . $email . "'");
                // }
                // else
                // {
                     mysqli_query($conn, "INSERT INTO asistentes (nombre, apellidos, curp, tipo_sangre, semestre, grupo, carrera, numero_control, tipo_asistente, unidad_academica, idQr) VALUES ('" . $nombre . "', '" . $apellidos . "', '" . $curp . "', '" . $tipo_sangre . "', '" . $semestre . "', '" . $grupo . "', '" . $carrera . "', '" . $numero_control . "', '" . $tipo_asistente . "', '" . $unidad_academica . "', '" . $concatenado . "')");
 
                // }
            }
 
            // Close opened CSV file
            fclose($csvFile);
            echo "
        <script>
        alert('Agregados correctamente');
        </script>
        ";
 
            header("Location: ../lista_Asistentes.php");
         
    }
    else
    {
        echo "
        <script>
        alert('Selecciona un archivo válido');
        </script>
        ";
        header("Location: ../lista_Asistentes.php");
    }
// }
?>