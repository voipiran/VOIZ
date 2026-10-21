/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function saveEdit(){
var module_name = $('#lblModule').val();
        var urlImaLoading = "<img src='images/loading2.gif' height='30px' /><span style='font-size: 14px; position: relative; top: -10px; left: -5px; '>"+$('#lblSaving').val()+"</span>";
	$('#cancel').attr('disabled','disabled');
	$('#save_edit').attr('disabled','disabled');
	$('.message').html(""); 	
	$('.loading').html(urlImaLoading);        
	var values           = getSelectEchoPort();
        var valuesActual     = getActualEchoPort();
        var url              = "index.php";
        var arrParams        = new Array();
        arrParams["action"]  = "save_echo";
        arrParams["idCard"]  = $('#idCard').val();
        arrParams["data"]    = values;
        arrParams["data2"]   = valuesActual;
        arrParams["rawmode"] = "yes";
        request(url,arrParams,false,
            function(arrData,statusResponse,error)
            {
                var message = arrData["msg"];
 		$('.loading').html("");   
		$('.message').html(message);  
		$('#cancel').removeAttr('disabled');
		$('#save_edit').removeAttr('disabled');
           }
        );
}

function saveSpan(){
	 // blocking screen
        var module_name = $('#lblModule').val();
       var urlImaLoading = "<img src='images/loading2.gif' height='30px' /><span style='font-size: 14px; position: relative; top: -10px; left: -5px; '>"+$('#lblSaving').val()+"</span>";
	$('.message').html(""); 
        $('.loading').html(urlImaLoading);   
	$('#cancel').attr('disabled','disabled');
	$('#save_span').attr('disabled','disabled');
        var url = "index.php";
        var module_name = $('#lblModule').val();
        var arrParams = new Array();
        arrParams["menu"]	= module_name;
        arrParams["action"] = "save_span";
        arrParams["idSpan"]  = $('#idCard').val();
        arrParams["rawmode"] = "yes";
        
        arrParams["tmsource"] = $('#tmsource').val();
        arrParams["lnbuildout"] = $('#lnbuildout').val();
        arrParams["framing"] = $('#framing').val();
        arrParams["coding"] = $('#coding').val();
        arrParams["crc"] = $('#crc').val();
        arrParams["media_pri"] = $('#media_pri').val();

        request(url, arrParams, false, 
        	function (arrData, statusResponse, error)
        	{
	            var message = arrData["msg"];
	            // unblocking
	            //$.unblockUI();
	            //alert(message);
	            if (arrData['reload']) {
	            	location.reload();
	            }
		    $('.loading').html("");   
		    $('.message').html(message);  
		    $('#cancel').removeAttr('disabled');
		    $('#save_span').removeAttr('disabled');	
        	}
        );

}
function param(id){
$('#idCard').val("");
        var url = "index.php";
        var arrParams = new Array();
        arrParams["menu"]	= $('#lblModule').val();
        arrParams["action"] = "config_echo";
        arrParams["cardId"] = id;
        arrParams["rawmode"] = "yes";
        request(url,arrParams,false,
            function(arrData,statusResponse,error)
            {
                var echoNames = arrData["type_echo_names"];
                var PortsEcho = arrData["arrPortsEcho"];
                var SpanNum   = arrData["card_id"];
                var key       = "";
                var key2      = "";
                var lastKey2  = "";
                var html      = "";
                var noPorts   = $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #labelNoPorts').val();
		
                $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #idCard').val(SpanNum);
                if(PortsEcho.length <= 0){
                    $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #port_desc').text(noPorts);
                    $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content .viewButton').attr("style","display: none;");
                }else{
                    var port_desc = $('#'+arrData["card_id"]).text();
                    $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #port_desc').text(port_desc);
                    $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content .viewButton').attr("style","display: block; margin-top:10px;");
                }
		
               // $('#config_echo_div').html("");
                html += "<table align='center' width='100%' style='margin-left: -10px;'>";
				
				var i = 0;
                for(key in PortsEcho){
                    key2 = "";
                    lastKey2 = "";
					if((i % 2) == 0){
						html += "<tr>";
						html += "<td align='center' style='padding: 5px;'><b>" + key + "</b> " + PortsEcho[key]['name_port'] + "</td>" +
								"<td align='center' style='padding: 5px;'><select id='typeecho_" + key + "' name='typeecho_" + key + "'>";
						for(key2 in echoNames){
							if(PortsEcho[key]['type_echo'] == key2){
								html += "<option value='" + key2 +"' selected='selected'>" + echoNames[key2] + "</option>";
								lastKey2 = key2;
							}else{
								html += "<option value='" + key2 +"'>" + echoNames[key2] + "</option>";
							}
						}
						html += "</select>" +
								"<input type='hidden' value='" +lastKey2+ "' id='tmpTypeEcho" + key + "' name='tmpTypeEcho" + key + "' />" +
								"</td>";
					}else{
						html += "<td align='center' style='padding: 5px;'><b>" + key + "</b> " + PortsEcho[key]['name_port'] + "</td>" +
								"<td align='center' style='padding: 5px;'><select id='typeecho_" + key + "' name='typeecho_" + key + "'>";
						for(key2 in echoNames){
							if(PortsEcho[key]['type_echo'] == key2){
								html += "<option value='" + key2 +"' selected='selected'>" + echoNames[key2] + "</option>";
								lastKey2 = key2;
							}else{
								html += "<option value='" + key2 +"'>" + echoNames[key2] + "</option>";
							}
						}
						html += "</select>" +
								"<input type='hidden' value='" +lastKey2+ "' id='tmpTypeEcho" + key + "' name='tmpTypeEcho" + key + "' />" +
								"</td>";
						html += "</tr>";
					}
					i++;
                }
		
                if((i % 2) != 0){ // si el ultimo td es impar entonces solo tiene un td y no 2 en el tr
					html += "<td colspan='2'></td>";
					html += "</tr>";
				}
                html += "</table>";
		
                $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #config_echo_div').html(html);
		$('.neo-modal-issabel-popup-box').css('display',"block");
		var alt= $('body .neo-modal-issabel-popup-box .neo-modal-issabel-popup-content #config_echo_div').height();
		if (alt < 545){
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();

			var winH = $(window).height();
			var winW = $(window).width();
			var top = winH/2-alt/2;
			
			$('.neo-modal-issabel-popup-box').css('top',  top-50);
			$('.neo-modal-issabel-popup-box').css('height',  alt+80);
			$('.neo-modal-issabel-popup-content').css('bottom',  10);
			if(i>=30)
			  $('.neo-modal-issabel-popup-box .neo-modal-issabel-popup-content .viewButton').css('margin-top',  0);
		}
            }
        );
}

function paramSpan(id){

	$('#idCard').val("");
        //$('#tmsource').val("Prueba");        
	var url = "index.php";
        var module_name = $('#lblModule').val();
        var arrParams = new Array();
        arrParams["menu"]	= module_name;
        arrParams["action"] = "config_span";
        arrParams["cardId"] = id;
        arrParams["rawmode"] = "yes";
        request(url, arrParams, false,
        	function(arrData, statusResponse, error)
        	{
        		var spaninfo = arrData["spaninfo"];
        		
        		$('#idCard').val(arrData["card_id"]);
        		$('#port_desc_span').text($('#'+arrData["card_id"]).text());
        		$('.viewButton').attr("style","display: block;");
        		
        		/* Se llenan las listas desplegables con las opciones válidas */
        		var coding_dropdown = $('#coding').get(0);
        		coding_dropdown.options.length = 0;
        		var framing_dropdown = $('#framing').get(0);
        		framing_dropdown.options.length = 0;
        		var crc_dropdown = $('#crc').get(0);
        		crc_dropdown.options.length = 0;

        		$.each(arrData['coding_options'], function() {
        			coding_dropdown[coding_dropdown.options.length] = new Option(this, this);
        		});
        		$.each(arrData['framing_options'], function() {
        			framing_dropdown[framing_dropdown.options.length] = new Option(this, this);
        		});
        		$.each(arrData['crc_options'], function() {
        			crc_dropdown[crc_dropdown.options.length] = new Option(this, this);
        		});

        		/* Asignación de los valores actuales de las listas desplegables */
        		$('#tmsource').val(spaninfo["tmsource"]);
        		$('#lnbuildout').val(spaninfo["lnbuildout"]);
        		$('#crc').val(spaninfo["crc"]);
        		
        		$('#media_pri').unbind('change');
        		$('#media_pri').change(function() {
        			var newval = $(this).val();
        			
        			var coding_dropdown = $('#coding').get(0);
            		var framing_dropdown = $('#framing').get(0);
            		var crc_dropdown = $('#crc').get(0);
        			coding_dropdown.options.length = 0;
            		framing_dropdown.options.length = 0;
            		crc_dropdown.options.length = 0;
        			if (newval == 'T1') {
        				coding_dropdown[0] = new Option('b8zs', 'b8zs');
        				coding_dropdown[1] = new Option('ami', 'ami');
        				framing_dropdown[0] = new Option('esf', 'esf');
        				framing_dropdown[1] = new Option('d4', 'd4');
        				$('#switch_crc').attr("style","display: none;");
        			} else if (newval == 'E1') {
        				coding_dropdown[0] = new Option('hdb3', 'hdb3');
        				coding_dropdown[1] = new Option('ami', 'ami');
        				framing_dropdown[0] = new Option('ccs', 'ccs');
        				framing_dropdown[1] = new Option('cas', 'cas');
        				crc_dropdown[0] = new Option('crc4', 'crc4');
        				crc_dropdown[1] = new Option('ncrc4', 'ncrc4');
        				$('#switch_crc').attr("style","display: table-row;");
        			}
        		});
        		
        		
        		if (spaninfo["wanpipe_force_media"] == "T1") {
        			$('#switch_pri_media').attr("style","display: table-row;");
            		$('#media_pri').val(spaninfo["wanpipe_force_media"]);
            		$('#switch_crc').attr("style","display: none;");
        		} else if (spaninfo["wanpipe_force_media"] == "E1") {
        			$('#switch_pri_media').attr("style","display: table-row;");
            		$('#media_pri').val(spaninfo["wanpipe_force_media"]);
            		$('#switch_crc').attr("style","display: table-row;");
        		} else {
        			$('#switch_pri_media').attr("style","display: none;");
        			$('#switch_crc').attr("style","display: none;");
				$('.neo-modal-issabel-popup-box').css('height', 225);
        		}
			
        		$('#framing').val(spaninfo["framing"]);
        		$('#coding').val(spaninfo["coding"]);
        	}
        );
$('.tabForm').css("border",0);
$('.tabForm').css("background-image","none");
}

$(document).ready(function(){
    $(".move").draggable({
        zIndex:     20,
        ghosting:   false,
        opacity:    0.7
    });

    $('a[id^=confSPAN]').click(function(e) {

	var arrAction = new Array();
    	arrAction["action"]  = "config_echol";
    	arrAction["rawmode"] = "yes";
	arrAction["menu"]       = $('#lblModule').val();
        var id = $(this).attr('id');
    	request("index.php",arrAction,false,
          function(arrData,statusResponse,error)
          {
  	      ShowModalPopUP(arrData['title'],300,800,arrData['html']);$('.neo-modal-issabel-popup-box').css('display',  "none");
	      param(id);
          }
    );
});

    $('a[id^=paramSPAN]').click(function(e) {
        var arrAction = new Array();
    	arrAction["action"]  = "config_param";
    	arrAction["rawmode"] = "yes";
        arrAction["menu"]       = $('#lblModule').val();
	var id = $(this).attr('id');
    	request("index.php",arrAction,false,
          function(arrData,statusResponse,error)
          {
  	      ShowModalPopUP(arrData['title'],500,300,arrData['html']);
	      paramSpan(id);
          }
        );
    });

  

    $('#chkAdvance').change(function() {
        var estado;
        if($(this).is(":checked")){
            $('#optionsAdvance').attr("style","visibility: visible;");
        }else{
            $('#optionsAdvance').attr("style","visibility: hidden;");
        }
    });

   $('#editArea1').click(function() {
        $("#layer1").show(); 
    });

    $('#close1').click(function() {
        $("#layer1").hide();
    });

    $('#editArea2').click(function() {
        $("#layer2").show(); 
    });
    $('#close2').click(function() {
        $("#layer2").hide();
    });

    $('#editArea3').click(function() {
        $("#layer3").show(); 
    });
    $('#close3').click(function() {
        $("#layer3").hide();
    });

    $('#editArea4').click(function() {
        $("#layer4").show(); 
    });
    $('#close4').click(function() {
        $("#layer4").hide();
    });

    $('#editArea5').click(function() {
        $("#layer5").show(); 
    });
    $('#close5').click(function() {
        $("#layer5").hide();
    });

    $('#editArea6').click(function() {
        $("#layer6").show(); 
    });
    $('#close6').click(function() {
        $("#layer6").hide();
    });

    $('#editArea7').click(function() {
        $("#layer7").show(); 
    });
    $('#close7').click(function() {
        $("#layer7").hide();
    });

    $('#editArea8').click(function() {
        $("#layer8").show(); 
    });
    $('#close8').click(function() {
        $("#layer8").hide();
    });

    $('#editArea9').click(function() {
        $("#layer9").show(); 
    });
    $('#close9').click(function() {
        $("#layer9").hide();
    });

    $('#editArea10').click(function() {
        $("#layer10").show(); 
    });
    $('#close10').click(function() {
        $("#layer10").hide();
    });

    $('#editArea11').click(function() {
        $("#layer10").show(); 
    });
    $('#close11').click(function() {
        $("#layer10").hide();
    });

    $('#editArea12').click(function() {
        $("#layer10").show(); 
    });
    $('#close12').click(function() {
        $("#layer10").hide();
    });

    $('#editArea13').click(function() {
        $("#layer10").show(); 
    });
    $('#close13').click(function() {
        $("#layer10").hide();
    });

    $('#editArea14').click(function() {
        $("#layer10").show(); 
    });
    $('#close14').click(function() {
        $("#layer10").hide();
    });

    $('#editArea15').click(function() {
        $("#layer10").show(); 
    });
    $('#close15').click(function() {
        $("#layer10").hide();
    });
    /*Manufacturer*/
    
    $('#editMan1').click(function() {
        $("#layerCM1").show(); 
    });
    $('#closeCM1').click(function() {
        $("#layerCM1").hide();
    });

    $('#editMan2').click(function() {
        $("#layerCM2").show(); 
    });
    $('#closeCM2').click(function() {
        $("#layerCM2").hide();
    });

    $('#editMan3').click(function() {
        $("#layerCM3").show(); 
    });
    $('#closeCM3').click(function() {
        $("#layerCM3").hide();
    });

    $('#editMan4').click(function() {
        $("#layerCM4").show(); 
    });
    $('#closeCM4').click(function() {
        $("#layerCM4").hide();
    });

    $('#editMan5').click(function() {
        $("#layerCM5").show(); 
    });
    $('#closeCM5').click(function() {
        $("#layerCM5").hide();
    });

    $('#editMan6').click(function() {
        $("#layerCM6").show(); 
    });
    $('#closeCM6').click(function() {
        $("#layerCM6").hide();
    });

    $('#editMan7').click(function() {
        $("#layerCM7").show(); 
    });
    $('#closeCM7').click(function() {
        $("#layerCM7").hide();
    });

    $('#editMan8').click(function() {
        $("#layerCM8").show(); 
    });
    $('#closeCM8').click(function() {
        $("#layerCM8").hide();
    });

    $('#editMan9').click(function() {
        $("#layerCM9").show(); 
    });
    $('#closeCM9').click(function() {
        $("#layerCM9").hide();
    });

    $('#editMan10').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM10').click(function() {
        $("#layerCM10").hide();
    });

    $('#editMan11').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM11').click(function() {
        $("#layerCM10").hide();
    });
    
    $('#editMan12').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM12').click(function() {
        $("#layerCM10").hide();
    });

    $('#editMan13').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM13').click(function() {
        $("#layerCM10").hide();
    });

    $('#editMan14').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM14').click(function() {
        $("#layerCM10").hide();
    });

    $('#editMan15').click(function() {
        $("#layerCM10").show(); 
    });
    $('#closeCM15').click(function() {
        $("#layerCM10").hide();
    });
});

/*
function saveSpanConfiguration(idSpan){
    var xhr = objAjax();
    var arrSpanConf = new Array();
    
    var tmsource = document.getElementById("tmsource_"+idSpan);
    var tmsource_escogida = tmsource.options[tmsource.selectedIndex].text;
    //arrSpanConf[0] = tmsource.options[tmsource.selectedIndex].text;

    var lnbuildout = document.getElementById("lnbuildout_"+idSpan);
    var lnbuildout_escogida = lnbuildout.options[lnbuildout.selectedIndex].text;
    //arrSpanConf[1] = lnbuildout.options[lnbuildout.selectedIndex].text;

    var framing = document.getElementById("framing_"+idSpan);
    var framing_escogida = framing.options[framing.selectedIndex].text;
    //arrSpanConf[2] = framing.options[framing.selectedIndex].text;

    var coding = document.getElementById("coding_"+idSpan);
    var coding_escogida = coding.options[coding.selectedIndex].text;
    //arrSpanConf[3] = coding.options[coding.selectedIndex].text;
    
    xhr.open("POST","index.php?menu=hardware_detector&rawmode=yes&action=setConfig&idSpan="+idSpan+"&tmsource="+tmsource_escogida+"&lnbuildout="+lnbuildout_escogida+"&framing="+framing_escogida+"&coding="+coding_escogida,true);
    xhr.onreadystatechange = function()
    {
        controllerDisplayConfig(xhr);
    }
    xhr.send(null);

    return;
}
*/
function controllerDisplayConfig(xhr)
{
    if(xhr.readyState==4)
    {
        if(xhr.status==200)
        {
            alert("Span configuration saved succesfully");
        }
    }
}

function addTextBox(idCard){
    var xhr = objAjax();
    var arrSpanConf = new Array();
    var manufacturer = document.getElementById("manufacturer_"+idCard);
    var manufacturer_selected = manufacturer.options[manufacturer.selectedIndex].text;

    if(manufacturer_selected=="Otros"){
        var select_td = document.getElementById("select_"+idCard);
        inputtag = document.createElement("input");
        inputtag.setAttribute("type", "text");
        inputtag.setAttribute("name", "manufacturer_other_"+idCard);
        inputtag.setAttribute("id", "manufacturer_other_"+idCard);
        inputtag.setAttribute("size", "12");
        select_td.appendChild(inputtag);
    }else{
        var select_td = document.getElementById("select_"+idCard);
        var kids = select_td.childNodes;
        select_td.removeChild(kids[1]);
    }

}

function objAjax()
{
    var xmlhttp=false;
    try 
    {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined')
    {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}


var request_hd = 'apagado';
function detectar()
{
    var nodoReloj            = document.getElementById('relojArena');
    var chk_dahdi_replace    = document.getElementById('chk_dahdi_replace');
    var chk_there_is_sangoma = document.getElementById('chk_there_is_sangoma');
    var chk_misdn_hardware   = document.getElementById('chk_misdn_hardware');

    var arrAction                      = new Array();
    arrAction["action"]                = "detection";
    arrAction["rawmode"]               = "yes";
    arrAction["menu"]                  = "hardware_detector";
    arrAction["chk_dahdi_replace"]     = chk_dahdi_replace.checked;
    arrAction["there_is_sangoma_card"] = chk_there_is_sangoma.checked;
    arrAction["there_is_misdn_card"]   = chk_misdn_hardware.checked;

    if(request_hd=='apagado'){
        request_hd='prendido';
        nodoReloj.style.display = "block";
        request("index.php",arrAction,false,
            function(arrData,statusResponse,error)
            {
                request_hd = 'apagado';
                alert(arrData["msg"]);
                nodoReloj.style.display = "none";
                window.location.reload();
            }
        );
    }
}

//typeecho_1|OSLEC,typeecho_2|OSLEC,typeecho_3|OSLEC,typeecho_4|OSLEC,
function getSelectEchoPort(){
    var values = "";
    $('select[id^=typeecho_] option:selected').each(function(){
        values += $(this).parent().attr('id')+"|"+$(this).text()+",";
    });
    return values;
}

//tmpTypeEcho1|OSLEC,tmpTypeEcho2|OSLEC,tmpTypeEcho3|OSLEC,tmpTypeEcho4|OSLEC,
function getActualEchoPort(){
    var values = "";
    $('input[id^=tmpTypeEcho]').each(function(){
        values += $(this).attr('id')+"|"+$(this).val()+",";
    });
    return values;
}
