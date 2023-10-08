<?php
/*
   Copyright 2007, 2008, 2009 Nicolás Gudiño

   This file is part of Asternic CDR Stats.

    Asternic CDR Stats is free software: you can redistribute it 
    and/or modify it under the terms of the GNU General Public License as 
    published by the Free Software Foundation, either version 3 of the 
    License, or (at your option) any later version.

    Asternic CDR Stats is distributed in the hope that it will be 
    useful, but WIthOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Asternic CDR Stats.  If not, see 
    <http://www.gnu.org/licenses/>.
*/

$appconfig = array();
$appconfig['departments'] = Array();
$appconfig['condicionextra'] = "";

$basedir = dirname($_SERVER["SCRIPT_FILENAME"]);
if(preg_match("/\/admin/",$basedir)) {
    $appconfig['relative_path'] = "images/";
} else {
    $appconfig['relative_path'] = "admin/images/";
}
if(isset($_POST['List_Extensions'])) {
    $appconfig['extension']="";
    if(is_array($_POST['List_Extensions'])) {
        foreach($_POST['List_Extensions'] as $valor) {
            $appconfig['extension'].=stripslashes($valor).",";
        }
        $appconfig['extension']=substr($appconfig['extension'],0,-1);
        $_SESSION['CDRSTATS']['extension']=$appconfig['extension'];
    }
} else {
    $appconfig['extension']="''";
}

if(isset($_POST['start'])) {
   $appconfig['start'] = $_POST['start'];
   $_SESSION['CDRSTATS']['start']=$appconfig['start'];
} else {
   $appconfig['start'] = date('Y-m-d 00:00:00');
}

if(isset($_POST['end'])) {
   $appconfig['end'] = $_POST['end'];
   $_SESSION['CDRSTATS']['end']=$appconfig['end'];
} else {
   $appconfig['end'] = date('Y-m-d 23:59:59');
}

if(isset($_SESSION['CDRSTATS']['start'])) {
   $appconfig['start'] = $_SESSION['CDRSTATS']['start'];
}

if(isset($_SESSION['CDRSTATS']['end'])) {
   $appconfig['end'] = $_SESSION['CDRSTATS']['end'];
}

if(isset($_SESSION['CDRSTATS']['extension'])) {
   $appconfig['extension'] = $_SESSION['CDRSTATS']['extension'];
}

$timestamp_start = return_timestamp($appconfig['start']);
$timestamp_end   = return_timestamp($appconfig['end']);
$elapsed_seconds = $timestamp_end - $timestamp_start;
$appconfig['period'] = floor(($elapsed_seconds / 60) / 60 / 24) + 1;

$sql = "SELECT extension,if(dial is null,concat('USER/',extension),dial) AS dial,";
$sql.= "name FROM users ";
$sql.= "LEFT JOIN devices ON users.extension=devices.id";
$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
if(DB::IsError($results)) {
    die($results->getMessage());
}
$appconfig['canals']=array();

foreach ($results as $result) {
    //ADDED BY JFL TO BE MORE CONSISTENT WITH ADMINISTRATOR ROLE RESTRICTION PER EXTENSION RANGE IN FPBX 
    // (with a little modification by asternic)
    if (isset($result['extension']) && checkRange($result['extension'])) { 
        $appconfig['canals'][$result['dial']]=$result['name'];
    }
}

$appconfig['dayp']=array();
$appconfig['dayp'][0]=_('Sunday');
$appconfig['dayp'][1]=_('Monday');
$appconfig['dayp'][2]=_('Tuesday');
$appconfig['dayp'][3]=_('Wednesday');
$appconfig['dayp'][4]=_('Thursday');
$appconfig['dayp'][5]=_('Friday');
$appconfig['dayp'][6]=_('Saturday');

$appconfig['db']=$db;

if(isset($_REQUEST['action'])) {
    if($_REQUEST['action']=="download") {
        asternic_download();
        die();
    } else if($_REQUEST['action']=="getrecords") {
        asternic_getrecords($_REQUEST,$appconfig);
        die();
    } else if($_REQUEST['action']=="export") {
        asternic_export($_REQUEST);
        die();
    }
}

if(isset($_REQUEST['file'])) {
    asternic_download();
}

echo "
<style>
.playicon {
background:url('${appconfig['relative_path']}asternic_playicon.png');
background-repeat: no-repeat;
width: 16px;
height: 16px;
margin-top: 2px;
}
.pauseicon {
background:url('${appconfig['relative_path']}asternic_pauseicon.png');
background-repeat: no-repeat;
width: 16px;
height: 16px;
margin-top: 2px;
}
.downicon {
background:url('${appconfig['relative_path']}asternic_downicon.png');
background-repeat: no-repeat;
width: 16px;
height: 16px;
margin-top: 2px;
}
.loadingicon {
background:url('${appconfig['relative_path']}asternic_loading.gif');
background-repeat: no-repeat;
width: 16px;
height: 16px;
margin-top: 2px;
}
.erroricon {
background:url('${appconfig['relative_path']}asternic_erroricon.png');
background-repeat: no-repeat;
width: 16px;
height: 16px;
margin-top: 2px;
}

#asterniccontents thead tr th {
    height: 32px;
    aline-height: 32px;
    text-align: center;
    color: #1c5d79;
    background-image: url(${appconfig['relative_path']}asternic_col_bg.gif);
    background-repeat: repeat;
    border-left:solid 1px #FF9900;
    border-right:solid 1px #FF9900;
    border-collapse: collapse;
}
</style>
";


if(!isset($_POST['start'])) {

    if(isset($_GET['tab'])) {
        if($_GET['tab']=="outgoing") {
            asternic_report('outgoing',$appconfig);
        } else if($_GET['tab']=="incoming") { 
            asternic_report('incoming',$appconfig);
        } else if($_GET['tab']=="combined") { 
            inbound_outbound('combined',$appconfig);
        } else if($_GET['tab']=="home") { 
            asternic_home($appconfig);
        } else if($_GET['tab']=="distribution") { 
            asternic_distribution($appconfig);
        }
    } else {
        // Desde el menu de FreePBX
        asternic_home($appconfig);
    }

} else {
    $_GET['tab']="outgoing";
    asternic_report('outgoing',$appconfig);
}

function asternic_distribution($appconfig) {

    $db   = $appconfig['db'];
    $dayp = $appconfig['dayp'];

    $start_parts = preg_split("/ /", $appconfig['start']);
    $end_parts   = preg_split("/ /", $appconfig['end']);

    $start_ts = return_timestamp($appconfig['start']);

    for($a=1;$a<=$appconfig['period'];$a++) {
        $new_ts = $start_ts + ($a * 86400) - 86400;
        $fechanueva = date('Ymd',$new_ts);
        $dianum = date('w',$new_ts);
        $day_of_week[$fechanueva]=$dayp[$dianum];
        $array_fechas[]=$fechanueva;
    }

    $items_canal = explode(",",$appconfig['extension']);
    $items_canal = array_map("remove_quotes",$items_canal);

    foreach ($items_canal as $canalete) {
        foreach ($array_fechas as $mifecha) {
            for($mishoras=0;$mishoras<24;$mishoras++) {
                $dur[$canalete][$mifecha][$mishoras]=0;
            }
        }
    }

    $colorete[]="#00ff00";
    $colorete[]="#c4ff00";
    $colorete[]="#ffc800";
    $colorete[]="#ff8800";
    $colorete[]="#ff4800";
    $colorete[]="#ff2800";
    $colorete[]="#ffffff";

    $graphcolor  = "&bgcolor=0xfffdf3&bgcolorchart=0xdfedf3&fade1=ff6600&fade2=ff6314&colorbase=0xfff3b3&reverse=1";

    $distinct_days = 0;
    $previous_date = "";

    // for outgoing calls
    $query = "SELECT substring(channel,1,locate(\"-\",channel,1)-1) AS chan1, ";
    $query.= "billsec, calldate,";
    $query.= "(time_to_sec(calldate)-(hour(calldate)*3600)+billsec)-3600 AS minute, hour(calldate) AS hour,date_format(calldate,'%Y%m%d') AS fulldate ";
    $query.= "FROM asteriskcdrdb.cdr WHERE  substring(channel,1,locate(\"-\",channel,1)-1)<>'' ";
    $query.= "AND calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ";
    $query.= "HAVING chan1 IN (${appconfig['extension']}) ORDER BY calldate";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

        if($row['fulldate']<>$previous_date) {
           $previous_date=$row['fulldate'];
           $distinct_days++;
        }

        $next_hour = $row['hour']+1;

        if($next_hour>23) { $next_hour = 0; }

        if(!isset($dur[$row['chan1']][$row['fulldate']][$row['hour']])) {
            $dur[$row['chan1']][$row['fulldate']][$row['hour']]=0;
        }
        if(!isset($num[$row['chan1']][$row['fulldate']][$row['hour']])) {
            $num[$row['chan1']][$row['fulldate']][$row['hour']]=0;
        }
        if(!isset($num[$row['chan1']][$row['fulldate']][$next_hour])) {
            $num[$row['chan1']][$row['fulldate']][$next_hour]=0;
        }
        if(!isset($dur[$row['chan1']][$row['fulldate']][$next_hour])) {
            $dur[$row['chan1']][$row['fulldate']][$next_hour]=0;
        }

        if($row['minute']>0) {
          // duration overflows hour
          $dur[$row['chan1']][$row['fulldate']][$next_hour]+=$row['minute'];
          $dur[$row['chan1']][$row['fulldate']][$row['hour']]+=($row['billsec']-$row['minute']);
          $num[$row['chan1']][$row['fulldate']][$next_hour]++;
          $num[$row['chan1']][$row['fulldate']][$row['hour']]++;
        } else {
          $dur[$row['chan1']][$row['fulldate']][$row['hour']]+=$row['billsec'];
          $num[$row['chan1']][$row['fulldate']][$row['hour']]++;
        }

    }
 
    // for incoming calls
    $query = "SELECT substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) AS chan1, billsec, calldate,";
    $query.= "billsec, calldate,";
    $query.= "(time_to_sec(calldate)-(hour(calldate)*3600)+billsec)-3600 AS minute, hour(calldate) AS hour,date_format(calldate,'%Y%m%d') AS fulldate ";
    $query.= "FROM asteriskcdrdb.cdr WHERE  substring(dstchannel,1,locate(\"-\",dstchannel,1)-1)<>'' ";
    $query.= "AND calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ";
    $query.= "HAVING chan1 IN (${appconfig['extension']}) ORDER BY calldate";

    //echo $query;

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    $distinct_days = 0;
    $previous_date = "";

    //while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

        if($row['fulldate']<>$previous_date) {
           $previous_date=$row['fulldate'];
           $distinct_days++;
        }
        $next_hour = $row['hour']+1;
        if($next_hour>23) { $next_hour = 0; }

        if(!isset($dur[$row['chan1']][$row['fulldate']][$row['hour']])) {
            $dur[$row['chan1']][$row['fulldate']][$row['hour']]=0;
        }

        if(!isset($num[$row['chan1']][$row['fulldate']][$row['hour']])) {
            $num[$row['chan1']][$row['fulldate']][$row['hour']]=0;
        }

        if(!isset($dur[$row['chan1']][$row['fulldate']][$next_hour])) {
            $dur[$row['chan1']][$row['fulldate']][$next_hour]=0;
        }

        if(!isset($num[$row['chan1']][$row['fulldate']][$next_hour])) {
            $num[$row['chan1']][$row['fulldate']][$next_hour]=0;
        }

        if($row['minute']>0) {
            // duration overflows hour
            $dur[$row['chan1']][$row['fulldate']][$next_hour]+=$row['minute'];
            $dur[$row['chan1']][$row['fulldate']][$row['hour']]+=($row['billsec']-$row['minute']);
            $num[$row['chan1']][$row['fulldate']][$next_hour]++;
            $num[$row['chan1']][$row['fulldate']][$row['hour']]++;
        } else {
            $dur[$row['chan1']][$row['fulldate']][$row['hour']]+=$row['billsec'];
            $num[$row['chan1']][$row['fulldate']][$row['hour']]++;
        }

    }

    $query = "SELECT hour(calldate) AS hour, count(*) AS count, SUM(billsec) AS seconds FROM asteriskcdrdb.cdr ";
    $query.= "WHERE  substring(dstchannel,1,locate(\"-\",dstchannel,1)-1)<>'' ";
    $query.= "AND calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ";
    $query.= "AND ( substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) IN (${appconfig['extension']}) OR substring(channel,1,locate(\"-\",channel,1)-1) IN (${appconfig['extension']})) ";
    $query.= "GROUP BY 1 ORDER BY calldate";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    for($i=0;$i<24;$i++) {
        $disthour[$i]['callcount']=0;
        $disthour[$i]['seconds']=0;
    }

    //while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {
        $disthour[$row['hour']]['callcount']=$row['count'];
        $disthour[$row['hour']]['seconds']=$row['seconds'];
    }

    require_once("menu.php");
?>

<div id="asternicmain">
<div id="asterniccontents">

    <table width='99%' cellpadding=3 cellspacing=3 border=0>
    <thead>
    <tr>
        <td valign=top width='50%'>
            <table width='100%' border=0 cellpadding=0 cellspacing=0>
            <caption><?php echo _('Report Information')?></caption>
            <tbody>
            <tr>
                   <td><?php echo _('Start Date')?>:</td>
                   <td><?php echo $start_parts[0]?></td>
            </tr>
            </tr>
            <tr>
                   <td><?php echo _('End Date')?>:</td>
                   <td><?php echo $end_parts[0]?></td>
            </tr>
            <tr>
                   <td><?php echo _('Period')?>:</td>
                   <td><?php echo $appconfig['period']?> <?php echo _('days')?></td>
            </tr>
            </tbody>
            </table>
        </td>
        <td width='50%'>
              &nbsp;
        </td>
    </tr>
    </thead>
    </table>
<?php

    // Distribution per Hour
    echo "<hr/><table>\n";
    echo "<caption>"._('Call Distribution per Hour')."</caption>";
    echo "<thead>"; 
    echo "<tr>";
    echo "<th>"._('Hour')."</th>";
    echo "<th>"._('Call Count')."</th>";
    echo "<th>"._('Duration')."</th>";
    echo "</tr></thead>\n";
    echo "<tbody>";

    $query1 = "";
    $contador = 0;
    foreach ($disthour as $hour=>$key) {
        $contavar = $contador+1;
        $hour_range = sprintf("%02d:00 - %02d:59",$hour,$hour);
        $query1 .= "val$contavar=".$disthour[$hour]['callcount']."&var$contavar=$hour_range&";
        echo "<tr><td>$hour_range</td><td>".$disthour[$hour]['callcount']."</td><td>".seconds2minutes($disthour[$hour]['seconds'])."</td></tr>\n";
        $contador++;
    }
    echo "</tbody></table><br/>";
    $query1.="title="._('Call Distribution per Hour')."$graphcolor";

    echo "<table class='pepa' width='99%' cellpadding=3 cellspacing=3 border=0>\n";
    echo "<thead>\n";
    echo "<tr><td><hr/></td></tr>";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query1,718,433,"chart1",0);
    echo "</td></tr>\n";
    echo "</thead>\n";
    echo "</table><BR>\n";

    // Distribution Diagrams
    if($appconfig['period']>1) {
        foreach ($dur as $chann=>$vel) {
            echo "<h2>".$appconfig['canals'][$chann]."</h2>";
            echo "<table>\n<thead>"; 
            echo "<tr><th></th><th colspan=25>"._('Hour of day (8 means 08h00 - 08h59)')."</th></tr>\n";
            echo "<tr><th>Date</th>";
            for ($hour=0;$hour<24;$hour++) {
                echo "<th>$hour</th>";
            }    
            echo "<th>Total</th></tr></thEAD><TBODY>\n";
            foreach ($vel as $date=>$val) {
                $dayprint = _($day_of_week[$date]);
                $dateprint=$dayprint." ".substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
                echo "<tr><td>$dateprint</td>";
                $total_day = 0;
                for ($hour=0;$hour<24;$hour++) {
                    if(!isset($dur[$chann][$date][$hour])) { $dur[$chann][$date][$hour]=0;}
                    if(!isset($num[$chann][$date][$hour])) { $num[$chann][$date][$hour]=0;}
                    $numcolor = intval(($dur[$chann][$date][$hour]/60)/10);
                    if((intval($dur[$chann][$date][$hour]/60))==0) { $numcolor=6; }
                    $minutes_this_hour = intval($dur[$chann][$date][$hour]/60);
                    $total_day+=$minutes_this_hour;
                    echo "<td bgcolor='$colorete[$numcolor]'>$minutes_this_hour</td>";
                }
                echo "<td><b>$total_day "._('mins')."</b></td></tr>\n";
            }
        echo "</tbody></table>";
        }
    } else {
      // For 1 day reports, list each channel in a row instead of a new table
      echo "<table>\n<thead>"; 
      echo "<tr><th></th><th colspan=25>"._('Hour of day (8 means 08h00 - 08h59)')."</th></tr>\n";
      echo "<tr><th>User</th>";
      for ($hour=0;$hour<24;$hour++) {
         echo "<th>$hour</th>";
      }    
      echo "<th>"._('total')."</th></tr></thead><tbody>\n";
      foreach ($dur as $chann=>$vel) {
          foreach ($vel as $date=>$val) {
            echo "<tr><td>".$appconfig['canals'][$chann]."</td>";
            $total_day = 0;
            for ($hour=0;$hour<24;$hour++) {
                if(!isset($dur[$chann][$date][$hour])) { $dur[$chann][$date][$hour]=0; }
                if($dur[$chann][$date][$hour]=="") { $dur[$chann][$date][$hour]=0;}
                if(!isset($num[$chann][$date][$hour])) { $num[$chann][$date][$hour]=0; }
                if($num[$chann][$date][$hour]=="") { $num[$chann][$date][$hour]=0;}
                // echo "$hour ".intval($dur[$chann][$date][$hour]/60)." - ".$num[$chann][$date][$hour]."<BR>" ;
                $numcolor = intval(($dur[$chann][$date][$hour]/60)/10);
                if((intval($dur[$chann][$date][$hour]/60))==0) { $numcolor=6; }
                $minutes_this_hour = intval($dur[$chann][$date][$hour]/60);
                $total_day+=$minutes_this_hour;
                echo "<td bgcolor='$colorete[$numcolor]'>$minutes_this_hour</td>";
            }
            echo "<td><b>$total_day "._('mins')."</b></td></tr>\n";
          }
      }
    echo "</table>";
    }
?>
</div>
</div>
<hr/>
<div id='asternicfooter'>
<div style='float:right;'><a href='https://www.asternic.net' border=0><img src='<?php echo $appconfig['relative_path'];?>/asternic_cdr_logo.jpg' alt='asternic cdr' border=0></a></div>
</div>
</div> <!-- end div asternic content -->
<div style='clear:both;'></div>
<?php

} // end function distribution

function inbound_outbound($type,$appconfig) {

    $db = $appconfig['db'];

    $graphcolor      = "&bgcolor=0xfffdf3&bgcolorchart=0xdfedf3&fade1=ff6600&fade2=ff6314&colorbase=0xfff3b3&reverse=1";
    $graphcolorstack = "&bgcolor=0xfffdf3&bgcolorchart=0xdfedf3&fade1=ff6600&colorbase=fff3b3&reverse=1&fade2=0x528252";

    // First outbound
    $chanfield      = "channel";
    $otherchanfield = "dstchannel";
    $rep_title      = "Incoming / Outgoing";
 
    $query = "SELECT substring($chanfield,1,locate(\"-\",$chanfield,length($chanfield)-8)-1) AS chan1,";
    $query.= "billsec,duration,duration-billsec as ringtime,src,dst,calldate,disposition,accountcode FROM asteriskcdrdb.cdr ";
    $query.= "WHERE calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ${appconfig['condicionextra']} ";
    $query.= "HAVING chan1 in (${appconfig['extension']}) order by null";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    $total_calls = 0;
    $total_bill  = 0;
    $total_ring  = 0;

    //while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

        $row['accountcode']="Default";

        if(!in_array($row['accountcode'],$appconfig['departments'])) {
            array_push($appconfig['departments'],$row['accountcode']);
            $group_bill_outbound[$row['accountcode']]  = 0;
            $group_ring_outbound[$row['accountcode']]  = 0;
            $group_calls_outbound[$row['accountcode']] = 0;
        }

        if(!isset($billsec[$row['accountcode']][$row['chan1']])) {
            $billsec[$row['accountcode']][$row['chan1']]      = 0;
            $duration[$row['accountcode']][$row['chan1']]     = 0;
            $ringing_outbound[$row['accountcode']][$row['chan1']]      = 0;
            $ringing[$row['accountcode']][$row['chan1']]      = 0;
            $number_calls_outbound[$row['accountcode']][$row['chan1']] = 0;
            $missed_outbound[$row['accountcode']][$row['chan1']]       = 0;
        }

        if(!isset($number_calls_outbound[$row['accountcode']][$row['chan1']])) {
            $number_calls_outbound[$row['accountcode']][$row['chan1']]=0;
        }

        if(!isset($number_calls_inbound[$row['accountcode']][$row['chan1']])) {
            $number_calls_inbound[$row['accountcode']][$row['chan1']]=0;
        }

        if(!isset($number_calls[$row['accountcode']][$row['chan1']])) {
            $number_calls[$row['accountcode']][$row['chan1']]=0;
        }

        $billsec[$row['accountcode']][$row['chan1']]  += $row['billsec'];
        $duration[$row['accountcode']][$row['chan1']] += $row['duration'];
        $number_calls_outbound[$row['accountcode']][$row['chan1']]++;
        $number_calls[$row['accountcode']][$row['chan1']]++;

        if(!isset($missed_outbound[$row['accountcode']][$row['chan1']])) { $missed_outbound[$row['accountcode']][$row['chan1']]=0; }

        $ringing[$row['accountcode']][$row['chan1']]+=$row['ringtime'];
        $ringing_outbound[$row['accountcode']][$row['chan1']]+=$row['ringtime'];
        $total_bill_outbound+=$row['billsec'];
        $total_ring_outbound+=$row['ringtime'];
        $total_calls_outbound++;

        $group_bill_outbound[$row['accountcode']]+=$row['billsec'];
        $group_ring_outbound[$row['accountcode']]+=$row['ringtime'];
        $group_calls_outbound[$row['accountcode']]++;

        $disposition = $row['disposition'];

        if(!isset($missed[$row['accountcode']][$row['chan1']])) { $missed[$row['accountcode']][$row['chan1']]=0;}

        if($disposition<>"ANSWERED" ) {
            $missed_outbound[$row['accountcode']][$row['chan1']]++;
            $missed[$row['accountcode']][$row['chan1']]++;
        }
    }

    // Then inbound
    $chanfield      = "dstchannel";
    $otherchanfield = "channel";
 
    $query = "SELECT substring($chanfield,1,locate(\"-\",$chanfield,length($chanfield)-8)-1) AS chan1,";
    $query.= "billsec,duration,duration-billsec as ringtime,src,dst,calldate,disposition,accountcode FROM asteriskcdrdb.cdr ";
    $query.= "WHERE calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ${appconfig['condicionextra']} ";
    $query.= "HAVING chan1 in (${appconfig['extension']}) order by null";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    //while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

        $row['accountcode']="Default";

        if(!in_array($row['accountcode'],$appconfig['departments'])) {
            array_push($appconfig['departments'],$row['accountcode']);
            $group_bill_inbound[$row['accountcode']]  = 0;
            $group_ring_inbound[$row['accountcode']]  = 0;
            $group_calls_inbound[$row['accountcode']] = 0;
        }

        if(!isset($billsec[$row['accountcode']][$row['chan1']])) {
            $billsec[$row['accountcode']][$row['chan1']]      = 0;
            $duration[$row['accountcode']][$row['chan1']]     = 0;
            $ringing_inbound[$row['accountcode']][$row['chan1']]      = 0;
            $ringing[$row['accountcode']][$row['chan1']]      = 0;
            $number_calls_inbound[$row['accountcode']][$row['chan1']] = 0;
            $missed_inbound[$row['accountcode']][$row['chan1']]       = 0;
        }

        if(!isset($number_calls_outbound[$row['accountcode']][$row['chan1']])) {
            $number_calls_outbound[$row['accountcode']][$row['chan1']]=0;
        }

        if(!isset($number_calls_inbound[$row['accountcode']][$row['chan1']])) {
            $number_calls_inbound[$row['accountcode']][$row['chan1']]=0;
        }

        if(!isset($number_calls_outbound[$row['accountcode']][$row['chan1']])) {
            $number_calls_outbound[$row['accountcode']][$row['chan1']]=0;
        }

        if(!isset($number_calls[$row['accountcode']][$row['chan1']])) {
            $number_calls[$row['accountcode']][$row['chan1']]=0;
        }

        $billsec[$row['accountcode']][$row['chan1']]  += $row['billsec'];
        $duration[$row['accountcode']][$row['chan1']] += $row['duration'];
        $number_calls_inbound[$row['accountcode']][$row['chan1']]++;
        $number_calls[$row['accountcode']][$row['chan1']]++;

        if(!isset($missed_inbound[$row['accountcode']][$row['chan1']])) { $missed_inbound[$row['accountcode']][$row['chan1']]=0; }

        $ringing_inbound[$row['accountcode']][$row['chan1']]+=$row['ringtime'];
        $ringing[$row['accountcode']][$row['chan1']]+=$row['ringtime'];
        $total_bill_inbound+=$row['billsec'];
        $total_ring_inbound+=$row['ringtime'];
        $total_calls_inbound++;

        $group_bill_inbound[$row['accountcode']]+=$row['billsec'];
        $group_ring_inbound[$row['accountcode']]+=$row['ringtime'];
        $group_calls_inbound[$row['accountcode']]++;

        $disposition = $row['disposition'];

        if(!isset($missed[$row['accountcode']][$row['chan1']])) { $missed[$row['accountcode']][$row['chan1']]=0;}
        if($disposition<>"ANSWERED" ) {
            $missed_inbound[$row['accountcode']][$row['chan1']]++;
            $missed[$row['accountcode']][$row['chan1']]++;
        }
    }

    $total_calls = $total_calls_inbound + $total_calls_outbound;
    $total_ring  = $total_ring_inbound + $total_ring_outbound;
    $total_bill  = $total_bill_inbound + $total_bill_outbound;

    $group_calls['Default'] = $group_calls_inbound[$row['accountcode']] + $group_calls_outbound[$row['accountcode']];
    $group_ring['Default']  = $group_ring_inbound[$row['accountcode']] + $group_ring_outbound[$row['accountcode']];
    $group_bill['Default']  = $group_bill_inbound[$row['accountcode']] + $group_bill_outbound[$row['accountcode']];

    if($total_calls > 0) {
        $avg_ring_full = $total_ring / $total_calls;
    } else {
        $avg_ring_full = 0;
    }

    $avg_ring_full = number_format($avg_ring_full,0);

    $total_bill_print = seconds2minutes($total_bill);

    $start_parts = preg_split("/ /", $appconfig['start']);
    $end_parts   = preg_split("/ /", $appconfig['end']);

    require_once("menu.php");
?>

<div id="asternicmain">
<div id="asterniccontents">

    <table width='99%' cellpadding=3 cellspacing=3 border=0>
    <thead>
    <tr>
        <td valign=top width='50%'>
            <table width='100%' border=0 cellpadding=0 cellspacing=0>
            <caption><?php echo _('Report Information')?></caption>
            <tbody>
            <tr>
                   <td><?php echo _('Start Date')?>:</td>
                   <td><?php echo $start_parts[0]?></td>
            </tr>
            </tr>
            <tr>
                   <td><?php echo _('End Date')?>:</td>
                   <td><?php echo $end_parts[0]?></td>
            </tr>
            <tr>
                   <td><?php echo _('Period')?>:</td>
                   <td><?php echo $appconfig['period']?> <?php echo _('days')?></td>
            </tr>
            </tbody>
            </table>

            </td>
            <td valign=top width='50%'>

                <table width='100%' border=0 cellpadding=0 cellspacing=0>
                <caption><?php echo _($rep_title)?></caption>
                <tbody>
                <tr> 
                  <td><?php echo _('Number of Calls')?>:</td>
                  <td><?php echo $total_calls?> <?php echo _('calls')?></td>
                </tr>
                <tr>
                  <td><?php echo _('Total Time')?>:</td>
                  <td><?php echo $total_bill_print?></td>
                </tr>
                <tr>
                  <td><?php echo _('Avg. ring time')?>:</td>
                  <td><?php echo $avg_ring_full?> <?php echo _('secs')?> </td>
                </tr>
                </tbody>
                </table>
            </td>
        </tr>
        </thead>
        </table>
<?php
if($total_calls>0) {
?>
        <br/>
        <a name='1'></a>
        <table width='99%' cellpadding=3 cellspacing=3 border=0 >
        <caption>
        <img src='<?php echo $appconfig['relative_path'];?>asternic_go-up.png' border=0 class='icon' width=16 height=16>
        &nbsp;&nbsp;
        <?php echo _($rep_title) ?>
        </caption>
            <thead>
            <tr>
                  <th><?php echo _('User')?></th>
                  <th><?php echo _('Total')?></th>
                  <th><?php echo _('Incoming')?></th>
                  <th><?php echo _('Outgoing')?></th>
                  <th><?php echo _('Completed')?></th>
                  <th><?php echo _('Missed')?></th>
                  <th><?php echo _('% Missed')?></th>
                  <th><?php echo _('Duration')?></th>
                  <th><?php echo _('%')?> <?php echo _('Duration')?> </th>
                  <th><?php echo _('Avg Duration')?></th>
                  <th><?php echo _('Total Ring Time')?></th>
                  <th><?php echo _('Avg Ring Time')?></th>
            </tr>
            </thead>

<?php

    foreach($billsec as $idx=>$key) {
        echo "<tbody>\n";
            if(count($appconfig['departments'])>1) {

                $group_bill_print = seconds2minutes($group_bill[$idx]);
      
                if($group_calls[$idx]>0) {
                    $avg_ring_group = $group_ring[$idx] / $group_calls[$idx];
                } else {
                    $avg_ring_group = 0;
                }

                $avg_ring_group = number_format($avg_ring_group,0);

                $texto  = "<table width=400 border=0 cellpadding=0 cellspacing=0>";
                $texto .= "<caption>".$rep_title."</caption>";
                $texto .= "<tbody>";
                $texto .= "<tr class=\'section\'>";
                $texto .= "<td>Account Code:";
                $texto .= "<td>$idx</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('No Calls').":</td>";
                $texto .= "  <td>".$group_calls[$idx]." "._('calls')."</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('Total Time').":</td>";
                $texto .= "  <td>$group_bill_print</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('Avg Ringtime').":</td>";
                $texto .= "  <td>$avg_ring_group "._('secs')." </td>";
                $texto .= "</tr>";
                $texto .= "</tbody>";
                $texto .= "</table>";
                echo "<tr ><td colspan=10 style='text-align: left;' bgcolor='#cc9900'><a style='color: black;' href='javascript:void();' class='info'>";
                echo "<span>"._('account_code')."</span> $idx </a></td></tr>\n";

           }

            $data_pdf   = Array();
            $header_pdf = Array (
                               _('User'),
                               _('Calls'),
                               _('Incoming'),
                               _('Outgoing'),
                               _('Missed'),
                               _('Percent'),
                               _('Bill secs'),
                               _('Percent'),
                               _('Avg. Calltime'),
                               _('Ring Time'),
                               _('Avg. Ring')
            );
            $width_pdf=array(35,15,10,10,15,15,25,20,20,20,20);
            $title_pdf=$rep_title;

           $contador=0;
           $query1="";
           $query2="";
           $query3="";

           foreach($key as $chan=>$val) {

                $contavar = $contador +1;
                $cual = $contador % 2;
                if($cual>0) { $odd = " class='odd' "; } else { $odd = ""; }

                $nomuser=$appconfig['canals'][$chan];

                $nomissed = $number_calls[$idx][$chan] - $missed[$idx][$chan];

                $yesmissed   = $missed[$idx][$chan];
                $query1 .= "valA$contavar=$nomissed&valB$contavar=$yesmissed&var$contavar=$nomuser&";
                $query2 .= "val$contavar=".$val."&var$contavar=$nomuser&";
                $query3 .= "valA$contavar=".$number_calls_outbound[$idx][$chan]."&valB$contavar=".$number_calls_inbound[$idx][$chan]."&var$contavar=$nomuser&";

                $ring_time = $duration[$idx][$chan]-$val;

                if($number_calls[$idx][$chan]>0) {
                    $avg_ring_time = $ring_time / $number_calls[$idx][$chan];
                    if($nomissed>0) {
                        $avg_duration  = $val / $nomissed;
                    } else {
                        $avg_duration = 0;
                    }
                } else {
                    $avg_duration  = 0;
                    $avg_ring_time = 0;
                }

                $avg_duration = number_format($avg_duration,0);
                $avg_duration_print = seconds2minutes($avg_duration);
                $avg_ring_time = number_format($avg_ring_time,2);
                $time_print = seconds2minutes($duration[$idx][$chan]);

                $bill_print = seconds2minutes($val);
                if($number_calls[$idx][$chan] > 0) {
                    $percent_missed = $missed[$idx][$chan] * 100 / $number_calls[$idx][$chan];
                } else {
                    $percent_missed = 0;
                }
                $percent_missed = number_format($percent_missed,0)." "._('%');

                $complete_self = $_SERVER['REQUEST_URI'];
                echo "<tr $odd>\n";

                echo "<td style='text-align: left;'><a style='cursor:pointer;' onclick=\"javascript:getRecords('$chan','${appconfig['start']}','${appconfig['end']}','combined','$complete_self');\">";
                echo "<img src='${appconfig['relative_path']}asternic_loading.gif' id='loading$chan' border=0 style=\"visibility: hidden; float: left;\">";
                echo "{$appconfig['canals'][$chan]}</a></td>\n";

                echo "<td>".$number_calls[$idx][$chan]."</td>\n";
                echo "<td>".$number_calls_inbound[$idx][$chan]."</td>\n";
                echo "<td>".$number_calls_outbound[$idx][$chan]."</td>\n";
                echo "<td>".$nomissed."</td>\n";
                echo "<td>".$missed[$idx][$chan]."</td>\n";
                echo "<td align=right>".$percent_missed."</td>\n";
                echo "<td>$bill_print</td>\n";
                $percentage_bill = $val * 100 / $total_bill;
                $percentage_bill = number_format($percentage_bill,2);
                echo "<td>$percentage_bill "._('%')."</td>\n";
                echo "<td>$avg_duration_print</td>\n";
                echo "<td>$ring_time "._('secs')."</td>\n";
                echo "<td>$avg_ring_time "._('secs')."</td>\n";
                echo "</tr>\n";
                echo "<tr style='display: none;' id='$chan'><td colspan=12>";
                echo "<span id='table${chan}table'></span>\n";
                echo "</td></tr>";

                $linea_pdf = Array(
                                     $appconfig['canals'][$chan],
                                     $number_calls[$idx][$chan],
                                     $number_calls_inbound[$idx][$chan],
                                     $number_calls_outbound[$idx][$chan],
                                     $nomissed,
                                     $missed[$idx][$chan],
                                     $percent_missed,
                                     "$bill_print ",
                                     "$percentage_bill "._('%'),
                                     "$avg_duration_print ",
                                     "$ring_time "._('secs'),
                                     "$avg_ring_time "._('secs')
                );
                $data_pdf[]=$linea_pdf;
                $contador++;

           }
           //$query1.="title=".$rep_title."$graphcolor";
           $query1.="title="._($rep_title)."$graphcolorstack&tagA="._('Completed')."&tagB="._('Missed');
           $query2.="title="._('Total Call Duration by User')."$graphcolor";
           $query3.="title="._('Incoming/Outgoing Calls by User')."$graphcolorstack&tagA=$tagA&tagB=$tagB";

    }
    echo "</tbody>\n";
    echo "</table>\n";

    $cover_pdf = _('Report Information')."\n";
    $cover_pdf.= _('Start Date').": ".$start_parts[0]."\n";
    $cover_pdf.= _('End Date').": ".$end_parts[0]."\n";
    $cover_pdf.= _('Period').": ".$appconfig['period']." "._('days')."\n\n";
    $cover_pdf.= $rep_title."\n";
    $cover_pdf.= _('Number of Calls').": ".$total_calls." "._('calls')."\n";
    $cover_pdf.= _('Total Time').": ".$total_bill_print." "._('mins')."\n";
    $cover_pdf.= _('Avg. ring time').": ".$avg_ring_full." "._('secs')."\n";

    print_exports($header_pdf,$data_pdf,$width_pdf,$title_pdf,$cover_pdf,$appconfig);

    echo "<table class='pepa' width='99%' cellpadding=3 cellspacing=3 border=0>\n";
    echo "<thead>\n";
    echo "<tr><td><hr/></td></tr>";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query1,718,433,"chart1",1);
    echo "</td></tr><tr><td><hr/></td></tr>\n";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query2,718,433,"chart2",0);
    echo "</td></tr><tr><td><hr/></td></tr>\n";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query3,718,433,"chart3",1);
    echo "</td></tr>\n";
    echo "</thead>\n";
    echo "</table><BR>\n";


} // end if totalbill > 1

?>
</div> <!-- end asterniccontents -->
</div>
<hr/>
<div id='asternicfooter'>
<div style='float:right;'><a href='https://www.asternic.net' border=0><img src='<?php echo $appconfig['relative_path'];?>asternic_cdr_logo.jpg' alt='asternic cdr' border=0></a></div>
</div>
</div> <!-- end div asternic content -->
<div style='clear:both;'></div>
<?php
} // end function inbound/outbound

function asternic_report($typereport,$appconfig) {

    $db = $appconfig['db'];

    $graphcolor  = "&bgcolor=0xfffdf3&bgcolorchart=0xdfedf3&fade1=ff6600&fade2=ff6314&colorbase=0xfff3b3&reverse=1";
    $graphcolorstack = "&bgcolor=0xfffdf3&bgcolorchart=0xdfedf3&fade1=ff6600&colorbase=fff3b3&reverse=1&fade2=0x528252";

    if($typereport=="outgoing") {
        $chanfield = "channel";
        $otherchanfield = "dstchannel";
        $typerecord="outgoing";
        $rep_title = "Outgoing Calls";
        $tagA=_("Outgoing");
        $tagB=_("Incoming");
    } else {
        $chanfield = "dstchannel";
        $otherchanfield = "channel";
        $typerecord="incoming";
        $rep_title = _('Incoming Calls');
        $tagB=_("Outgoing");
        $tagA=_("Incoming");
    }


    // Counts incoming calls for graph
    $query = "SELECT substring($otherchanfield,1,locate(\"-\",$otherchanfield,length($otherchanfield)-8)-1) AS chan1,";

    $query.= "billsec,duration,duration-billsec as ringtime,accountcode FROM asteriskcdrdb.cdr ";
    $query.= "WHERE calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ${appconfig['condicionextra']} ";
    $query.= "HAVING chan1 in (${appconfig['extension']}) order by null";


    $number_in_calls = Array();
    $appconfig['departments']     = Array();
    $billsec         = Array();
    $total_ring      = 0;
    $total_calls     = 0;

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }


    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

//        if($row['accountcode']=="") {
            $row['accountcode']="Default";
//        }

        if(!isset($number_in_calls[$row['accountcode']][$row['chan1']])) {
            $number_in_calls[$row['accountcode']][$row['chan1']]=0;
        }
        $number_in_calls[$row['accountcode']][$row['chan1']]++;
    }


    $query = "SELECT substring($chanfield,1,locate(\"-\",$chanfield,length($chanfield)-8)-1) AS chan1,";
    $query.= "billsec,duration,duration-billsec as ringtime,src,dst,calldate,disposition,accountcode FROM asteriskcdrdb.cdr ";
    $query.= "WHERE calldate >= '${appconfig['start']}' AND calldate <= '${appconfig['end']}' AND (duration-billsec) >=0 ${appconfig['condicionextra']} ";
    $query.= "HAVING chan1 in (${appconfig['extension']}) order by null";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    $total_calls = 0;
    $total_bill  = 0;
    $total_ring  = 0;

    // while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {

//        if($row['accountcode']=="") {
            $row['accountcode']="Default";
//        }

        if(!in_array($row['accountcode'],$appconfig['departments'])) {
            array_push($appconfig['departments'],$row['accountcode']);
            $group_bill[$row['accountcode']]  = 0;
            $group_ring[$row['accountcode']]  = 0;
            $group_calls[$row['accountcode']] = 0;
        }

        if(!isset($billsec[$row['accountcode']][$row['chan1']])) {
            $billsec[$row['accountcode']][$row['chan1']]      = 0;
            $duration[$row['accountcode']][$row['chan1']]     = 0;
            $ringing[$row['accountcode']][$row['chan1']]      = 0;
            $number_calls[$row['accountcode']][$row['chan1']] = 0;
            $missed[$row['accountcode']][$row['chan1']]       = 0;
        }
        if(!isset($number_in_calls[$row['accountcode']][$row['chan1']])) {
            $number_in_calls[$row['accountcode']][$row['chan1']]=0;
        }

        $billsec[$row['accountcode']][$row['chan1']]  += $row['billsec'];
        $duration[$row['accountcode']][$row['chan1']] += $row['duration'];
        $number_calls[$row['accountcode']][$row['chan1']]++;

        if(!isset($missed[$row['accountcode']][$row['chan1']])) { $missed[$row['accountcode']][$row['chan1']]=0; }
        $ringing[$row['accountcode']][$row['chan1']]+=$row['ringtime'];
        $total_bill+=$row['billsec'];
        $total_ring+=$row['ringtime'];
        $total_calls++;

        $group_bill[$row['accountcode']]+=$row['billsec'];
        $group_ring[$row['accountcode']]+=$row['ringtime'];
        $group_calls[$row['accountcode']]++;

        $disposition = $row['disposition'];

        if($disposition<>"ANSWERED" ) {
          $missed[$row['accountcode']][$row['chan1']]++;
        }
    }

    if($total_calls > 0) {
        $avg_ring_full = $total_ring / $total_calls;
    } else {
        $avg_ring_full = 0;
    }

    $avg_ring_full = number_format($avg_ring_full,0);

    $total_bill_print = seconds2minutes($total_bill);

    $start_parts = preg_split("/ /", $appconfig['start']);
    $end_parts   = preg_split("/ /", $appconfig['end']);

    require_once("menu.php");
?>

<div id="asternicmain">
<div id="asterniccontents">

    <table width='99%' cellpadding=3 cellspacing=3 border=0>
    <thead>
    <tr>
        <td valign=top width='50%'>
            <table width='100%' border=0 cellpadding=0 cellspacing=0>
            <caption><?php echo _('Report Information')?></caption>
            <tbody>
            <tr>
                   <td><?php echo _('Start Date')?>:</td>
                   <td><?php echo $start_parts[0]?></td>
            </tr>
            </tr>
            <tr>
                   <td><?php echo _('End Date')?>:</td>
                   <td><?php echo $end_parts[0]?></td>
            </tr>
            <tr>
                   <td><?php echo _('Period')?>:</td>
                   <td><?php echo $appconfig['period']?> <?php echo _('days')?></td>
            </tr>
            </tbody>
            </table>

            </td>
            <td valign=top width='50%'>

                <table width='100%' border=0 cellpadding=0 cellspacing=0>
                <caption><?php echo _($rep_title)?></caption>
                <tbody>
                <tr> 
                  <td><?php echo _('Number of Calls')?>:</td>
                  <td><?php echo $total_calls?> <?php echo _('calls')?></td>
                </tr>
                <tr>
                  <td><?php echo _('Total Time')?>:</td>
                  <td><?php echo $total_bill_print?></td>
                </tr>
                <tr>
                  <td><?php echo _('Avg. ring time')?>:</td>
                  <td><?php echo $avg_ring_full?> <?php echo _('secs')?> </td>
                </tr>
                </tbody>
                </table>
            </td>
        </tr>
        </thead>
        </table>
<?php
if($total_calls>0) {
?>
        <br/>
        <a name='1'></a>
        <table width='99%' cellpadding=3 cellspacing=3 border=0 >
        <caption>
        <img src='<?php echo $appconfig['relative_path'];?>asternic_go-up.png' border=0 class='icon' width=16 height=16>
        &nbsp;&nbsp;
        <?php echo _($rep_title) ?>
        </caption>
            <thead>
            <tr>
                  <th><?php echo _('User')?></th>
                  <th><?php echo _('Total')?></th>
                  <th><?php echo _('Completed')?></th>
                  <th><?php echo _('Missed')?></th>
                  <th><?php echo _('% Missed')?></th>
                  <th><?php echo _('Duration')?></th>
                  <th><?php echo _('%')?> <?php echo _('Duration')?> </th>
                  <th><?php echo _('Avg Duration')?></th>
                  <th><?php echo _('Total Ring Time')?></th>
                  <th><?php echo _('Avg Ring Time')?></th>
            </tr>
            </thead>

<?php
   
    foreach($billsec as $idx=>$key) {
        echo "<tbody>\n";
            if(count($appconfig['departments'])>1) {

                $group_bill_print = seconds2minutes($group_bill[$idx]);
      
                if($group_calls[$idx]>0) {
                    $avg_ring_group = $group_ring[$idx] / $group_calls[$idx];
                } else {
                    $avg_ring_group = 0;
                }

                $avg_ring_group = number_format($avg_ring_group,0);

                $texto  = "<table width=400 border=0 cellpadding=0 cellspacing=0>";
                $texto .= "<caption>".$rep_title."</caption>";
                $texto .= "<tbody>";
                $texto .= "<tr class=\'section\'>";
                $texto .= "<td>Account Code:";
                $texto .= "<td>$idx</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('No Calls').":</td>";
                $texto .= "  <td>".$group_calls[$idx]." "._('calls')."</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('Total Time').":</td>";
                $texto .= "  <td>$group_bill_print</td>";
                $texto .= "</tr>";
                $texto .= "<tr>";
                $texto .= "  <td>"._('Avg Ringtime').":</td>";
                $texto .= "  <td>$avg_ring_group "._('secs')." </td>";
                $texto .= "</tr>";
                $texto .= "</tbody>";
                $texto .= "</table>";
                echo "<tr ><td colspan=10 style='text-align: left;' bgcolor='#cc9900'><a style='color: black;' href='javascript:void();' class='info'>";
                echo "<span>"._('account_code')."</span> $idx </a></td></tr>\n";

           }

            $data_pdf   = Array();
            $header_pdf = Array (
                               _('User'),
                               _('Calls'),
                               _('Missed'),
                               _('Percent'),
                               _('Bill secs'),
                               _('Percent'),
                               _('Avg. Calltime'),
                               _('Ring Time'),
                               _('Avg. Ring')
            );
            $width_pdf=array(40,15,15,15,25,20,25,25,25);
            $title_pdf=$rep_title;

           $contador=0;
           $query1="";
           $query2="";
           $query3="";

           foreach($key as $chan=>$val) {

                $contavar = $contador +1;
                $cual = $contador % 2;
                if($cual>0) { $odd = " class='odd' "; } else { $odd = ""; }

                $nomuser=$appconfig['canals'][$chan];
                $nomissed = $number_calls[$idx][$chan] - $missed[$idx][$chan];
                $yesmissed   = $missed[$idx][$chan];
                $query1 .= "valA$contavar=$nomissed&valB$contavar=$yesmissed&var$contavar=$nomuser&";
                $query2 .= "val$contavar=".$val."&var$contavar=$nomuser&";
                $query3 .= "valA$contavar=".$number_calls[$idx][$chan]."&valB$contavar=".$number_in_calls[$idx][$chan]."&var$contavar=$nomuser&";

                $ring_time = $duration[$idx][$chan]-$val;

                if($number_calls[$idx][$chan]>0) {
                    $avg_ring_time = $ring_time / $number_calls[$idx][$chan];
                    if($nomissed>0) {
                        $avg_duration  = $val / $nomissed;
                    } else {
                        $avg_duration = 0;
                    }
                } else {
                    $avg_duration  = 0;
                    $avg_ring_time = 0;
                }
                $avg_duration = number_format($avg_duration,0);
                $avg_duration_print = seconds2minutes($avg_duration);
                $avg_ring_time = number_format($avg_ring_time,2);
                $time_print = seconds2minutes($duration[$idx][$chan]);

                $bill_print = seconds2minutes($val);
                if($number_calls[$idx][$chan] > 0) {
                    $percent_missed = $missed[$idx][$chan] * 100 / $number_calls[$idx][$chan];
                } else {
                    $percent_missed = 0;
                }
                $percent_missed = number_format($percent_missed,0)." "._('%');

                $complete_self = $_SERVER['REQUEST_URI'];
                //$complete_self .= "&chan=$chan&startd=$start&endd=$end&direction=$typerecord";
                echo "<tr $odd>\n";


                echo "<td style='text-align: left;'><a style='cursor:pointer;' onclick=\"javascript:getRecords('$chan','${appconfig['start']}','${appconfig['end']}','$typerecord','$complete_self');\">";
                echo "<img src='${appconfig['relative_path']}asternic_loading.gif' id='loading$chan' border=0 style=\"visibility: hidden; float: left;\">";
                echo "{$appconfig['canals'][$chan]}</a></td>\n";


                echo "<td>".$number_calls[$idx][$chan]."</td>\n";
                echo "<td>".$nomissed."</td>\n";
                echo "<td>".$missed[$idx][$chan]."</td>\n";
                echo "<td align=right>".$percent_missed."</td>\n";
                echo "<td>$bill_print</td>\n";
                if($total_bill != 0) {
                    $percentage_bill = $val * 100 / $total_bill;
                } else {
                    $percentage_bill = 0;
                }
                $percentage_bill = number_format($percentage_bill,2);
                echo "<td>$percentage_bill "._('%')."</td>\n";
                echo "<td>$avg_duration_print</td>\n";
                echo "<td>$ring_time "._('secs')."</td>\n";
                echo "<td>$avg_ring_time "._('secs')."</td>\n";
                echo "</tr>\n";
                echo "<tr style='display: none;' id='$chan'><td colspan=10>";
                echo "<span id='table${chan}table'></span>\n";
                echo "</td></tr>";

                $linea_pdf = Array(
                                     $appconfig['canals'][$chan],
                                     $number_calls[$idx][$chan],
                                     $missed[$idx][$chan],
                                     $percent_missed,
                                     "$bill_print ",
                                     "$percentage_bill "._('%'),
                                     "$avg_duration_print ",
                                     "$ring_time "._('secs'),
                                     "$avg_ring_time "._('secs')
                );
                $data_pdf[]=$linea_pdf;
                $contador++;

           }
           //$query1.="title=".$rep_title."$graphcolor";
           $query1.="title="._($rep_title)."$graphcolorstack&tagA="._('Completed')."&tagB="._('Missed');
           $query2.="title="._('Total Call Duration by User')."$graphcolor";
           $query3.="title="._('Incoming/Outgoing Calls by User')."$graphcolorstack&tagA=$tagA&tagB=$tagB";

    }
    echo "</tbody>\n";
    echo "</table>\n";

    $cover_pdf = _('Report Information')."\n";
    $cover_pdf.= _('Start Date').": ".$start_parts[0]."\n";
    $cover_pdf.= _('End Date').": ".$end_parts[0]."\n";
    $cover_pdf.= _('Period').": ".$appconfig['period']." "._('days')."\n\n";
    $cover_pdf.= $rep_title."\n";
    $cover_pdf.= _('Number of Calls').": ".$total_calls." "._('calls')."\n";
    $cover_pdf.= _('Total Time').": ".$total_bill_print." "._('mins')."\n";
    $cover_pdf.= _('Avg. ring time').": ".$avg_ring_full." "._('secs')."\n";

    print_exports($header_pdf,$data_pdf,$width_pdf,$title_pdf,$cover_pdf,$appconfig);

    echo "<table class='pepa' width='99%' cellpadding=3 cellspacing=3 border=0>\n";
    echo "<thead>\n";
    echo "<tr><td><hr/></td></tr>";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query1,718,433,"chart1",1);
    echo "</td></tr><tr><td><hr/></td></tr>\n";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query2,718,433,"chart2",0);
    echo "</td></tr><tr><td><hr/></td></tr>\n";
    echo "<tr><td align=center bgcolor='#fffdf3' width='100%'>\n";
    swf_bar($query3,718,433,"chart3",1);
    echo "</td></tr>\n";
    echo "</thead>\n";
    echo "</table><BR>\n";


} // end if totalbill > 1


?>
</div> <!-- end asterniccontents -->
</div>
<hr/>
<div id='asternicfooter'>
<div style='float:right;'><a href='https://www.asternic.net' border=0><img src='<?php echo $appconfig['relative_path'];?>asternic_cdr_logo.jpg' alt='asternic cdr' border=0></a></div>
</div>
</div> <!-- end div asternic content -->
<div style='clear:both;'></div>
<?php
} // end function outgoing


function asternic_dashboard() {

    $sql="SELECT src,dst,lastapp,substring(channel,1,locate(\"-\",channel,1)-1) AS chan1,  substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) AS chan2, ";
    $sql.="billsec, calldate,j1.dial,j2.dial,if(j1.dial is not null and j2.dial is null,'outbound','') as outbound,if(j1.dial is null and j2.dial is not null,'inbound','') ";
    $sql.="AS inbound FROM asteriskcdrdb.cdr LEFT JOIN asterisk.devices as j2 on substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) = j2.dial ";
    $sql.="LEFT JOIN asterisk.devices as j1 on substring(channel,1,locate(\"-\",channel,1)-1) = j1.dial WHERE calldate>curdate() and billsec>0 ";
    $sql.="HAVING outbound<>'' OR inbound<>'' AND chan2<>'' ORDER BY calldate DESC";

    $res = $db->query($query);

    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    //while ($res->fetchInto($row, DB_FETCHMODE_ASSOC)) {
    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {
    }


}

function asternic_home($appconfig) {

    $yearp[0]=_('January');
    $yearp[1]=_('February');
    $yearp[2]=_('March');
    $yearp[3]=_('April');
    $yearp[4]=_('May');
    $yearp[5]=_('June');
    $yearp[6]=_('July');
    $yearp[7]=_('August');
    $yearp[8]=_('September');
    $yearp[9]=_('October');
    $yearp[10]=_('November');
    $yearp[11]=_('December');

    $dayp = $appconfig['dayp'];
    $fstart_year  = substr($appconfig['start'],0,4);
    $fstart_month = substr($appconfig['start'],5,2);
    $fstart_day = substr($appconfig['start'],8,2);

    $fend_year  = substr($appconfig['end'],0,4);
    $fend_month = substr($appconfig['end'],5,2);
    $fend_day = substr($appconfig['end'],8,2);

    $start_today = date('Y-m-d 00:00:00');
    $end_today = date('Y-m-d 23:59:59');
    $start_today_ts = return_timestamp($start_today);

    $day = date('w',$start_today_ts);
    $diff_to_monday = $start_today_ts - (($day - 1) * 86400);

    // Start and End date for last week (it counts from the first monday back
    // till the next sunday
    $begin_week_monday = date('Y-m-d 00:00:00',$diff_to_monday);
    $end_week_sunday   = date('Y-m-d 23:59:59',($diff_to_monday + (6 * 86400)));

    $end_year = date('Y');

    $begin_month = date('Y-m-01 00:00:00');
    $begin_month_ts = return_timestamp($begin_month);
    $end_month_ts = $begin_month_ts + (86400 * 32);

    $end_past_month_ts = $begin_month_ts - 1;
    $end_past_month =  date('Y-m-d 23:59:59',$end_past_month_ts);
    $begin_past_month = date('Y-m-01 00:00:00',$end_past_month_ts);

    $begin_past_month_ts = return_timestamp($begin_past_month);
    $end_past2_month_ts = $begin_past_month_ts - 1;
    $end_past2_month =  date('Y-m-d 23:59:59',$end_past2_month_ts);
    $begin_past2_month = date('Y-m-01 00:00:00',$end_past2_month_ts);

    for ($a=4; $a>0; $a--) {
       $day_number = date('d',$end_month_ts);
       if($day_number == 1) {
          $a==0;
       } else {
          $end_month_ts -= 86400;
       }
    }
    $end_month_ts -= 86400;

    $end_month = date('Y-m-d',$end_month_ts);

    $items_extension = explode(",",$appconfig['extension']);
    $items_extension = array_map("remove_quotes",$items_extension);

    $db = $appconfig['db'];

    $sql= "SELECT src,dst,lastapp,substring(channel,1,locate(\"-\",channel,1)-1) AS chan1, ";
    $sql.="substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) AS chan2, ";
    $sql.="billsec, calldate,j1.dial,j2.dial,if(j1.dial is not null and j2.dial is null,'outbound','') as outbound, ";
    $sql.="if(j1.dial is null and j2.dial is not null,'inbound','') AS inbound, ";
    $sql.="if(j1.dial is not null and j2.dial is not null,'internal','') as internal ";
    $sql.="FROM asteriskcdrdb.cdr LEFT JOIN asterisk.devices as j2 on substring(dstchannel,1,locate(\"-\",dstchannel,1)-1) = j2.dial ";
    $sql.="LEFT JOIN asterisk.devices as j1 on substring(channel,1,locate(\"-\",channel,1)-1) = j1.dial WHERE calldate>curdate() AND billsec>0 AND disposition='ANSWERED' ";
    $sql.="HAVING (outbound<>'' OR inbound<>'' OR internal<>'') AND chan2<>'' ORDER BY calldate DESC";

    $res = $db->query($sql);


    if(DB::IsError($res)) {
        die($res->getMessage());
    }

    $inbound   = 0;
    $outbound  = 0;
    $internal  = 0;
    $totaltime = 0;
    $totalinboundtime  = 0;
    $totaloutboundtime = 0;
    $totalinternaltime = 0;
    $totalcall = 0;
    $avgtime   = 0;
    $callsfrom = Array();

    while (is_array($row = $res->fetchRow(DB_FETCHMODE_ASSOC))) {
        $totalcall++;
        if($row['inbound']<>'') {
            $inbound++;
            $totalinboundtime+=$row['billsec'];
        } else if($row['outbound']<>'') {
            $totaloutboundtime+=$row['billsec'];
            $outbound++;
        } else if($row['internal']<>'') {
            $totalinternaltime+=$row['billsec'];
            $internal++;
        }
        if($row['internal']=='') {
            if(!isset($callsfrom[$row['src']])) {
                $callsfrom[$row['src']]=1;
            } else {
                $callsfrom[$row['src']]++;
            }
        }
    }
    $totalinboundtime = round($totalinboundtime/60,0);
    $totaloutboundtime = round($totaloutboundtime/60,0);
    $totalinternaltime = round($totalinternaltime/60,0);
    $totaltime = $totalinboundtime + $totaloutboundtime + $totalinternaltime;

    if($inbound>0) { 
        $avgtimein  = round($totalinboundtime / $inbound,2);
    } else {
        $avgtimein = 0;
    }

    if($outbound>0) { 
        $avgtimeout = round($totaloutboundtime / $outbound,2);
    } else {
        $avgtimeout = 0;
    }

    if($internal>0) { 
        $avgtimeinternal = round($totalinternaltime / $internal,2);
    } else {
        $avgtimeinternal = 0;
    }


    require_once("menu.php");
?>
<div id="asternicmain">
<div id="asterniccontents">
<form method='POST' name='asternic_cdr_form'>
<input type=hidden name=start>
<input type=hidden name=end>

<div id='topdash'>
<h2>
<?php echo _("Today's Dashboard");?>
</h2>
<br/>
    <table width='99%' cellpadding=3 cellspacing=3 border=0>
    <thead>
    <tr>
        <td valign=top width='50%'>
            <table width='100%' border=0 cellpadding=0 cellspacing=0>
                <caption><?php echo _('Call Counters')?></caption>
                <tbody>
                <tr>
                   <td><?php echo _('Total Calls')?>:</td>
                   <td><?php echo $totalcall?></td>
                </tr>
                </tr>
                <tr>
                   <td><?php echo _('Total Inbound Calls')?>:</td>
                   <td><?php echo $inbound?></td>
                </tr>
                <tr>
                   <td><?php echo _('Total Outbound Calls')?>:</td>
                   <td><?php echo $outbound?></td>
                </tr>
                <tr>
                   <td><?php echo _('Total Internal Calls')?>:</td>
                   <td><?php echo $internal?></td>
                </tr>
                <tr>
                   <td><?php echo _('Unique Callers')?>:</td>
                   <td><?php echo count($callsfrom); ?></td>
                </tr>
                </tbody>
            </table>
        </td>
        <td valign=top width='50%'>
             <table width='100%' border=0 cellpadding=0 cellspacing=0>
                <caption><?php echo _("Call Duration")?></caption>
                <tbody>
                <tr> 
                  <td><?php echo _('Total Minutes')?>:</td>
                  <td><?php echo $totaltime ?></td>
                </tr>
                <tr>
                  <td><?php echo _('Total Inbound Minutes')?>:</td>
                  <td><?php echo $totalinboundtime ?></td>
                </tr>
                <tr>
                  <td><?php echo _('Total Outbound Minutes')?>:</td>
                  <td><?php echo $totaloutboundtime ?> </td>
                </tr>
                <tr>
                  <td><?php echo _('Total Internal Minutes')?>:</td>
                  <td><?php echo $totalinternaltime ?> </td>
                </tr>
                <tr>
                  <td><?php echo _('Average Inbound Call Duration')?>:</td>
                  <td><?php echo $avgtimein." "._('minutes')  ?> </td>
                </tr>
                <tr>
                  <td><?php echo _('Average Outbound Call Duration')?>:</td>
                  <td><?php echo $avgtimeout." "._('minutes')  ?> </td>
                </tr>
                <tr>
                  <td><?php echo _('Average Internal Call Duration')?>:</td>
                  <td><?php echo $avgtimeinternal." "._('minutes')  ?> </td>
                </tr>
                </tbody>
                </table>
            </td>
        </tr>
        </thead>
        </table>
</div>
<br/>
<hr/>
<div id='left'>
<h2>
<?php echo _('Select Extensions');?>
</h2>
<br/>

<table class='pad10' border=0>
<thead style='background-color:#dfedf3;'>
<tr>
   <td>
    <?php echo _('Available'); ?><br/>
    <select size=10 name="List_Extensions_available" multiple="multiple" id="myform_List_Extensions_from" style="height: 100px;width: 125px;" onDblClick="List_move_around('right',false);" >
<?php    
foreach($appconfig['canals'] as $canall=>$canalname) {
    if($canall <> "NONE" && !in_array($canall,$items_extension) && $appconfig['extension']<>"''") {
       echo "<option value=\"'$canall'\">$canalname</option>\n";
    }
}
?>
    </select>
</td>
<td align="left">
        <a href='#' onclick="List_move_around('right',false); return false;"><img src='<?php echo $appconfig['relative_path'];?>asternic_go-next.png' width=16 height=16 border=0></a>
        <a href='#' onclick="List_move_around('left', false); return false;"><img src='<?php echo $appconfig['relative_path'];?>asternic_go-previous.png' width=16 height=16 border=0></a>
        <br>
        <br>
        <a href='#' onclick="List_move_around('right', true); return false;"><img src='<?php echo $appconfig['relative_path'];?>asternic_go-last.png' width=16 height=16 border=0></a>
        <a href='#' onclick="List_move_around('left', true); return false;"><img src='<?php echo $appconfig['relative_path'];?>asternic_go-first.png' width=16 height=16 border=0></a>
</td>
<td>
    <?php echo _('Selected')?><br/>
    <select size=10 name="List_Extensions[]" multiple="multiple" style="height: 100px;width: 125px;" id="myform_List_Extensions_to" onDblClick="List_move_around('left',false);" >
        <?php
        if($appconfig['extension'] == "''") {
            foreach($appconfig['canals'] as $canall=>$canalname) {
                if($canall <> "NONE") {
                       echo "<option value=\"'$canall'\">$canalname</option>\n";
                }
            }
        } else {
            foreach($items_extension as $canall) {
                echo "<option value=\"'$canall'\">".$appconfig['canals'][$canall]."</option>\n";
            }
        }
        ?>
    </select>
   </td>
</tr> 
</thead> 
</table>


</div>
<div id='right'>
<h2><?php echo _('Select Timeframe')?></h2>
<h3><?php echo _('Shortcuts')?></h3>
<?php
echo "<a href=\"javascript:setdates('$start_today', '$end_today')\">";
echo _('Today'). "</a> | ";
echo "<a href=\"javascript:setdates('$begin_week_monday', '$end_week_sunday')\">";
echo _('This Week')."</a> | ";
echo "<a href=\"javascript:setdates('$begin_month', '$end_month')\">";
echo _('This Month')."</a> | ";
echo "<a href=\"javascript:setdates('$begin_past2_month', '$end_month')\">";
echo _('Last three months')."</a><br/>";
?>
<br/>
<table class='pad10'>
<thead style='background-color:#dfedf3;'>
<tr>
<td><?php echo _("Start Date"); ?></td>
<td>
        <select name="day1" size="1">
        <?php
        for($a=1;$a<32;$a++) {
            echo "<option value='$a' ";
            if($fstart_day == $a) { echo " selected "; }
            echo ">$a</option>\n";
        }
        ?>
        </select>

        <select name="month1" size="1" onchange="dateChange('day1','month1','year1');">
        <?php
        for($a=0;$a<12;$a++)
        {
        $amonth = $a+1;
        echo "<option value='$a' ";
        if ($fstart_month == $amonth) { echo "selected "; }
        echo ">$yearp[$a]</option>\n";
        }
        ?>
        </select>
    
        <?php
        $start_year = $end_year - 5;
        $super_start_year = $start_year - 50;
        $super_end_year   = $end_year + 5;
        echo "<select name='year1' size='1' onchange=\"checkMore( this, $start_year, $end_year, $super_start_year, $super_end_year );dateChange('day1','month1','year1');\">\n";
        echo "<option value=\"MWJ_DOWN\">"._('lower')."</option>\n";
        for($a=$start_year;$a<=$end_year;$a++)
        {
            echo "<option value='$a' ";
            if ($fstart_year == $a) { echo "selected "; }
            echo ">$a</option>\n";
        }
        echo "<option value=\"MWJ_UP\">"._('higher')."</option>\n";
        ?>
        </select>
</td></tr>
<tr>
<td><?php echo _("End Date"); ?></td>
<td>
        <select name="day2" size="1">
        <?php 
        for($a=1;$a<32;$a++) {
            echo "<option value='$a' ";
            if($fend_day == $a) { echo " selected "; }
            echo ">$a</option>\n";
        }
        ?>
        </select>

        <select name="month2" size="1" onchange="dateChange('day2','month2','year2');">
        <?php
        for($a=0;$a<12;$a++)
        {
        $amonth = $a+1;
        echo "<option value='$a' ";
        if ($fend_month == $amonth) { echo "selected "; }
        echo ">$yearp[$a]</option>\n";
        }
        ?>
        </select>
    
        <?php
        $start_year = $end_year - 5;
        $super_start_year = $start_year - 50;
        $super_end_year   = $end_year + 5;
        echo "<select name='year2' size='1' onchange=\"checkMore( this, ${start_year}, ${end_year}, $super_start_year, $super_end_year );dateChange('day2','month2','year2');\">\n";
        echo "<option value=\"MWJ_DOWN\">"._('lower')."</option>\n";
        for($a=$start_year;$a<=$end_year;$a++)
        {
            echo "<option value='$a' ";
            if ($fend_year == $a) { echo "selected "; }
            echo ">$a</option>\n";
        }
        echo "<option value=\"MWJ_UP\">"._('higher')."</option>\n";
        ?>
        </select>
</td></tr>
</thead>
</table>
</div>
<div style="clear: both;">&nbsp;</div>
<div id='rest'>
<br/>
<input type=submit name='runreport' value='<?php echo _('Run Report')?>' onClick='return envia();'>
</div> <!-- end div rest submit button -->
</form>
</div> <!-- end div asterniccontents green -->
</div> <!-- end div asternicmain red -->
<hr/>
<div id='asternicfooter'>
<div style='float:right;'><a href='https://www.asternic.net' border=0><img src='<?php echo $appconfig['relative_path'];?>asternic_cdr_logo.jpg' alt='asternic cdr' border=0></a></div>
</div> <!-- end div asternicfooter -->
</div> <!-- end div asternic content -->
<div style='clear:both;'></div>
<?php
} // end function asternic_home
?>
