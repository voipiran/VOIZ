<div id="asterniccontent">
<a name='0'></a>
<div id='asternicheader'>
<ul id='primary'>
<?php

$tab = isset($_GET['tab'])?$_GET['tab']:'home';

$menu[] = _('Home');
$menu[] = _('Outgoing');
$menu[] = _('Incoming');
$menu[] = _('Combined');
$menu[] = _('Distribution');

$link[] = "?type=tool&display=asternic_cdr&tab=home";
$link[] = "?type=tool&display=asternic_cdr&tab=outgoing";
$link[] = "?type=tool&display=asternic_cdr&tab=incoming";
$link[] = "?type=tool&display=asternic_cdr&tab=combined";
$link[] = "?type=tool&display=asternic_cdr&tab=distribution";

$anchor = Array();

if(basename(SELF)=="outgoing.php") {
    $b=1;
} elseif (basename(SELF) =="incoming.php") {
    $b=2;
} elseif (basename(SELF) =="distribution.php") {
    $b=3;
}


for($a=0;$a<count($menu);$a++) {
    if(preg_match("/tab=$tab/",$link[$a])) {
        echo "<li><span>".$menu[$a]."</span></li>\n";
        if(count($anchor)>0 && $a=$b) {
            echo "<ul id='secondary'>\n";
            $contador=1;
            foreach ($anchor as $item) {
                echo "<li><a href='#$contador'>$item</a></li>\n";
                $contador++;
            }
            echo "</ul>\n";
        }
    
    } else {
        if(isset($_SESSION['CDRSTATS']['start']) || $link[$a]=="/admin/config.php?type=tool&display=asternic_cdr" ) {
            echo "<li><a href='".$link["$a"]."'>".$menu["$a"]."</a></li>\n";
        }
    }
}
?>
</ul>

</div>
