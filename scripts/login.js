function login(){
    var usr = document.getElementById("usuario").value;
    var pwd = document.getElementById("pwd").value;

    $.ajax(
        {
            type: "POST",
            url: 'query/login.php',
            dataType:'json',
            data:{
              usr:usr,
              pwd:pwd
            },
            success: function (data) {
              var jsonData = JSON.parse(JSON.stringify(data));
              var success = jsonData.success;
              var perfil = jsonData.perfil;
              
            if(success == 1){
              if(perfil == 1){
                Swal.fire({
                  icon:'success',
                  title: 'Login correcto',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "sistema/rc/";
                  }
                });
              }
              else if(perfil == 2){
                Swal.fire({
                  icon:'success',
                  title: 'Login correcto',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "sistema/admin/";
                  }
                });
              }
              else if(perfil == 3){
                Swal.fire({
                  icon:'success',
                  title: 'Login correcto',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "sistema/dashboard/";
                  }
                });
              }
            }
              else if(success == 0){
                Swal.fire({
                  icon: 'error',
                  title: 'Usuario o contraseña incorrectos',
                  footer: 'RCs'
                });
              }

            }
        });
}