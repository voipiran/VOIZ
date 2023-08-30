var table;
$(document).ready( function () {
    if(typeof(module)=='undefined') {
        return;
    }
    table = $('#CDRreport').DataTable( {
    "language": {
                "url": "/modules/"+module+"/lang/datatables."+lang+".json"
                },
    pagingType: "full_numbers",
    mark: true,
    data: cdrs,
    orderClasses: false,
    searchDelay: 500,
     columnDefs: [
        { type: 'time-elapsed-dhms', targets: 8 },
    ],
    "order": [[ 0, "desc" ]],
    responsive: true,
    colReorder: true,
    lengthChange: true,
    select: {
            style: "multi+shift",
            blurable: true
            },
    bSort: true,
    "initComplete": function(settings, json) {
    buildData();
    $('div.dataTables_filter input').off('keyup.DT input.DT');

     var searchDelay = null;

     $('div.dataTables_filter input').on('keyup', function() {
         var search = $('div.dataTables_filter input').val();
         clearTimeout(searchDelay);
         searchDelay = setTimeout(function() {
            if (search != null) {
                table.search(search).draw();
                buildData();
            }
        }, 1000);
    });
    },
    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "dom": '<"clear"><"top"<"row"<"col-md-12 nopadding"B>><"row"<"col-md-6 nopadding"l><"col-md-6 nopadding"f>>>'+
           '<"col-md-12 nopadding"rt>'+
           '<"bottom"<"row"<"col-md-6 nopadding"i><"col-md-6 nopadding"p>>><"clear">',
    buttons: [
       {
           className: 'btn-danger',
           text: '<i class="fa fa-eraser"></i> '+'Delete',
           action: function () {
               var data = table.rows( { selected: true } ).data();
               var uniqueids=[];
               if (data.length < 1) {
                   alert('No row(s) selected');
                   return true;
               }
               if (!confirm(DELMSG)) {
                  return true;
               }
               for (var i=0; i < data.length ;i++){
                   uniqueids.push(data[i][9]);
               }
               var uidslist = uniqueids.join(",");
               var date_start = document.getElementsByName("date_start")[0].value;
               var date_end = document.getElementsByName("date_end")[0].value;
               result = true;

               $.ajax({
                    url:'./index.php',
                    type: 'post',
                    data: {delete: 'delete', date_start: date_start, date_end: date_end, UIDsList: uidslist},
                    success: function(response) {
                        console.log(response);
                    }
               });
               if (result == true) {
                   var rows = table
                   .rows( '.selected' )
                   .remove()
                   .draw();
                   buildData();
              }
          }
       },
       {
       className: 'btn',
       text: '&nbsp'+'<i class="glyphicon glyphicon-eye-open"></i>'+'&nbsp',
       extend: 'colvis'
       },
       {
       className: 'btn',
       text: '&nbsp'+'<i class="glyphicon glyphicon-check"></i>'+'&nbsp',
       action: function() {
       table.rows().deselect();
       table.rows({
       page: 'current'
       }).select();
       }
       },
       {
       className: 'btn',
       text: '&nbsp'+'<i class="glyphicon glyphicon-unchecked"></i>'+'&nbsp',
       extend: 'selectNone'
       },
       {
       className: 'btn btn-link',
       extend: 'csvHtml5',
       exportOptions: {
           columns: ':visible',
           },
       },
       {
       className: 'btn btn-link',
       extend: 'excelHtml5',
       exportOptions: {
           columns: ':visible',
           },
       },
       {
       className: 'btn btn-link',
       extend: 'pdfHtml5',
       exportOptions: {
           columns: ':visible',
           },
       orientation: 'landscape',
       },
   ],
} );
   table.on( 'select', function ( e, dt, type, ix ) {
     var selected = dt.rows({selected: true});
     if ( selected.count() > 100 ) {
       dt.rows(ix).deselect();
     }
} );
} );

document.onreadystatechange = function() {

    if($('#loader').length > 0) {
        if (document.readyState !== "complete") {
             document.querySelector(
               "#loader").style.visibility = "visible";
        } else {
            document.querySelector(
              "#loader").style.display = "none";
        }
    };
}
//BuildChart(dates, descrip, ALL_count, ANSWERED_count,NOANSWER_count, BUSY_count, FAILED_count);
function BuildChart(labels, datalabels, all, answered, noanswer, busy, failed) {
  if (
        window.myChart1 !== undefined
        &&
        window.myChart1 !== null
        ) {
        window.myChart1.destroy();
    }
  var ctx = document.getElementById("myChart").getContext('2d');
  window.myChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels, // Our labels
      datasets: [
        {
        label: datalabels[1], // Name the series
        data: answered, // Our values
        borderColor: "#00cc44",
        backgroundColor: "#00cc44",
        fill: false,
        type: 'line'
        },
        {
        label: datalabels[2], // Name the series
        data: busy, // Our values
        borderColor: "#e68a00",
        backgroundColor: "#e68a00",
        fill: false,
        type: 'line'
        },
        {
        label: datalabels[3], // Name the series
        data: failed, // Our values
        borderColor: "#e62e00",
        backgroundColor: "#e62e00",
        fill: false,
        type: 'line'
        },
        {
        label: datalabels[4], // Name the series
        data: noanswer, // Our values
        borderColor: "#e6e600",
        backgroundColor: "#e6e600",
        fill: false,
        type: 'line'
        },
        {
        label: datalabels[0], // Name the series
        data: all, // Our values
        backgroundColor: "#522b76",
        borderWidth: 1
        },
     ]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behavior of full-width/height
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
                precision: 2,
            }
        }],
      },
    }
  });
  return myChart1;
}

function buildData() {
       var dates = [];
       var dates = table.column( 0 , { 'search': 'applied' })
                   .data()
                   .sort()
                   .map( function ( val ) {
                        return val.split(' ')[0];
                   } )
                   .unique();
       var x = document.getElementById('status');
       var callstatus = [];
       var descrip = [];
       for (var i = 0; i < x.length; i++) {
           callstatus.push(x[i].value);
           descrip.push(x[i].text);
       }
       for (var i = 0; i < callstatus.length; i++) {
            name = callstatus[i].replace(/\s/g, '');
            window[name+'_count'] = 0;
            window[name+'_total'] = [];
       }
            for (var j = 0; j < dates.length; j++) {
                var cant1 =  table.column( 0 , { 'search': 'applied' })
                             .data()
                             .filter( function ( value, index ) {
                                if (value.split(' ')[0] == dates[j]) {
                                    data = table.cell( index, 7 ).data();
                                    for (var i = 0; i < callstatus.length; i++) {
                                        if (callstatus[i] == "ALL") {
                                            name = callstatus[i].replace(/\s/g, '');
                                            window[name+'_count']++;
                                        }
                                        if (data.replace(/(<([^>]+)>)/gi, "") == descrip[i]) {
                                           name = callstatus[i].replace(/\s/g, '');
                                           window[name+'_count']++;
                                        }
                                    }
                                    return true;
                                } else {
                                     return false;
                                }
                             } )
                             .count();
                 for (var i = 0; i < callstatus.length; i++) {
                    name = callstatus[i].replace(/\s/g, '');
                    window[name+'_total'].push(window[name+'_count']);
                    window[name+'_count'] = 0;
                 }
            }
       //Si es reportado solo un dia se agregar un registro antes y otro despues en 0 para mejor visualizacion
       if (dates.length == 1) {
          if (dates[0] == '') {
              ALL_total[0] = 0;
          }
          dates.unshift('');
          dates.push('');
          for (var i = 0; i < callstatus.length; i++) {
               name = callstatus[i].replace(/\s/g, '');
               window[name+'_total'].unshift('0');
               window[name+'_total'].push('0');
          }
       }
       var chart = BuildChart(dates, descrip, ALL_total, ANSWERED_total,NOANSWER_total, BUSY_total, FAILED_total);
}


function downloadPDF2() {
	var newCanvas = document.querySelector('#myChart');
    var newCanvasImg = newCanvas.toDataURL("image/jpeg", 1.0);
    var jsPDF = window.jspdf.jsPDF;
	var doc = new jsPDF('landscape');
	doc.setFontSize(20);
	doc.text(15, 15, "Issabel CDR");
	doc.addImage(newCanvasImg, 'PNG', 10, 10, 280, 150 );
                var data = newCanvas.toDataURL();
                var docDefinition = {
                    pageOrientation: 'landscape',
                    pageSize: 'A4',
                    content: [
                        {text: 'Issabel CDR Chart', headlineLevel: 1},
                        " ",
                        {text: document.getElementById("msgFilter").textContent, headlineLevel: 1},
                        " ",
                        {
                        image: data,
                        width: 750
                    }]
                };
                pdfMake.createPdf(docDefinition).download("cdr-chart.pdf");
 }
