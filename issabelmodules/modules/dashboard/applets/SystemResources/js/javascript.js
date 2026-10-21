$(document).ready(function() {
    var gauges = ['cpugauge', 'memgauge', 'swapgauge'];
    var themeColors = getComputedStyle(document.documentElement);
    var resourceColors = [
        themeColors.getPropertyValue('--voiz-success').trim(),
        themeColors.getPropertyValue('--voiz-warning').trim(),
        themeColors.getPropertyValue('--voiz-danger').trim()
    ];
    for (var i = 0; i < gauges.length; i++) {
        $('div#dashboard-applet-'+gauges[i]).data('justgage', new JustGage({
            id: "dashboard-applet-"+gauges[i],
            value: $('input#'+gauges[i]+'_value').val() * 100.0,
            min: 0,
            max: 100,
            donut: true,
            startAnimationType : 'bounce',
            shadowSize: 0,
            shadowVerticalOffset: 0,
            gaugeColor: themeColors.getPropertyValue('--voiz-border').trim(),
            levelColors: resourceColors,
            titleFontColor: themeColors.getPropertyValue('--voiz-text-secondary').trim(),
            valueFontColor: themeColors.getPropertyValue('--voiz-text-secondary').trim(),
            labelFontColor: themeColors.getPropertyValue('--voiz-text-secondary').trim(),
            title: $('input#'+gauges[i]+'_label').val(),
            label: "%"
        }));
    }

	if (typeof systemresources_status_timer == 'undefined')
		systemresources_status_timer = null;
	if (systemresources_status_timer != null) clearInterval(systemresources_status_timer);
	systemresources_status_timer = setInterval(function() {
		$.get('index.php', {
			menu:		getCurrentIssabelModule(),
			rawmode:	'yes',
			applet:		'SystemResources',
			action:		'updateStatus'
		}, function(respuesta) {
			if (respuesta.status != null) {
				for(var gauge in respuesta.status) {
					SystemResources_setGaugeFraction(gauge, respuesta.status[gauge]);
				}
			}
		});
	}, 5000);
});

function SystemResources_setGaugeFraction(gauge, fraction)
{
    $('div#dashboard-applet-'+gauge).data('justgage').refresh(fraction * 100.0);
}