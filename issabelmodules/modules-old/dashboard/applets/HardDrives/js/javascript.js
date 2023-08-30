$(document).ready(function() {
	$('#harddrives_dirspacereport_fetch').click(function() {
		$('#harddrives_dirspacereport').html("<img class='ima' src='modules/" + getCurrentIssabelModule() + "/images/loading.gif' border='0' align='absmiddle' />");
		$.get('index.php', {
			menu: getCurrentIssabelModule(),
			rawmode: 'yes',
			applet: 'HardDrives',
			action: 'dirspacereport'
		},
		function(respuesta) {
			if (respuesta.status == 'error') {
				alert(respuesta.message);
			} else {
				$('#harddrives_dirspacereport').html(respuesta.html);
			}
		});
	});
});