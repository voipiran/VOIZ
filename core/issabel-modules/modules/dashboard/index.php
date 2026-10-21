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
  $Id: index.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/

require_once 'libs/paloSantoJSON.class.php';

function _moduleContent($smarty, $module_name)
{
    require_once "modules/$module_name/libs/paloSantoApplets.class.php";

	load_language_module($module_name);

    $smarty->assign("module_name",  $module_name);

    // Leer lista de applets implementados y validar con directorio
    $paloApplets = new paloSantoApplets();
    $appletlist = $paloApplets->leerAppletsActivados($_SESSION["issabel_user"]);
    $t = array();
    foreach ($appletlist as $applet) {
    	if (is_dir("modules/$module_name/applets/{$applet['applet']}"))
            $t[] = $applet;
    }
    $appletlist = $t;

    // Verificar si se pide una petición para un applet individual
    $appletnames = array();
    foreach ($appletlist as $applet) { $appletnames[] = $applet['applet']; }
    if (isset($_REQUEST['applet']) && !in_array($_REQUEST['applet'], $appletnames))
        unset($_REQUEST['applet']);
    if (isset($_REQUEST['applet'])) {
        if (file_exists("modules/$module_name/applets/{$_REQUEST['applet']}/lang/en.lang"))
            load_language_module("$module_name/applets/{$_REQUEST['applet']}");
        require_once "modules/$module_name/applets/{$_REQUEST['applet']}/index.php";
    }

    $h = 'handleHTML_appletGrid';
    if (isset($_REQUEST['action'])) {
        $h = NULL;
        $regs = NULL;
        if (preg_match('/^\w+$/', $_REQUEST['action'])) {
            if (isset($_REQUEST['applet']) && preg_match('/^\w+$/', $_REQUEST['applet'])) {
                $classname = 'Applet_'.ucfirst($_REQUEST['applet']);
                $methodname = 'handleJSON_'.$_REQUEST['action'];
                
                if (class_exists($classname)) {
                	$appletobj = new $classname;
                    if (method_exists($appletobj, $methodname)) {
                        $h = array($appletobj, $methodname);                
                    }
                }
                
            }
            if (is_null($h) && function_exists('handleJSON_'.$_REQUEST['action']))
                $h = 'handleJSON_'.$_REQUEST['action'];
        }
        if (is_null($h))
            $h = 'handleJSON_unimplemented';
    }        
    return call_user_func($h, $smarty, $module_name, $appletlist);
}

function handleHTML_appletGrid($smarty, $module_name, $appletlist)
{
    $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/themes/default";
    
    $smarty->assign("title", htmlentities(_tr('Dashboard'), ENT_COMPAT, 'UTF-8'));
    $smarty->assign("icon","modules/$module_name/images/system_dashboard.png");
    $smarty->assign("LABEL_LOADING",  _tr('Loading'));
    
    // Partir los applets en las columnas requeridas
    $applet_col_1 = array();
    $applet_col_2 = array();
    foreach ($appletlist as $i => $applet) {
    	$applet['name'] = _tr($applet['name']);
        if ($i % 2)
            $applet_col_2[] = $applet;
        else $applet_col_1[] = $applet;
    }
    $smarty->assign('applet_col_1', $applet_col_1);
    $smarty->assign('applet_col_2', $applet_col_2);
    
    return $smarty->fetch("$local_templates_dir/appletgrid.tpl");
}

function handleJSON_unimplemented($smarty, $module_name, $appletlist)
{
    $json = new Services_JSON();
    Header('Content-Type: application/json');
    return $json->encode(array(
        'status'    =>  'error',
        'message'   =>  _tr('Unimplemented method'),
    ));
}

function handleJSON_updateOrder($smarty, $module_name, $appletlist)
{
    $respuesta = array(
        'status'    =>  'success',
        'message'   =>  '(no message)',
    );
    
    if (!isset($_REQUEST['appletorder']) || !is_array($_REQUEST['appletorder'])) {
    	$respuesta['status'] = 'error';
        $respuesta['message'] = _tr('Invalid request');
    } else {
        $paloApplets = new paloSantoApplets();
        if (!$paloApplets->actualizarOrdenApplets($_SESSION["issabel_user"], $_REQUEST['appletorder'])) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = $paloApplets->errMsg;
        }
    }
    
    $json = new Services_JSON();
    Header('Content-Type: application/json');
    return $json->encode($respuesta);
}
?>