$(document).ready(function(){
    $(".outter").hide();
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
       $("#loading").hide();
    });
$('.fireevent').click(btnclick)
});

function btnclick()
{
    var btnid=$(this).attr('id');
    var tosend=({
        'btnid':btnid
    });
    $.ajax({
        url:'/findout',
        data:tosend,
        dataType:'JSON',
        method:'POST',
        success: function(data){
            var text="";
            switch(btnid)
            {
                case 'maxsal':
                text="max salary";
                break;
                case 'minsal':
                text="min salary";
                break;
                case 'avgsal':
                text="average salary";
                break;
                case 'highlypaidemp':
                text ="highly paid employee";
                break;
                case 'leastpaidemp':
                text ="least paid employee";
                break;
            }
            $("#"+btnid).html(data+" click to update "+text);
        }
    })
}