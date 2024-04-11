function claveN(val){
    var nominal = val;
    $.ajax(
        {
            type: "POST",
            url: '../../query/nominal.php',
            dataType:'json',
            data:{
              nominal:nominal
            },
            success: function (data) {
              var jsonData = JSON.parse(JSON.stringify(data));
              var success = jsonData.success;
              var voto = jsonData.voto;
              
              if (success == 1){
                  var nombre = jsonData.nombre;
                  var clave = jsonData.clave;
                  var seccion = jsonData.seccion;
                  var municipio = jsonData.municipio;
                  var id = jsonData.id;

                  document.getElementById('nombreNominal').innerHTML = nombre;
                  document.getElementById('claveNominal').innerHTML = clave;
                  document.getElementById('seccionNominal').innerHTML = seccion;
                  document.getElementById('municipioNominal').innerHTML = municipio;
                  document.getElementById('idNominal').value = id;

                  document.getElementById('textoCN').innerHTML = "Clave correcta";
                  document.getElementById('textoCN').setAttribute('class', 'text-primary');
                  
                  if (voto == 1){
                      document.getElementById('btnIncidencias').disabled = false;
                      document.getElementById('btnRegistro').disabled = true;
                      document.getElementById('votoNominal').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
                      
                    }
                    else if (voto == 0){
                        document.getElementById('btnIncidencias').disabled = true;
                        document.getElementById('btnRegistro').disabled = false;
                        document.getElementById('votoNominal').innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
                  }



              }
              else if(success == 0){
                document.getElementById('textoCN').innerHTML = "No exite la clave";
                document.getElementById('textoCN').setAttribute('class', 'text-danger');

                document.getElementById('btnIncidencias').disabled = false;
                document.getElementById('btnRegistro').disabled = true;

                document.getElementById('nombreNominal').innerHTML = "";
                document.getElementById('claveNominal').innerHTML = "";
                document.getElementById('seccionNominal').innerHTML = "";
                document.getElementById('municipioNominal').innerHTML = "";
                document.getElementById('votoNominal').innerHTML = '';

              }
            }

        });
}

function registraVotacion(){
    $('#modalRegistro').modal('hide'); 

    var id = document.getElementById('idNominal').value;

    $.ajax(
        {
            type: "POST",
            url: '../../prcd/registrar_voto.php',
            dataType:'json',
            data:{
              id:id
            },
            success: function (data) {
              var jsonData = JSON.parse(JSON.stringify(data));
              var success = jsonData.success;
              var voto = jsonData.voto;

              if (success == 1){
                alert('Voto registrado correctamente');
                document.getElementById('nombreNominal').innerHTML = "";
                document.getElementById('claveNominal').innerHTML = "";
                document.getElementById('seccionNominal').innerHTML = "";
                document.getElementById('municipioNominal').innerHTML = "";
                document.getElementById('votoNominal').innerHTML = '';
                document.getElementById('claveNominal2').value = '';

              }
              else if(success == 0){
                alert('No se pudo registrar el voto');
              }

            }
        });
}

function reporteIncidencia(){
    // var id = document.getElementById('idNominal').value;
    var incidencia = document.getElementById('incidencia').value;
    // var idSess = document.getElementById('idNominal').value;

    $.ajax(
        {
            type: "POST",
            url: '../../prcd/registrar_incidencia.php',
            dataType:'json',
            data:{
              incidencia:incidencia
            },
            success: function (data) {
              var jsonData = JSON.parse(JSON.stringify(data));
              var success = jsonData.success;

              if (success == 1){
                $('#modalIncidencia').modal('hide');
                alert('Incidencia reportada correctamente');
                document.getElementById('incidencia').value = "";

              }
              else if(success == 0){
                alert('No se pudo registrar el voto');
              }

            }
        });
}