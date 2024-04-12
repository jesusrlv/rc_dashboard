function porcentajeRC(){
    $.ajax(
        {
            type: "POST",
            url: '../../query/porcentajeRC.php',
            dataType:'html',
            success: function (data) {
                $('#porcentajeRC').fadeIn(1000).html(data);
            }
        });
}