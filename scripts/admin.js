function queryNo(){
    $.ajax(
        {
            type: "POST",
            url: '../../query/votoNo.php',
            dataType:'html',
            success: function (data) {
                $('#adminRC').fadeIn(1000).html(data);
            }
        });
}
function querySi(){
    $.ajax(
        {
            type: "POST",
            url: '../../query/votoSi.php',
            dataType:'html',
            success: function (data) {
                $('#adminRCSi').fadeIn(1000).html(data);
            }
        });
}