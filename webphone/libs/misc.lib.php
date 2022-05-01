<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License  |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php                   |
  |                                                                      |
  | Software distributed under the License is distributed on an "AS IS"  |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See  |
  | the License for the specific language governing rights and           |
  | limitations under the License.                                       |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions    |
  +----------------------------------------------------------------------+
  $Id: misc.lib.php,v 1.3 2007/08/10 01:32:51 gcarrillo Exp $ */


function recoger_valor($key, &$get, &$post, $default = NULL) {
    if (isset($post[$key])) return $post[$key];
    elseif (isset($get[$key])) return $get[$key];
    else return $default;
}

function obtener_muestra_actividad_cpu()
{
    if (!function_exists('_info_sistema_linea_cpu')) {
        function _info_sistema_linea_cpu($s) { $pos = (strpos($s, 'cpu ') === 0); return $pos; }
    }
    $sample1 = array_filter(file('/proc/stat', FILE_IGNORE_NEW_LINES), '_info_sistema_linea_cpu');
    $sample2 = array_shift($sample1);
    $muestra = preg_split('/\s+/', $sample2);
    array_shift($muestra);
    return $muestra;
}

function calcular_carga_cpu_intervalo($m1, $m2)
{
    if (!function_exists('_info_sistema_diff_stat')) {
        function _info_sistema_diff_stat($a, $b)
        {
            $aa = str_split($a);
            $bb = str_split($b);
            while (count($aa) < count($bb)) array_unshift($aa, '0');
            while (count($aa) > count($bb)) array_unshift($bb, '0');
            while (count($aa) > 0 && $aa[0] == $bb[0]) {
                array_shift($aa);
                array_shift($bb);
            }
            if (count($aa) <= 0) return 0;
            $a = implode('', $aa); $b = implode('', $bb);
            return (int)$b - (int)$a;
        }
    }
    $diffmuestra = array_map('_info_sistema_diff_stat', $m1, $m2);
    $cpuActivo = $diffmuestra[0] + $diffmuestra[1] + $diffmuestra[2] + $diffmuestra[4] + $diffmuestra[5] + $diffmuestra[6];
    $cpuTotal = $cpuActivo + $diffmuestra[3];
    return ($cpuTotal > 0) ? $cpuActivo / $cpuTotal : 0;
}

function obtener_info_de_sistema()
{
    $muestracpu = array();
    $muestracpu[0] = obtener_muestra_actividad_cpu();

    $arrInfo=array(
        'MemTotal'      =>  0,
        'MemFree'       =>  0,
        'MemBuffers'    =>  0,
        'SwapTotal'     =>  0,
        'SwapFree'      =>  0,
        'Cached'        =>  0,
        'CpuModel'      =>  '(unknown)',
        'CpuVendor'     =>  '(unknown)',
        'CpuMHz'        =>  0.0,
    );
    $arrExec=array();
    $arrParticiones=array();
    $varExec="";

    if($fh=fopen("/proc/meminfo", "r")) {
        while($linea=fgets($fh, "4048")) {
            // Aqui parseo algunos parametros
            if(preg_match("/^MemTotal:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["MemTotal"]=trim($arrReg[1]);
            }
            if(preg_match("/^MemFree:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["MemFree"]=trim($arrReg[1]);
            }
            if(preg_match("/^Buffers:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["MemBuffers"]=trim($arrReg[1]);
            }
            if(preg_match("/^SwapTotal:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["SwapTotal"]=trim($arrReg[1]);
            }
            if(preg_match("/^SwapFree:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["SwapFree"]=trim($arrReg[1]);
            }
            if(preg_match("/^Cached:[[:space:]]+([[:digit:]]+) kB/", $linea, $arrReg)) {
                $arrInfo["Cached"]=trim($arrReg[1]);
            }
        }
        fclose($fh);
    }

    if($fh=fopen("/proc/cpuinfo", "r")) {
        while($linea=fgets($fh, "4048")) {
            // Aqui parseo algunos parametros
            if(preg_match("/^model name[[:space:]]+:[[:space:]]+(.*)$/", $linea, $arrReg)) {
                $arrInfo["CpuModel"]=trim($arrReg[1]);
            }
            if (preg_match("/^Processor[[:space:]]+:[[:space:]]+(.*)$/", $linea, $arrReg)) {
                $arrInfo["CpuModel"]=trim($arrReg[1]);
            }
            if(preg_match("/^vendor_id[[:space:]]+:[[:space:]]+(.*)$/", $linea, $arrReg)) {
                $arrInfo["CpuVendor"]=trim($arrReg[1]);
            }
            if(preg_match("/^cpu MHz[[:space:]]+:[[:space:]]+(.*)$/", $linea, $arrReg)) {
                $arrInfo["CpuMHz"]=trim($arrReg[1]);
            }
        }
        fclose($fh);
    }

    exec("/usr/bin/uptime", $arrExec, $varExec);

    if($varExec=="0") {
        if(preg_match("/up[[:space:]]+([[:digit:]]+ days?,)?(([[:space:]]*[[:digit:]]{1,2}:[[:digit:]]{1,2}),?)?([[:space:]]*[[:digit:]]+ min)?/",
                $arrExec[0],$arrReg)) {
            if(!empty($arrReg[3]) and empty($arrReg[4])) {
                list($uptime_horas, $uptime_minutos) = explode(":", $arrReg[3]);
                $arrInfo["SysUptime"]=$arrReg[1] . " $uptime_horas hour(s), $uptime_minutos minute(s)";
            } else if (empty($arrReg[3]) and !empty($arrReg[4])) {
                // Esto lo dejo asi
                $arrInfo["SysUptime"]=$arrReg[1].$arrReg[3].$arrReg[4];
            } else {
                $arrInfo["SysUptime"]=$arrReg[1].$arrReg[3].$arrReg[4];
            }
        }
    }


    // Infomacion de particiones
    //- TODO: Aun no se soportan lineas quebradas como la siguiente:
    //-       /respaldos/INSTALADORES/fedora-1/disco1.iso
    //-                              644864    644864         0 100% /mnt/fc1/disc1

    exec("/bin/df -P /etc/fstab", $arrExec, $varExec);

    if($varExec=="0") {
        foreach($arrExec as $lineaParticion) {
            if(preg_match("/^([\/-_\.[:alnum:]|-]+)[[:space:]]+([[:digit:]]+)[[:space:]]+([[:digit:]]+)[[:space:]]+([[:digit:]]+)" .
                    "[[:space:]]+([[:digit:]]{1,3}%)[[:space:]]+([\/-_\.[:alnum:]]+)$/", $lineaParticion, $arrReg)) {
                $arrTmp="";
                $arrTmp["fichero"]=$arrReg[1];
                $arrTmp["num_bloques_total"]=$arrReg[2];
                $arrTmp["num_bloques_usados"]=$arrReg[3];
                $arrTmp["num_bloques_disponibles"]=$arrReg[4];
                $arrTmp["uso_porcentaje"]=$arrReg[5];
                $arrTmp["punto_montaje"]=$arrReg[6];
                $arrInfo["particiones"][]=$arrTmp;
            }
        }
    }

    usleep(250000);
    $muestracpu[1] = obtener_muestra_actividad_cpu();
    $arrInfo['CpuUsage'] = calcular_carga_cpu_intervalo($muestracpu[0], $muestracpu[1]);

    return $arrInfo;
}

/**
 * Procedimiento para construir una cadena de parámetros GET a partir de un
 * arreglo asociativo de variables. Opcionalmente se puede indicar un conjunto
 * de variables a excluir de la construcción. Si se ejecuta en contexto web y
 * se dispone del superglobal $_GET, sus variables se agregan también a la
 * cadena, a menos que el nombre de la variable GET conste también en la lista
 * de variables indicada explícitamente.
 *
 * @param   array   $arrVars    Lista de variables a incluir en cadena URL
 * @param   array   $arrExcluir Lista de variables a excluir de cadena URL
 *
 * @return  string  Cadena URL con signo de interrogación enfrente, si hubo al
 *                  menos una variable a convertir, o cadena vacía si no hay
 *                  variable alguna a convertir
 */
function construirURL($arrVars=array(), $arrExcluir=array())
{
    $listaVars = array();   // Lista de variables inicial

    // Variables GET, si existen
    if (isset($_GET) && is_array($_GET))
        $listaVars = array_merge($listaVars, $_GET);

    // Variables explícitas, si existen
    if (is_array($arrVars))
        $listaVars = array_merge($listaVars, $arrVars);

    // Quitar variables excluídas
    foreach ($arrExcluir as $k) unset($listaVars[$k]);
    if (count($listaVars) <= 0) return '';

    $keyval = array();
    foreach ($listaVars as $k => $v) {
        $keyval[] = urlencode($k).'='.urlencode($v);
    }
    return '?'.implode('&amp;', $keyval);
}

// Translate a date in format 9 Dec 2006
function translateDate($dateOrig)
{
    if(preg_match("/([[:digit:]]{1,2})[[:space:]]+([[:alnum:]]{3})[[:space:]]+([[:digit:]]{4})/", $dateOrig, $arrReg)) {
        if($arrReg[2]=="Jan")      $numMonth = "01";
        else if($arrReg[2]=="Feb") $numMonth = "02";
        else if($arrReg[2]=="Mar") $numMonth = "03";
        else if($arrReg[2]=="Apr") $numMonth = "04";
        else if($arrReg[2]=="May") $numMonth = "05";
        else if($arrReg[2]=="Jun") $numMonth = "06";
        else if($arrReg[2]=="Jul") $numMonth = "07";
        else if($arrReg[2]=="Aug") $numMonth = "08";
        else if($arrReg[2]=="Sep") $numMonth = "09";
        else if($arrReg[2]=="Oct") $numMonth = "10";
        else if($arrReg[2]=="Nov") $numMonth = "11";
        else if($arrReg[2]=="Dec") $numMonth = "12";
        return $arrReg[3] . "-" . $numMonth . "-" . $arrReg[1];
    } else {
        return false;
    }
}
function get_key_settings($pDB,$key)
{
    $r = $pDB->getFirstRowQuery(
        'SELECT `value` FROM settings WHERE `key` = ?',
        FALSE, array($key));
    return ($r && count($r) > 0) ? $r[0] : '';
}
function set_key_settings($pDB,$key,$value)
{
    // Verificar si existe el valor de configuración
    $r = $pDB->getFirstRowQuery(
        'SELECT COUNT(*) FROM settings WHERE `key` = ?',
        FALSE, array($key));
    if (!$r) return FALSE;
    $r = $pDB->genQuery(
        (($r[0] > 0)
            ? 'UPDATE settings SET `value` = ? WHERE `key` = ?'
            : 'INSERT INTO settings (`value`, `key`) VALUES (?, ?)'),
        array($value, $key));
    return $r ? TRUE : FALSE;
}

function load_version_issabel($ruta_base='')
{
    require_once $ruta_base."configs/default.conf.php";
    global $arrConf;
    include_once $ruta_base."libs/paloSantoDB.class.php";

    //conectarse a la base de settings para obtener la version y release del sistema elastix
    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if(empty($pDB->errMsg)) {
        $theme=get_key_settings($pDB,'issabel_version_release');
    }
//si no se encuentra setear solo ?
    if (empty($theme)){
        set_key_settings($pDB,'issabel_version_release','?');
        return "?";
    }
    else return $theme;
}

function load_theme($ruta_base='')
{
    require_once $ruta_base."configs/default.conf.php";
    require_once $ruta_base."libs/paloSantoDB.class.php";
    global $arrConf;

    if (!function_exists('_load_theme_is_theme_dir_valid')) {
        function _load_theme_is_theme_dir_valid($themedir)
        {
            $theme = basename($themedir);
            if (!preg_match('/^\w+$/', $theme)) return FALSE;
            if (!is_dir($themedir)) return FALSE;
            if (!file_exists($themedir.'/_common/index.tpl')) return FALSE;
            if (!file_exists($themedir.'/_common/_menu.tpl')) return FALSE;
            if (!file_exists($themedir.'/_common/login.tpl')) return FALSE;
            return TRUE;
        }
    }

    $chosen_theme = NULL;

    // Leer el tema de la base de datos settings
    $settings_theme = NULL;
    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if (empty($pDB->errMsg)) {
        $settings_theme = get_key_settings($pDB, 'theme');
        if (!preg_match('/^\w+$/', $settings_theme))
            $settings_theme = NULL;
    }

    // Verificar si los temas existen en el orden indicado
	exec("rpm -q centos-release",$output);
	$ver = explode("-",$output[0]);
	switch($ver[2]){
		case 5:
			$available_themes = array('elastixneo','tenant', 'blackmin', 'giox', 'default');
		break;
		case 7:
			$available_themes = array('tenant', 'elastixneo', 'blackmin', 'giox', 'default');
		break;
	}
    if (!is_null($settings_theme)) array_unshift($available_themes, $settings_theme);
    foreach ($available_themes as $theme) {
        if (_load_theme_is_theme_dir_valid($ruta_base."themes/$theme")) {
            $chosen_theme = $theme;
            break;
        }
    }

    // Si todavía no se encuentra un tema, se busca el primer directorio
    if (is_null($chosen_theme)) {
        foreach (glob($ruta_base.'themes/*') as $theme_dir) {
            if (_load_theme_is_theme_dir_valid($theme_dir)) {
                $chosen_theme = basename($theme_dir);
                break;
            }
        }
    }

    if (is_null($chosen_theme)) {
        die('No themes found under '.$ruta_base.'themes/. At least one theme must exist for Issabel GUI.');
    }

    // Guardar nuevo tema elegido, si es distinto del leído
    if (empty($pDB->errMsg) && $chosen_theme != $settings_theme) {
        set_key_settings($pDB, 'theme', $chosen_theme);
        array_map('unlink', glob($ruta_base.'var/templates_c/*php'));
    }
    return $chosen_theme;
}

function load_language($ruta_base='')
{
    $lang = get_language($ruta_base);

    include_once $ruta_base."lang/en.lang";
    $lang_file = $ruta_base."lang/$lang.lang";

    if ($lang != 'en' && file_exists("$lang_file")) {
        $arrLangEN = $arrLang;
        include_once "$lang_file";
        $arrLang = array_merge($arrLangEN, $arrLang);
    }
}

function load_language_module($module_id, $ruta_base='')
{
    global $arrLangModule;

    $lang = get_language($ruta_base);
    include_once $ruta_base."modules/$module_id/lang/en.lang";
    $lang_file_module = $ruta_base."modules/$module_id/lang/$lang.lang";
    if ($lang != 'en' && file_exists("$lang_file_module")) {
        $arrLangEN = $arrLangModule;
        include_once "$lang_file_module";
        $arrLangModule = array_merge($arrLangEN, $arrLangModule);
    }

    global $arrLang;
    global $arrLangModule;
    $arrLang = array_merge($arrLang,$arrLangModule);
}

function _tr($s)
{
    global $arrLang;
    return isset($arrLang[$s]) ? $arrLang[$s] : $s;
}

function get_language($ruta_base='')
{
    require_once $ruta_base."configs/default.conf.php";
    include $ruta_base."configs/languages.conf.php";

    global $arrConf;
    $lang="";

    //conectarse a la base de settings para obtener el idioma actual
    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if(empty($pDB->errMsg)) {
        $lang=get_key_settings($pDB,'language');
    }
    //si no se encuentra tomar del archivo de configuracion
    if (empty($lang)) $lang=isset($arrConf['language'])?$arrConf['language']:"en";

    //verificar que exista en el arreglo de idiomas, sino por defecto en
    if (!array_key_exists($lang,$languages)) $lang="en";
    return $lang;
}


#funciones para menu


/**
* Genera la lista de opciones para el tag SELECT_INPUT
* @generic
*/
function combo($arreglo_valores, $selected) {
    $cadena = '';
    if(!is_array($arreglo_valores) or empty($arreglo_valores)) return '';

    foreach($arreglo_valores as $key => $value) if ($selected == $key)
        $cadena .= "<option value='$key' selected>$value</option>\n"; else $cadena .= "<option value='$key'>$value</option>\n";
    return $cadena;
}

/**
* Funcion que sirve para obtener informacion de un checkbox si esta o no seteado.
* Habia un problema q cunado un checkbox no era seleccionado, este no devolvia nada por POST
* Esta funcion garantiza que siempre q defina un checkbox voy a tener un 'false' si no esta
* seteado y un 'true' si lo esta.
*
* Ejemplo: $html = checkbox("chk_01",'on','off'); //define un checkbox y esta seteado.
           $smarty("eje",$html); //lo paso a las plantilla.
           ......... por POST lo recibo ......
*          $check = $_POST['chk_01'] //recibo 'on' or 'off' segun el caso de q este seteado o  no.
*/
function checkbox($id_name, $checked='off', $disable='off')
{
    $check = $disab = "";
    $id_name_fixed  = str_replace("-","_",$id_name);

    if(!($checked=='off'))
        $check = "checked=\"checked\"";
    if(!($disable=='off'))
        $disab = "disabled=\"disabled\"";

    $checkbox  = "<input type=\"checkbox\" name=\"chkold{$id_name}\" $check $disab onclick=\"javascript:{$id_name_fixed}check();\" />
                  <input type=\"hidden\"   name=\"{$id_name}\" id=\"{$id_name}\"   value=\"{$checked}\" />
                  <script type=\"text/javascript\">
                    function {$id_name_fixed}check(){
                        var node = document.getElementById('$id_name');
                        if(node.value == 'on')
                            node.value = 'off';
                        else node.value = 'on';
                    }
                  </script>";
    return $checkbox;
}

/**
* Funcion que sirve para obtener los valores de los parametros de los campos en los
* formularios, Esta funcion verifiva si el parametro viene por POST y si no lo encuentra
* trata de buscar por GET para poder retornar algun valor, si el parametro ha consultar no
* no esta en request retorna null.
*
* Ejemplo: $nombre = getParameter('nombre');
*/
function getParameter($parameter)
{
    $name_delete_filters = null;
    if(isset($_POST['name_delete_filters']) && !empty($_POST['name_delete_filters']))
        $name_delete_filters = $_POST['name_delete_filters'];
    else if(isset($_GET['name_delete_filters']) && !empty($_GET['name_delete_filters']))
        $name_delete_filters = $_GET['name_delete_filters'];

    if($name_delete_filters){
        $arrFilters = explode(",",$name_delete_filters);
        if(in_array($parameter,$arrFilters))
            return null;
    }
    if(isset($_POST[$parameter]))
        return $_POST[$parameter];
    else if(isset($_GET[$parameter]))
        return $_GET[$parameter];
    else
        return null;
}

/**
 * Función para obtener la clave del Cyrus Admin de Issabel.
 * La clave es obtenida de /etc/issabel.conf
 *
 * @param   string  $ruta_base          Ruta base para inclusión de librerías
 *
 * @return  mixed   NULL si no se reconoce usuario, o la clave en plaintext
 */
function obtenerClaveCyrusAdmin($ruta_base='')
{
    require_once $ruta_base.'libs/paloSantoConfig.class.php';

    if(is_file("/etc/issabel.conf")) {
        $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
        $listaParam = $pConfig->leer_configuracion(FALSE);
        if (isset($listaParam['cyrususerpwd'])) {
        $ret = $listaParam['cyrususerpwd']['valor'];
        } else {
            $ret = 'palosanto';
        }
    }

    if(is_file("/etc/issabel.conf")) {
        $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
        $listaParam = $pConfig->leer_configuracion(FALSE);
        if (isset($listaParam['cyrususerpwd'])) {
            $ret = $listaParam['cyrususerpwd']['valor'];
        } else {
            $ret = 'palosanto';
        }
    }

    return $ret;

}

/**
 * Función para obtener la clave MySQL de usuarios bien conocidos de Issabel.
 * Los usuarios conocidos hasta ahora son 'root' (sacada de /etc/issabel.conf)
 * y 'asteriskuser' (sacada de /etc/amportal.conf)
 *
 * @param   string  $sNombreUsuario     Nombre de usuario para interrogar
 * @param   string  $ruta_base          Ruta base para inclusión de librerías
 *
 * @return  mixed   NULL si no se reconoce usuario, o la clave en plaintext
 */
function obtenerClaveConocidaMySQL($sNombreUsuario, $ruta_base='')
{
    if(file_exists($ruta_base.'libs/paloSantoConfig.class.php'))
    	require_once $ruta_base.'libs/paloSantoConfig.class.php';
    else{
        global $arrConf;
        $ruta_base = $arrConf['basePath'];
        require_once $ruta_base.'/libs/paloSantoConfig.class.php';
    }

    switch ($sNombreUsuario) {
    case 'root':
        if(is_file("/etc/issabel.conf")) {
            $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
            $listaParam = $pConfig->leer_configuracion(FALSE);
            if (isset($listaParam['mysqlrootpwd'])) {
                $ret = $listaParam['mysqlrootpwd']['valor'];
            } else {
                $ret = 'iSsAbEl.2o17'; 
            }
        }
        if(is_file("/etc/issabel.conf")) {
            $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
            $listaParam = $pConfig->leer_configuracion(FALSE);
            if (isset($listaParam['mysqlrootpwd'])) {
                $ret = $listaParam['mysqlrootpwd']['valor'];
            } else {
                $ret = 'iSsAbEl.2o17'; 
            }
        }
        return $ret;
        break;
    case 'asteriskuser':
        $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
        $listaParam = $pConfig->leer_configuracion(FALSE);
        if (isset($listaParam['AMPDBPASS']))
            return $listaParam['AMPDBPASS']['valor'];
        break;
    }
    return NULL;
};

/**
 * Función para obtener la clave AMI del usuario admin, obtenida del archivo /etc/issabel.conf
 *
 * @param   string  $ruta_base          Ruta base para inclusión de librerías
 *
 * @return  string   clave en plaintext de AMI del usuario admin
 */

function obtenerClaveAMIAdmin($ruta_base='')
{
    require_once $ruta_base.'libs/paloSantoConfig.class.php';

    if(is_file('/etc/issabel.conf')) {
        $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
        $listaParam = $pConfig->leer_configuracion(FALSE);
        if(isset($listaParam["amiadminpwd"])) {
            $ret = $listaParam["amiadminpwd"]['valor'];
        } else {
            $ret = "issabel789";
        }
    }
    if(is_file('/etc/issabel.conf')) {
        $pConfig = new paloConfig("/etc", "issabel.conf", "=", "[[:space:]]*=[[:space:]]*");
        $listaParam = $pConfig->leer_configuracion(FALSE);
        if(isset($listaParam["amiadminpwd"])) {
            $ret = $listaParam["amiadminpwd"]['valor'];
        } else {
            $ret = "issabel789";
        }
    }
    return $ret;
}

/**
 * Función para construir un DSN para conectarse a varias bases de datos
 * frecuentemente utilizadas en Issabel. Para cada base de datos reconocida, se
 * busca la clave en /etc/issabel.conf o en /etc/amportal.conf según corresponda.
 *
 * @param   string  $sNombreUsuario     Nombre de usuario para interrogar
 * @param   string  $sNombreDB          Nombre de base de datos para DNS
 * @param   string  $ruta_base          Ruta base para inclusión de librerías
 *
 * @return  mixed   NULL si no se reconoce usuario, o el DNS con clave resuelta
 */
function generarDSNSistema($sNombreUsuario, $sNombreDB, $ruta_base='')
{
    require_once $ruta_base.'libs/paloSantoConfig.class.php';
    switch ($sNombreUsuario) {
    case 'root':
        $sClave = obtenerClaveConocidaMySQL($sNombreUsuario, $ruta_base);
        if (is_null($sClave)) return NULL;
        return 'mysql://root:'.$sClave.'@localhost/'.$sNombreDB;
    case 'asteriskuser':
        if(is_file("/etc/issabelpbx.conf")) {
            $pConfig = new paloConfig("/etc", "issabelpbx.conf", "=", "[[:space:]]*=[[:space:]]*");
            $listaParam = $pConfig->leer_configuracion(FALSE);
            return $listaParam['$amp_conf[\'AMPDBENGINE\']']['valor']."://".
                   $listaParam['$amp_conf[\'AMPDBUSER\']']['valor']. ":".
                   $listaParam['$amp_conf[\'AMPDBPASS\']']['valor']. "@".
                   $listaParam['$amp_conf[\'AMPDBHOST\']']['valor']. "/".$sNombreDB;
        } else if(is_file("/etc/freepbx.conf")) {
            $pConfig = new paloConfig("/etc", "freepbx.conf", "=", "[[:space:]]*=[[:space:]]*");
            $listaParam = $pConfig->leer_configuracion(FALSE);
            return $listaParam['$amp_conf[\'AMPDBENGINE\']']['valor']."://".
                   $listaParam['$amp_conf[\'AMPDBUSER\']']['valor']. ":".
                   $listaParam['$amp_conf[\'AMPDBPASS\']']['valor']. "@".
                   $listaParam['$amp_conf[\'AMPDBHOST\']']['valor']. "/".$sNombreDB;
        } else {
            $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
            $listaParam = $pConfig->leer_configuracion(FALSE);
            return $listaParam['AMPDBENGINE']['valor']."://".
                   $listaParam['AMPDBUSER']['valor']. ":".
                   $listaParam['AMPDBPASS']['valor']. "@".
                   $listaParam['AMPDBHOST']['valor']. "/".$sNombreDB;
        }
    }
    return NULL;
}

function isPostfixToIssabel2(){
    $pathImap    = "/etc/imapd.conf";
    $vitualDomain = "virtdomains: yes";
    $band = TRUE;
    $handle = fopen($pathImap, "r");
    $contents = fread($handle, filesize($pathImap));
    fclose($handle);
    if(strstr($contents,$vitualDomain)){
        $band = TRUE; // if the conf postfix is for Elastix 2.0
    }
    else{
        $band = FALSE;// if the conf postfix is for Elastix 1.6
    }
    return $band;
}

// Esta función revisa las bases de datos del framework (acl.db, menu.db, register.db, settings.db, samples.db) en caso de que no existan y se encuentre su equivalente pero con extensión .rpmsave entonces se las renombra.
// Esto se lo hace exclusivamente debido a la migración de las bases de datos .db del framework a archivos .sql ya que el último rpm generado que contenía las bases como .db las renombra a .rpmsave
function checkFrameworkDatabases($dbdir)
{
    $arrFrameWorkDatabases = array("acl.db","menu.db","register.db","samples.db","settings.db");
    foreach($arrFrameWorkDatabases as $database){
        if(!file_exists("$dbdir/$database") || filesize("$dbdir/$database")==0){
            if(file_exists("$dbdir/$database.rpmsave"))
                 rename("$dbdir/$database.rpmsave","$dbdir/$database");
        }
    }
}

function writeLOG($logFILE, $log)
{
    $logPATH = "/var/log/issabel";
    $path_of_file = "$logPATH/".$logFILE;

    $fp = fopen($path_of_file, 'a+');
    if ($fp) {
        fwrite($fp,date("[M d H:i:s]")." $log\n");
        fclose($fp);
    }
    else
        echo "The file $logFILE couldn't be opened";
}

function verifyTemplate_vm_email()
{
   $ip = $_SERVER['SERVER_ADDR'];
   $login = "?login=\${VM_MAILBOX}";
   $file = "/etc/asterisk/vm_email.inc";
   //http://AMPWEBADDRESS/recordings/index.php?login=${VM_MAILBOX}
   $file_string = file_get_contents($file);
   if($file_string){
      $file_string_new = str_replace("*98","*97", $file_string);

      if(preg_match("/https?:\/\/(.*)\/recordings\/index\.php/",$file_string_new,$arrVar)){
         if(is_array($arrVar) && count($arrVar) > 1){
             $ip_old = $arrVar[1];
             if($ip_old != $ip)
                $file_string_new = str_replace($ip_old, $ip, $file_string_new);
         }
      }

      if(preg_match("/https?:\/\/.*\/recordings\/index\.php(\s|\?login=\$\{VM_MAILBOX\})/",$file_string_new,$arrVar)){
         if(is_array($arrVar) && count($arrVar) > 1){
             $login_old  = $arrVar[1];
             if($login_old != $login)
                $file_string_new = str_replace("index.php","index.php$login", $file_string_new);
         }
      }

      if($file_string != $file_string_new)
         file_put_contents($file, $file_string_new);
   }
}

function getMenuColorByMenu($pdbACL, $uid)
{
    /* Desde el commit SVN #3231 hecho por (quien ya sabemos), se ha estado
     * almacenando el valor de menuColor bajo el perfil "default" del recurso
     * con ID=19, sin importar si existe realmente un recurso con ese ID, o su
     * identidad. Voy a asumir aquí que (quien ya sabemos) anotó el ID de
     * recurso para themes_system, así que se pedirá el valor para ese recurso
     * primero, y luego se consulta al recurso 19 si themes_system no tiene el
     * valor almacenado. */
    $pACL = new paloACL($pdbACL);
    $color = $pACL->getUserProfileProperty($uid, 'themes_system', 'default', 'menuColor');
    return is_null($color) ? $pACL->getUserProfileProperty($uid, 19, 'default', 'menuColor', '#454545') : $color;
}

/**
 * Procedimiento que almacena el item de menú como parte del historial de
 * navegación del usuario indicado por $uid. El historial del usuario debe
 * cumplir las siguientes propiedades:
 * - El historial es una lista con un máximo número de items (5), parecido, pero
 *   no idéntico, a una cola FIFO.
 * - Los items están ordenados por su ID de inserción. El item más reciente es
 *   el item de mayor número de inserción.
 * - Repetidas llamadas sucesivas a esta función con el mismo valor de $uid y
 *   $menu deben dejar la lista inalterada, asumiendo que no hayan otras
 *   ventanas de navegación abierta.
 * - Si la lista tiene su número máximo de items y se agrega un nuevo item que
 *   no estaba previamente presente en la lista, el item más antiguo se olvida.
 * - Si el item resulta idéntico en menú a uno que ya existe, debe de quitarse
 *   de su posición actual y colocarse en la parte superior de la lista. El
 *   número de items debe quedar inalterado.
 *
 * @param   object  $pdbACL     Objeto paloDB conectado a las tablas de ACL.
 * @param   object  $pACL       Objeto paloACL para consultar IDs de menú.
 * @param   integer $uid        ID de usuario para el historial
 * @param   string  $menu       Item de menú a insertar en el historial
 *
 * @return  bool    VERDADERO si se inserta el item, FALSO en error.
 */
function putMenuAsHistory($pdbACL, $pACL, $uid, $menu)
{
    global $arrConf;

    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if (empty($pDB->errMsg)) {
        $uissabel = get_key_settings($pDB, 'uissabel');
        if ((int)$uissabel != 0) return TRUE;
    }

	$id_resource = $pACL->getResourceId($menu);
    if (is_null($id_resource)) return FALSE;

    // Leer historial actual. El item 0 es el más reciente
    $sqlselect = <<<SQL_LEER_HISTORIAL
SELECT aus.id AS id, ar.id AS id_menu FROM acl_user_shortcut aus, acl_resource ar
WHERE id_user = ? AND type = 'history' AND ar.id = aus.id_resource
ORDER BY aus.id DESC
SQL_LEER_HISTORIAL;
    $historial = $pdbACL->fetchTable($sqlselect, TRUE, array($uid));
    if (!is_array($historial)) return FALSE;
    if (count($historial) > 0 && $historial[0]['id_menu'] == $id_resource)
        return TRUE;    // Idempotencia
    for ($i = 0; $i < count($historial); $i++) $historial[$i]['modified'] = FALSE;

    // Procesar la lista según las reglas requeridas
    $shiftindex = NULL;
    for ($i = 0; $i < count($historial); $i++) {
    	if ($historial[$i]['id_menu'] == $id_resource) {
    		$shiftindex = $i;
            break;
    	}
    }
    if (is_null($shiftindex) && count($historial) >= 5)
        $shiftindex = count($historial);

    // Insertar nuevo item al inicio, corriendo los items si es necesario
    if (!is_null($shiftindex)) {
    	for ($i = $shiftindex; $i > 0; $i--) if ($i < count($historial)) {
    		$historial[$i]['id_menu'] = $historial[$i - 1]['id_menu'];
            $historial[$i]['modified'] = TRUE;
    	}
        $historial[0]['id_menu'] = $id_resource;
        $historial[0]['modified'] = TRUE;
    } else array_unshift($historial, array('id' => NULL, 'id_menu' => $id_resource, 'modified' => TRUE));

    // Guardar en la DB todas las modificaciones
    $pdbACL->beginTransaction();
    foreach ($historial as $item) if ($item['modified']) {
    	if (is_null($item['id'])) {
    		$sqlupdate = 'INSERT INTO acl_user_shortcut (id_resource, id_user, type) VALUES (?, ?, ?)';
            $paramsql = array($item['id_menu'], $uid, 'history');
    	} else {
    		$sqlupdate = 'UPDATE acl_user_shortcut SET id_resource = ? WHERE id_user = ? AND type = ? AND id = ?';
            $paramsql = array($item['id_menu'], $uid, 'history', $item['id']);
    	}
        if (!$pdbACL->genQuery($sqlupdate, $paramsql)) {
            $pdbACL->rollBack();
            return FALSE;
        }
    }
    $pdbACL->commit();
    return TRUE;
}

function menuIsBookmark($pdbACL, $uid, $menu)
{
    require_once 'libs/paloSantoACL.class.php';

    $pACL = new paloACL($pdbACL);
    $tupla = $pdbACL->getFirstRowQuery(
        'SELECT COUNT(id) FROM acl_user_shortcut WHERE id_user = ? AND id_resource = ? AND type = ?',
        FALSE, array($uid, $pACL->getResourceId($menu), 'bookmark'));
    return (is_array($tupla) && ($tupla[0] > 0));
}

function getStatusNeoTabToggle($pdbACL, $uid)
{
    $tupla = $pdbACL->getFirstRowQuery(
        "SELECT description FROM acl_user_shortcut WHERE id_user = ? AND type = 'NeoToggleTab'",
        TRUE, array($uid));
    return (is_array($tupla) && count($tupla) > 0) ? $tupla['description'] : 'none';
}

/**
 * Funcion que se encarga obtener un sticky note.
 *
 * @return array con la informacion como mensaje y estado de resultado
 * @param string $menu nombre del menu al cual se le va a agregar la nota
 *
 * @author Eduardo Cueva
 * @author ecueva@palosanto.com
 */
function getStickyNote($pdbACL, $uid, $menu)
{
    require_once 'libs/paloSantoACL.class.php';

    $arrResult = array(
        'status'    =>  FALSE,
        'msg'       =>  'no_data',
        'data'      =>  _tr("Click here to leave a note."),
    );
    $pACL = new paloACL($pdbACL);
    $tupla = $pdbACL->getFirstRowQuery(
        'SELECT * FROM sticky_note WHERE id_user = ? AND id_resource = ?',
        TRUE, array($uid, $pACL->getResourceId($menu)));
    if (is_array($tupla) && count($tupla) > 0) {
    	$arrResult = array(
            'status'    =>  TRUE,
            'msg'       =>  '',
            'data'      =>  $tupla['description'],
            'popup'     =>  $tupla['auto_popup'],
        );
    }

    return $arrResult;
}

function get_default_timezone()
{
    $sDefaultTimezone = @date_default_timezone_get();
    if ($sDefaultTimezone == 'UTC') {
        $sDefaultTimezone = 'America/New_York';
        $regs = NULL;
        if (is_link("/etc/localtime") && preg_match("|/usr/share/zoneinfo/(.+)|", readlink("/etc/localtime"), $regs)) {
            $sDefaultTimezone = $regs[1];
        } elseif (file_exists('/etc/sysconfig/clock')) {
            foreach (file('/etc/sysconfig/clock') as $s) {
                $regs = NULL;
                if (preg_match('/^ZONE\s*=\s*"(.+)"/', $s, $regs)) {
                    $sDefaultTimezone = $regs[1];
                }
            }
        }
    }
    return $sDefaultTimezone;
}

// Set default timezone from /etc/sysconfig/clock for PHP 5.3+ compatibility
function load_default_timezone()
{
    date_default_timezone_set(get_default_timezone());
}

// Create a new Smarty object and initialize template directories
function getSmarty($mainTheme, $basedir = '/var/www/html')
{
    $smartyClass = 'Smarty';
    if (file_exists('/usr/share/php/Smarty/Smarty.class.php')) {
        require_once('Smarty/Smarty.class.php');
        if (!method_exists($smartyClass, 'get_template_vars')) {
            require_once('Smarty/SmartyBC.class.php');
            $smartyClass = 'SmartyBC';
        }
    } else if(file_exists('$basedir/libs/smarty/libs/Smarty.class.php'))
        require_once("$basedir/libs/smarty/libs/Smarty.class.php");
    else{
        global $arrConf;
        $basedir = $arrConf['basePath'];
        require_once("$basedir/libs/smarty/libs/Smarty.class.php");
    }

    $smarty = new $smartyClass();

    $smarty->template_dir = "$basedir/themes/$mainTheme";
    $smarty->config_dir =   "$basedir/configs/";
    $smarty->compile_dir =  "$basedir/var/templates_c/";
    $smarty->cache_dir =    "$basedir/var/cache/";
    $smarty->error_reporting = E_ALL & ~E_NOTICE;

    return $smarty;
}

function loadShortcut($pdbACL, $uid, &$smarty)
{
    global $arrConf;

    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if (empty($pDB->errMsg)) {
        $uissabel = get_key_settings($pDB, 'uissabel');
        if ((int)$uissabel != 0) return '';
    }

    if($uid === FALSE) return '';
    $sql = <<<SQL_BOOKMARKS_HISTORY
SELECT aus.id AS id, ar.description AS name, ar.id AS id_menu, ar.name AS namemenu
FROM acl_user_shortcut aus, acl_resource ar
WHERE id_user = ? AND type = ? AND ar.id = aus.id_resource
ORDER BY aus.id DESC
SQL_BOOKMARKS_HISTORY;

    $bookmarks = $pdbACL->fetchTable($sql, TRUE, array($uid, 'bookmark'));
    if (is_array($bookmarks) && count($bookmarks) >= 0)
    foreach (array_keys($bookmarks) as $i) {
        $bookmarks[$i]['name'] = _tr($bookmarks[$i]['name']);
    } else $bookmarks = NULL;
    $smarty->assign(array(
        'SHORTCUT_BOOKMARKS' => $bookmarks,
        'SHORTCUT_BOOKMARKS_LABEL' => _tr('Bookmarks'),
    ));

    $history = $pdbACL->fetchTable($sql, TRUE, array($uid, 'history'));
    if (is_array($history) && count($history) >= 0)
    foreach (array_keys($history) as $i) {
        $history[$i]['name'] = _tr($history[$i]['name']);
    } else $history = NULL;
    $smarty->assign(array(
        'SHORTCUT_HISTORY' => $history,
        'SHORTCUT_HISTORY_LABEL' => _tr('History'),
    ));

    return $smarty->fetch('_common/_shortcut.tpl');
}

function getTemplatesDirModule($module_name)
{
    global $arrConf;

    //folder path for custom templates
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    return "$base_dir/modules/$module_name/$templates_dir/{$arrConf['theme']}";
}
?>
