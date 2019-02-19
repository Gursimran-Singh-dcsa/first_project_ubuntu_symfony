var error=false;
$(document).ready(function(){
    var error=false;
    $("#loading").hide();
    $("#submit").click(validator);
    $(document).on("click",".no",noclick);
    $(document).on("click",".outer",noclick);
    $(document).on("click",".inner",innerclick);
    $(document).on('click','.yes',yesclick);
    $(document).ajaxStart(function () {
        console.log("ajax start function");
        $("#loading").show();
    }).ajaxStop(function () {
        console.log("ajax stop function");
        $("#loading").hide();
    });

    
});
function yesclick(){
    $(".outer").remove();
    $.ajax({
        url:"/trypanga",
        dataType:'json',
        method:"POST",
        data:{
            Name:$("#name").val(),
            salary:parseInt($("#salary").val())
        },  
        success:function(data){
        
          alert(data.Name);
        },
       });
}
function innerclick(e){
    
    e.stopPropagation();
    console.log("fmdfmd");
}
function noclick(){
      $(".outer").remove();
}
function validator()
{
    
    error=false;
    calculate();
    nameVal();
    if(error)
    {
        alert("There is some Error in your input");
    }
    else
    {
        askSubmit();
    }
    
}

function calculate(e){
    let salary=$("#salary").val();
    if(salary==''|| isNaN(salary))
    {   
        error=true;
        console.log("calculate error is true");
        if(isNaN(salary))
        {
            $("#salary").css("color","red");
            $("#salary").css("border","1px solid red");
        }
        
        $("#PF").html("---NA---");
        $("#Inhand").html("---NA---");
    }
    else
    {
        $("#salary").css("color","green");
        $("#salary").css("border","none");
        $("#salary").css("border-bottom","1px solid white");
        let pf=(salary*12)/100;
        let inhand=salary-pf;
        diff=pf-parseInt(pf);
        if(diff>.5)
        {
            modifiedpf=parseInt(pf)+1;
            
        }
        else{
            modifiedpf=parseInt(pf);
        }
       let  modifiedinhand=salary-modifiedpf;
        if(pf==modifiedpf)
        {
            $("#PF").html("PF:"+pf);
            $("#Inhand").html("Inhand:"+inhand);
        }
            else{
            $("#PF").html("PF:"+pf+" ~ "+ modifiedpf);
            $("#Inhand").html("Inhand:"+inhand+" ~ "+modifiedinhand);
        }
    }

}

function nameVal(e)
{
    
    let name=$("#name").val();
    
    if(name==''|| !/^[A-Za-z ]+$/.test(name))
    {
        error=true;
        console.log("name eror is true");   
        if(!/^[A-Za-z ]+$/.test(name))
        {
            console.log("NAN");
            $("#name").css("color","red");
            $("#name").css("border","1px solid red");
        }
        
    }
    else
    {
        $("#name").css("color","green");
        $("#name").css("border","none");

        $("#name").css("border-bottom","1px solid white");
    }

}
 function askSubmit()
{
    $("body").append("<div class='outer'><div class='inner'>Do you want to Submit?<br><span class='yes'>yes</span>\
    <span class='no'>No</span></div></div>");
}
