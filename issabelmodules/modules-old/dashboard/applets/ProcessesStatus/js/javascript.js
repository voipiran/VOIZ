$(document).ready(function() {
	$(document).off('click', '.neo-applet-processes-row-menu');
	$(document).on('click', '.neo-applet-processes-row-menu', neoAppletProcesses_manejarMenu);
});

function neoAppletProcesses_esconderMenu()
{
	$('.neo-applet-processes-menu').unbind('click');
	$('html').unbind('click', neoAppletProcesses_esconderMenu);
	$('.neo-applet-processes-menu').hide();
	return false;
}

// Mostrar menú de administración en applet de procesos
function neoAppletProcesses_manejarMenu(event)
{
	sCurrState = $(this).children('#status-servicio').val();
	isActivate = $(this).children('#activate-process').val();
	sProc = $(this).children('#key-servicio').val();
	if (sCurrState != 'OK' && sCurrState != 'Shutdown') return;
	
	if ($('.neo-applet-processes-menu').is(':visible')) {
		neoAppletProcesses_esconderMenu();
	} else {
		event.stopPropagation();

		// Operaciones para cerrar menú cuando se hace clic fuera
		$('.neo-applet-processes-menu').click(function(event) {
			event.stopPropagation();
		});
		$('html').click(neoAppletProcesses_esconderMenu);

		// Se recuerda qué proceso se va a manejar
		$('#neo_applet_selected_process').val(sProc);
		
		$('#neo-applet-processes-controles').show();
		$('#neo-applet-processes-processing').hide();
		
		$('.neo_applet_process').unbind('click');
		
		$('.neo_applet_process').click(function() {
			$('#neo-applet-processes-controles').hide();
			$('#neo-applet-processes-processing').show();
			$.post('index.php', {
				menu:		getCurrentIssabelModule(), 
				rawmode:	'yes',
				applet:		'ProcessesStatus',
				action:		$(this).attr('name'),
				process:	$('#neo_applet_selected_process').val()
			},
			
			function (respuesta) {
				neoAppletProcesses_esconderMenu();
				if (respuesta.status == 'error') {
					alert(respuesta.message);
				} else {
					appletRefresh($('#Applet_ProcessesStatus'));
				}
			});
		});
		
		$('.neo-applet-processes-menu').show();
		$('.neo-applet-processes-menu').css("position","fixed");
		$('.neo-applet-processes-menu').position({
			of: $(this),
			my: "right top",
			at: "right bottom",
			offset: "-7 1"
		});
		
		if (sCurrState == 'OK') {
			$('#neo_applet_process_stop').show();
			$('#neo_applet_process_restart').show();
			$('#neo_applet_process_start').hide();
		}
		if (sCurrState == 'Shutdown') {
			$('#neo_applet_process_stop').hide();
			$('#neo_applet_process_restart').hide();
			$('#neo_applet_process_start').show();
		}
		if(isActivate == '1')
		{
			$('#neo_applet_process_activate').hide();
			$('#neo_applet_process_deactivate').show(); 
		}else{
			$('#neo_applet_process_activate').show();
			$('#neo_applet_process_deactivate').hide();
		}
	}
}
