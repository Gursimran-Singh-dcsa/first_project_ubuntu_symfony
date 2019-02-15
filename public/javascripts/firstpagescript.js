var error=false;
$(document).ready(function(){
    var error=false;
    $("#submit").click(validator);
    
});
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
        alert("are you sure you want to submit?");
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
        $("#PF").html("PF:"+pf);
        let inhand=salary-pf;
        $("#Inhand").html("Inhand:"+inhand);
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
 
