$(document).ready(function(){

    $('.table_data tr').mouseover(function() {
        if(!($(this).attr("class")))
            $(this).children(':last-child').children(':first-child').children(':last-child').children(':first-child').attr("style", "visibility: visible;");

    });

    $('.table_data tr').mouseout(function(){
        if(!($(this).attr("class")))
            var dd = $(this).children(':last-child').children(':first-child').children(':last-child').children(':first-child').attr("style", "visibility: hidden;");
    });

});

function callContact(idContact,typeContact){
    var arrAction = new Array();
    arrAction["menu"]="address_book";
    arrAction["action"]="call2phone";
    arrAction["rawmode"]="yes";
    arrAction["idContact"]=idContact;
    arrAction["typeContact"]=typeContact;

    request("index.php", arrAction, false,
        function(arrData,statusResponse,error){
            if(error != ''){
                alert(error);
            }else{
                //se rrealiza la llamada.
            }
        }
    );
}

function transferCall(idContact,typeContact){
    var arrAction = new Array();
    arrAction["menu"]="address_book";
    arrAction["action"]="transfer_call";
    arrAction["rawmode"]="yes";
    arrAction["idContact"]=idContact;
    arrAction["typeContact"]=typeContact;

    request("index.php", arrAction, false,
        function(arrData,statusResponse,error){
            if(error != ''){
                alert(error);
            }else{
                //se realiza la transferencia de llamada.
            }
        }
    );
}

