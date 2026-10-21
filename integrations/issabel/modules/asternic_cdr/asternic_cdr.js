var sound = {};
var pauseaction = {}

function debug(message) {
    if(window.console !== undefined) {
        console.log(message);
    }
};


function List_move_around(direction, all) {

    if (direction=="right") {
        box1 = "List_Extensions_available";
        box2 = "List_Extensions[]";
    } else {
        box1 = "List_Extensions[]";
        box2 = "List_Extensions_available" + "";
    }

    for (var i=0;i<document.forms.asternic_cdr_form.elements[box1].length;i++) {
        if ((document.forms.asternic_cdr_form.elements[box1][i].selected || all)) {
            document.forms.asternic_cdr_form.elements[box2].options[document.forms.asternic_cdr_form.elements[box2].length] =    new Option(document.forms.asternic_cdr_form.elements[box1].options[i].text, document.forms.asternic_cdr_form.elements[box1][i].value);
            document.forms.asternic_cdr_form.elements[box1][i] = null;
            i--;
        }
    }
    return false;
}

function List_check_submit() {
    box = "List_Extensions[]";
    if (document.forms.asternic_cdr_form.elements[box]) {
        for (var i=0;i<document.forms.asternic_cdr_form.elements[box].length;i++) {
            document.forms.asternic_cdr_form.elements[box][i].selected = true;
         }
    }
    return true;
}

function envia() {

    List_check_submit();

    box = "List_Extensions[]";
    if (document.forms.asternic_cdr_form.elements[box].length == 0) {
        alert("Please select at least one Extension");
        return false;
    }

    month_start = parseInt(document.forms.asternic_cdr_form.month1.value) + 1;
    month_end   = parseInt(document.forms.asternic_cdr_form.month2.value) + 1;

    fecha_s  = document.forms.asternic_cdr_form.year1.value  + '-';

    if(String(month_start).length == 1) {
        fecha_s += "0";
    }
    fecha_s += month_start + '-';
    if(String(document.forms.asternic_cdr_form.day1.value).length == 1) {
        fecha_s += "0";
    }
    fecha_s += document.forms.asternic_cdr_form.day1.value   + ' ';
    fecha_s += '00:00:00';

    fecha_check_s = document.forms.asternic_cdr_form.year1.value;
    if(String(month_start).length == 1) {
        fecha_check_s += "0";
    }
    fecha_check_s += month_start;
    if(String(document.forms.asternic_cdr_form.day1.value).length == 1) {
        fecha_check_s += "0";
    }
    fecha_check_s += document.forms.asternic_cdr_form.day1.value;

    fecha_check_e = document.forms.asternic_cdr_form.year2.value;
    if(String(month_end).length == 1) {
        fecha_check_e += "0";
    }
    fecha_check_e += month_end;
    if(String(document.forms.asternic_cdr_form.day2.value).length == 1) {
        fecha_check_e += "0";
    }
    fecha_check_e += document.forms.asternic_cdr_form.day2.value;

    fecha_e  = document.forms.asternic_cdr_form.year2.value  + '-';
    if(String(month_end).length == 1) {
        fecha_e += "0";
    }
    fecha_e += month_end + '-';
    if(String(document.forms.asternic_cdr_form.day2.value).length == 1) {
        fecha_e += "0";
    }
    fecha_e += document.forms.asternic_cdr_form.day2.value   + ' ';
    fecha_e += '23:59:59';

    document.forms.asternic_cdr_form.start.value = fecha_s;
    document.forms.asternic_cdr_form.end.value   = fecha_e;

    if(fecha_check_e < fecha_check_s) {
        alert("Invalid date range");
    } else {
      document.forms.asternic_cdr_form.submit();
    }
    return false;
}

function setdates(start,end) {
    var start_year  = start.substr(0,4);
    var start_month = start.substr(5,2);
    var start_day   = start.substr(8,2);

    var end_year  = end.substr(0,4);
    var end_month = end.substr(5,2);
    var end_day   = end.substr(8,2);

    dstart = MWJ_findSelect( "day1" ), mstart = MWJ_findSelect( "month1" ), ystart = MWJ_findSelect( "year1" );
    dend   = MWJ_findSelect( "day2" ), mend   = MWJ_findSelect( "month2" ), yend   = MWJ_findSelect( "year2" );

    while( dstart.options.length ) { dstart.options[0] = null; }
    while( dend.options.length   ) { dend.options[0]   = null; }

    for( var x = 0; x < 31; x++  ) { dstart.options[x] = new Option( x + 1, x + 1 ); }
    for( var x = 0; x < 31; x++  ) { dend.options[x]   = new Option( x + 1, x + 1 ); }

    x = start_day - 1;
    y = end_day - 1;
    dstart.options[x].selected = true;
    dend.options[y].selected = true;

    x = start_month - 1;
    y = end_month - 1;
    mstart.options[x].selected = true;
    mend.options[y].selected   = true;

    for( var x = 0; x < ystart.options.length; x++ ) {
        if( ystart.options[x].value == '' + start_year + '' ) {
            ystart.options[x].selected = true;
            if( window.opera && document.importNode ) {
                window.setTimeout('MWJ_findSelect( \''+ystart.name+'\' ).options['+x+'].selected = true;',0);
            }
        }
    }
    for( var x = 0; x < yend.options.length; x++ ) {
        if( yend.options[x].value == '' + end_year + '' ) {
            yend.options[x].selected = true;
            if( window.opera && document.importNode ) {
                window.setTimeout('MWJ_findSelect( \''+yend.name+'\' ).options['+x+'].selected = true;',0);
            }
        }
    }

}


/********************************************************************************************************
                                         Valid month script
                               Written by Mark Wilton-Jones, 6-7/10/2002
********************************************************************************************************

Please see http://www.howtocreate.co.uk/jslibs/ for details and a demo of this script
Please see http://www.howtocreate.co.uk/jslibs/termsOfUse.html for terms of use

This script monitors years and months and makes sure that the correct number of days are provided.

To use:

Inbetween the <head> tags, put:

    <script src="PATH TO SCRIPT/validmonth.js" type="text/javascript" language="javascript1.2"></script>

To have a static year box (only allows the years defined in the HTML)

    Day of month select box should be in the format:
        <select name="day" size="1">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        ...
        <option value="31">31</option>
        </select>

    Month select box should be in the format:
        <select name="month" size="1" onchange="dateChange('day','month','year');">
        <option value="January" selected>January</option>
        <option value="February">February</option>
        ...
        <option value="December">December</option>
        </select>

    Year select box should be in the format:
        <select name="year" size="1" onchange="dateChange('day','month','year');">
        <option value="1980" selected>1980</option>
        <option value="1981">1981</option>
        ...
        <option value="2010">2010</option>
        </select>

    You can now use:
        setToday('day','month','year');
    to set the date to today's date (after the page has loaded)

To have an extendible year box (creates dates lower/higher than the current range)

    Year select box should be in the format:
        <select name="year" size="1" onchange="checkMore( this, 1980, 2005, 1840, 2010 );dateChange('day','month','year');">
        <option value="MWJ_DOWN">Lower ...</option>
        <option value="1980" selected>1980</option>
        <option value="1981">1981</option>
        ...
        <option value="2005">2005</option>
        <option value="MWJ_UP">Higher ...</option>
        </select>
    If you do not want to have higher / lower values, simply omit the relevant option

    Function format:
        checkMore( this, CURRENT LOWEST YEAR, CURRENT HIGHEST YEAR, LOWEST POSSIBLE YEAR, HIGHEST POSSIBLE YEAR )

    You can now use:
        reFill( 'year', 1980, 2005, true, true );setToday('day','month','year');
    to set the date to today's date (after the page has loaded)

    Function format (make sure the range of years includes the current year):
        reFill( name of year select box, LOWEST YEAR, HIGHEST YEAR, ALLOW HIGHER (true/false), ALLOW LOWER (true/false) )
_____________________________________________________________________________________________________________________*/

//Opera 7 has a bug making it fail to set selectedIndex after dynamic generation of options unless there is a 0ms+ delay
//I have put fixes in in all necessary places

function MWJ_findSelect( oName, oDoc ) { //get a reference to the select box using its name
    if( !oDoc ) { oDoc = window.document; }
    for( var x = 0; x < oDoc.forms.length; x++ ) { if( oDoc.forms[x][oName] ) { return oDoc.forms[x][oName]; } }
    for( var x = 0; document.layers && x < oDoc.layers.length; x++ ) { //scan layers ...
        var theOb = MWJ_findObj( oName, oDoc.layers[x].document ); if( theOb ) { return theOb; } }
    return null;
}
function dateChange( d, m, y ) {
    d = MWJ_findSelect( d ), m = MWJ_findSelect( m ), y = MWJ_findSelect( y );
    //work out if it is a leap year
    var IsLeap = parseInt( y.options[y.selectedIndex].value );
    IsLeap = !( IsLeap % 4 ) && ( ( IsLeap % 100 ) || !( IsLeap % 400 ) );
    //find the number of days in that month
    IsLeap = [31,(IsLeap?29:28),31,30,31,30,31,31,30,31,30,31][m.selectedIndex];
    //store the current day - reduce it if the new month does not have enough days
    var storedDate = ( d.selectedIndex > IsLeap - 1 ) ? ( IsLeap - 1 ) : d.selectedIndex;
    while( d.options.length ) { d.options[0] = null; } //empty days box then refill with correct number of days
    for( var x = 0; x < IsLeap; x++ ) { d.options[x] = new Option( x + 1, x + 1 ); }
    d.options[storedDate].selected = true; //select the number that was selected before
    if( window.opera && document.importNode ) { window.setTimeout('MWJ_findSelect( \''+d.name+'\' ).options['+storedDate+'].selected = true;',0); }
}
function setToday( d, m, y ) {
    d = MWJ_findSelect( d ), m = MWJ_findSelect( m ), y = MWJ_findSelect( y );
    var now = new Date(); var nowY = ( now.getYear() % 100 ) + ( ( ( now.getYear() % 100 ) < 39 ) ? 2000 : 1900 );
    //if the relevant year exists in the box, select it
    for( var x = 0; x < y.options.length; x++ ) { if( y.options[x].value == '' + nowY + '' ) { y.options[x].selected = true; if( window.opera && document.importNode ) { window.setTimeout('MWJ_findSelect( \''+y.name+'\' ).options['+x+'].selected = true;',0); } } }
    //select the correct month, redo the days list to get the correct number, then select the relevant day
    m.options[now.getMonth()].selected = true; dateChange( d.name, m.name, y.name ); d.options[now.getDate()-1].selected = true;
    if( window.opera && document.importNode ) { window.setTimeout('MWJ_findSelect( \''+d.name+'\' ).options['+(now.getDate()-1)+'].selected = true;',0); }
}
function checkMore( y, curBot, curTop, min, max ) {
    var range = curTop - curBot;
    if( typeof( y.nowBot ) == 'undefined' ) { y.nowBot = curBot; y.nowTop = curTop; }
    if( y.options[y.selectedIndex].value == 'MWJ_DOWN' ) { //they have selected 'lower'
        while( y.options.length ) { y.options[0] = null; } //empty the select box
        y.nowBot -= range + 1; y.nowTop = range + y.nowBot; //make note of the start and end values
        //adjust the values as necessary if we will overstep the min value. If not, refill with the
        //new option for 'lower'
        if( min < y.nowBot ) { y.options[0] = new Option('Lower ...','MWJ_DOWN'); } else { y.nowBot = min; }
        for( var x = y.nowBot; x <= y.nowTop; x++ ) { y.options[y.options.length] = new Option(x,x); }
        y.options[y.options.length] = new Option('Higher ...','MWJ_UP');
        y.options[y.options.length - 2].selected = true; //select the nearest number
        if( window.opera && document.importNode ) { window.setTimeout('MWJ_findSelect( \''+y.name+'\' ).options['+(y.options.length - 2)+'].selected = true;',0); }
    } else if( y.options[y.selectedIndex].value == 'MWJ_UP' ) { //A/A except upwards
        while( y.options.length ) { y.options[0] = null; }
        y.nowTop += range + 1; y.nowBot = y.nowTop - range;
        y.options[0] = new Option('Lower ...','MWJ_DOWN');
        if( y.nowTop > max ) { y.nowTop = max; }
        for( var x = y.nowBot; x <= y.nowTop; x++ ) { y.options[y.options.length] = new Option(x,x); }
        if( max > y.nowTop ) { y.options[y.options.length] = new Option('Higher ...','MWJ_UP'); }
        y.options[1].selected = true;
        if( window.opera && document.importNode ) { window.setTimeout('MWJ_findSelect( \''+y.name+'\' ).options[1].selected = true;',0); }
    }
}
function reFill( y, oBot, oTop, oDown, oUp ) {
    y = MWJ_findSelect( y ); y.nowBot = oBot; y.nowTop = oTop;
    //empty and refill the select box using the range of numbers specified
    while( y.options.length ) { y.options[0] = null; }
    if( oDown ) { y.options[0] = new Option('Lower ...','MWJ_DOWN'); }
    for( var x = oBot; x <= oTop; x++ ) { y.options[y.options.length] = new Option(x,x); }
    if( oUp ) { y.options[y.options.length] = new Option('Higher ...','MWJ_UP'); }
}


ns4 = document.layers;
ie4 = document.all;
nn6 = document.getElementById && !document.all;

function showObject(myobject) {

  if (ns4) {
     eval("document."+myobject+".display = ''");
  }
  else if (ie4) {
     if(document.all[myobject].style.display == 'none') {
         document.all[myobject].style.display = "";
     } else {
         document.all[myobject].style.display = "none";
     }
  }
  else if (nn6) {
     if(document.getElementById(myobject).style.display == 'none') {
         document.getElementById(myobject).style.display = "";
     } else {
         document.getElementById(myobject).style.display = "none";
     }
  }
}



/* Create a new XMLHttpRequest object to talk to the Web server */
var xmlHttp = false;
var current = "";

/*@cc_on @*/
/*@if (@_jscript_version >= 5)
try {
  xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttp = false;
  }
}
@end @*/

if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
  xmlHttp = new XMLHttpRequest();
}

function getRecords(channel,start,end,type,uri) {

    var procesa=false;

    if (ie4) {
        if(document.all[channel].style.display == 'none') {
           procesa=true;
        }
    }
    else if (nn6) {
        if(document.getElementById(channel).style.display == 'none') {
           procesa=true;
        }
    }

    if(procesa==true) {
        document.getElementById("loading"+channel).style.visibility = "visible";
//        var url = "modules/asternic_cdr/getrecords.php?channel=" + escape(channel) + "&type=outgoing&start=" + escape(start) + "&end=" + escape(end) + '&type=' + escape(type);
        var url = uri + "&action=getrecords&channel=" + escape(channel) + "&direction="+escape(type)+"&start=" + escape(start) + "&end=" + escape(end);

        // Open a connection to the server
        xmlHttp.open("GET", url, true);

        // Setup a function for the server to run when it's done
        xmlHttp.onreadystatechange = updatePage;
        current = channel;
        xmlHttp.send(null);

    } else {
        showObject(channel);
    }

}

function updatePage() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
    document.getElementById('table'+current+'table').innerHTML = response;
    document.getElementById("loading"+current).style.visibility = "hidden";
    sortables_init();
    showObject(current);
  }
}


addEvent(window, "load", sortables_init);

var SORT_COLUMN_INDEX;

function sortables_init() {
    // Find all tables with class sortable and make them sortable
    if (!document.getElementsByTagName) return;
    tbls = document.getElementsByTagName("table");
    for (ti=0;ti<tbls.length;ti++) {
        thisTbl = tbls[ti];
        if (((' '+thisTbl.className+' ').indexOf("sortable") != -1) && (thisTbl.id)) {
            //initTable(thisTbl.id);
            ts_makeSortable(thisTbl);
        }
    }
}

function ts_makeSortable(table) {
    if (table.rows && table.rows.length > 0) {
        var firstRow = table.rows[0];
    }
    if (!firstRow) return;

    // We have a first row: assume it's the header, and make its contents clickable links
    for (var i=0;i<firstRow.cells.length;i++) {
        var cell = firstRow.cells[i];
        var txt = ts_getInnerText(cell);
        cell.innerHTML = '<a href="#" class="sortheader" onclick="ts_resortTable(this, '+i+');return false;">'+txt+'<span class="sortarrow">&nbsp;&nbsp;&nbsp;</span></a>';
    }
}

function ts_getInnerText(el) {
    if (typeof el == "string") return el;
    if (typeof el == "undefined") { return el };
    if (el.innerText) return el.innerText;    //Not needed but it is faster
    var str = "";

    var cs = el.childNodes;
    var l = cs.length;
    for (var i = 0; i < l; i++) {
        switch (cs[i].nodeType) {
            case 1: //ELEMENT_NODE
                str += ts_getInnerText(cs[i]);
                break;
            case 3:    //TEXT_NODE
                str += cs[i].nodeValue;
                break;
        }
    }
    return str;
}

function ts_resortTable(lnk,clid) {
    // get the span
    var span;
    for (var ci=0;ci<lnk.childNodes.length;ci++) {
        if (lnk.childNodes[ci].tagName && lnk.childNodes[ci].tagName.toLowerCase() == 'span') span = lnk.childNodes[ci];
    }
    var spantext = ts_getInnerText(span);
    var td = lnk.parentNode;
    var column = clid || td.cellIndex;
    var table = getParent(td,'TABLE');

    // Work out a type for the column
    if (table.rows.length <= 1) return;
    var itm = ts_getInnerText(table.rows[1].cells[column]);
    sortfn = ts_sort_caseinsensitive;
    if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d\d\d$/)) sortfn = ts_sort_date;
    if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d$/)) sortfn = ts_sort_date;
    if (itm.match(/^[£$]/)) sortfn = ts_sort_currency;
    if (itm.match(/^[\d]/)) { sortfn = ts_sort_numeric; }
    SORT_COLUMN_INDEX = column;
    var firstRow = new Array();
    var newRows = new Array();
    for (i=0;i<table.rows[0].length;i++) { firstRow[i] = table.rows[0][i]; }
    for (j=1;j<table.rows.length;j++) { newRows[j-1] = table.rows[j]; }

    newRows.sort(sortfn);

    for (j=0;j<newRows.length;j++) { if( j%2 == 0) { newRows[j].setAttribute('class','odd'); } else { newRows[j].setAttribute('class','null'); } }

    if (span.getAttribute("sortdir") == 'down') {
        ARROW = '&nbsp;&nbsp;&uarr;';
        newRows.reverse();
        span.setAttribute('sortdir','up');
    } else {
        ARROW = '&nbsp;&nbsp;&darr;';
        span.setAttribute('sortdir','down');
    }

    // We appendChild rows that already exist to the tbody, so it moves them rather than creating new ones
    // don't do sortbottom rows
    for (i=0;i<newRows.length;i++) { if (!newRows[i].className || (newRows[i].className && (newRows[i].className.indexOf('sortbottom') == -1))) table.tBodies[0].appendChild(newRows[i]);}
    // do sortbottom rows only
    for (i=0;i<newRows.length;i++) { if (newRows[i].className && (newRows[i].className.indexOf('sortbottom') != -1)) table.tBodies[0].appendChild(newRows[i]);}

    // Delete any other arrows there may be showing
    var allspans = document.getElementsByTagName("span");
    for (var ci=0;ci<allspans.length;ci++) {
        if (allspans[ci].className == 'sortarrow') {
            if (getParent(allspans[ci],"table") == getParent(lnk,"table")) { // in the same table as us?
                allspans[ci].innerHTML = '&nbsp;&nbsp;&nbsp;';
            }
        }
    }

    span.innerHTML = ARROW;
}

function getParent(el, pTagName) {
    if (el == null) return null;
    else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())    // Gecko bug, supposed to be uppercase
        return el;
    else
        return getParent(el.parentNode, pTagName);
}
function ts_sort_date(a,b) {
    // y2k notes: two digit years less than 50 are treated as 20XX, greater than 50 are treated as 19XX
    aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
    bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
    if (aa.length == 10) {
        dt1 = aa.substr(6,4)+aa.substr(3,2)+aa.substr(0,2);
    } else {
        yr = aa.substr(6,2);
        if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
        dt1 = yr+aa.substr(3,2)+aa.substr(0,2);
    }
    if (bb.length == 10) {
        dt2 = bb.substr(6,4)+bb.substr(3,2)+bb.substr(0,2);
    } else {
        yr = bb.substr(6,2);
        if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
        dt2 = yr+bb.substr(3,2)+bb.substr(0,2);
    }
    if (dt1==dt2) return 0;
    if (dt1<dt2) return -1;
    return 1;
}

function ts_sort_currency(a,b) {
    aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
    bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
    return parseFloat(aa) - parseFloat(bb);
}

function ts_sort_numeric(a,b) {
    //alert(ts_getInnerText(a.cells[SORT_COLUMN_INDEX]));
    aa = parseFloat(ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,''));
    if (isNaN(aa)) aa = 0;
    bb = parseFloat(ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,''));
    if (isNaN(bb)) bb = 0;
    return aa-bb;
}

function ts_sort_caseinsensitive(a,b) {
    aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).toLowerCase();
    bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).toLowerCase();
    if (aa==bb) return 0;
    if (aa<bb) return -1;
    return 1;
}

function ts_sort_default(a,b) {
    aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
    bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
    if (aa==bb) return 0;
    if (aa<bb) return -1;
    return 1;
}


function addEvent(elm, evType, fn, useCapture)
// addEvent and removeEvent
// cross-browser event handling for IE5+,  NS6 and Mozilla
// By Scott Andrew
{
  if (elm.addEventListener){
    elm.addEventListener(evType, fn, useCapture);
    return true;
  } else if (elm.attachEvent){
    var r = elm.attachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
}

function playVmail(file,iconid) {
    if(typeof(sound[iconid])==="undefined") {
        var getfile = '?'+window.location.search.substring(1)+'&file='+file;

        pauseaction[iconid]='pause';

        $('div#'+iconid).removeClass('playicon').addClass('loadingicon');
        sound[iconid] = new Howl({
            src: getfile,
            autoplay: true,
            format: 'wav',
            onplay: function() {
                $('div#'+iconid).removeClass('playicon').removeClass('loadingicon').addClass('pauseicon');
            },
            onend: function() {
                $('div#'+iconid).removeClass('pauseicon').addClass('playicon');
                pauseaction[iconid] = 'play';
            },
            onloaderror: function() {
                $('div#'+iconid).removeClass('loadingicon').addClass('erroricon');
            },
            onpause: function() {
                pauseaction[iconid] = 'play';
            }
        });
    } else {
        if(pauseaction[iconid]=='play') {
            pauseaction[iconid]='pause';
            sound[iconid].play();
            $('div#'+iconid).removeClass('playicon').addClass('pauseicon');
        } else {
            sound[iconid].pause();
            pauseaction[iconid]='play';
            $('div#'+iconid).removeClass('pauseicon').addClass('playicon');
        }
    }
}

function downloadVmail(file,iconid,ftype,display,tab) {
        debug($("#downloadform"));
        $("#downloadfile").val(file);
        $("#dtype").val(ftype);
        $("#idisplay").val(display);
        $("#itab").val(tab);
        $("#downloadform").submit();
        return false;
//        var pars = "file="+file;
//        $.ajax({
//          url: "modules/asternic_cdr/download.php?file="+file
//        });
}








