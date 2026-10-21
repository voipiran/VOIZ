$(document).ready(function() {
	$('.telephonyhardware_editregister').click(function () {
		$.get('index.php', {
			menu:	getCurrentIssabelModule(),
			rawmode: 'yes',
			applet: 'TelephonyHardware',
			action: 'registerform',
			hwd: $(this).attr('id')
		}, function(respuesta) {
			if (respuesta.status == 'error') {
				alert(respuesta.message);
			} else {
				ShowModalPopUP(respuesta['title'], 300, 200, respuesta['html']);
			}
		});
	});
});

function telephonyhardware_registersave()
{
	$('.loading').show();
	$('.message').text('');
	$.post('index.php', {
		menu:	getCurrentIssabelModule(),
		rawmode: 'yes',
		applet: 'TelephonyHardware',
		action: 'registersave',
		hwd: $('#telephonyhardware_form input[name="hwd"]').val(),
		num_serie: $('#telephonyhardware_form input[name="num_serie"]').val(),
		vendor: $('#telephonyhardware_form input[name="vendor"]').val()
	}, function(respuesta) {
		$('.loading').hide();
		$('.message').text(respuesta.message);
		if (respuesta.status == 'error') {
			$('.message').css('color', 'red');
		} else {
			$('.message').css('color', 'blue');
			hideModalPopUP();
			appletRefresh($('#Applet_TelephonyHardware'));
		}
	});
}