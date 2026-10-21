$(document).ready(function() {
	$('.appletcolumn').sortable({
        connectWith: ".appletcolumn",
        forcePlaceholderSize: true,
        forceHelperSize: true,
        scroll: false,
        stop: function () {
        	var appletlist_left = $('#applet_col_1 .appletwindow_content')
        		.map(function() { return this.id; })
        		.get();
        	var appletlist_right = $('#applet_col_2 .appletwindow_content')
        		.map(function() { return this.id; })
        		.get();

        	/* NOTA: el siguiente código codifica el orden de presentación de
        	 * los applets pero no indica exactamente en qué columna aparecerán.
        	 * Esto es consistente con la implementación anterior. */
        	var appletlist = [];
        	for (var i = 0; i < appletlist_left.length || i < appletlist_right.length; i++) {
        		if (i < appletlist_left.length)
        			appletlist.push(appletlist_left[i]);
        		if (i < appletlist_right.length)
        			appletlist.push(appletlist_right[i]);
        	}

        	//console.debug(appletlist);
        	$.post('index.php', {
        		menu: getCurrentIssabelModule(),
        		rawmode: 'yes',
        		action: 'updateOrder',
        		appletorder: appletlist
        	}, function(respuesta) {
        		if (respuesta.status == 'error') {
        			alert(respuesta.message);
        		}
        	});
        }
	});
	$('.appletrefresh').click(function() {
		$(this).parent().parent().next().map(function() { appletRefresh($(this));});
	});

	// Iniciar la carga de todos los applets
	$('.appletwindow_content').map(function() { appletRefresh($(this));});
});

function appletRefresh(appletwindow_content)
{
	appletwindow_content.children('.appletwindow_fullcontent').hide().empty();
	appletwindow_content.children('.appletwindow_wait').show();
	$.get('index.php', {
		menu: getCurrentIssabelModule(),
		rawmode: 'yes',
		applet: appletwindow_content.attr('id').substr(7), // para quitar 'Applet_'
		action: 'getContent'
	}, function(respuesta) {
		var fullcontent = appletwindow_content.children('.appletwindow_fullcontent');
		appletwindow_content.children('.appletwindow_wait').hide();
		if (respuesta.status == 'error') {
			fullcontent.text(respuesta.message);
		} else {
			fullcontent.html(respuesta.html);
		}
		fullcontent.show();
	});
}