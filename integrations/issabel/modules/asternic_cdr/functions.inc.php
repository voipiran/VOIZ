<?php 

if(isset($_SERVER['PATH_INFO'])) {
    define("SELF",  substr($_SERVER['PHP_SELF'], 0, (strlen($_SERVER['PHP_SELF']) - @strlen($_SERVER['PATH_INFO']))));
} else {
    define("SELF",  $_SERVER['PHP_SELF']);
}

function asternic_cdr_get_config($engine) {
    // Executed on APPLY in FreePBX
    global $amp_conf, $db, $active_modules;
}

function return_timestamp($date_string) {
    list ($year,$month,$day,$hour,$min,$sec) = preg_split("/-|:| /",$date_string,6);
    $u_timestamp = mktime($hour,$min,$sec,$month,$day,$year);
    return $u_timestamp;
}



function swf_bar($values,$width,$height,$divid,$stack) {

?>

<canvas id="<?php echo $divid?>" width='<?php echo $width;?>' height='<?php echo $height;?>'></canvas>


<script>

<?php
parse_str($values,$options);

$colores = array('#FF6600','#538353');
$labels  = array();
$dvalues = array();

foreach($options as $key=>$val) {
    if(substr($key,0,3)=="var") {
        $labels[]=$val;
    } else if(substr($key,0,3)=="tag") {
        $series = substr($key,3,1);
        $seriename[$series]=$val;
    } else if(substr($key,0,3)=="val") {
        if($stack==0) {
            $dvalues['A'][]=$val;
        } else {
            $series = substr($key,3,1);
            $dvalues[$series][]=$val;
        }
    }
}
if(!isset($seriename['A'])) {
    if(preg_match("/secs/",$options['title'])) {
        $seriename['A']="Seconds";
    } else {
        $seriename['A']="Count";
    }
}

$labelstext = "'".implode("','",$labels)."'";

?>

var barChartData_<?php echo $divid;?> = {
    labels: [<?php echo $labelstext;?>],
    datasets: [

<?php
foreach($dvalues as $serie=>$points) {
    $valuestext = implode(",",$points);
    $color = array_shift($colores);
?>
{
backgroundColor: '<?php echo $color;?>',
label: '<?php echo $seriename[$serie];?>',
data: [
<?php echo $valuestext;?>
]
},
<?php } ?>

    ]
};

$('document').ready(function(){
var ctx = document.getElementById('<?php echo $divid;?>').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
    data: barChartData_<?php echo $divid;?>,
    options: {
        title: {
            display: true,
            text: '<?php echo $options['title'];?>'
        },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true
    }
});
});
</script>

<?php
}

function swf_bar_old($values,$width,$height,$divid,$stack) {
    global $config;

    if ($stack==1) {
        $chart = "images/barstack.swf";
    } else {
        $chart = "images/bar.swf";
    }
    $return = "<div id='$divid'>\n";
    $return.= "</div>\n";
    $values = html_entity_decode($values);
    $return.= "<script type='text/javascript'>\n";
    $return.='$(document).ready(function() {'."\n";

    $variables = preg_split("/&/",$values);
    if(isset($config['no_animation'][''])) {
        $variables[] = "noanimate=1";
    }

    $return .= "var flashvars = {\n";
    $param = Array();
    foreach($variables as $deauna) {
        $pedazos = preg_split("/=/",$deauna);
        $param[]="'$pedazos[0]': '$pedazos[1]'";
    }
    $texti = implode(",\n",$param);
    $return.=$texti;
    $return.=" };\n";

    $return.= "swfobject.embedSWF('$chart', '$divid', '$width', '$height', '9.0.0', '#336699', flashvars, {wmode:'transparent'});\n";
    $return.= "});</script>\n";
    echo $return;
}

function print_exports($header_pdf,$data_pdf,$width_pdf,$title_pdf,$cover_pdf,$appconfig) {

    $head_serial  = serialize($header_pdf);
    $data_serial  = serialize($data_pdf);
    $width_serial = serialize($width_pdf);
    $title_serial = serialize($title_pdf);
    $cover_serial = serialize($cover_pdf);
    $head_serial  = rawurlencode($head_serial);
    $data_serial  = rawurlencode($data_serial);
    $width_serial = rawurlencode($width_serial);
    $title_serial = rawurlencode($title_serial);
    $cover_serial = rawurlencode($cover_serial);

    $complete_self = $_SERVER['REQUEST_URI'];
    echo "<br/><form method='post' action='$complete_self'>\n";
    foreach($_REQUEST as $kkey=>$vval) {
        echo "<input type='hidden' name='$kkey' value='".$vval."' />\n";
    }
    echo "<input type='hidden' name='action' value='export' />\n";
    echo "<input type='hidden' name='head' value='".$head_serial."' />\n";
    echo "<input type='hidden' name='rawdata' value='".$data_serial."' />\n";
    echo "<input type='hidden' name='width' value='".$width_serial."' />\n";
    echo "<input type='hidden' name='title' value='".$title_serial."' />\n";
    echo "<input type='hidden' name='cover' value='".$cover_serial."' />\n";
    echo "<a href='javascript:void()' class='info'><input type=image name='pdf' src='${appconfig['relative_path']}asternic_pdf.gif' style='border:0;'><span>";
    echo _('Export to PDF');
    echo "</span></a>\n";
    echo "<a href='javascript:void()' class='info'><input type=image name='csv' src='${appconfig['relative_path']}asternic_excel.gif' style='border:0;'><span>"; 
    echo _('Export to CSV/Excel');
    echo "</span></a>\n";
    echo "</form>";
}

function seconds2minutes($segundos) {
    $horas    = intval($segundos / 3600);
    $minutos  = intval($segundos % 3600 ) / 60;
    $segundos = $segundos % 60;
    $ret = sprintf("%02d:%02d:%02d",$horas,$minutos,$segundos);
    return $ret;
}

function remove_quotes($argument) {
    return substr($argument,1,-1);
}   

function asternic_download() {
    include("download.php");
}

function asternic_getrecords( $MYVARS ,$appconfig) {

    $db = $appconfig['db'];

    $channel = $MYVARS['channel'];
    $start   = $MYVARS['start'];
    $end     = $MYVARS['end'];
    $gtype   = $MYVARS['direction'];
    $condicionextra="";

    if($gtype=='outgoing') {
        $chanfield = "channel";
        $otherchanfield = "dstchannel";
    } else {
        $chanfield = "dstchannel";
        $otherchanfield = "channel";
    }

    if($gtype=='combined') {
        $query = "SELECT substring(channel,1,locate(\"-\",channel,length(channel)-8)-1) AS chan1,";
        $query .= "substring(dstchannel,1,locate(\"-\",dstchannel,length(dstchannel)-8)-1) AS chan2,";
        $query.= "billsec,duration,duration-billsec as ringtime,src,";
        $query.="IF(dst='s',dcontext,dst) as dst,calldate,disposition,accountcode,recordingfile,uniqueid FROM asteriskcdrdb.cdr ";
        $query.= "WHERE calldate >= '$start' AND calldate <= '$end' AND (duration-billsec) >=0 $condicionextra ";
        $query.= "HAVING chan1 IN ('$channel') OR chan2 IN ('$channel') ORDER BY calldate ";
    } else {
        $query = "SELECT substring($chanfield,1,locate(\"-\",$chanfield,length($chanfield)-8)-1) AS chan1,";
        $query.= "billsec,duration,duration-billsec as ringtime,src,";
        $query.="IF(dst='s',dcontext,dst) as dst,calldate,disposition,accountcode,recordingfile,uniqueid FROM asteriskcdrdb.cdr ";
        $query.= "WHERE calldate >= '$start' AND calldate <= '$end' AND (duration-billsec) >=0 $condicionextra ";
        $query.= "HAVING chan1 IN ('$channel') ORDER BY calldate";
    }

    $me=true;

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    $ftype = $_REQUEST['type'];
    $fdisplay = $_REQUEST['display'];
    $ftab = $gtype;

    $cont=0;
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {
        if (!(substr($row['accountcode'],0,5)=='Local' && $dispo[$row['disposition']]=='BUSY' && $row[9]=='ResetCDR')) {
            $cont++;
            $disposition = $row['disposition'];

            if($gtype=='combined') {
                if($row['chan1']<>$channel) { $direction='Incoming'; } else { $direction='Outgoing'; }
                $campo=($row['chan1']<>$channel)?$row['chan2']:$row['chan1'];
            } else {
                $campo=$row['chan1'];
            }

            //echo "campo $campo, ".$row['chan1']."=".$row['chan2']."<br>";

            if(!isset($detail[$campo])) {
                $detail[$campo]="";
            }

            $me = ! $me;
            if($me==true) {
                $odclass="class='odd'";
            } else {
                $odclass="";
            }
            $bill_print = seconds2minutes($row['billsec']);

            $detail[$campo].= "<tr $odclass>\n<td>$cont</td>\n";
            if($gtype=='combined') {
                $detail[$campo].= "<td>$direction</td>\n";
            }
            $detail[$campo].= "<td style='text-align: center;' >".$row['calldate']."</td>\n";
            $detail[$campo].= "<td>".$row['src']."</td><td>".$row['dst']."</td>\n";
            $detail[$campo].= "<td align=right>".$bill_print."</td>\n";
            $detail[$campo].="<td align=right>".$row['ringtime']." "._('secs')."</td>\n";
            $detail[$campo].= "<td style='text-align: center;'>";

            $pertes = preg_split("/ /",$row['calldate']);
            $partes = preg_split("/-/",$pertes[0]);
            $year   = $partes[0];
            $month  = $partes[1];
            $day    = $partes[2];

            if($row['disposition']=="NO ANSWER" || $row['disposition']=="FAILED") {
                $detail[$campo].="<span style='color: red;'>";
            } elseif($row['disposition']=="BUSY") {
                $detail[$campo].="<span style='color: orange;'>";
            } else {
                $detail[$campo].="<span style='color: green;'>";
            }

            $detail[$campo].= $row['disposition'];
            $detail[$campo].= "</span></td>";
            $detail[$campo].= "\n<td>";

            $uni = $row['uniqueid'];
            $uni = str_replace(".","",$uni);

            if($row['recordingfile']<>"") {
                if(!preg_match("/^\//",$row['recordingfile'])) {
                    $actualfile = "$year/$month/$day/".$row['recordingfile'];
                } else {
                    $actualfile = $row['recordingfile'];
                }
                $detail[$campo].="<a href=\"javascript:void(0);\" onclick='javascript:playVmail(\"".$actualfile."\",\"play".$uni."\");'>";
                $detail[$campo].="<div class='playicon' title='"._('Play')."' id='play".$uni."'  style='float:left;'>";
                $detail[$campo].="<img src='images/blank.gif' alt='pixel' height='16' width='16' border='0'>";
                $detail[$campo].="</div></a>";
                $detail[$campo].="<a href=\"javascript:void(0); return false;\" onclick='javascript:downloadVmail(\"".$actualfile."\",\"play".$uni."\",\"$ftype\",\"$fdisplay\",\"$ftab\"); return false;'>";
                $detail[$campo].="<div class='downicon' title='"._('Download')."' id='dload".$uni."'  style='float:left;'>";
                $detail[$campo].="<img src='images/blank.gif' alt='pixel' height='16' width='16' border='0'>";
                $detail[$campo].="</div></a>";
            } else {
                $detail[$campo].= "&nbsp;";
            }
            $detail[$campo].= "</td>\n";
            $detail[$campo].= "\n</tr>\n";
        } 
    }

    echo "<table width='99%' cellpadding=3 cellspacing=3 border=0 id='table${channel}' class='sortable'>\n";
    echo "<thead><tr><td bgcolor='#ddcc00'>#</td>";
    if($gtype=='combined') {
        echo "<td bgcolor='#ddcc00'>Direction</td>";
    }
    echo "<td bgcolor='#ddcc00' align='center'>"._('Date')."</td>\n";
    echo "<td bgcolor='#ddcc00'>"._('From')."</td>\n";
    echo "<td bgcolor='#ddcc00'>"._('To')."</td>\n";
    echo "<td bgcolor='#ddcc00' align='right'>"._('Billable Time')."</td>\n";
    echo "<td bgcolor='#ddcc00' align='right'>"._('Ring Time')."</td>\n";
    echo "<td bgcolor='#ddcc00' align='center'>"._('Disposition')."</td>\n";
    echo "<td bgcolor='#ddcc00' align='center'>"._('Listen')."</td></tr></thead>\n";
    echo "<tbody>".$detail[$channel]."</tbody>\n";
    echo "</table>\n";

    $complete_self = $_SERVER['REQUEST_URI'];
    echo "<form id='downloadform' method='get' action='$complete_self'><input type=hidden name='file' id='downloadfile' value=''><input type=hidden name='action' value='download'><input type='hidden' name='type' id='dtype' value=''><input type='hidden' id='idisplay' name='display' value=''> <input type='hidden' id='itab' name='tab' value=''></form>";

}

define('FPDF_FONTPATH',dirname(__FILE__).'/lib/font/');
include_once(dirname(__FILE__) . "/lib/fpdf.php");

class PDF extends FPDF
{

    function Footer() {
        global $lang;
        global $language;
        //Go to 1.5 cm from bottom
        $this->SetY(-15);
        //Select Arial italic 8
        $this->SetFont('Arial','I',8);
        //Print centered page number
        $this->Cell(0,10,$lang["$language"]['page'].' '.$this->PageNo(),0,0,'C');
    }

    function Cover($cover) {
        $this->SetFont('Arial','',15);
        $this->MultiCell(150,9,$cover);
        $this->Ln();
    }

    function Header() {
        global $title;
        //Select Arial bold 15
        $this->SetFont('Arial','B',15);
        //Move to the right
        $this->Cell(85);
        //Framed title
        $this->Cell(30,10,$title,0,0,'C');
        //Line break
        $this->Ln(10);
    }

    function TableHeader($header,$w) {
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B',11);

        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'C',1);
        $this->Ln();
    }

    //Colored table
    function FancyTable($header,$data,$w) {

        $this->TableHeader($header,$w);

        //Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        //Data
        $fill=0;
        $supercont=1;
        foreach($data as $row) {
            $contador=0;
            foreach($row as $valor) {
                $this->Cell($w[$contador],6,$valor,'LR',0,'C',$fill);
                $contador++;
            }
            $this->Ln();
            $fill=!$fill;
            if($supercont%40 == 0) {
                $this->Cell(array_sum($w),0,'','T');
                $this->AddPage();
                $this->TableHeader($header,$w);
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
            }
            $supercont++;
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

function asternic_export_csv($header,$data) {
    header("Content-Type: application/csv-tab-delimited-table");
    header("Content-disposition: filename=table.csv");

    $linea="";
    foreach($header as $valor) {
        $linea.="\"$valor\",";
    }
    $linea=substr($linea,0,-1);

    print $linea."\r\n";

    foreach($data as $valor) {
        $linea="";
        foreach($valor as $subvalor) {
            $linea.="\"$subvalor\",";
        }
        $linea=substr($linea,0,-1);
        print $linea."\r\n";
    }
}

function asternic_export($REQ) {

    $header = unserialize(rawurldecode($REQ['head']));
    $data   = unserialize(rawurldecode($REQ['rawdata']));
    $width  = unserialize(rawurldecode($REQ['width']));
    $title  = unserialize(rawurldecode($REQ['title']));
    $cover  = unserialize(rawurldecode($REQ['cover']));

    if(isset($_REQUEST['pdf']) || isset($REQ['pdf_x'])) {
        $pdf=new PDF();
        $pdf->SetFont('Arial','',12);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetLeftMargin(1);
        $pdf->SetRightMargin(1);
        $pdf->AddPage();
        if($cover<>"") {
            $pdf->Cover($cover);
        }
        $pdf->AddPage();
        $pdf->FancyTable($header,$data,$width);
        $pdf->Output("export.pdf","D");
    } else {
        asternic_export_csv($header,$data);
    }
}

?>
