outputhash = null;

$(document).ready(function() {
	var jobid = $("#jobid").val();
	if (jobid != '') {
		outputhash = null;
		checkFaxStatus(jobid);
	}
});

function checkFaxStatus(jobid)
{
	var params = {
		menu:			'sendfax',
		action:			'checkFaxStatus',
		rawmode:		'yes',
		jobid:			$("#jobid").val(),
		modem:			$("#from").val(),
		'outputhash':	outputhash	
	};
	$.post('index.php', params,
		function (respuesta) {
			outputhash = respuesta.message.outputhash;
	        if (respuesta.statusResponse == 'CHANGED'){
        		$("#sending_fax").hide();
	        	if (respuesta.message.faxstatus.state == 'D') {
	        		// Fax enviado correctamente
	        		$("#success_fax").show();
	        		$("#statusFax").html('');
	        	} else if (respuesta.message.faxstatus.state == 'F') {
	        		// Fax ha fallado luego de los reintentos
	        		$("#statusFax").html(respuesta.message.faxstatus.status);
	        	} else {
	        		// Fax en progreso
	        		$("#statusFax").html(respuesta.message.faxstatus.modemstatus + ' - [' 
	        				+ respuesta.message.faxstatus.state + '] ' 
	        				+ respuesta.message.faxstatus.status);
	    			setTimeout(checkFaxStatus, 1);
	        	}
	        } else {
    			setTimeout(checkFaxStatus, 1);
	        }
		});
}
